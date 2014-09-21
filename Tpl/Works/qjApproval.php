<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_qjApprove"
            style="height:430px"
            title='加班审批'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/getTransitionByType/tid/3"
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
                <th field="holidaytype" width="60" align="center">请假类型</th>
                <th field="rejiect" width="40" align="center" formatter="rejectFormatter">驳回</th>
                <th field="approve" width="40" align="center" formatter="approveFormatter">批准</th>
                             
            </tr>  
        </thead>  
    </table>
<script>
   
	function rejectFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doReject('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+','+row.nums+','+row.status+')"><img src="__TPL__/images/check.png" width="16"/></a>';
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
	function doApprove(id,nums,status){
		if(nums<=3||(status=="2"&&nums>3&&nums<=5)||status=="3"){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/approveTrans/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
								$('#grid_qjApprove').datagrid('loadData', { total:0, rows:[ ]});
								$('#grid_qjApprove').datagrid('load', { });
							}				
						},
						error:function(XMLHttpRequest,textStatus,errorThrown){
							alert(''+errorThrown);
						}	
					});
				}
			});
		}else if(nums>3&&nums<=5){
			$.messager.confirm('提示', '请假时间大于3天需要人事经理审核，是否提交？', function(r){
			if (r){
				$.ajax({
					url:"__APP__/Works/sub2hr/vid/"+id,
					type:'GET',
					success:function(data){
						if(data=="1"){
							$.messager.alert("提示","提交成功！");
							$('#grid_qjApprove').datagrid('loadData', { total:0, rows:[ ]});
							$('#grid_qjApprove').datagrid('load', { });
						}				
					},
					error:function(XMLHttpRequest,textStatus,errorThrown){
						alert(''+errorThrown);
					}	
				});
			}
		});
		}else if(nums>5){
			$.messager.confirm('提示', '请假时间大于5天需要老板审核，是否提交？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2boss/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","提交成功！");
								$('#grid_qjApprove').datagrid('loadData', { total:0, rows:[ ]});
								$('#grid_qjApprove').datagrid('load', { });
							}				
						},
						error:function(XMLHttpRequest,textStatus,errorThrown){
							alert(''+errorThrown);
						}	
					});
				}
			});
		}
	}
	
	
    
</script>
    
    
</div>