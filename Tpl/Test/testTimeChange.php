<div class="main_include">
<form id="form_modify_time" method="post">
<table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="4">打卡基本信息</th>
    </tr>
           <tr><th  colspan="7" style="color:#F00" >注意：只可将不正常考勤时间改为正常考勤，不可将正常记录改为不正常，否则系统接受处理后数据出错，修改时请谨慎填写时间！</th> </tr>
    	
    
    <tr>
    	<td>打卡日期(xxxx-xx-xx)：</td>
        <td><input type="text" name="clockdate" class="easyui-validatebox" required missingMessage="必填" value="<?php echo $clockinfo['clockdate'];?>"/></td>
    
    
    </tr>
    
        <tr>
    	<td>打卡时间(xx:xx:xx)：</td>
        <td><input type="text" name="clocktime" class="easyui-validatebox" required missingMessage="必填" value="<?php echo $clockinfo['clocktime'];?>"/></td>
    
    
    </tr>
  
 
    <tr>
    
     <td align="left"><a class="easyui-linkbutton" onclick="return modify_time_do()">修改</a></td>
  
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
						$('#main').tabs('close','testChange');
						$('#main').tabs('close','timeChange');		
						$('#main').tabs('add',{
												title:'testChange',
												href:'__APP__/Test/testChange',
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