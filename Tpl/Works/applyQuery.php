<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_myApprove"
            style="height:430px"
            title='我的申请'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/getMyApply"
            >
            
        <thead>
            <tr>  
                <th field="username" width="80" align="center">员工姓名</th>  
                <th field="uid" width="80" align="center">员工工号</th>
                <th field="begindate" width="80" align="center">开始日期</th>
                <th field="begintime" width="80" align="center">开始时间</th>
                <th field="enddate" width="80" align="center">结束日期</th>
                <th field="endtime" width="80" align="center">结束时间</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="statusinfo" width="80" align="center" formatter="statusFormatter">查看详情</th>
            </tr>  
        </thead>  
    </table>
<script>
   function statusFormatter(val,row){
	   if(row.isapproved==1){
			return '已批准';
	   }
		else if(row.isrejected==1){
			return '已驳回'
		}else{
			return '审批中'
		}
		
	}
    
</script>
    
    
</div>