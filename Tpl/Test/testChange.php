<div class="main_include">

	<div id="ext_testsearchmanage"  style="padding:5px;height:auto">
       
            <form id="testsearchForm">  
             考勤状态：
            <select name="testsearch_chose" id="testsearch_chose" >
                <option  value="testsearch_none"  selected></option>
            	<option value="testsearch_yes" >正常</option>
                <option value="testsearch_no" >异常</option>
            </select>         
            员工部门：
            <input type="text" id="department" style="width:100px"/>
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
            开始日期：
               <input id="testsearch_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="testsearch_end_time" type="text" style="width:100px" />
            &nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="testsearch_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="testsearch_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_testsearchmanage"
                      
            toolbar="#ext_testsearchmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/test/testfetch_all_users"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="teamname" width="100" align="center">所在组</th> 
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
                <th field="clockdate" width="80" align="center">打卡日期</th>
                <th field="clocktime" width="80" align="center">打卡时间</th>
              
                <th field="static" width="80" align="center" >考勤状态</th>
                <th field="isapply" width="80" align="center" >备注</th>
               <th field="details" width="80" align="center" formatter="testformatUserDetails">Change</th>

                 
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#testsearch_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#testsearch_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function testsearch_clear_time()
{
	$('#testsearchForm').form('clear');
	}

function testsearch_accountmanage() {
	$('#grid_testsearchmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_testsearchmanage').datagrid('load', {hrsearch_chose:$('#testsearch_chose').val(), department:$('#department').val(),username:$('#username').val(),uid:$('#uid').val(),hrsearch_begin_time:$('#testsearch_begin_time').combo("getValue"),hrsearch_end_time:$('#testsearch_end_time').combo("getValue")});
	
}

//个人信息详细按钮
function testformatUserDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="testopenAttendanceDetails('+row.clockid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人信息详情tab
function testopenAttendanceDetails(clockid){
	$('#main').tabs('close','timeChange');
	$('#main').tabs('add',{
						title:'timeChange',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/test/testTimeChange/clockid/'+ clockid,
						cache:false,
						closable:true
						});
}





</script>


</div>