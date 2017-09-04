<?php
// Fireboard - Discord intergration widget plugin
// Put this into your settings for the link
// https://discordapp.com/widget?id=the numbers
// JUST COPY THAT. NOTHING ELSE.


function widgetdiscord() {
		file_get_contents(Settings::pluginGet('url'));
}

$discor = $loguser['name']

	echo "
	<iframe src=\"https://discordapp.com/widget?id=$widgetdiscord&username=$discor&theme=dark\" width=\"350\" height=\"500\" allowtransparency=\"true\" frameborder=\"0\"></iframe>
";
?>
