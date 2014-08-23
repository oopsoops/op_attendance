<div class="main_include">

	<div id="ext_hrsearchmanage"  style="padding:5px;height:auto">
       
           
    </div>

    <table class="easyui-datagrid"   
            id="grid_hrsearchmanage"
                      
            toolbar="#ext_hrsearchmanage"
            
            style="height:430px"
            title='当前待审批'
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
                <th field="teamname" width="100" align="center">所在组</th> 
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
               <th field="details" width="80" align="center" formatter="hrformatUserDetails">查看申请详情</th>
               <th field="appove" width="80" align="center" formatter="ap">批准</th>
               <th field="reject" width="80" align="center" formatter="rej">驳回</th>

                 
                             
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

//个人信息详细按钮
function hrformatUserDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="hropenAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
function ap(){
	return '<img src="__TPL__/images/check.png" width="16"/>';
}
function rej(){
	return '<img src="__TPL__/images/reject.png" width="16"/>';
}
//打开个人信息详情tab
function hropenAttendanceDetails(uid){
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