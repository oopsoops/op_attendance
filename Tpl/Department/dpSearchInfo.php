<div class="main_include">

	<div id="ext_dpsearchmanage"  style="padding:5px;height:auto">
       
            <form id="dpsearchForm">  
             考勤状态：
            <select name="dpsearch_chose" id="dpsearch_chose" >
                <option  value="dpsearch_none"  selected></option>
            	<option value="dpsearch_yes" >正常</option>
                <option value="dpsearch_no" >异常</option>
            </select>         
            
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
            开始日期：
               <input id="dpsearch_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="dpsearch_end_time" type="text" style="width:100px" />
            &nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="dpsearch_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="dpsearch_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_dpsearchmanage"
                      
            toolbar="#ext_dpsearchmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Department/dpfetch_all_attendance"
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
               <th field="details" width="80" align="center" formatter="dpformatUserDetails">个人信息详情</th>

                 
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#dpsearch_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#dpsearch_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function dpsearch_clear_time()
{
	$('#dpsearchForm').form('clear');
	}

function dpsearch_accountmanage() {
	$('#grid_dpsearchmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_dpsearchmanage').datagrid('load', {dpsearch_chose:$('#dpsearch_chose').val(), username:$('#username').val(),uid:$('#uid').val(),dpsearch_begin_time:$('#dpsearch_begin_time').combo("getValue"),dpsearch_end_time:$('#dpsearch_end_time').combo("getValue")});
	
}

//个人信息详细按钮
function dpformatUserDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="dpopenAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人信息详情tab
function dpopenAttendanceDetails(uid){
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