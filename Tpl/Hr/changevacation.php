<div class="main_include">
<br />
<table>
<tr><th  colspan="7" style="color:#F00" >员工考勤调休导入请在员工考勤调休导出的excel上进行修改，禁止修改excel格式，否则将会导致导入数据异常！</th> </tr>
           </table>

<form id="importVacationForm" method="post" action="__APP__/Hr/doimportvacation" enctype="multipart/form-data"> 
	<table class="tb">
	   
		<tr>
	    	<td><input name="import_xls" type="file" /></td>
	        <td><input type="submit"  value="导入" style="width:80px" /></td>
	        <td><a class="easyui-linkbutton" onclick="import_clear()">清空</a></td>
	        <!-- <td><a class="easyui-linkbutton" iconCls="icon-search" onclick="checkClock()">分析</a></td> -->
	    </tr>
    </table>
 </form>


<script>



	


function import_clear()
{
	$('#importVacationForm').form('clear');
}
	



</script>





















</div>