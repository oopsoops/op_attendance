<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_jbApprove"
            style="height:430px"
            title='加班审批'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/getTransitionByType/tid/1"
            >
            
        <thead>
            <tr> 
                <th field="departmentname" width="100" align="center">员工部门</th>
                <th field="teamname" width="80" align="center">所在组</th> 
                <th field="username" width="80" align="center">员工姓名</th>  
                <th field="uid" width="80" align="center">员工工号</th>
                <th field="begindate" width="80" align="center">开始日期</th>
                <th field="begintime" width="80" align="center">开始时间</th>
                <th field="enddate" width="80" align="center">结束日期</th>
                <th field="endtime" width="80" align="center">结束时间</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="details" width="80" align="center" formatter="jbDetailFormatter">查看详情</th>
                <th field="rejiect" width="40" align="center" formatter="rejectFormatter">驳回</th>
                <th field="approve" width="40" align="center" formatter="approveFormatter">批准</th>
                <?php if($power=='4'){?>
                <th field="subm" width=50" align="center" formatter="submitFormatter">提交HR</th>  
                <?php }?>  
                <?php if($power=='2'){?>
                <th field="subboss" width=60" align="center" formatter="subbossFormatter">提交老板</th>  
                <?php }?> 
                
               

                 
                             
            </tr>  
        </thead>  
    </table>
<script>
    function jbDetailFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="openjbDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
	}
	function rejectFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doReject('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	function submitFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doSubm('+row.id+')"><img src="__TPL__/images/handfor.png" width="16"/></a>';
	}
	function subbossFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doSubm('+row.id+')"><img src="__TPL__/images/handfor.png" width="16"/></a>';
	}
	
	function openjbDetail(vid){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						//href:'__APP__/Account/account_details/pid/'+pid,
						href:'__APP__/works/transitionDetail/vid/'+vid,
						cache:false,
						closable:true
						});
	}
	function doReject(id){
		
		$.messager.confirm('提示', '确认要驳回该员工申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/rejectTrans/vid/"+id,
					type:'GET',
					success:function(data){
						if(data=="1"){
							$.messager.alert("提示","驳回成功！");
							$('#grid_jbApprove').datagrid('loadData', { total:0, rows:[ ]});
							$('#grid_jbApprove').datagrid('load', { });
						}				
					},
					error:function(XMLHttpRequest,textStatus,errorThrown){
						alert(''+errorThrown);
					}	
				});
			}
		});
	}
	function doApprove(id){
		
		$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/approveTrans/vid/"+id,
					type:'GET',
					success:function(data){
						if(data=="1"){
							$.messager.alert("提示","批准成功！");
							$('#grid_jbApprove').datagrid('loadData', { total:0, rows:[ ]});
							$('#grid_jbApprove').datagrid('load', { });
						}				
					},
					error:function(XMLHttpRequest,textStatus,errorThrown){
						alert(''+errorThrown);
					}	
				});
			}
		});
	}
	
	function doSubm(id){
		$.messager.confirm('提示', '确认要提交给人事经理审批？', function(r){
			if (r){
				$.ajax({
					url:"__APP__/Works/sub2hr/vid/"+id,
					type:'GET',
					success:function(data){
						if(data=="1"){
							$.messager.alert("提示","提交成功！");
							$('#grid_ccApprove').datagrid('loadData', { total:0, rows:[ ]});
							$('#grid_ccApprove').datagrid('load', { });
						}				
					},
					error:function(XMLHttpRequest,textStatus,errorThrown){
						alert(''+errorThrown);
					}	
				});
			}
		});
	}
    
    
</script>
    
    
</div>