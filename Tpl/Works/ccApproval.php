<div class="main_include">
   <table class="easyui-datagrid"   
            id="grid_ccApprove"
            style="height:430px"
            title='出差审批'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Works/getTransitionByType/tid/2"
            >
        <thead>
            <tr> 
                <th field="departmentname" width="100" align="center">员工部门</th>
                <th field="teamname" width="80" align="center">所在组</th> 
                <th field="username" width="80" align="center">员工姓名</th>  
                <th field="uid" width="80" align="center">员工工号</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="transpot" width="50" align="center">交通</th>
                <th field="fee" width="50" align="center">预算</th>
                <th field="detail" width="80" align="center" formatter="ccDetailFormatter">申请详情</th>
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
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+','+row.status+','+row.departmentid+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	
	function ccDetailFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="openccDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
	}
	function openccDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/transitionDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	
	function open_reject(id){
		rejectId=id;
		$("#cc_reject").dialog('open');
	}
	
	
	function doReject(id){
		
		var id=rejectId;
		var reason=$("#cc_reject_reason").val();
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
						$("#cc_reject").dialog('close');
						if(data=="1"){
							$.messager.alert("提示","驳回成功！");
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
	function doApprove(id,status,departmentid){
		if(status=="1"&&departmentid!=2){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2hr/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
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
		if((status=="2"&&departmentid!=3)||(status=="1"&&departmentid==2)){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2caiwu/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
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
		
		if(status=="3"||(status=="4"&&departmentid==7)){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/approveTrans/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
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
		if((status=="4"&&departmentid!=7)||(status=="2"&&departmentid==3)){
			$.messager.confirm('提示', '确认要批准该员工申请？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/sub2boss/vid/"+id,
						type:'GET',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
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
		
	}
	
   
    
</script>
    <div id="cc_reject" class="easyui-dialog" style="width:350px;height:250px;" title="驳回理由" data-options="cache:false,modal:true,closed:true">
	<br/>
	<textarea id="cc_reject_reason" rows="10" cols="36"/>
    <button type="button" onclick="doReject()">提交</button>
</div> 
    
</div>