<div class="main_include">



    <table class="easyui-datagrid"   
            id="grid_bossmanage"
                      
            toolbar="#ext_bossmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Boss/boss_searchstaff"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="teamname" width="100" align="center">所在组</th> 
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
				 <th field="phone" width="100" align="center">联系电话</th>
                <th field="details" width="80" align="center" formatter="formatUserDetails">个人信息详情</th>
              
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	




//个人信息详细按钮
function formatUserDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="openAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人信息详情tab
function openAttendanceDetails(uid){
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