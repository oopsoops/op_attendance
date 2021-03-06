<form id="worktimetnew_form">
	<table width="100%" class="tb">
		<tr>
			<td colspan="4" class="notice"> 每组排班时间段不可以有重叠</td>
		</tr>
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
			<td>起始日期</td>
			<td><input type="text" id="worktimenew_startdate" /></td>
			<td>结束日期</td>
			<td><input type="text" id="worktimenew_enddate" /></td>
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

$('#worktimenew_teamid').val(<?php echo $teamid ?>);

$('#worktimenew_startdate').datebox({	
	formatter:timeformatter,
	parser:timeparser,
	editable:false,
	width: 100,
	required:true
});

$('#worktimenew_enddate').datebox({	
	formatter:timeformatter,
	parser:timeparser,
	editable:false,
	width: 100,
	required:true
});

function doWorktimeNew() {
	if(!$('#worktimetnew_form').form('validate')) return false;

	var startdate = $("#worktimenew_startdate").datebox('getValue');
	var enddate = $("#worktimenew_enddate").datebox('getValue');
	var start = $("#worktimenew_starttime").timespinner('getValue');
	var end = $("#worktimenew_endtime").timespinner('getValue');
	var tid = $("#worktimenew_teamid").val();

	//判断起止日期必须为同一月
	var start_tp = timeparser(startdate);
	var end_tp = timeparser(enddate);
	if(start_tp.getMonth()!=end_tp.getMonth() || start_tp.getFullYear()!=end_tp.getFullYear()) {
		$.messager.alert('提示','起始和结束日期必须在同一年月内！');
		return false;
	}

	$.ajax({
		url:'__APP__/Hr/doWorktimeNew/tid/'+tid+'/start/'+start+'/end/'+end+'/startdate/'+startdate+'/enddate/'+enddate,
		success:function(data) {
			if (data=="ok") {
				$('#grid_worktimelist').datagrid('loadData',{total:0,rows:[]});
				$('#grid_worktimelist').datagrid('reload',{
			        teamid: $('#worktimelist_teamid').val(),
			        month: $('#worktimelist_month').val()
			    });
				$('#w_worktimeedit').window('close');
			} else {
				alert(data);
			}
		}
	});
	
}

</script>