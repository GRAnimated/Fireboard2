	{if $pagelinks}<div class="smallFonts pages">Pages: {$pagelinks}</div>{/if}

	<style>

	#ThreadInput {
	width: 80%; /* Full-width */
	}

	</style>

	<script>
	function SearchFunction() {
		// Declare variables 
		var input, filter, table, tr, td, i;
		input = document.getElementById("ThreadInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("threadlist");
		tr = table.getElementsByTagName("tr");

		// Loop through all table rows, and hide those who don't match the search query
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[2];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	</script>

	<table class="outline margin">
		<tr class="header1"><th>Search</th></tr>
		<tr><td class="cell2"><center><input type="text" id="ThreadInput" onkeyup="SearchFunction()" placeholder="Search for threads inside this forum..."></center></td></tr>
	</table>

	<table class="outline margin threadlist" id="threadlist">
		<tr class="header1">
			<th>&nbsp;</th>
			<th style="width:16px;">&nbsp;</th>
			<th style="width:60%;">Title</th>
			{if $showforum}<th style="width:20%;">Forum</th>{/if}
			<th>Started by</th>
			<th>Replies</th>
			<th>Views</th>
			<th style="min-width:150px; width:15%;">Last post</th>
		</tr>
		{foreach $threads as $thread}
		{if $dostickies && !$thread@first && $laststicky != $thread.sticky}
		<tr class="header0"><th colspan={if $showforum}8{else}7{/if} style="height:5px;"></th></tr>
		{/if}
		{$laststicky=$thread.sticky}
		<tr class="cell{if $dostickies && $thread.sticky}2{elseif $thread@index is odd}1{else}0{/if}">
			<td class="cell2 newMarker">{$thread.new}</td>
			<td class="threadIcon" style="border-right:0px none;">{$thread.icon}</td>
			<td style="border-left:0px none;">
				{$thread.gotonew}
				{$thread.poll}
				{$thread.link}
				{if $thread.pagelinks} <small>[{$thread.pagelinks}]</small>{/if}<br><i>{$thread.description}</i>
			</td>
			{if $showforum}<td class="center">{$thread.forumlink}</td>{/if}
			<td class="center">{$thread.startuser}</td>
			<td class="center">{$thread.replies}</td>
			<td class="center">{$thread.views}</td>
			<td class="center smallFonts">
				{$thread.lastpostdate}<br>
				by {$thread.lastpostuser} <a href="{$thread.lastpostlink}">&raquo;</a>
			</td>
		</tr>
		{/foreach}
	</table>
	
	{if $pagelinks}<div class="smallFonts pages">Pages: {$pagelinks}</div>{/if}
