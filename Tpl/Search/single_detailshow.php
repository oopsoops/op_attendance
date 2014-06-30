<div class="main_include">

	<div id="ext_singlemanage"  style="padding:5px;height:auto">
       
            <form id="singleForm">  
            考勤是否正常：
            <select name="single_chose" id="single_chose" >
                <option value="single_none" selected ></option>
            	<option value="single_yes" >是</option>
                <option value="single_no" >否</option>
                </select>
            员工工号：
            <input id="uid" type="text" style="width:100px" value="<?php echo $_GET['uid']?>" />
            开始日期：
               <input id="single_begin_time" type="text" style="width:100px" />
            结束日期：
            <input id="single_end_time" type="text" style="width:100px" />
            &nbsp;&nbsp;&nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="single_accountmanage()">搜索</a>
            &nbsp;
             <a class="easyui-linkbutton" iconCls="icon-search" onclick="single_clear_time()">清空</a>
             </form>
    </div>

    <table class="easyui-datagrid"   
            id="grid_singlemanage"
                      
            toolbar="#ext_singlemanage"
            
            style="height:430px"
            title='个人考勤详情'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Search/fetch_single_attendance/uid/<?php echo $_GET['uid']?>"
            >
            
        <thead>
            <tr> 
                <th field="department" width="100" align="center">员工部门</th>
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="uid" width="100" align="center">员工工号</th>
                <th field="clocktime" width="100" align="center">打卡时间</th>
                <th field="static" width="100" align="center" >考勤状态</th>
                <th field="isapply" width="100" align="center" >备注</th>

                            
            </tr>  
        </thead>  
    </table>


<div id="my_projectRightMenu" class="easyui-menu" style="width:120px;">



</div>

<script>
	$('#single_begin_time').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#single_end_time').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});


  

function single_clear_time()
{
	$('#singleForm').form('clear');
	}

function single_accountmanage() {
	$('#grid_singlemanage').datagrid('loadData', { total:0, rows:[]});
	$('#grid_singlemanage').datagrid('load', { single_chose:$('#single_chose').val(),uid:$('#uid').val(),single_begin_time:$('#single_begin_time').val(),single_end_time:$('#single_end_time').val()});
	
}



  




</script>


</div>