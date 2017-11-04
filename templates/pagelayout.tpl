
<table id="main" class="layout-table">
<tr>
<td id="main-header" colspan="2">
    <table id="header" class="outline">
        <tr>
            <td class="cell0 left">
                <table class="layout-table">
                <tr>
                <td>
					<a href="{actionLink page='board'}"><img id="theme_banner" title="{$title}" src="{$layout_logopic}" alt="{$boardname}" title="{$boardname}"></a>
                </td>
				{if $poratext}
				<td>
					<table class="outline" id="headerInfo">
						<tr class="header1"><th>{$poratitle}</th></tr>
						<tr>
							<td class="cell1 center">
								{if $layout_birthdays}<br>{$layout_birthdays}{/if}
								{if $poratext}{$poratext}{/if}
							</td>
						</tr>
						</tr>
					</table>
				</td>
			{/if}
        </tr>
			 <tr class="header1">
            <th id="navBar">
			<div id="navMenuContainer">
			    <div style="display:inline-block; float:left;">
			        {$layout_views}
			    </div>
                    <center>
                    <div class="dropdownContainer">
                        <div class="navButton">
                            <a href="{actionLink page='board'}">Forums</a>
                            <i class="icon-caret-down"></i>
                        </div>
                        <ul class="dropdownMenu">
						    <li><i class="fa fa-newspaper-o"></i><a href="{actionLink page='board'}">Index</a></li>
                            <li><i class="fa fa-reorder"></i><a href="{actionLink page='lastposts'}">Last posts</a></li>
                           <li> <i class="fa fa-search"></i><a href="{actionLink page='search'}">Search</a></li>
							 <i class="fa fa-question"></i><li><a href="{actionLink page='faq'}">FAQ/Rules</a></li>
                            <i class="fa fa-group"></i><li><a href="{actionLink page='memberlist'}">Member list</a></li>
<i class="fa fa-eye"></i><li><a href="{actionLink page='online'}">Online users</a></li>
                            <i class="fa fa-trophy"></i><li><a href="{actionLink page='ranks'}">Ranks</a></li>
							<li><a href="{actionLink page='stats'}">Stats</a></li>
                        </ul>
                    </div>
					{if $loguserid}
			 <div id="userMenuContainer" class="dropdownContainer">
						<div id="userMenuButton" class="navButton">
							{$loguserlink}
							<i class="icon-caret-down"></i>
						</div>
						<ul class="dropdownMenu">
							<li><a href="#" onclick="$('#logout').submit(); return false;">Logout</a>
    {if HasPermission('admin.viewadminpanel')}<li> <a href="{actionLink page='admin'}">Admin</a>{/if}
    <li><a href="{actionLink page='private'}">Private messages</a>
	<li><a href="{actionLink page='editprofile'}">Edit profile</a>
	{if HasPermission('user.editavatars')}<li> <a href="{actionLink page='editavatars'}">Mood avatars</a>{/if}
	<li><a href="../../?action=markallread">Mark forums read</a>
	<li><a href="{actionLink page='favorites'}">Favorite threads</a></li> 
						</ul>
					</div>
	<div class="dropdownContainer">
{$numnotifs=count($notifications)}
 					<div id="notifMenuContainer" class="dropdownContainer {if $numnotifs}hasNotifs{else}noNotif{/if}">
						    Notifications   
							<span id="notifCount">{$numnotifs}</span>
						</div>
						{if $numnotifs}
						<ul id="notifList" class="dropdownMenu">
							{foreach $notifications as $notif}
								<li>{$notif.text}<br><small>{$notif.formattedDate}</small>
							{/foreach}
						</ul>
						{/if}
					</div>
					<div style="display:inline-block; float:right;">
			        {$layout_time}
			     </div>
                    </div>
				  {else}
				   <div id="userMenuContainer" class="dropdownContainer">
						<div id="userMenuButton" class="navButton">
                            Guest:
							<i class="icon-caret-down"></i>
					    </div>
						<ul class="dropdownMenu">
                            <li><a href="{actionLink page='login'}">Log in</a> 
							<li><a href="{actionLink page='register'}">Register</a></li>
						</ul>
					</div>
					<div style="display:inline-block; float:right;">
			        {$layout_time}
			     </div>
                    {/if}
                 </center></div>
				
            </th>
        </tr>

		
<tr class="cell0">
			<td class="smallFonts center">
				{$layout_onlineusers}
			</td>
		</tr>
		{if $maintenancemode}
		<tr class="cell0">
			<td class="smallFonts center">
				{$maintenance}
			</td>
		</tr>
		{/if}
        <tr><th id="header-sep"></th></tr>
    </table>
</td>
</tr>
 
<tr>

 
{capture "breadcrumbs"}
{if $layout_crumbs || $layout_actionlinks}
        <table class="outline breadcrumbs"><tr class="header1">
            <th>
                {if $layout_actionlinks && count($layout_actionlinks)}
                <div class="actionlinks" style="float:right;">
                    <ul class="pipemenu smallFonts">
                    {foreach $layout_actionlinks as $alink}
                        <li>{$alink}
                    {/foreach}
                    </ul>
                </div>
                {/if}
                {if $layout_crumbs && count($layout_crumbs)}
                <ul class="crumbLinks">
                {foreach $layout_crumbs as $url=>$text}
                    <li><a href="{$url|escape}">{$text}</a>
                {/foreach}
                </ul>
                {/if}
            </th>
        </tr></table>
{/if}
{/capture}
 
<td id="main-page">
    <table id="page-container" class="layout-table">
    <tr><td class="crumb-container crumbContTop">
        {$smarty.capture.breadcrumbs}
    </td></tr>
{$boardblocklinks}
    <tr><td class="contents-container">
        {$layout_contents}
    </td></tr>
    <tr><td class="crumb-container crumbContBottom">
        {$smarty.capture.breadcrumbs}
    </td></tr>
    </table>
</td>
</tr>

<tr>
<td id="main-footer" colspan="2">

	<table id="footer" class="outline">
	<tr>
	<td class="cell2">
		<table class="layout-table" style="line-height: 1.4em;">
			<tr>
			<td style="text-align: left;">
				{$layout_credits}
			</td>
			<td style="text-align: right;">
				{$perfdata}
			</td>
		</table>
	</td>
	</tr>
	</table>

</td>
</tr>
</tr>
</table>
