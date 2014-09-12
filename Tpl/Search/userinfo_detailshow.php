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
              <td>所在组：</td>
              <td colspan="2"><input type="text" name="teamid" readonly="readonly" value="<?php echo $userinfo['teamname'];?>" /></td>
              </tr>
              <tr>
    	<td>去年剩余年假：</td>
        <td><input type="text" name="lholiday"   value="<?php echo $userinfo['lholiday'];?>"/></td>
        
    </tr>
    
         <tr>
    	<td>今年可用年假：</td>
        <td><input type="text" name="tholiday"  value="<?php echo $userinfo['tholiday'];?>"/></td>
        
    </tr>
    
         <tr>
    	<td>去年剩余调休：</td>
        <td><input type="text" name="lrest" value="<?php echo $userinfo['lrest'];?>"/></td>
        
    </tr>
    
         <tr>
    	<td>今年可用调休：</td>
        <td><input type="text" name="trest"  value="<?php echo $userinfo['trest'];?>"/></td>
        
    </tr>
              <tr>
              <td>成本中心：</td>
              <td colspan="2"><input type="text" name="costcenter" readonly="readonly" value="<?php echo $userinfo['costcenter'];?>" /></td>
              </tr>
              
              <tr>
              <td>入职日期：</td>
              <td colspan="2"><input type="text" name="entrydate" readonly="readonly" value="<?php echo $userinfo['entrydate'];?>" /></td>
              </tr>
              
              <tr>
              <td>联系电话：</td>
              <td colspan="2"><input type="text" name="phone" readonly="readonly" value="<?php echo $userinfo['phone'];?>" /></td>
              </tr>
              
              <tr>
              <td>Email：</td>
              <td colspan="2"><input type="text" name="email" readonly="readonly" value="<?php echo $userinfo['email'];?>" /></td>
              </tr>
              


                            
            </tr>  
     
    </table>





</div>