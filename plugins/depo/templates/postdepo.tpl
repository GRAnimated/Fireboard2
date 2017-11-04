	<table class="outline margin newspost" style="width:400px; padding:5px 5px 5px 5px; flex: 1; flex-grow: 1;">
		<tr class="header1 center">
			<th>
				<span style='font-size:125%;'>
					<span class="navButton">{$post.title}</span>
				</span>
			</th>
		</tr>
		<tr class="header0">
			<th>
				<span style="font-weight:normal;font-size:97%;">
					Posted on {$post.formattedDate} by {$post.userlink}
				</span>
			</th>
		</tr>
		<tr class="cell0 center">
			<td style="padding:10px; max-height:200px !important;">
				{$post.text}
			</td>
		</tr>
		<tr class="cell1 center">
			<td>
				{$post.comments}. {$post.replylink}
			</td>
		</tr>
	</table>