<div class="main_include">



    <table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="3">个人详细信息</th>
    </tr>
            
       
            <tr>
            <td>员工部门：</td> 
            <td colspan="2"><input type="text" name="department" readonly="readonly" value="<?php echo $userinfo['department'];?>" /></td>
             </tr>
             
             <tr>
             <td>员工工号：</td> 
             <td colspan="2"><input type="text" name="uid" readonly="readonly" value="<?php echo $userinfo['uid'];?>" /></td> 
              </tr>
              
              <tr>
              <td>员工姓名：</td>
              <td colspan="2"><input type="text" name="username" readonly="readonly" value="<?php echo $userinfo['username'];?>" /></td>
              </tr>
              
              <tr>
              <td>员工角色：</td>
              <td colspan="2"><input type="text" name="typename" readonly="readonly" value="<?php echo $userinfo['typename'];?>" /></td>
              </tr>
              
              <tr>
              <td>联系方式：</td>
              <td colspan="2"><input type="text" name="phone" readonly="readonly" value="<?php echo $userinfo['phone'];?>" /></td>
              </tr>
              
              <tr>
              <td>入职日期：</td>
              <td colspan="2"><input type="text" name="entrydate" readonly="readonly" value="<?php echo $userinfo['entrydate'];?>" /></td>
              </tr>

                            
            </tr>  
     
    </table>





</div>