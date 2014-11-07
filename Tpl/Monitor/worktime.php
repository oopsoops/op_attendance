<form>
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
		<td><input type="text" id="worktimeedit_starttime" class="easyui-timespinner" value="<?php echo substr($worktime['worktime1'],0,5)?>" /></td>
		<td>下班时间</td>
		<td><input type="text" id="worktimeedit_endtime" class="easyui-timespinner" value="<?php echo substr($worktime['worktime2'],0,5)?>" /></td>
	</tr>
	<tr>
		<td colspan="4" align="right"><a class="easyui-linkbutton" onclick="doWorktimeEdit()">调整</a></td>
	</tr>
</table>
</form>

<script>
function doWorktimeEdit() {
	var start = $("#worktimeedit_starttime").timespinner('getValue');
	var end = $("#worktimeedit_endtime").timespinner('getValue');
	
	$.ajax({
		url:'__APP__/Monitor/doWorktimeEdit/start/'+start+'/end/'+end,
		success:function(data) {
			if (data=="ok") {
				alert("修改成功!");
			} else {
				alert(data);
			}
		}
	});
}
</script>