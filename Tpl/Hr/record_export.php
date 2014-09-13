<div class="main_include">
<br />


<form id="exportForm" method="post" action="__APP__/Hr/doexport" enctype="multipart/form-data"> 
	<table class="tb">
	    
		<tr>
	    	<td>开始日期：</td>
	        <td><input name="export_begin_time"  id="export_begin_time" type="text" style="width:100px" /></td>
	        <td>结束日期：</td>
	        <td><input name="export_end_time"   id="export_end_time" type="text" style="width:100px" /></td>
	        <td><input type="submit"  value="导出" style="width:80px" /></td>
	        <td><a class="easyui-linkbutton" onclick="export_clear()">清空</a></td>
	        <!-- <td><a class="easyui-linkbutton" iconCls="icon-search" onclick="checkClock()">分析</a></td> -->
	    </tr>
    </table>
 </form>






<script>




	$('#export_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#export_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


function export_clear()
{
	$('#exportForm').form('clear');
}
	



</script>





















</div>