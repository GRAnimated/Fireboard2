# Blargboard 1.3.5 (when the old Fireboard todo list is done, this will be merged)

-------------------------------------------------------------------------------

Board software written in PHP. Uses MySQL for storage.

This is the software that will power my forums (http://firecharge64.bplaced.net) and Mario Making Mods (http://mariomods.net)
in the near future.

It is based off ABXD (and Blargboard, it's forked of course!). ABXD is a project based off of Acmlmboard started by Kawa
and is now maintained by Dirbaio. Development for that project has gone down the drain after 2013. Blargboard however was
created by StapleButter and had a few of its commits done by Ninjifox. Started in mid-2013, Blargboard was meant to be the
successor to ABXD but ceased development in July 2014 due to the derps making derpboards (including myself).

It uses Smarty for its templates, Font Awesome, jQuery, JSColor and maybe some other stuff we forgot about.
In the near future reCAPTCHA, Securimage, whatever you want to use in the near future when this is implemented.

Blargboard 1.3.5 follows the Blargboard structure.

## Requirements

This board software (Blargboard 1.3.5) requires at least PHP 5.5, but with a few PHP changes this could be lowered
to PHP 5.3. You will also need the mcrypt extension, and a server that supports cURL if you want proxy protection.

MySQL wise, you will need the most recent version for security fixes, bug fixes, etc. If you're using PHP 7.0,
you will need to use MySQLi. I am sure it will work with BB1.3.5 with a few SQL and PHP changes.

Everything else is provided in the package.

## How to install and use

PHP and MySQL knowledge isn't required to use Blargboard but is a plus.

PHP knowledge and maybe JS/HTML knowledge is required if you want to make a plugin,
and you will have to understand the codebase.

Get a host, webserver, VPS, whatever. (The free one I recommend is a) Byethost and b) Bplaced)
Upload the codebase to it. Create a MySQL database.

