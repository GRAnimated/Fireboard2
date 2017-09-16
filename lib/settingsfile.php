<?php
if (!defined('BLARG')) die();

	$settings = array(
		"boardname" => array (
			"type" => "text",
			"default" => "Fireboard",
			"name" => "Board name",
			'category' => 'Board identity'
		),
		"metaDescription" => array (
			"type" => "text",
			"default" => "Fireboard Beta",
			"name" => "Meta description",
			'category' => 'Board identity'
		),
		"metaTags" => array (
			"type" => "text",
			"default" => "fireboard fire board",
			"name" => "Meta tags",
			'category' => 'Board identity'
		),
		"breadcrumbsMainName" => array (
			"type" => "text",
			"default" => "Main",
			"name" => "Text in breadcrumbs' first link",
			'category' => 'Board identity'
		),
		"menuMainName" => array (
			"type" => "text",
			"default" => "Main",
			"name" => "Text in menu's first link",
			'category' => 'Board identity'
		),
		
		"urlrewrit" => array (
		   "type" => "boolean",
		   "default" => "0", // disabled URL rewritting
		   "name" => "URL rewriting",
		   'category' => 'Presentation',
		),
		"dateformat" => array (
			"type" => "text",
			"default" => "m-d-y, h:i a",
			"name" => "Default date format",
			'category' => 'Presentation'
		),
		"guestLayouts" => array (
			"type" => "boolean",
			"default" => "0",
			"name" => "Show post layouts to guests",
			'category' => 'Presentation'
		),
		"defaultTheme" => array (
			"type" => "theme",
			"default" => "fireboard_red",
			"name" => "Default board theme",
			'category' => 'Presentation'
		),
		"showGender" => array (
			"type" => "boolean",
			"default" => "1",
			"name" => "Color usernames based on gender",
			'category' => 'Presentation'
		),
		"defaultLanguage" => array (
			"type" => "language",
			"default" => "en_US",
			"name" => "Board language",
			'category' => 'Presentation'
		),
		"tagsDirection" => array (
			"type" => "options",
			"options" => array('Left' => 'Left', 'Right' => 'Right'),
			"default" => 'Right',
			"name" => "Direction of thread tags",
			'category' => 'Presentation'
		),
		"alwaysMinipic" => array (
			"type" => "boolean",
			"default" => "0",
			"name" => "Show minipics everywhere",
			'category' => 'Presentation'
		),
		"showExtraSidebar" => array (
			"type" => "boolean",
			"default" => "1",
			"name" => "Show extra info in post sidebar",
			'category' => 'Presentation'
		),
		"profilePreviewText" => array (
			"type" => "textbbcode",
			"default" => "This is a sample post. You [b]probably[/b] [i]already[/i] [u]know[/u] what this is for.

[quote=Goomba][quote=Mario]Woohoo! [url=http://www.mariowiki.com/Super_Mushroom]That's what I needed![/url][/quote]Oh, nooo! *stomp*[/quote]

Well, what more could you [url=http://en.wikipedia.org]want to know[/url]? Perhaps how to do the classic infinite loop?
[code]while(true){
    printf(\"Hello World!
\");
}[/code]",
			"name" => "Post preview text",
			'category' => 'Presentation'
		),
		
		
		"postLayoutType" => array (
			"type" => "options",
			"options" => array('0' => 'Signature', '1' => 'Post header + signature', '2' => 'Post header + signature + sidebars'),
			"default" => '2',
			"name" => "Post layout type",
			'category' => 'Functionality'
		),
		"postAttach" => array (
			"type" => "boolean",
			"default" => "0",
			"name" => "Allow post attachments",
			'category' => 'Functionality'
		),
		"customTitleThreshold" => array (
			"type" => "integer",
			"default" => "0",
			"name" => "Custom title threshold (posts)",
			'category' => 'Functionality'
		),
		"oldThreadThreshold" => array (
			"type" => "integer",
			"default" => "3",
			"name" => "Old thread threshold (months)",
			'category' => 'Functionality'
		),
		"viewcountInterval" => array (
			"type" => "integer",
			"default" => "10000",
			"name" => "Viewcount report interval",
			'category' => 'Functionality'
		),
		"ajax" => array (
			"type" => "boolean",
			"default" => "1",
			"name" => "Enable AJAX",
			'category' => 'Functionality'
		),
		"ownerEmail" => array (
			"type" => "text",
			"default" => "",
			"name" => "Owner email address",
			"help" => "This email address will be shown to IP-banned users and on other occasions.",
			'category' => 'Functionality'
		),
		"mailResetSender" => array (
			"type" => "text",
			"default" => "",
			"name" => "Password Reset email sender",
			"help" => "Email address used to send the pasword reset e-mails. If left blank, the password reset feature is disabled.",
			'category' => 'Functionality'
		),
		"floodProtectionInterval" => array (
			"type" => "integer",
			"default" => "30",
			"name" => "Minimum time between user posts (seconds)",
			'category' => 'Functionality'
		),
		"nofollow" => array (
			"type" => "boolean",
			"default" => "0",
			"name" => "Add rel=nofollow to all user-posted links",
			'category' => 'Functionality'
		),
		"maintenance" => array (
			"type" => "boolean",
			"default" => "0",
			"name" => "Maintenance mode",
			'category' => 'Functionality',
			'rootonly' => 1,
		),
		
		
		'PoRATitle' => array(
			'type' => 'text',
			'default' => 'Dorpbox',
			'name' => 'PoRA title',
			'category' => 'Information',
		),
		"PoRAText" => array (
			"type" => "textbox",
			"default" => "Welcome to Fireboard. Edit this.",
			"name" => "PoRA text",
			'category' => 'Information',
		),
		
		'newsForum' => array(
			'type' => 'forum',
			'default' => '0',
			'name' => 'Latest News forum',
			'category' => 'Forum settings',
		),
		'anncForum' => array(
			'type' => 'forum',
			'default' => '0',
			'name' => 'Announcements forum',
			'category' => 'Forum settings',
		),
		"trashForum" => array (
			"type" => "forum",
			"default" => "0",
			"name" => "Trash forum",
			'category' => 'Forum settings',
		),
		"secretTrashForum" => array (
			"type" => "forum",
			"default" => "0",
			"name" => "Deleted threads forum",
			'category' => 'Forum settings',
		),
		
		
		'defaultGroup' => array (
			'type' => 'group',
			'default' => 0,
			'name' => 'Group for new users',
			'category' => 'Group settings',
			'rootonly' => 1,
		),
		'rootGroup' => array (
			'type' => 'group',
			'default' => 4,
			'name' => 'Group for root users',
			'category' => 'Group settings',
			'rootonly' => 1,
		),
		'bannedGroup' => array (
			'type' => 'group',
			'default' => -1,
			'name' => 'Group for banned users',
			'category' => 'Group settings',
			'rootonly' => 1,
		),
		
		'faqText' => array(
			'type' => 'texthtml',
			'default' => '<table class="outline margin width25" style="margin-left: auto; margin-right: auto;"><tbody>
    <tr class="header1"><th>Quick Navigation</th></tr>
    <tr class="cell0"><td><a href="#fineprint">The Fine Print</a></td></tr>
    <tr class="cell0"><td><a href="#faq">Frequently-Asked Questions</a></td></tr>
    <tr class="cell0"><td><a href="#rules">The Rules</a></td></tr>
</tbody></table>

<br>
<br>

<a name="fineprint"></a>
<table class="outline margin"><tbody>
    <tr class="header1"><th>The Fine Print</th></tr>
    <tr class="cell0"><td>
        <i>
            The site does not own and cannot be held responsible for statements made by members on the forum. This site is offered as-is to the user. Any statements made on the board may be altered or removed at the discretion of the staff. Furthermore, all users are expected to have read, understood, and agreed to this FAQ before posting.
We do not sell, distribute or otherwise disclose member information like IP addresses to any third party. If you have questions about any information contained in this FAQ, please send a private message with your question to a moderator or administrator before posting.<br>
            <br>
            The board uses cookies to keep track of your login session when you are logged in.
        </i>
    </td></tr>
</tbody></table>
<br><br>


<a name="faq"></a>
<table class="outline margin"><tbody>
    <tr class="header1"><th>Frequently-Asked Questions</th></tr>
    <tr class="header0"><th>And some infrequently-asked questions that should be here, too.</th></tr>
    <tr class="cell0"><td>
        <h4>Do I need to register to use the board?</h4>
        You can view the board without registering, but you need to register to post.
    </td></tr><tr class="cell0"><td>
        <h4>What are all of these different layouts I see on posts?</h4>
        They're called post layouts. It's a customization option on the board for your posts to stand out. 
    </td></tr><tr class="cell0"><td>
        <h4>Cool! How do I make one?</h4>
        You need to know the basics of CSS (style sheets) to make a post layout. Just make sure you abide by <a href="#post_layout_rules">the rules</a>, though.
    </td></tr><tr class="cell0"><td>
        <h4>What do the different username colors mean?</h4>
        Username colors indicate permissions levels. Use the following table for reference:<br>
        <br>
        
<table class="width50 outline" style="margin-left: auto; margin-right: auto;">
	<tr class="header1">
		
	<th>
		Male
	</th>

	<th>
		Female
	</th>

	<th>
		N/A
	</th>

	</tr>
	
<tr class="cell1">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #888888;">
			Banned
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #888888;">
			Banned
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #888888;">
			Banned
		</span></a>
	</td>

</tr>

<tr class="cell0">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #97ACEF;">
			Normal user
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #F185C9;">
			Normal user
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #7C60B0;">
			Normal user
		</span></a>
	</td>

</tr>

<tr class="cell1">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #D8E8FE;">
			Local moderator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #FFB3F3;">
			Local moderator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #EEB9BA;">
			Local moderator
		</span></a>
	</td>

</tr>

<tr class="cell0">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #70ba81;">
			Global moderator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #C762F2;">
			Global moderator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #47B53C;">
			Global moderator
		</span></a>
	</td>

</tr>

<tr class="cell1">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #FFEA95;">
			Administrator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #C53A9E;">
			Administrator
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #F0C413;">
			Administrator
		</span></a>
	</td>

</tr>

<tr class="cell0">
	
	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #5555FF;">
			Owner
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #FF5588;">
			Owner
		</span></a>
	</td>

	<td class="center" style="padding:2px!important;">
		<a href="javascript:void()"><span style="color: #FF55FF;">
			Owner
		</span></a>
	</td>

</tr>

</table>

    </td></tr><tr class="cell0"><td>
        <h4>I have a question about this board that is not answered here.</h4>
        That's not really a question, but we'll answer it anyway. First, read this:<br><br>
        Then, if you can't find the answer on your own, post your question as a new thread in the relevant forum. Make sure to show us that you've done your own research first.
    </td></tr>
</tbody></table>

<br>
<br>

<a name="rules"></a>
<table class="outline margin"><tbody>
    <tr class="header1"><th>The Rules</th></tr>
    <tr class="header0"><th>Posting: Don'ts</th></tr>
    <tr class="cell0"><td>
        <h4><u>Do not ask for copyrighted content, and do not post links to copyrighted content.</u></h4>
        This includes discussion of ISOs and ISO-related tools such as WiiScrubber. Violators of this rule will be banned.
    </td></tr><tr class="cell0"><td>
        <h4>Do not spam, troll, flame, harass, bash, etc.</h4>
    </td></tr><tr class="cell0"><td>
        <h4>Do not respond to spam, trolling, flaming, harassment, bashing, etc.</h4>
        The reason is that the staff then has to delete your post as well, and it wastes our time. Instead, report the offending post with the "Report" button in its top-right corner.
    </td></tr><tr class="cell0"><td>
        <h4>Do not bump old threads without a good reason.</h4>
        "I'm having the same problem but none of the answers above have helped" or "Here's some new information about this" are good reasons to bump a thread. "Thanks for posting this" or "bump" are not.
    </td></tr>
    <tr class="header0"><th>Posting: Courtesy</th></tr>
    <tr class="cell0"><td>
        <h4>Read before you post.</h4>
        Before asking a question, make sure the answer isn't already there.
    </td></tr><tr class="cell0"><td>
        <h4>Only post if you have something to add to a conversation.</h4>
        "yeah great idea!" or similar comments are not useful.
    </td></tr><tr class="cell0"><td>
        <h4>This is an English-speaking board.</h4>
        If you do not know English well, you can write your post in whatever language you are fluent in, provided it is followed by a English translation. You can use <a href="https://translate.google.com/">Google Translate</a> or an equivalent service for this.
    </td></tr><tr class="cell0"><td>
        <h4>Do not quote very long posts.</h4>
        This makes threads difficult to navigate.
    </td></tr>
    <tr class="header0"><th>
        <a name="post_layout_rules"></a>
        Post Layouts and Signatures
    </th></tr>
    <tr class="cell0"><td>
        <h4>Don't make your layout difficult to read.</h4>
        Having similar text and background colors makes it difficult to read your posts.
    </td></tr><tr class="cell0"><td>
        <h4>Don't make your layout too wild.</h4>
        This includes spamming animations or crazy colors, or causing pages to lag.
    </td></tr><tr class="cell0"><td>
        <h4>Don't put visible text in your layout header. Don't put visible text in your signature without showing the signature separator.</h4>
        Putting visible text in the header is confusing because it looks like part of your posts. This applies to signatures, too, though it's okay there if you check the "Show signature separator" box.
    </td></tr><tr class="cell0"><td>
        <h4>The maximum allowed height for signatures is 150 pixels.</h4>
        Users with signatures larger than 150px will be contacted by staff and asked to edit their signature so it fits. If they do not fix the signature within a day of being notified, the signature may be deleted.
    </td></tr><tr class="cell0"><td>
        <h4>The board's staff is allowed to and has the ability to modify or remove any post layout or signature at any time and for any reason.</h4>
    </td></tr>
    <tr class="header0"><th>User Accounts</th></tr>
    <tr class="cell0"><td>
        <h4>Do not make multiple accounts.</h4>
        This is known as "reregistering" (or simply "reregging"). Each user is allowed only one account. Duplicate accounts will be banned or deleted, and the user's original account may be banned as well.
    </td></tr><tr class="cell0"><td>
        <h4>Do not use PMs to harass other members.</h4>
    </td></tr><tr class="cell0"><td>
        <h4>Do not use proxy servers to access the board.</h4>
        Don't think that the staff can't figure out if you're doing this. If you have a legitimate reason to need a proxy, contact a staff member and explain your situation.
    </td></tr><tr class="cell0"><td>
        <h4>Do not PM an administrator with questions about games, consoles or help.</h4>
        That's what the forums are for. Only PM administrators about website-related issues.
    </td></tr>
    <tr class="header0"><th>Meta</th></tr>
    <tr class="cell0"><td>
        <h4>Violations of these rules may cause you to be warned or banned, at the staff's discretion.</h4>
    </td></tr><tr class="cell0"><td>
        <h4>The board's staff is allowed to make exceptions to any of the above rules at any time and for any reason.</h4>
    </td></tr>
</tbody></table>

<br>
<br>

<table class="outline margin width25" style="margin-left: auto; margin-right: auto;"><tbody>
    <tr class="header1"><th>And One More Thing</th></tr>
    <tr class="cell0 center"><td>Enjoy the board!</tr>
</tbody></table>',
			'name' => 'FAQ contents',
			'category' => 'FAQ contents',
		),
	);
?>
