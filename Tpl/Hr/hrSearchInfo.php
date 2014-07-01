<div class="main_include">

	<div id="ext_hrsearchmanage"  style="padding:5px;height:auto">
       
            <form id="hrsearchForm">  
             考勤状态：
            <select name="hrsearch_chose" id="hrsearch_chose" >
                <option  value="hrsearch_none"  selected></option>
            	<option value="hrsearch_yes" >正常</option>
                <option value="hrsearch_no" >异常</option>
            </select>         
            员工部门：
            <input type="text" id="department" style="width:100px"/>
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
            开始日期：
               <input id="hrsearch_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="hrsearch_end_time" type="text" style="width:100px" />
            &nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="hrsearch_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="hrsearch_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_hrsearchmanage"
                      
            toolbar="#ext_hrsearchmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/hrfetch_all_attendance"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
                <th field="clockdate" width="80" align="center">打卡日期</th>
                <th field="clocktime" width="80" align="center">打卡时间</th>
              
                <th field="static" width="80" align="center" >考勤状态</th>
                <th field="isapply" width="80" align="center" >备注</th>
                 <th field="phone" width="100" align="center">联系方式</th>

                 
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#hrsearch_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#hrsearch_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function hrsearch_clear_time()
{
	$('#hrsearchForm').form('clear');
	}

function hrsearch_accountmanage() {
	$('#grid_hrsearchmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_hrsearchmanage').datagrid('load', {hrsearch_chose:$('#hrsearch_chose').val(), department:$('#department').val(),username:$('#username').val(),uid:$('#uid').val(),hrsearch_begin_time:$('#hrsearch_begin_time').combo("getValue"),hrsearch_end_time:$('#hrsearch_end_time').combo("getValue")});
	
}


//个人考勤详细按钮
function hrformatAttendanceDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="openAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人考勤详情tab




</script>


</div>