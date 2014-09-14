<div class="main_include">
<div id="exportVaForm"  style="padding:5px;height:auto">


<form id="exportVaForm" method="post" action="__APP__/Hr/exportVacation" enctype="multipart/form-data"> 
	<table class="tb">
	    
		<tr>
           <td>员工部门：</td>
	        <td><input name="department"   id="department" type="text" style="width:100px" /></td>
	    	<td>员工姓名：</td>
	        <td><input name="username"  id="username" type="text" style="width:100px" /></td>
	        <td>员工工号：</td>
	        <td><input name="uid"   id="uid" type="text" style="width:100px" /></td>
	        <td>  <a class="easyui-linkbutton" iconCls="icon-search" onclick="hrsearch_vacationmanage()">搜索</a></td>
	        <td><a class="easyui-linkbutton" onclick="export_clear()">清空</a></td>
            <td><input type="submit"  value="导出" style="width:80px" /></td>
            
	        <!-- <td><a class="easyui-linkbutton" iconCls="icon-search" onclick="checkClock()">分析</a></td> -->
	    </tr>
      
    </table>
 </form>
</div>
<table class="easyui-datagrid"   
            id="grid_hrvacationmanage"
                      
            toolbar="#exportVaForm"
            
            style="height:430px"
            title='年假调休'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/hrfetch_all_vacation"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
                <th field="tholiday" width="120" align="center">今年可用年假</th>
                <th field="trest" width="120" align="center">今年可用调休</th>
                <th field="lholiday" width="120" align="center" >去年剩余年假</th>
                <th field="lrest" width="120" align="center" >去年剩余调休</th>
                                        
            </tr>  
        </thead>  
    </table>




<script>





function export_clear()
{
	$('#exportVaForm').form('clear');
}
	

function hrsearch_vacationmanage() {
	$('#grid_hrvacationmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_hrvacationmanage').datagrid('load', {username:$('#username').val(),department:$('#department').val(), uid:$('#uid').val()});
	
}

</script>





















</div>