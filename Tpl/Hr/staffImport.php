<div class="main_include">

 <form id="import_staff_Form" method="post" action="__APP__/Hr/importStaffExcel" enctype="multipart/form-data"> 
<table class="tb">
	<tr>
    	<td><input name="import_staff" type="file" /></td>

        <td><input type="submit"  value="导入" name="daoru" style="width:80px" /></td>

    </tr>
   
    </table>
    
 </form>
 
   <table class="easyui-datagrid"   
            id="grid_hrimportsample"
                
            style="height:380px"
            
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
           url="__APP__/Hr/staffInfoSample"
            >
            
        <thead>
         
        <tr><th  colspan="7" style="color:#F00" >员工信息请按如下Excel格式导入（Excel第一行为类别名称，第二行为数据开始，列与列之间禁止有空单元格，EXCEL版本为2003,否则信息导入不正确）：</th> </tr>
            <tr> 
                <th field="uid" width="120" align="center" >员工工号</th>
                <th  field="username" width="120" align="center">员工姓名</th>  
                <th field="department" width="120" align="center">部门ID</th>
                <th  field="team" width="120" align="center">所属组ID</th>
                <th field="usertype" width="120" align="center">员工类别ID号</th>
                  <th  field="costcenterid" width="120" align="center">成本中心ID</th>
                 <th field="entrydate" width="120" align="center">入职日期</th>
                 <th  field="phone" width="120" align="center">联系电话</th>
                 <th  field="email" width="120" align="center">Email</th>
                 <th  field="lholiday" width="120" align="center">去年剩余年假</th>
                 <th  field="tholiday" width="120" align="center">今年可用年假</th>
                 <th  field="lrest" width="120" align="center">去年剩余调休</th>
                 <th  field="trest" width="120" align="center">今年可用调休</th>
                  <th  field="loginname" width="120" align="center">登陆账号</th>
                
                             
            </tr>  
          
        </thead>  
    </table>

</div>