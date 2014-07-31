<form>
	<table width="100%" class="tb">
		<tr>
			<td>类别</td>
			<td colspan="3">
				<select id="worktimenew_teamid" class="easyui-combo">
					<?php for ($i=0; $i < count($teaminfo); $i++) { ?>
					<option value="<?php echo $teaminfo[$i]['tid'];?>"><?php echo $teaminfo[$i]['teamname']?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<td>上班时间</td>
			<td><input type="text" id="worktimenew_starttime" class="easyui-timespinner" value="08:00" /></td>
			<td>下班时间</td>
			<td><input type="text" id="worktimenew_endtime" class="easyui-timespinner" value="17:00" /></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><a class="easyui-linkbutton" onclick="doWorktimeNew()">确定</a></td>
		</tr>
	</table>
</form>

<script>
function doWorktimeNew() {
	var start = $("#worktimenew_starttime").timespinner('getValue');
	var end = $("#worktimenew_endtime").timespinner('getValue');
	var tid = $("#worktimenew_teamid").val();
	
	$.ajax({
		url:'__APP__/Hr/doWorktimeNew/tid/'+tid+'/start/'+start+'/end/'+end,
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