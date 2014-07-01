<div class="main_include">

	<div id="ext_hrstaffmanage"  style="padding:5px;height:auto">
       
            <form id="hrstaffForm">  
            
            员工部门：
            <input type="text" id="department" style="width:100px"/>
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
           
            &nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="hrsearch_manage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="hr_clear()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_hrstaffmanage"
                      
            toolbar="#ext_hrstaffmanage"
            
            style="height:430px"
            title='员工信息管理'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/hrfetch_all_users"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
                <th field="modifystaff" width="80" align="center" formatter="hrModifyDetails">修改员工</th>
                 <th field="deletestaff" width="80" align="center" formatter="hrDelStaff">删除员工</th>
                 <th field="details" width="80" align="center" formatter="hrLoginDetails">员工登录详情</th>

                 
                             
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


  

function hr_clear()
{
	$('#hrstaffForm').form('clear');
	}
	

function hrsearch_manage() {
	$('#grid_hrstaffmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_hrstaffmanage').datagrid('load', { department:$('#department').val(),username:$('#username').val(),uid:$('#uid').val()});
	
}

//修改个人信息详细按钮
function hrModifyDetails(row,val){  
	
	return '<a href="javascript:void(0)" onclick="hropenModifyDetails()"><img src="__TPL__/images/note.png" width="16"/></a>';  
}
//打开修改个人信息详情tab
function hropenModifyDetails(){
	
	var row = $('#grid_hrstaffmanage').datagrid('getSelected');
	
	if(row!=null) {
	
	$('#main').tabs('close','修改员工基本信息');
	
	$('#main').tabs('add',{
						title:'修改员工基本信息',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/Hr/staffInfoModify/uid/'+row.uid,
						cache:false,
						closable:true
						});
	}
}


//删除个人信息详细按钮
function hrDelStaff(){  
	
	return '<a href="javascript:void(0)" onclick="hropenDel()"><img src="__TPL__/images/del.png" width="16"/></a>';  
}
//删除个人信息详情tab
function hropenDel(){
	var row = $('#grid_hrstaffmanage').datagrid('getSelected');
	if(row!=null){
		$.messager.confirm('提示', '确认要删除该员工信息？', function(r){  
			if (r){  
				//提交删除
				
				$.ajax({  
					url:'__APP__/Hr/staffDel/uid/'+row.uid,  
					
					success:function(data){ 
						 
						//刷新grid
						$('#grid_hrstaffmanage').datagrid('loadData', { total:0, rows:[ ]});
						$('#grid_hrstaffmanage').datagrid('load', { });
						
						
					}  
				});    
			}  
		}); 
	}
}







//个人登录信息详情按钮
function hrLoginDetails(){  
	
	return '<a href="javascript:void(0)" onclick="hropenLoginDetails()"><img src="__TPL__/images/property.png" width="16"/></a>';  
}
//个人登录信息详
function hropenLoginDetails(){
	var row = $('#grid_hrstaffmanage').datagrid('getSelected');
	if(row!=null)
	{
	$('#main').tabs('close','员工登录信息详情');
	$('#main').tabs('add',{
						title:'员工登录信息详情',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/Hr/loginDetails/uid/'+row.uid,
						cache:false,
						closable:true
						});
	}
}



</script>


</div>