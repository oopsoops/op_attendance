<div class="main_include">

	<div id="ext_searchmanage"  style="padding:5px;height:auto">
       
            <form id="searchForm">  
             考勤是否正常：
            <select name="search_chose" id="search_chose" >
                <option  value="search_none"  selected></option>
            	<option value="search_yes" >是</option>
                <option value="search_no" >否</option>
            </select>         
            员工部门：
            <input type="text" id="department" style="width:100px"/>
            员工工号：
            <input type="text" id="uid" style="width:100px"/>
            员工姓名：
            <input type="text" id="username" style="width:100px"/>
            开始日期：
               <input id="search_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="search_end_time" type="text" style="width:100px" />
            &nbsp;&nbsp;&nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="search_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="search_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_searchmanage"
                      
            toolbar="#ext_searchmanage"
            
            style="height:430px"
            title='考勤查询'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Search/fetch_all_attendance"
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

                 <th field="details" width="100" align="center" formatter="formatAttendanceDetails">个人考勤详情</th>
                             
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#search_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#search_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function search_clear_time()
{
	$('#searchForm').form('clear');
	}

function search_accountmanage() {
	$('#grid_searchmanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_searchmanage').datagrid('load', {search_chose:$('#search_chose').val(), department:$('#department').val(),username:$('#username').val(),uid:$('#uid').val(),search_begin_time:$('#search_begin_time').combo("getValue"),search_end_time:$('#search_end_time').combo("getValue")});
	
}


//个人考勤详细按钮
function formatAttendanceDetails(val,row){  
	
	return '<a href="javascript:void(0)" onclick="openAttendanceDetails('+row.uid+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
//打开个人考勤详情tab
function openAttendanceDetails(uid){
	$('#main').tabs('close','个人考勤详情');
	$('#main').tabs('add',{
						title:'个人考勤详情',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/search/single_detailshow/uid/'+ uid,
						cache:false,
						closable:true
						});
}

  




</script>


</div>