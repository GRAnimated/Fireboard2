<?php

if ($loguserid != 1) { require('pages/404.php'); return; }

$key = hash('sha256', "{$loguserid},{$loguser['pss']},".SALT."9aHVbAoEjM6AqxvjeEWhXzhY");

if ($_POST['stuff'] && $_POST['key'] === $key)
	ircReport($_POST['stuff']);

echo '
<form action="" method="POST">
	<table class="outline margin width100">
		<tr class="header1"><th>Secret Discord reporting control</th></tr>
		<tr class="cell1"><td><input type="text" name="stuff" maxlength="2000" style="width:100%;"></td></tr>
		<tr class="cell0"><td><input type="submit" value="Send"></td></tr>
	</table>
	<input type="hidden" name="key" value="'.$key.'">
</form>';

?>