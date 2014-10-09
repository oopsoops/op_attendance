<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_qjApprove"
            style="height:430px"
            title='休假审批'
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
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="holidaytype" width="60" align="center">请假类型</th>
                <th field="detail" width="80" align="center" formatter="qjDetailFormatter">申请详情</th>
                <th field="info" width="80" align="center" formatter="daysDetailFormatter">员工详情</th>
                <th field="rejiect" width="40" align="center" formatter="rejectFormatter">驳回</th>
                <th field="approve" width="40" align="center" formatter="approveFormatter">批准</th>
                             
            </tr>  
        </thead>  
    </table>
<script>
   
	var rejectId="";
	function rejectFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="open_reject('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+','+row.nums+','+row.status+','+row.power+','+row.departmentid+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	
	function qjDetailFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="openqjDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
	}
	function openqjDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/transitionDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	
	function daysDetailFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="openInfoDetail('+row.uid+')"><img src="__TPL__/images/man.png" width="16"/></a>';  
	}
	function openInfoDetail(uid){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/search/userinfo_detailshow/uid/'+uid+'/flag/1',
						cache:false,
						closable:true
		});
	}
	
	function open_reject(id){
		rejectId=id;
		//$("#reject").show();
		$("#reject").dialog('open');
	}
	
	function doReject(){
		var id=rejectId;
		var reason=$("#reject_reason").val();
		if(reason==""){
			$.messager.alert("提示","请正确填写驳回理由！");
			return false;
		}
		
		$.messager.confirm('提示', '确认要驳回该员工申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/rejectTrans",
					type:'POST',
					data:{
						vid:id,
						reason:reason	
					},
					success:function(data){
						$("#reject").dialog('close');
						if(data=="1"){
					//		$.messager.alert("提示","驳回成功！");
					//		$("#reject").dialog('close');
							$.messager.alert("提示","驳回成功！");
							
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
	function doApprove(id,nums,status,power,departmentid){
		if(power==4&&status=="3"){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2hr/vid/"+id,
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
		}
		else if((status=="1"&&nums<=3)||(status=="2"&&nums>3&&nums<=5)||(status=="2"&&power==4)||(status=="3"&&nums>5&&departmentid!=7)||(status=="1"&&departmentid==2&&nums<=5)||(status=="2"&&departmentid==7) ){
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
		}else if(nums>3&&status=="1"&&departmentid!=2){
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
		}else if((nums>5&&status=="2")||(departmentid==2&&status=="1")){
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
<div id="reject" class="easyui-dialog" style="width:350px;height:250px;" title="驳回理由" data-options="cache:false,modal:true,closed:true">
	<br/>
	<textarea id="reject_reason" rows="10" cols="36"/>
    <button type="button" onclick="doReject()">提交</button>
</div>  
    
</div>