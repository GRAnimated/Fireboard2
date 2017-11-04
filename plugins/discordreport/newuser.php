<?php

$c1 = ircColor(Settings::pluginGet("color1"));
$c2 = ircColor(Settings::pluginGet("color2"));

$link = getServerDomainNoSlash().actionLink("profile", $user['id'], "", $user['name']);

	ircReport("New user: "
		.ircUserColor($user['name'], $user['sex'], 0)
		." -- "
		.$link
		);