Go to your site (http://my.board.for.example) and you will be redirected to "Blargboard installer",
if the common.php file is working properly.

If you cannot get to the install.php page, download JeDaYoshi's fork of Blargboard. That is going to work.

If everything went fine, browse to your freshly installed board and configure it. If not, let us know.

We recommend you take some time and make your own board themes and banner to give your board a truly unique feel.
If you have HTML knowledge, you can even edit the templates to change your board's look more in-depth.

## Working plugins

The following plugins have been updated and are known to work with current Blargboard. Any other plugins in the repo are probably broken, so don't try using them.

 * Calendar
 * postplusone
 * CustomUserNameColors
 * layoutblockstats

## How to update your board

Download the most recent Blargboard package (be it an official release or a Git package).

Copy the files over your existing board's files.

Make sure to not overwrite/delete the config directory, especially config/salt.php! Lose that one and you'll have fun resetting everyone's passwords.
Everything else is safe to overwrite. Be careful to not lose any changes you have made, though.

Once that is done, run update.php (http://my.board.for.example/update.php) to update the board's database structure.

Depending on the versions, your update may involve running extra scripts to fix certain things. Make sure to follow those instructions.


Updating from Blargboard 1.0 isn't covered.

## Features

 * Flexible permission system
 * Plugin system
 * Templates (in the works, about 80% done)
 * URL rewriting, enables human-readable forum and thread URLs for public content (requires code editing to enable it as of now, and
 is broken for pages such as IP Search)
 * Post layouts
 * more Acmlmboard feel
 * typical messageboard features

-------------------------------------------------------------------------------

Coders and such, who like to hack new features in their software, may think that the use
of templates in Blargboard gets in their way. Well uh, can't please everybody. I tried to
do my best at separating logic and presentation. Besides, the use of templates actually
makes the code nicer. Just look at the first few revisions and see how much duplicate logic
is powering the mobile layout, for example. Templates allowed to get rid of all that madness.

As of now, there are no official releases for this, and the ABXD database installer hasn't
been adapted to Blargboard's database structure yet. Thus, when updating your Blargboard
copy, you need to check for changes to database.sql and modify your database's structure
accordingly.

## Board owner's tips

http://board.example/?page=makelr -> regenerates the L/R tree used for forum listings and such.
Use if some of your forums are showing up in wrong places.

http://board.example/?page=ipsearch&id=X -> IP search, retrieves all users with that exact IP

http://board.example/?page=rereg -> Rereg Radar, retrieves all users who have a matching IP or password

http://board.example/?page=editperms&gid=X -> edit permissions for group ID X.

http://board.example/?page=secgroups -> assign secondary groups to a user.


How to add groups: add to the usergroups table via PMA
 * type: 0 for primary groups, 1 for secondary
 * display: 0 for normal group, 1 for group listed as staff, -1 for hidden group
 * rank: a user may not mess with users of higher ranks no matter his permissions

 
How to add/remove secondary groups to someone: add to/remove from the secondarygroups table via PMA (or use ?page=secgroups for adding)
 * userid: the user's ID
 * groupid: the group's ID. Do not use the ID of a primary group!
 
WARNING: when banning someone, make sure that the secondary groups' permissions won't override the banned group's permissions. If that happens, you'll need to delete the secondarygroups assignments for the user.


How to (insert action): first look into your board's admin panel, settings panel, etc... then if you still can't find, ask us. But please don't be a noob and ask us about every little thing.

## Support, troubleshooting, etc

If the error is a 'MySQL Error', to get a detailed report, you need to open config/database.php in a text editor, find `$debugMode = 0;` and replace it with `$debugMode = 1;`. 
This will make the board give you the MySQL error message and the query which went wrong. Once you're done troubleshooting your board, it is recommended that you edit config/database.php back so that `$debugMode` is 0.

YOU WILL NOT RECEIVE HELP IF YOU HAVEN'T READ THE INSTRUCTIONS WHEN INSTALLING YOUR BOARD.

## TODO list

(no particular order there)

 * finish implementing templates
 * improve the permission editing interfaces
 * port the 'show/hide sidebar' feature from Kuribo64? or just nuke the sidebar? more leaning towards the latter.
 * merge/split threads a la phpBB (albeit without the shitty interface)
 * support multiple password hashing methods? (for importing from other board softwares, or for those who feel SHA256 with per-user salt isn't enough) (kinda addressed via login plugins)
 * more TODO at Kuribo64 and RVLution
 
 * low priority: change/remove file headers? most of the original files still say 'AcmlmBoard XD'
 * besides it'd be an opportunity to add a license like the GPL
 
 ## Fireboard TODO list
 
1) Make PMs like threads
2) When msgread=1 in the database, show "Conversation read by:'.$readUser.';"
3) Fix proxy protection, use SFS' tor JSON check.
4) Finish the name search, AJAX file
5) Use an AJAX name search request to suggest usernames in sendprivate
6) Port quite a lot of old ABXD plugins
7) Fix the Post +1 plugin, aka add the list plus ones page
8) Fix rewritten links
9) Implement a warning system
10) Make a discord plugin, where you enter your discord link and it embeds it in an iframe
11) Make it easier to add forum moderators, like on ABXD
12) Add a few different layouts and the ability to choose between them <ul>
<li>Acmlmboard</li>
<li>ABXD New</li>
<li>Blargboard default</li>
<li>Blargboard no sidebar</li>
<li>phpBB style</li>
</ul>
12) Make a JS AJAX request for inserting a quote like at K64
13) Make a JS request for inserting a URL BBCode
14) Fix all currently known issues
15) Attempt preventing the RHCafe disaster like this:<ul>
<li>Making it so you can only comment on a user's profile every 30 seconds</li>
<li>Adding a PM limit so you can only send a PM every 45 seconds</li>
<li>An account can only be registered after 1 minute of another account being registered (optional, choose if you want it or not)</li><li>Registration word key, lock the site down like Cucco.de unless you're signed in. You would also need the key to register</li></ul>
16) Finish the Blargboard todo list at Github
17) Allow BBCode in the PoRA
18) Allow/disable PoRA setting, like on ABXD
21) New layout

Optional stuff:
1) Port the Acmlmboard RPG system
2) Choose which type of post syndrome you want to use like Vizzed or Acmlmboard 2
3) Allow webhooks to be used
4) Make the IRC report plugin easy to use

-------------------------------------------------------------------------------

Blargboard is provided as-is, with no guarantee that it'll be useful or even work. I'm not
responsible if it explodes in your face. Use that thing at your own risk.

Oh well, it should work rather well. But uh, we never know.

-------------------------------------------------------------------------------

Have fun.

blarg
