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
                <th field="applytime" width="140" align="center">申请时间</th>
               <th field="detail" width="80" align="center" formatter="jbDetailFormatter">申请详情</th>
                <th field="rejiect" width="40" align="center" formatter="rejectFormatter">驳回</th>
                <th field="approve" width="40" align="center" formatter="approveFormatter">批准</th>
            </tr>  
        </thead>  
    </table>
    </div>
    
    <div title="批量审批" style="padding:20px;">
    	  <table class="easyui-datagrid"   
            id="grid_jbAllApprove"
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
                
                <th field="teamname" width="80" align="center">组名</th>
                <th field="begindate" width="80" align="center">开始日期</th>
                <th field="begintime" width="80" align="center">开始时间</th>
                <th field="enddate" width="80" align="center">结束日期</th>
                <th field="endtime" width="80" align="center">结束时间</th>
                <th field="applytime" width="140" align="center">申请时间</th>
                <th field="reason" width="180" align="center">加班理由</th>
                <th field="rejiectall" width="40" align="center" formatter="rejectallFormatter">驳回</th>
                <th field="approveall" width="40" align="center" formatter="approveallFormatter">批准</th>  
            </tr>  
        </thead>  
    </table>
    </div>
<script>
   
	var rejectId=""; 
	var rejectTid="";  
	function rejectFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="open_reject('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doApprove('+row.id+','+row.nums+','+row.status+','+row.power+','+row.departmentid+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	
	function jbDetailFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="openjbDetail('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
	}
	function openjbDetail(id){
		$('#main').tabs('close','申请详情');
		$('#main').tabs('add',{
						title:'申请详情',
						href:'__APP__/works/transitionDetail/vid/'+id,
						cache:false,
						closable:true
		});
	}
	
	
	function rejectallFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="open_all_reject('+row.teamid+')"><img src="__TPL__/images/del.png" width="16"/></a>';
	}
	function approveallFormatter(val,row){
		return '<a href="javascript:void(0)" onclick="doallApprove('+row.teamid+','+row.days+','+row.status+')"><img src="__TPL__/images/check.png" width="16"/></a>';
	}
	
	function open_reject(id){
		rejectId=id;
		$("#jb_reject").dialog('open');
	}
	function open_all_reject(tid){
		rejectTid=tid;
		$("#jb_all_reject").dialog('open');
	}
	
	
	function doReject(id){
		
		var id=rejectId;
		var reason=$("#jb_reject_reason").val();
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
						$("#jb_reject").dialog('close');
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
	
	function doallReject(){
		var teamid=rejectTid;
		var reason=$("jball_reject_reason").val();
		$.messager.confirm('提示', '确认要驳回该条产线加班申请？', function(r){  
			if (r){
				$.ajax({
					url:"__APP__/Works/rejectallTrans",
					type:'POST',
					data:{
						teamid:teamid,
						reason:reason
					},
					success:function(data){
						$("#jb_all_reject").dialog('close');
						if(data=="1"){
							$.messager.alert("提示","驳回成功！");
							$('#grid_jbAllApprove').datagrid('loadData', { total:0, rows:[ ]});
							$('#grid_jbAllApprove').datagrid('load', { });
						}				
					},
					error:function(XMLHttpRequest,textStatus,errorThrown){
						alert(''+errorThrown);
					}	
				});
			}
		});
	}
	
	function doallApprove(teamid,days,status){
		
		if(days<=1||status=="2"){
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
								$('#grid_jbAllApprove').datagrid('loadData', { total:0, rows:[ ]});
								$('#grid_jbAllApprove').datagrid('load', { });
							}				
						},
						error:function(XMLHttpRequest,textStatus,errorThrown){
							alert(''+errorThrown);
						}	
					});
				}
			});
		}else if(days>1&&status=="1"){
			$.messager.confirm('提示', '加班时间大于一小时需要提交人事经理审批，是否提交？', function(r){  
				if (r){
					$.ajax({
						url:"__APP__/Works/all2hr",
						type:'POST',
						data:{
							tid:teamid
						},
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","批准成功！");
								$('#grid_jbAllApprove').datagrid('loadData', { total:0, rows:[ ]});
								$('#grid_jbAllApprove').datagrid('load', { });
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
	
	
	
	function doApprove(id,nums,status,power,departmentid){
		if((power==4&&status=="3"&&departmentid!=2)||(status=="3"&&nums>1&&departmentid==7)){
			$.messager.confirm('提示', '确认要批准该员工加班申请？', function(r){  
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
		else if(((status=="1"&&nums<=1)||(departmentid==2))||(status=="2")||(status=="1"&&departmentid==2)||(status=="3"&&departmentid==7&&nums<=1)){
			$.messager.confirm('提示', '确认要批准该员工加班申请？', function(r){  
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
		}else if(status=="1"&&nums>1&&departmentid!=2){
			$.messager.confirm('提示', '加班时间大于1小时需要提交人事经理，是否提交？', function(r){  
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
	}

    
    
</script>
    
    </div>
    
    <div id="jb_reject" class="easyui-dialog" style="width:350px;height:250px;" title="驳回理由" data-options="cache:false,modal:true,closed:true">
	<br/>
	<textarea id="jb_reject_reason" rows="10" cols="36"/>
    <button type="button" onclick="doReject()">提交</button>
</div>  

<div id="jb_all_reject" class="easyui-dialog" style="width:350px;height:250px;" title="驳回理由" data-options="cache:false,modal:true,closed:true">
	<br/>
	<textarea id="jball_reject_reason" rows="10" cols="36"/>
    <button type="button" onclick="doallReject()">提交</button>
</div>  
</div>