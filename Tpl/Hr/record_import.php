<div class="main_include">
<br />
<form id="importForm" method="post" action="__APP__/Hr/doexcel" enctype="multipart/form-data"> 
	<table class="tb">
	    
		<tr>
	    	<td><input name="import_xls" type="file" /></td>
	        <td>开始日期：</td>
	        <td><input id="import_begin_time" type="text" style="width:100px" /></td>
	        <td>结束日期：</td>
	        <td><input id="import_end_time" type="text" style="width:100px" /></td>
	        <td><input type="submit"  value="导入" style="width:80px" /></td>
	        <td><a class="easyui-linkbutton" onclick="import_clear()">清空</a></td>
	        <td><a class="easyui-linkbutton" iconCls="icon-search" onclick="checkClock()">分析</a></td>
	    </tr>
    </table>
 </form>




<script>

	$('#import_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#import_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


function import_clear()
{
	$('#importForm').form('clear');
}
	
function checkClock() {
	var start = $("#import_begin_time").datebox('getValue');
	var end = $("#import_end_time").datebox('getValue');
	$.ajax({
		url:'__APP__/Check/doCheck/start/'+start+'/end/'+end,
		success:function(data) {
			alert(data);
		}
	});
}


</script>





















</div>