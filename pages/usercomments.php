<?php
// Fireboard - User Comments
// seperate page for whatever reason

// 1 = enabled
// 0 = disabled
$usercomments = 1;

if($usercomments = 1) 
{
	
if($loguserid && $_REQUEST['token'] == $loguser['token'])
{
	if($_GET['action'] == "delete")
	{
		$postedby = FetchResult("SELECT cid FROM {usercomments} WHERE uid={0} AND id={1}", $id, (int)$_GET['cid']);
		if ($canDeleteComments || ($postedby == $loguserid && HasPermission('user.deleteownusercomments')))
		{
			Query("delete from {usercomments} where uid={0} and id={1}", $id, (int)$_GET['cid']);
			if ($loguserid != $id)
			{
				// dismiss any new comment notification that has been sent to that user, unless there are still new comments
				$lastcmt = FetchResult("SELECT date FROM {usercomments} WHERE uid={0} ORDER BY date DESC LIMIT 1", $id);
				if ($lastcmt < $user['lastprofileview'])
					DismissNotification('profilecomment', $id, $id);
			}
			die(header("Location: ".actionLink("profile", $id, '', $user['name'])));
		}
	}

	if(isset($_POST['actionpost']) && !IsReallyEmpty($_POST['text']) && $canComment)
	{
		$rComment = Query("insert into {usercomments} (uid, cid, date, text) values ({0}, {1}, {2}, {3})", $id, $loguserid, time(), $_POST['text']);
		if($loguserid != $id)
		{
			SendNotification('profilecomment', $id, $id);
		}
		die(header("Location: ".actionLink("profile", $id, '', $user['name'])));
	}
}


$canDeleteComments = ($id == $loguserid && HasPermission('user.deleteownusercomments')) || HasPermission('admin.adminusercomments');
$canComment = (HasPermission('user.postusercomments') && $user['primarygroup'] != Settings::get('bannedGroup')) || HasPermission('admin.adminusercomments');

$cpp = 15;
$total = FetchResult("SELECT
						count(*)
					FROM {usercomments}
					WHERE uid={0}", $id);

$from = (int)$_GET["from"];
if(!isset($_GET["from"]))
	$from = 0;
$realFrom = $total-$from-$cpp;
$realLen = $cpp;
if($realFrom < 0)
{
	$realLen += $realFrom;
	$realFrom = 0;
}
$rComments = Query("SELECT
		u.(_userfields),
		uc.id, uc.cid, uc.text, uc.date
		FROM {usercomments} uc
		LEFT JOIN {users} u ON u.id = uc.cid
		WHERE uc.uid={0}
		ORDER BY uc.date ASC LIMIT {1u},{2u}", $id, $realFrom, $realLen);

$pagelinks = PageLinksInverted(actionLink("profile", $id, "from=", $user['name']), $cpp, $from, $total);

$comments = array();
while($comment = Fetch($rComments))
{
	$cmt = array();
	
	$deleteLink = '';
	if($canDeleteComments || ($comment['cid'] == $loguserid && HasPermission('user.deleteownusercomments')))
		$deleteLink = "<small style=\"float: right; margin: 0px 4px;\">".
			actionLinkTag("&#x2718;", "profile", $id, "action=delete&cid=".$comment['id']."&token={$loguser['token']}")."</small>";
			
	$cmt['deleteLink'] = $deleteLink;
	
	$cmt['userlink'] = UserLink(getDataPrefix($comment, 'u_'));
	$cmt['formattedDate'] = relativedate($comment['date']);
	$cmt['text'] = CleanUpPost($comment['text']);
	
	$comments[] = $cmt;
}

$commentField = __("You are not allowed to post usercomments.");
if($canComment)
{
	$commentField = "
		<form name=\"commentform\" method=\"post\" action=\"".htmlentities(actionLink("profile"))."\">
			<input type=\"hidden\" name=\"id\" value=\"$id\">
			<input type=\"text\" name=\"text\" style=\"width: 80%;\" maxlength=\"255\">
			<input type=\"submit\" name=\"actionpost\" value=\"".__("Post")."\">
			<input type=\"hidden\" name=\"token\" value=\"{$loguser['token']}\">
		</form>";
}

RenderTemplate('profile', array(
	'comments' => $comments,
	'commentField' => $commentField,
}
else if($usercomments = 0) {
	$commentField = __("Profile comments are currently disabled.");

RenderTemplate('profile', array(
	'commentField' => $commentField,
}
?>