<div class="main_include">
<?php if($power==3){ ?>
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
            url="__APP__/Works/getMycxApply"
            >
            
        <thead>
            <tr>  
                <th field="username" width="80" align="center">员工姓名</th>  
                <th field="uid" width="80" align="center">员工工号</th>
                <th field="begindate" width="80" align="center">开始日期</th>
                <th field="begintime" width="80" align="center">开始时间</th>
                <th field="enddate" width="80" align="center">结束日期</th>
                <th field="endtime" width="80" align="center">结束时间</th>
                <th field="typemc" width="80" align="center">事务类型</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="statusinfo" width="80" align="center" formatter="statusFormatter">状态</th>
                <th field="print" width="80" align="center" formatter="printFormatter">详情</th>
                
            </tr>  
        </thead>  
    </table>
<?php } 
		else{
?>
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
                <th field="typemc" width="80" align="center">事务类型</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="print" width="80" align="center" formatter="printFormatter">详情</th>
                <th field="statusinfo" width="80" align="center" formatter="statusFormatter">状态</th>
            </tr>  
        </thead>  
    </table>

<?php } ?>
<script>
   function statusFormatter(val,row){
	   if(row.isapproved==1){
			return '已批准';
	   }
		else if(row.isrejected==1){
			return '已驳回'
		}else if(row.status=="2"&&row.isapproved==0&&row.isrejected==0){
			return '人事经理审批中';
		}else if(row.status=="3"&&row.isapproved==0&&row.isrejected==0){
			return '工厂经理审批中';
		}else if(row.status=="1"&&row.isapproved==0&&row.isrejected==0){
			return '部门经理审批中';
		}else if(row.status=="4"&&row.isapproved==0&&row.isrejected==0){
			return '财务经理审批中';
		}
		
	}
	
	
	function printFormatter(val,row){
		if(row.isapproved==1 && row.transtype=="2"){
			return '<a href="javascript:void(0)" onclick="printDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
		}else{
			return '<a href="javascript:void(0)" onclick="showDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
		}
		
	}
	function printDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/ccDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	function showDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/transitionDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	
    
</script>
    
    
</div>