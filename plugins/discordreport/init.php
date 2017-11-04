<?php
//Copyright EzioisAwesome56 for discord code
//You need a channel webhook URL for this to work correctly
function ircReport($stuff)
{
	$data = array("content" => $stuff, "username" => Settings::pluginGet("username"), "avatar_url" => Settings::pluginGet("image"),);
    $curl = curl_init(Settings::pluginGet("webhook"));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $fartz = curl_exec($curl);
	if (Settings::pluginGet("extra") == "yes")
	{
		$curl2 = curl_init(Settings::pluginGet("webhook2"));
		curl_setopt($curl2, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl2, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
		$icecapzone = curl_exec($curl2);
	}
}
// dummy functions, they do nothing at all, but there so I dont have to delete stuff
function ircColor($c)
{
	return "";
}
function ircForumPrefix($forum)
{
	return "";
}
// oringal functions edited so they spit out what is required and nothing else
function ircUserColor($name, $gender, $power) {
	return $name;
}