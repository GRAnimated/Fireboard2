<?php
	$settings = array(
		"username" => array(
			"type" => "text",
			"default" => "BlargReport",
			"name" => "Webhook username",
		),
		"webhook" => array(
			"type" => "text",
			"default" => "",
			"name" => "Discord webhook link",
		),
		"image" => array(
			"type" => "text",
			"default" => "https://maxcdn.icons8.com/Share/icon/Logos//discord_logo1600.png",
			"name" => "Webhook profile picture",
		),
		"extra" => array(
			"type" => "options",
			"options" => array('yes' => 'on', 'no' => 'off'),
			"default" => 'off',
			"name" => "Extra webhooks",
		),
		"webhook2" => array(
			"type" => "text",
			"default" => "",
			"name" => "Secondary Discord webhook link",
		),	
	);
?>
