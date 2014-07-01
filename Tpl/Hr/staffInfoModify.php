<div class="main_include">
<form id="form_modify_staff" method="post">
<table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="4">员工基本信息</th>
    </tr>
    <tr>
    	<td>员工部门：</td>
        <td>
        	<select name="department">
            	<?php for($i=0;$i<count($category);$i++) {?>
        		<option value="<?php echo $category[$i]['did'];?>"  <?php if($category[$i]['did']==$userinfo[0]['did']) {echo "selected =selected";};?>><?php echo $category[$i]['departmentname'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    
        <tr>
   	<td>员工类别：</td>
        <td>
        	<select name="stafftype">
            	<?php for($i=0;$i<count($usertype);$i++) {?>
        		<option value="<?php echo $usertype[$i]['tid'];?>" <?php if($usertype[$i]['tid']==$userinfo[0]['typeid']) {echo "selected =selected";};?>><?php echo $usertype[$i]['typename'];?></option>
                <?php }?>
            </select>
        </td>
    </tr>
    

    
    <tr>
    	<td>员工姓名：</td>
        <td><input type="text" name="staffname" class="easyui-validatebox" required missingMessage="必填" value="<?php echo $userinfo[0]['username'];?>"/></td>
    
    
    </tr>
    
        
    
 	</tr>
    
        <tr>
    	<td>联系方式：</td>
        <td><input type="text" name="phone" class="easyui-validatebox" value="<?php echo $userinfo[0]['phone'];?>"/></td>
        
    </tr>
    
     </tr>
    
    <tr>
    	<td>入职日期：</td>
        <td><input id="modifyentrytime" type="text"   style="width:100px" value="<?php echo  $userinfo[0]['entrydate'];?>" /></td>
        
    </tr>
    
 
    <tr>
    
     <td align="left"><a class="easyui-linkbutton" onclick="return modify_staff_do()">修改</a></td>
  
    </tr>
</table>
</form>
<script>
	$('#modifyentrytime').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});



function modify_staff_do() {
	$('#form_modify_staff').form('submit', {  
		url:'__APP__/Hr/staff_modify_do/uid/<?php echo $_GET['uid']?>'+'/entrytime/'+$('#modifyentrytime').combo("getValue"),  
		onSubmit: function(){  

			return $('#form_modify_staff').form('validate');
		},  
		success:function(data){  
			if(data=='ok') {
				 		$.messager.alert('提示', '修改成功'); 
						$('#main').tabs('close','修改员工基本信息');
						$('#main').tabs('close','员工信息管理');
							
						$('#main').tabs('add',{
												title:'员工信息管理',
												href:'__APP__/Hr/staffManager',
												cache:false,
												closable:true
				}); 
					
				
			} else {
				$.messager.alert('提示','修改失败，请核实修改信息！');
			}
		}  
	});  
}



</script>


</div>