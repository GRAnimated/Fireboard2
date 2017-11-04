<?php

if ($isHidden) return;

$c1 = ircColor(Settings::pluginGet("color1"));
$c2 = ircColor(Settings::pluginGet("color2"));

$thename = $loguser["name"];
if($loguser["displayname"])
	$thename = $loguser["displayname"];
	
$fpage = ircForumPrefix($forum);
$link = getServerDomainNoSlash().actionLink("thread", $tid, "", $thread['title']);

ircReport("New thread by "
	.ircUserColor($thename, $loguser['sex'], 0)
	.": "
	.$thread["title"]
	." (".$fpage.$forum["title"].")"
	." -- "
	.$link
	);
