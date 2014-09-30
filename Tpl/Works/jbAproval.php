<div class="main_include">
<div id="tt" class="easyui-tabs" style="width:1024px;height:520px;"> 
<div title="加班审批" style="padding:20px;"> 
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
                <th field="rejiect" width="40" align="center" formatter="rejectFormatter">驳回</th>
                <th field="approve" width="40" align="center" formatter="approveFormatter">批准</th>
            </tr>  
        </thead>  
    </table>
    </div>
    
    <div title="批量审批" style="padding:20px;">
    	  <table class="easyui-datagrid"   
            id="grid_jbApprove"
            style="height:430px"
            title='批量审批'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/jbAllApply/tid/1"
            >
        <thead>
            <tr> 
                <th field="departmentname" width="100" align="center">员工部门</th>
                <th field="teamname" width="80" align="center">组名</th>
                <th field="begindate" width="80" align="center">开始日期</th>
                <th field="begintime" width="80" align="center">开始时间</th>
                <th field="enddate" width="80" align="center">结束日期</th>
                <th field="endtime" width="80" align="center">结束时间</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="reason" width="140" align="center">申请理由</th>
                <th field="rejiectall" width="40" align="center" formatter="rejectallFormatter">驳回</th>
                <th field="approveall" width="40" align="center" formatter="approveallFormatter">批准</th>  
            </tr>  
        </thead>  
    </table>
    </div>
<script>
   
	function rejectFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doReject('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+','+row.nums+','+row.power+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	
	
	function rejectallFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doallReject('+row.teamid+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveallFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doallApprove('+row.teamid+')"><img src="__TPL__/images/check.png" width="16"/></a>';
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
	
	function doallReject(teamid){
		
		$.messager.confirm('提示', '确认要驳回该条产线加班申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/rejectallTrans",
					type:'POST',
					data:{
						teamid:teamid
					},
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
	
	function doallApprove(teamid){
		$.messager.confirm('提示', '确认要批准该条生产线加班申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/approveallTrans",
					type:'POST',
					data:{
						teamid:teamid
					},
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
	
	
	
	function doApprove(id,nums){
		if(power==4&&status=="3"){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2hr/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","提交成功！");
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
		else if(nums<=3){
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
		}else{
			$.messager.confirm('提示', '加班时间大于3天需要提交人事经理，是否提交？', function(r){  
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
		}
	}

    
    
</script>
    
    </div>
</div>