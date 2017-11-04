<?php

error_reporting(E_ALL);

CheckPermission('admin.usernuke');

$title = __("Delete the user");

makeCrumbs([actionlink('deleteuser') => __("Delete User")]);

$uid = (int)$_GET["id"];

$user = fetch(query("select * from {users} where id={0}", $uid));

if(!$user)
	Kill(__("You cannot delete a user that doesn't exist."));

$passwordFailed = false;

if(isset($_POST["currpassword"])) {
	$sha = doHash($_POST['currpassword'].SALT.$loguser['pss']);
	if($loguser['password'] == $sha) {

		//Delete posts from threads by user
		query("delete pt from {posts_text} pt
				left join {posts} p on pt.pid = p.id
				left join {threads} t on p.thread = t.id
				where t.user={0}", $uid);
		query("delete p from {posts} p
				left join {threads} t on p.thread = t.id
				where t.user={0}", $uid);

		//Delete posts by user			
		query("delete pt from {posts_text} pt
				left join {posts} p on pt.pid = p.id
				where p.user={0}", $uid);
		query("delete p from {posts} p
				where p.user={0}", $uid);

		//Delete threads by user
		query("delete t from {threads} t
				where t.user={0}", $uid);

		//Delete usercomments by user or to user
		query("delete from {usercomments}
				where uid={0} or cid={0}", $uid);

		//Delete the PM's sent to the user or sent by the user
		query("delete pt from {pmsgs_text} pt
			left join {pmsgs} p on pt.pid = p.id
			where p.userfrom={0} or p.userto={0}", $uid);
		query("delete p from {pmsgs} p
			where p.userfrom={0} or p.userto={0}", $uid);
			
		//Delete all the badges of the user.
		Query("delete from {badges} where owner = {0}", $uid);

		//Delete THE USER ITSELF
		query("delete from {users}
				where id={0}", $uid);

		//and then IP BAN HIM
		query("insert into {ipbans} (ip, reason, date) 
				values ({0}, {1}, 0)
				on duplicate key update ip=ip", $user["lastip"], "Deleting ".$user["name"]);

		//Log that the user is deleted: Just a safety check if an admin wants to know what happend to that user, and not make the user dissapear without a trace. It also now displays his ID (In case the delete function didn't delete something and an account has some problems, you know if its linked or not) and who nuked him.
		Report("[b]".$loguser['name']."[/] successfully deleted ".$user["name"]." (#".$uid.").");

		echo "User deleted!<br/>";
		echo "You will need to ", actionLinkTag("Recalculate statistics now", "recalc");

		throw new KillException();
	} else
		$passwordFailed = true;
}

if($passwordFailed) {
	Report("[b]".$loguser['name']."[/] tried to delete ".$user["name"]." (#".$uid.").");
	Alert("Invalid password. Please try again.");
}

echo "
<form name=\"confirmform\" action=\"".actionLink("nuke", $uid)."\" method=\"post\" onsubmit=\"actionlogin.disabled = true; return true;\">
	<table class=\"outline margin width50\">
		<tr class=\"header0\">
			<th colspan=\"2\">
				".__("Delete the user!!")."
			</th>
		</tr>
		<tr>
			<td class=\"cell2\">
			</td>
			<td class=\"cell0\">
				".__("WARNING: This will IP-ban the user, and permanently and irreversibly delete the user itself and all his posts, threads, private messages, and profile comments. This user will be gone forever, as if he never existed.")."
				<br/><br/>
				".__("Please enter your password to confirm.")."
			</td>
		</tr>
		<tr>
			<td class=\"cell2\">
				<label for=\"currpassword\">".__("Password")."</label>
			</td>
			<td class=\"cell1\">
				<input type=\"password\" id=\"currpassword\" name=\"currpassword\" size=\"13\" maxlength=\"32\" />
			</td>
		</tr>
		<tr class=\"cell2\">
			<td></td>
			<td>
				<input type=\"submit\" name=\"actionlogin\" value=\"".__("Delete the user!!")."\" />
			</td>
		</tr>
	</table>
</form>";