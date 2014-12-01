<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_myApprove"
            style="height:430px"
            title='我的审批'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/getMyApprove"
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
                <th field="typemc" width="140" align="center" formatter="typeFormatter">事务类型</th>
                <th field="detai" width="80" align="center" formatter="detailFormatter">详情</th>
                <th field="statusinfo" width="160" align="center" formatter="statusFormatter">状态</th>
            </tr>  
        </thead>  
    </table>
<script>

	function detailFormatter(val,row){
		if(row.transtype=="2"){
			return '<a href="javascript:void(0)" onclick="ccDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
		}else{
			return '<a href="javascript:void(0)" onclick="openDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
		}
	}
	function typeFormatter(val,row){
		if(row.transtype=="3"){
			return row.holiday;
		}else{
			return row.typemc;
		}
	}

   function statusFormatter(val,row){
	   if(row.isapproved==1){
			return '已批准';
	   }
		else if(row.isrejected==1){
			return '已驳回'
		}else if(row.status=="2"){
			return '人事经理审批中';
		}else if(row.status=="3"){
			return '工厂经理审批中';
		}else if(row.status=="1"){
			return '部门经理审批中';
		}else if(row.status=="4"){
			return '财务经理审批中';
		}
		
	}
	function openDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/transitionDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	function ccDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/ccDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
    
</script>
    
    
</div>