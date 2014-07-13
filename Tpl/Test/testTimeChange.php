<div class="main_include">
<form id="form_modify_time" method="post">
<table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="4">打卡基本信息</th>
    </tr>
   
    	
    
    <tr>
    	<td>打卡日期(xxxx-xx-xx)：</td>
        <td><input type="text" name="clockdate" class="easyui-validatebox" required missingMessage="必填" value="<?php echo $clockinfo[0]['clockdate'];?>"/></td>
    
    
    </tr>
    
        <tr>
    	<td>打卡时间(xx:xx:xx)：</td>
        <td><input type="text" name="clocktime" class="easyui-validatebox" required missingMessage="必填" value="<?php echo $clockinfo[0]['clocktime'];?>"/></td>
    
    
    </tr>
  
 
    <tr>
    
     <td align="left"><a class="easyui-linkbutton" onclick="return modify_staff_do()">修改</a></td>
  
    </tr>
</table>
</form>
<script>
	


function modify_time_do() {
	$('#form_modify_time').form('submit', {  
		url:'__APP__/Test/time_modify_do/clockid/<?php echo $_GET['clockid']?>',  
		onSubmit: function(){  

			return $('#form_modify_time').form('validate');
		},  
		success:function(data){ 
		
		

			 if(data=='ok') {
				 		$.messager.alert('提示', '修改成功'); 
						$('#main').tabs('close','timechange');
						$('#main').tabs('close','test');
							
						$('#main').tabs('add',{
												title:'test',
												href:'__APP__/Test/test_menu',
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