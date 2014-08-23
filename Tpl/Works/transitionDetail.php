<div class="main_include">



    <table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="3">个人详细信息</th>
    </tr>
            
       
            <tr>
            <td>员工姓名：</td> 
            <td colspan="3"><input type="text" name="department" readonly="readonly" value="<?php echo $detail[0]['username'];?>" /></td>
             </tr>
             
             <tr>
             <td>开始时间：</td> 
             <td colspan="3"><input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['begintime'];?>" /></td> 
              </tr>
              
              <tr>
              <td>结束时间：</td>
              <td colspan="3"><input type="text" name="username" readonly="readonly" value="<?php echo $detail[0]['endtime'];?>" /></td>
              </tr>
              
              <tr>
              <td>申请理由：</td>
              <td colspan="3"><input width="400" type="area" name="typename" readonly="readonly" value="<?php echo $detail[0]['reason'];?>" /></td>
              </tr>
                            
             
              


                            
            </tr>  
     
    </table>





</div>