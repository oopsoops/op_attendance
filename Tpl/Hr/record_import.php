<div class="main_include">
<br />

	<table class="tb">
	   	<form id="importForm" method="post" action="__APP__/Hr/doexcel" enctype="multipart/form-data"> 
		<tr>
	    	<td colspan="3"><input name="import_xls" type="file" /></td>
	        <td><input type="submit"  value="导入" style="width:80px" /></td>
	        
	        <!-- <td><a class="easyui-linkbutton" iconCls="icon-search" onclick="checkClock()">分析</a></td> -->
	    </tr>
	    </form>
	    <tr>
	    	<td colspan="5" style="color:gray">请确定时间段内已导入所有员工数据，再点击分析按钮</td>
	    </tr>
	    <form id="form_import_check" method="get" action="__APP__/Check/doCheck">
	    <tr>
	    	<td>开始日期：</td>
	        <td><input class="easyui-datebox" name="start" id="start" type="text" required="true" style="width:100px" /></td>
	        <td>结束日期：</td>
	        <td><input class="easyui-datebox" name="end" id="end" type="text" required="true" style="width:100px" /></td>
	        <td colspan="2" align="right"><a id="checkBtn" class="easyui-linkbutton" onclick="doImportCheck()">分析</a></td>
	    </tr>
	    </form>
    </table>
 




<script>

	$('#start').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100,
			required:true
	});
	$('#end').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100,
			required:true
	});

function import_clear()
{
	$('#importForm').form('clear');
}
	
function doImportCheck() {
	$('#checkBtn').linkbutton({disabled:true});

	var start = $('#start').datebox('getValue');
	var end = $('#end').datebox('getValue');
	if(start.length==0 || end.length==0) {
		$('#checkBtn').linkbutton({disabled:false});
		alert('起止日期不允许为空！');
		return false;
	}
	$.ajax({
		url:'__APP__/Check/doCheck',
		data:{
			start:start,
			end:end
		},
		success:function(data) {
			$('#checkBtn').linkbutton({disabled:false});
			alert('分析完成！');
		}
	});
}


</script>





















</div>