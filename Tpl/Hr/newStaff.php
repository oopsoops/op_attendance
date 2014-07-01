<div class="main_include">
<form id="form_new_staff" method="post">
<table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="4">员工基本信息</th>
    </tr>
    <tr>
    	<td>员工部门：</td>
        <td>
        	<select name="department">
            	<?php for($i=0;$i<count($category);$i++) {?>
        		<option value="<?php echo $category[$i]['did'];?>"><?php echo $category[$i]['departmentname'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    
        <tr>
   	<td>员工类别：</td>
        <td>
        	<select name="stafftype">
            	<?php for($i=0;$i<count($usertype);$i++) {?>
        		<option value="<?php echo $usertype[$i]['tid'];?>"><?php echo $usertype[$i]['typename'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    
    <tr>
    	<td>员工姓名：</td>
        <td><input type="text" name="staffname" class="easyui-validatebox" required missingMessage="必填" /></td>
    
    
    </tr>
    
        <tr>
    	<td>员工工号：</td>
        <td><input type="text" name="staffid" class="easyui-validatebox" required missingMessage="必填" /></td>
        
    </tr>
    
 	</tr>
    
        <tr>
    	<td>联系方式：</td>
        <td><input type="text" name="phone" class="easyui-validatebox" /></td>
        
    </tr>
    
     </tr>
    
    <tr>
    	<td>入职日期：</td>
        <td><input id="addentrytime" type="text"   style="width:100px" /></td>
        
    </tr>
    
  <tr>
    	<th colspan="4">被添加员工为主管及以上员工才可拥有以下信息，请慎重填写！</th>
    </tr>
    
        <tr>
    	<td>登录名称：</td>
        <td><input type="text" name="newloginname" class="easyui-validatebox" /></td>
        
    </tr>
    
   
    
    <tr>
    	<td>请输入登录密码：</td>
        <td><input  type="password" name="userpassworda" class="easyui-validatebox" /></td>
        
    </tr>
    
      
    <tr>
    	<td>请再次输入登录密码：</td>
        <td><input type="password"  name="userpasswordb" class="easyui-validatebox" /></td>
        
    </tr>
    <tr>
    
     <td align="right">
     <a class="easyui-linkbutton" onclick="return new_staff_do()">提交</a></td>
    
      <td align="left">
     <a class="easyui-linkbutton" onclick="clear_info()">清空</a>
     </td>
    </tr>
</table>
</form>
<script>
	$('#addentrytime').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});

function clear_info()
{
	$('#form_new_staff').form('clear');
	}





function new_staff_do() {
	$('#form_new_staff').form('submit', {  
		url:'__APP__/Hr/new_staff_do/entrytime/'+$('#addentrytime').combo("getValue"),  
		onSubmit: function(){  

			return $('#form_new_staff').form('validate');
		},  
		success:function(data){  
			if(data == 'loginexist')
			{
				$.messager.alert('提示','该登录账号已经存在！');
				
				}
		
		 	 else	if(data == 'passwordnull')
			{
				$.messager.alert('提示','登录密码不能为空！');
				
				}
		
			 else	if(data == 'bothpassword')
			{
				$.messager.alert('提示','请确保输入密码都已填写！');
				
				}
			else	if(data == 'diffpassword')
			{
				$.messager.alert('提示','请确保两次密码输入一致！');
				
				}
		
			else if(data=='ok') {
				
						$.messager.alert('提示', '添加员工信息成功');
						$('#main').tabs('close','创建员工');
						$('#main').tabs('add',{
												title:'创建员工',
												href:'__APP__/Hr/newStaff',
												cache:false,
												closable:true
				}); 
					
				
			} else {
				$.messager.alert('提示','添加员工失败,请检查信息输入是否正确！');
			}
		}  
	});  
}



</script>


</div>