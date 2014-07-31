<form>
	<table width="100%" class="tb">
		<tr>
			<td>类别</td>
			<td colspan="3"><?php echo $worktime['teamname']?></td>
		</tr>
		<tr>
			<td>上班时间</td>
			<td><input type="text" id="worktimeedit_starttime" class="easyui-timespinner" value="<?php echo substr($worktime['worktime1'], 0, 5)?>" /></td>
			<td>下班时间</td>
			<td><input type="text" id="worktimeedit_endtime" class="easyui-timespinner" value="<?php echo substr($worktime['worktime2'], 0, 5)?>" /></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><a class="easyui-linkbutton" onclick="doWorktimeEdit()">确定</a></td>
		</tr>
	</table>
</form>

<script>
function doWorktimeEdit() {
	var start = $("#worktimeedit_starttime").timespinner('getValue');
	var end = $("#worktimeedit_endtime").timespinner('getValue');
	var id = <?php echo $worktime['id']?>;
	$.ajax({
		url:'__APP__/Hr/doWorktimeEdit/id/'+id+'/start/'+start+'/end/'+end,
		success:function(data) {
			if (data=="ok") {
				$('#grid_worktimelist').datagrid('loadData', { total:0, rows:[]});
				$('#grid_worktimelist').datagrid('load', { });
				$('#w_worktimeedit').window('close');
			} else {
				alert(data);
			}
		}
	});
}

</script>