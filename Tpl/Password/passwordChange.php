<div class="main_include">
<br/><br/>
    <form id="form_m_passchange" method="post">
        <table class="tb" align="center" border="0" width="60%">
        <tr>
        <th align="center">输入旧密码：</th>
        <td align="left"><input name="oldpass" id="oldpass" type="password"></td>
        </tr>
        <tr>
        <th align="center">输入新密码：</th>
        <td align="left"><input name="newpass1" id="newpass1" type="password"></td>
        </tr>
        <tr>
        <th align="center">再次输入新密码：</th>
        <td align="left"><input name="newpass2" id="newpass2" type="password"></td>
        </tr>
        <tr>
        <td colspan="1" align="right"><a class="easyui-linkbutton" onclick="passchangeSubmit()">提交</a></td>
        <td colspan="1" align="left"><a class="easyui-linkbutton" onclick="passclear()">清空</a></td>
        </tr>
        </table>
    </form>



<script>

function passclear()
{
	$('#form_m_passchange').form('clear');
	}
	


function passchangeSubmit() {
	$('#form_m_passchange').form('submit', {  
		url:'__APP__/Password/passchange_do',  
		onSubmit: function(){  
			//进行表单验证  
			//如果返回false阻止提交  
			return $('#form_m_passchange').form('validate');
		},  
		success:function(data){ 
			if(data=='ok') {
				$.messager.alert('提示', '修改成功'); 
				//关闭窗口
				//$('#m_passchange').window('close');
				 $('#main').tabs('close','密码管理');
						$('#main').tabs('close','我的信息');
						$('#main').tabs('add',{
												title:'我的信息',
												href:'__APP__/Search/userinfo_detailshow',
												cache:false,
												closable:true
						});
				 
				 
				 
				 
			} else if(data == 'olderror'){
				
				$.messager.alert('提示', '旧密码输入错误！'); 
				//关闭窗口
				//$('#m_passchange').window('close');
				} 
				
				else if(data == 'passnull'){
					
				$.messager.alert('提示', '新密码两次输入都不能为空！'); 
					}
					
				else if(data == 'diff'){
					
				$.messager.alert('提示', '新密码输入不一致！'); 
					}
					
									
			
			
			
			else {

						$.messager.alert('提示',data);
												 
						//刷新grid
						$('#form_m_passchange').datagrid('loadData', { total:0, rows:[ ]});
						$('#form_m_passchange').datagrid('load', { });
						
						
						
						
			}
		}  
	});  
}




</script>


</div>