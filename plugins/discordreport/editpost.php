<?php

if ($isHidden) return;

$thename = $loguser["name"];
if($loguser["displayname"])
	$thename = $loguser["displayname"];
	
$fpage = ircForumPrefix($forum);
$link = getServerDomainNoSlash().actionLink("post", $pid);

ircReport("Post edited by "
	.ircUserColor($thename, $loguser['sex'], 0)
	.": "
	.$thread["title"]
	."(".$fpage.$forum["title"].")"
	." -- "
	.$link
	);
	
?>
