
<table width="auto" class="tb">
	<tr>
		<th colspan="4">
			<div>排班情况</div>
			<div class="notice">组长可对排班进行修改</div>
		</th>
	</tr>
	<tr>
		<td>所属组别</td>
		<td colspan="3"><?php echo $worktime['teamname']?></td>
	</tr>
	<tr>
		<td>上班时间</td>
		<td><?php echo substr($worktime['worktime1'],0,5)?></td>
		<td>下班时间</td>
		<td><?php echo substr($worktime['worktime2'],0,5)?></td>
	</tr>
</table>

