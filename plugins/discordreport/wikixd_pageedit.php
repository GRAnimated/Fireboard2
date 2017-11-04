<?php

$c1 = ircColor(Settings::pluginGet("color1"));
$c2 = ircColor(Settings::pluginGet("color2"));

$thename = $loguser["name"];
if($loguser["displayname"])
	$thename = $loguser["displayname"];
$uncolor = ircUserColor($thename, $loguser['sex'], 0);

$link = getServerDomainNoSlash().actionLink("wiki", $page['id'], '', '_');

if ($page['new'] == 2)
	ircReport("New wiki page: ".url2title($page['id'])." created by {$thename} -- {$link}");
else
	ircReport("Wiki page ".url2title($page['id'])." edited by {$thename} (rev. {$rev}) -- {$link}");
	
?>
