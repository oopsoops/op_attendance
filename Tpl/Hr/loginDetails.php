<div class="main_include">


	<div id="ext_loginmanage"  style="padding:5px;height:auto">
       <form>
           <table>     
		<tr>
        <td>登录账号：</td>
        <td><input type="text" name="loginname"   readonly = "readonly" class="easyui-validatebox" value="<?php echo $loginname;?>"/></td>
        
    	<td>登录总次数：</td>
        <td><input type="text" name="total"   readonly = "readonly" class="easyui-validatebox" value="<?php echo $total;?>"/></td>
   	  
        <td>账务信息：</td>
        <td><input type="text" name="accountinfo"   readonly = "readonly" class="easyui-validatebox" value="<?php echo $total;?>"/></td>
        </tr>
        </table>
        </form>
            
    </div>





<form id="form_login_staff" method="post">

<table  class="easyui-datagrid"   
            id="grid_loginmanage"
                      
            toolbar="#ext_loginmanage"
            
            style="height:430px"
            title='员工信息管理'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/fetch_all_login/uid/<?php echo $uid; ?>"
           >
    
             <thead>  
        
            <tr> 
               
                <th field="username" width="100" align="center">员工姓名</th>  
                <th field="logintime" width="120" align="center">登录时间</th>
              
            </tr>  
          </thead>
</table>
</form>
<script>
	$('#entrytime').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});





</script>


</div>