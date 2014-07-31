<div class="main_include">

	<div id="ext_mosearchmanage"  style="padding:5px;height:auto">
       
            <form id="mosearchForm">  
             考勤状态：
            <select name="mosearch_chose" id="mosearch_chose" >
                <option  value="mosearch_none"  selected></option>
            	<option value="mosearch_yes" >正常</option>
                <option value="mosearch_no" >异常</option>
            </select>         
            
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
            开始日期：
               <input id="mosearch_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="mosearch_end_time" type="text" style="width:100px" />
            &nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="mosearch_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="mosearch_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_mosearchmanage"
                      
            toolbar="#ext_mosearchmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Monitor/mofetch_all_attendance"
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
               <th field="details" width="80" align="center" formatter="moformatUserDetails">个人信息详情</th>

                 
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#mosearch_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#mosearch_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function mosearch_clear_time()
{
	$('#mosearchForm').form('clear');
	}

function mosearch_accountmanage() {
	$('#grid_mosearchmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_mosearchmanage').datagrid('load', {mosearch_chose:$('#mosearch_chose').val(), username:$('#username').val(),uid:$('#uid').val(),mosearch_begin_time:$('#mosearch_begin_time').combo("getValue"),mosearch_end_time:$('#mosearch_end_time').combo("getValue")});
	
}

//个人信息详细按钮
function moformatUserDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="moopenAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人信息详情tab
function moopenAttendanceDetails(uid){
	$('#main').tabs('close','个人信息详情');
	$('#main').tabs('add',{
						title:'个人信息详情',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/search/userinfo_detailshow/uid/'+ uid+'/flag/1',
						cache:false,
						closable:true
						});
}





</script>


</div>