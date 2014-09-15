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
    	<td>所在工作组：</td>
        <td><select name="teamid">
            	<?php for($i=0;$i<count($teaminfo);$i++) {?>
        		<option value="<?php echo $teaminfo[$i]['tid'];?>"><?php echo $teaminfo[$i]['teamname'];?></option>
                <?php }?>
            </select></td>
        
    </tr>
    
    <tr>
    	<td>员工姓名：</td>
        <td><input type="text" name="staffname" class="easyui-validatebox" required missingMessage="必填" /></td>
    
    
    </tr>
    
        <tr>
    	<td>员工工号：</td>
        <td><input type="text" name="staffid" class="easyui-validatebox" required missingMessage="必填" /></td>
        
    </tr>
    
     <tr>
    	<td>去年剩余年假（天）：</td>
        <td><input type="text" name="lholiday" class="easyui-validatebox" required missingMessage="必填" value="0.0"/></td>
        
    </tr>
    
         <tr>
    	<td>今年可用年假（天）：</td>
        <td><input type="text" name="tholiday" class="easyui-validatebox" required missingMessage="必填" value="0.0"/></td>
        
    </tr>
    
         <tr>
    	<td>去年剩余调休（小时）：</td>
        <td><input type="text" name="lrest" class="easyui-validatebox" required missingMessage="必填" value="0.0"/></td>
        
    </tr>
    
         <tr>
    	<td>今年可用调休（小时）：</td>
        <td><input type="text" name="trest" class="easyui-validatebox" required missingMessage="必填" value="0.0"/></td>
        
    </tr>
    
        </tr>
    
            
    <tr>
    	<td>成本中心ID：</td>
        <td><input type="text" name="costcenter" class="easyui-validatebox" required missingMessage="必填" /></td>
        
    </tr>
    

        <tr>
    	<td>入职日期：</td>
        <td><input id="addentrytime" type="text"   style="width:100px" /></td>
        
    </tr>
    
 	</tr>
    
        <tr>
    	<td>联系电话：</td>
        <td><input type="text" name="phone"  /></td>
        
    </tr>
            <tr>
    	<td>Email：</td>
        <td><input type="text" name="email"  /></td>
        
    </tr>
    
    
    <tr>
        
    	<td>登录账户（初始密码：12345）：</td>
        <td><input id="staffloginname"  name="staffloginname" type="text"   style="width:100px"/></td>
        </tr>
        <tr>
        <td>是否有登录权限：</td><td><select name="access" id="access" >
               	<option value="access_yes" >是	</option>
                <option value="access_no" >否</option>
            </select>  </td>
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
		
		if(data=='timeerror')
		{
			  $.messager.alert('提示', '年假或调休的最小单位为0.5！'); 
			
			}
		
			else if(data == 'loginexist')
			{
				$.messager.alert('提示','该登录账号已经存在！');
				
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