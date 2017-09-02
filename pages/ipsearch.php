<?php

// Fireboard - IP search

CheckPermission('admin.ipsearch');

$ip = $_GET["id"];

if(!$ip)
	Kill(__("No IP specified."));

$links = array();
$links[] = "<a href=\"http://dnsquery.org/ipwhois/$ip\" target=\"_blank\">Whois Query</a>";
$links[] = "<a href=\"#ipban\">IP ban</a>";

MakeCrumbs(array(actionLink("admin") => __("Admin"), actionLink("ipsearch") => __("IP search"), '' => $ip), $links);


$rUsers = Query("select * from {users} where lastip={0}", $ip);

$rGuests = Query("select * from {guests} where ip={0}", $ip);

// Get all users with the IP searched and print them all.
echo "<h3>Users with this IP</h3>";

$userList = "";
$ipBanComment = "";
$i = 1;
if(NumRows($rUsers))
{
	while($user = Fetch($rUsers))
	{
		$ipBanComment .= $user["name"]." ";
		$cellClass = ($cellClass+1) % 2;
		if($user['lasturl'])
			$lastUrl = "<a href=\"".$user['lasturl']."\">".$user['lasturl']."</a>";
		else
			$lastUrl = __("None");

		$userList .= format(
	"
		<tr class=\"cell{0}\">
			<td>
				{1}
			</td>
			<td>
				{2}
			</td>
			<td>
				{3}
			</td>
			<td>
				{4}
			</td>
			<td>
				{5}
			</td>
			<td>
				{6}
			</td>
		</tr>
	",	$cellClass, $i, UserLink($user), cdate("d-m-y G:i:s", $user['lastactivity']),
		($user['lastposttime'] ? cdate("d-m-y G:i:s",$user['lastposttime']) : __("Never")),
		$lastUrl, formatIP($user['lastip']));
		$i++;
	}
}
else
	$userList = "<tr class=\"cell0\"><td colspan=\"6\">".__("No users")."</td></tr>";

// Get all guests with matching IP and print them all.
/* broken right now
if(NumRows($rGuests))
{
	while($user = Fetch($rGuests))
	{
		$ipBanComment .= "Guest";
		$cellClass = ($cellClass+1) % 2;
		if($user['lasturl'])
			$lastUrl = "<a href=\"".$user['lasturl']."\">".$user['lasturl']."</a>";
		else
			$lastUrl = __("None");

		$userList .= format(
	"
		<tr class=\"cell{0}\">
			<td>
				{1}
			</td>
			<td>
				{2}
			</td>
			<td>
				{3}
			</td>
			<td>
				{4}
			</td>
			<td>
				{5}
			</td>
			<td>
				{6}
			</td>
		</tr>
	",	formatIP($user['lastip']));
		$i++;
	}
} */

echo "<form id=\"banform\" action=\"".actionLink('ipbans')."\" method=\"post\">
	<input type=\"hidden\" name=\"ip\" value=\"$ip\">
	<input type=\"hidden\" name=\"reason\" value=\"".htmlentities($ipBanComment)."\">
	<input type=\"hidden\" name=\"days\" value=\"0\">
	<input type=\"hidden\" name=\"actionadd\" value=\"yes, do it!\">
</form>";

echo "
	<table class=\"outline margin\">
		<tr class=\"header1\">
			<th style=\"width: 30px;\">
				#
			</th>
			<th>
				".__("Name")."
			</th>
			<th style=\"width: 140px;\">
				".__("Last view")."
			</th>
			<th style=\"width: 140px;\">
				".__("Last post")."
			</th>
			<th>
				".__("URL")."
			</th>
			<th style=\"width: 140px;\">
				".__("IP")."
			</th>
		</tr>
		$userList
	</table>";
	
	if(isset($_POST['actionadd']))
{
	//This doesn't allow you to ban IP ranges...
	//if(!filter_var($_POST['ip'], FILTER_VALIDATE_IP))
	//	Alert("Invalid IP");
	//else
	if(isIPBanned($_POST['ip']))
		Alert("Already banned IP!");
	else
	{
		$rIPBan = Query("insert into {ipbans} (ip, reason, date) values ({0}, {1}, {2})", $_POST['ip'], $_POST['reason'], ((int)$_POST['days'] > 0 ? time() + ((int)$_POST['days'] * 86400) : 0));
		Alert(__("Added."), __("Notice"));
	}
}
elseif($_GET['action'] == "delete")
{
	$rIPBan = Query("delete from {ipbans} where ip={0} limit 1", $_GET['ip']);
	Alert(__("Removed."), __("Notice"));
}

$rIPBan = Query("select * from {ipbans} order by date desc, ip asc");

echo "<h3 id=\"ipban\">IP ban</h3>";

print "
<form action=\"".actionLink("ipbans")."\" method=\"post\">
	<table class=\"outline margin width50\">
		<tr class=\"header1\">
			<th colspan=\"2\">
				".__("Add")."
			</th>
		</tr>
		<tr>
			<td class=\"cell2\">
				".__("IP")."
			</td>
			<td class=\"cell0\">
				<input type=\"text\" name=\"ip\" style=\"width: 98%;\" maxlength=\"45\" value=\"$ip\" />
			</td>
		</tr>
		<tr>
			<td class=\"cell2\">
				".__("Reason")."
			</td>
			<td class=\"cell1\">
				<input type=\"text\" name=\"reason\" style=\"width: 98%;\" maxlength=\"100\" />
			</td>
		</tr>
		<tr>
			<td class=\"cell2\">
				".__("For")."
			</td>
			<td class=\"cell1\">
				<input type=\"text\" name=\"days\" size=\"13\" maxlength=\"13\" /> ".__("days")."
			</td>
		</tr>
		<tr class=\"cell2\">
			<td></td>
			<td>
				<input type=\"submit\" name=\"actionadd\" value=\"".__("Add")."\" />
			</td>
		</tr>
	</table>
</form>";

