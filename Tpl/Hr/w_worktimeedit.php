<form id="worktimeedit_form">
	<table width="100%" class="tb">
		<tr>
			<td colspan="4" class="notice"> 每组排班时间段不可以有重叠</td>
		</tr>
		<tr>
			<td>类别</td>
			<td colspan="3"><?php echo $worktime['teamname']?></td>
		</tr>
		<tr>
			<td>起始日期</td>
			<td><input type="text" id="worktimeedit_startdate" value="<?php echo $worktime['workdate1']?>" /></td>
			<td>结束日期</td>
			<td><input type="text" id="worktimeedit_enddate" value="<?php echo $worktime['workdate2']?>" /></td>
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
$('#worktimeedit_startdate').datebox({	
	formatter:timeformatter,
	parser:timeparser,
	editable:false,
	width: 100,
	required:true
});

$('#worktimeedit_enddate').datebox({	
	formatter:timeformatter,
	parser:timeparser,
	editable:false,
	width: 100,
	required:true
});

function doWorktimeEdit() {
	if(!$('#worktimetedit_form').form('validate')) return false;

	var startdate = $("#worktimeedit_startdate").datebox('getValue');
	var enddate = $("#worktimeedit_enddate").datebox('getValue');
	var start = $("#worktimeedit_starttime").timespinner('getValue');
	var end = $("#worktimeedit_endtime").timespinner('getValue');
	var id = <?php echo $worktime['id']?>;

	//判断起止日期必须为同一月
	var start_tp = timeparser(startdate);
	var end_tp = timeparser(enddate);
	if(start_tp.getMonth()!=end_tp.getMonth() || start_tp.getFullYear()!=end_tp.getFullYear()) {
		$.messager.alert('提示','起始和结束日期必须在同一年月内！');
		return false;
	}

	$.ajax({
		url:'__APP__/Hr/doWorktimeEdit/id/'+id+'/start/'+start+'/end/'+end+'/startdate/'+startdate+'/enddate/'+enddate,
		success:function(data) {
			if (data=="ok") {
				$('#grid_worktimelist').datagrid('loadData',{total:0,rows:[]});
				$('#grid_worktimelist').datagrid('reload',{
			        teamid: $('#worktimelist_teamid').val()
			    });
				$('#w_worktimeedit').window('close');
			} else {
				alert(data);
			}
		}
	});
}

</script>