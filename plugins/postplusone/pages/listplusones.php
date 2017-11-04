<?php
//  AcmlmBoard XD - Posts by user viewer
//  Access: all

if(!isset($pageParams['id']))
	Kill(__("User ID unspecified."));

$id = (int)$pageParams['id'];

$rUser = Query("select * from {users} where id={0}", $id);
if(NumRows($rUser))
	$user = Fetch($rUser);
else
	Kill(__("Unknown user ID."));

$title = __("+1 list");

$minpower = $loguser['primarygroup'];
if($minpower < 0)
	$minpower = 0;

/*error_reporting(E_ALL);
ini_set("display_errors", "on");
ini_set("display_startup_errors", "on");*/

$total = FetchResult("
			SELECT
				count(p.id)
			FROM
				{posts} p
				LEFT JOIN {threads} t ON t.id=p.thread
				LEFT JOIN {forums} f ON f.id=t.forum
			WHERE p.user={0} AND t.forum IN ({1c}) AND p.postplusones > 0",
		$id, ForumsWithPermission('forum.viewforum'));

$ppp = $loguser['postsperpage'];
if(isset($_GET['from']))
	$from = (int)$_GET['from'];
else
	$from = 0;

if(!$ppp) $ppp = 25;


$rPosts = Query("	SELECT
				p.*,
				pt.text, pt.revision, pt.user AS revuser, pt.date AS revdate,
				u.(_userfields), u.(rankset,title,picture,posts,postheader,signature,signsep,lastposttime,lastactivity,regdate,globalblock,fulllayout),
				ru.(_userfields),
				du.(_userfields),
				t.id thread, t.title threadname,
				f.id fid
			FROM
				{posts} p
				LEFT JOIN {posts_text} pt ON pt.pid = p.id AND pt.revision = p.currentrevision
				LEFT JOIN {users} u ON u.id = p.user
				LEFT JOIN {users} ru ON ru.id=pt.user
				LEFT JOIN {users} du ON du.id=p.deletedby
				LEFT JOIN {threads} t ON t.id=p.thread
				LEFT JOIN {forums} f ON f.id=t.forum
				LEFT JOIN {categories} c ON c.id=f.catid
			WHERE u.id={1} AND f.id IN ({4c}) AND p.postplusones > 0
			ORDER BY postplusones DESC, date ASC LIMIT {3u}, {4u}", $loguserid, $id, $from, $ppp, ForumsWithPermission('forum.viewforum'));

$numonpage = NumRows($rPosts);

$uname = $user["name"];
if($user["displayname"])
	$uname = $user["displayname"];

if($total == 0)
	Kill(__("This user has no +1'd posts"));

$pagelinks = PageLinks(actionLink("listplusones", $id, "from="), $ppp, $from, $total);

if($pagelinks)
	write("<div class=\"smallFonts pages\">".__("Pages:")." {0}</div>", $pagelinks);

if($numonpage > 0) {
	while($post = Fetch($rPosts))
		MakePost($post, POST_NORMAL, array('threadlink'=>1, 'tid'=>$post['thread'], 'fid'=>$post['fid'], 'noreplylinks'=>1));
}

if($pagelinks)
	write("<div class=\"smallFonts pages\">".__("Pages:")." {0}</div>", $pagelinks);

?>
