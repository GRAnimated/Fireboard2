<?php

echo getForm('leveldepo');

RenderTemplate('form_welcome', array('fields' => $fields));

echo '
	</form>';

$rFora = Query("select * from {forums} where id = {0}", Settings::pluginget('depoForum'));
if(NumRows($rFora))
{
	$forum = Fetch($rFora);
	if(!HasPermission('forum.viewforum', $forum['id']))
		return;
} else
	return;
	

RenderTemplate('form_lvluserpanel', array('form_lvluserpanel' => $fields));
$fid = $forum['id'];

$total = $forum['numthreads'];

if(isset($_GET['from']))
	$from = (int)$_GET['from'];
else
	$from = 0;

$tpp = 3;

$rThreads = Query("	SELECT 
						t.id, t.title, t.closed, t.replies, t.lastpostid,
						p.id pid, p.date,
						pt.text,
						su.(_userfields),
						lu.(_userfields)
					FROM 
						{threads} t
						LEFT JOIN {posts} p ON p.thread=t.id AND p.id=t.firstpostid
						LEFT JOIN {posts_text} pt ON pt.pid=p.id AND pt.revision=p.currentrevision
						LEFT JOIN {users} su ON su.id=t.user
						LEFT JOIN {users} lu ON lu.id=t.lastposter
					WHERE t.forum={0} AND p.deleted=0
					ORDER BY p.date DESC LIMIT {1u}, {2u}", $fid, $from, $tpp);

$numonpage = NumRows($rThreads);

$pagelinks = PageLinks(actionLink('depot', '', 'from='), $tpp, $from, $total);

echo '<table><tr class="cell1" style="width: 90%; align: center;"><td><h2><center>';

RenderTemplate('pagelinks', array('pagelinks' => $pagelinks, 'position' => 'top'));

echo '</center></h2></td></tr></table> <div style="max-width: 90%; display: flex; flex-flow: row wrap; justify-content: space-around;">';

while($thread = Fetch($rThreads))
{
	$pdata = array();

	$starter = getDataPrefix($thread, 'su_');
	$last = getDataPrefix($thread, 'lu_');

	$tags = ParseThreadTags($thread['title']);
	
	$pdata['title'] = actionLinkTag(__($tags[0]), "thread", $thread['id']);

	$pdata['formattedDate'] = formatdate($thread['date']);
	$pdata['userlink'] = UserLink($starter);
	$pdata['text'] = CleanUpPost($thread['text'],$starter['name'], false, false);

	if (!$thread['replies'])
		$comments = 'No comments yet';
	else if ($thread['replies'] < 2)
		$comments = actionLinkTag('1 comment', 'post', $thread['lastpostid']).' (by '.UserLink($last).')';
	else
		$comments = actionLinkTag($thread['replies'].' comments', 'post', $thread['lastpostid']).' (last by '.UserLink($last).')';
	$pdata['comments'] = $comments;

	if ($thread['closed'])
		$newreply = __('Comments closed.');
	else if (!$loguserid)
		$newreply = actionLinkTag(__('Log in'), 'login').__(' to post a comment.');
	else if (HasPermission('forum.postthreads', $forum['id']))
		$newreply = actionLinkTag(__("Post a comment"), "newreply", $thread['id']);
	$pdata['replylink'] = $newreply;

	RenderTemplate('postdepo', array('post' => $pdata));
}

echo '</div> <br> <table><tr class="cell1"><td><h2><center>';

RenderTemplate('pagelinks', array('pagelinks' => $pagelinks, 'position' => 'bottom'));

echo '</center></h2></td></tr></table>';
?>