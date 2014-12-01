<div class="main_include">



   <div id="cPrint">
        <br />    
       
          &nbsp;&nbsp; 姓名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="department" readonly="readonly" value="<?php echo $detail[0]['username'];?>" /><br /><br />&nbsp;&nbsp;
           开始日期：&nbsp;<input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['begindate'];?>" />
           开始时间：&nbsp;<input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['begintime'];?>" />
           <br /><br />&nbsp;&nbsp;
           结束日期：&nbsp;<input type="text" name="uid" readonly="readonly" value="<?php echo $detail[0]['enddate'];?>" />
           结束时间：&nbsp;<input type="text" name="username" readonly="readonly" value="<?php echo $detail[0]['endtime'];?>" />
           <br /><br />&nbsp;&nbsp;
            目的地：&nbsp;&nbsp;&nbsp;<input id="place" type="text" style="width:100px" value="<?php echo $detail[0]['place'];?>"/><br /><br />&nbsp;&nbsp;
            住宿费用：
                <input name="stayfee" type="text" readonly="readonly" style="width:60px" value="<?php echo $detail[0]['stayfee'];?>"/>
            餐饮费用：
                <input name="foodfee" type="text" readonly="readonly" style="width:60px" value="<?php echo $detail[0]['foodfee'];?>"/>
                
            交通费用：
                <input name="transpot" type="text" readonly="readonly" style="width:60px" value="<?php echo $detail[0]['transpot'];?>" /><br /><br />&nbsp;&nbsp;
            其他费用：
                <input name="otherfee" type="text" readonly="readonly" style="width:60px" value="<?php echo $detail[0]['otherfee'];?>"/>
                合&nbsp;&nbsp;&nbsp;&nbsp;计：
                <input name="totalfee" type="text" readonly="readonly" style="width:60px" value="<?php echo $detail[0]['totalfee'];?>"/>
       <br /><br />   &nbsp;&nbsp;  
            备注信息：     <input name="ccbz" type="text" readonly="readonly" style="width:400px" value="<?php echo $detail[0]['ccbz'];?>" />
                 <br /><br />&nbsp;&nbsp;
                 
           出差事由：&nbsp;<input style="width:600px" type="area" name="typename" readonly="readonly" value="<?php echo $detail[0]['reason'];?>" />
           <br /><br /><br />
           <div style="float:left;width:50px;">&nbsp;</div>
           <div style="float:left;width:500px">
               <table cellspacing= "0" cellpadding="0" border= "1"  style="width:500px;font-size:18px;text-align:center;">
                    <tr style="font-wight:bold">
                        <td>审批职位</td><td>审批人姓名</td><td>审批时间</td>
                    </tr>
                    <tr>
                        <td>部门经理</td><td><?php echo $detail[0]['managername'];?></td><td><?php echo $detail[0]['dpmanager_date'];?></td>
                    </tr>
                    <tr>
                        <td>人事经理</td><td><?php echo $detail[0]['hrname'];?></td><td><?php echo $detail[0]['hr_date'];?></td>
                    </tr>
                    <tr>
                        <td>财务经理</td><td><?php echo $detail[0]['cwname'];?></td><td><?php echo $detail[0]['caiwu_date'];?></td>
                    </tr>
                    <tr>
                        <td>工厂经理</td><td><?php echo $detail[0]['bossname'];?></td><td><?php echo $detail[0]['boss_date'];?></td>
                    </tr>
               </table>
           </div>
           <br /><br /><br /><br /><br /><br />
           
           
           </div>
           <a class="easyui-linkbutton" iconCls="icon-search" onclick="ccprint()">打印</a>
            
<script>
	function ccprint(){
		var oldstr = document.body.innerHTML;
		var newstr=document.getElementById("cPrint").innerHTML;
    	document.body.innerHTML = newstr; 
   		window.print(); 
		document.body.innerHTML = oldstr;
		history.go(0);
	}





</script>            
             
                            
             
              


                            
              
     
    





</div>