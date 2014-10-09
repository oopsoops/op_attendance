<div class="main_include">



    <table class="tb" border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
    	<th colspan="4">个人详细信息</th>
    </tr>
            
       
            <tr>
            <td>员工姓名：</td> 
            <td colspan="4"><input type="text" name="department" readonly="readonly" value="<?php echo $detail[0]['username'];?>" /></td>
             </tr>
             <tr>
             <td>开始日期：</td> 
             <td colspan="4"><input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['begindate'];?>" /></td> 
              </tr>
             
             <tr>
             <td>开始时间：</td> 
             <td colspan="4"><input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['begintime'];?>" /></td> 
              </tr>
              <tr>
             <td>结束日期：</td> 
             <td colspan="4"><input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['enddate'];?>" /></td> 
              </tr>
              <tr>
              <td>结束时间：</td>
              <td colspan="4"><input type="text" name="username" readonly="readonly" value="<?php echo $detail[0]['endtime'];?>" /></td>
              </tr>
              
              <tr>
              <td>申请理由：</td>
              <td colspan="4"><input width="800" type="area" name="typename" readonly="readonly" value="<?php echo $detail[0]['reason'];?>" /></td>
              </tr>
                            
             
              


                            
            </tr>  
     
    </table>





</div>