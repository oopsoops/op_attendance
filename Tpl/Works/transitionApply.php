<div class="main_include">
   
    
    	<div id="tt" class="easyui-tabs" style="width:1024px;height:500px;"> 
            <div title="加班申请" style="padding:20px;"> 
            <form id="transitionApply_Form" method="post">
            	
                 <?php if ($teamlist[0]['teamid']!=1&&$power==3){ ?>
                    选择员工：
                    <select id="uid">
                        <?php 
								echo "<option value=''>全部</option>";
								for($i=0;$i<count($teamlist);$i++){
                                    echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username']."</option>";	
                              }
                        ?>	  
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php }?>
                    
                  
                    开始日期：
                        <input id="trans_begin_date" type="text" style="width:100px" />
                    开始时间：
                        <input type="text" id="trans_starttime" class="easyui-timespinner"  value="08:30" />
                    结束日期：
                        <input id="trans_end_date" type="text" style="width:100px" />
                    结束时间：
                        <input type="text" id="trans_endtime" class="easyui-timespinner"  value="17:30" />
                    <br/><br />
                    是否周末加班
                    <select id="iszm">
                    	<option value='1'>否</option>
                        <option value='2'>是</option>
                    </select>
                    <br /><br />
                    申请理由：<br />
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <textarea id="reason" rows="8" cols="100"></textarea><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="easyui-linkbutton" iconCls="icon-search" onclick="apply()">提交</a>
                        
                   
                 </form> 
            </div> 
            
            
            <div title="休假申请"  style="overflow:auto;padding:20px;"> 
             <?php if ($teamlist[0]['teamid']!=1&&$power==3){ ?>
                    选择员工：
                    <select id="uid2">
                        <?php for($i=0;$i<count($teamlist);$i++){
                                    echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username']."</option>";	
                              }
                        ?>	  
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php }?>
                    
                    开始日期：
                        <input id="trans_begin_date2" type="text" style="width:100px" />
                    开始时间：
                        <input type="text" id="trans_starttime2" class="easyui-timespinner"  value="08:30" />
                    结束日期：
                        <input id="trans_end_date2" type="text" style="width:100px" />
                    结束时间：
                        <input type="text" id="trans_endtime2" class="easyui-timespinner"  value="17:30" />
                    <br/><br />
                    休假类型：
                    <select id="holiday">
                        <option value="">请选择</option>
                        <option value="年假">年假</option>
                        <option value="调休假">调休假</option>
                        <option value="病假<=6个月">病假<=6个月</option>
                        <option value="病假>=6个月">病假>=6个月</option>
                        <option value="婚假">婚假</option>
                        <option value="产假">产假</option>
                        <option value="陪产假">陪产假</option>
                        <option value="事假">事假</option>
                        <option value="工伤假">工伤假</option>
                        <option value="哺乳假">哺乳假</option>
                        <option value="丧假">丧假</option>
                        
                    </select>
                        <a class="easyui-linkbutton" iconCls="icon-search" onclick="apply2()">提交</a>
                
            </div>
     
            <div id="divcc" title="出差申请"   style="padding:20px;"> 
                    <?php if ($teamlist[0]['teamid']!=1&&$power==3){ ?>
                    选择员工：
                    <select id="uid3">
                        <?php for($i=0;$i<count($teamlist);$i++){
                                    echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username']."</option>";	
                              }
                        ?>	  
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php }?>
                  
                    开始日期：
                        <input id="trans_begin_date3" type="text" style="width:100px" />
                    开始时间：
                        <input type="text" id="trans_starttime3" class="easyui-timespinner"  value="08:30" />
                    结束日期：
                        <input id="trans_end_date3" type="text" style="width:100px" />
                    结束时间：
                        <input type="text" id="trans_endtime3" class="easyui-timespinner"  value="17:30" />
                    <br/><br />
                    目的地：&nbsp;&nbsp;&nbsp;<input id="place" type="text" style="width:100px" /><br /><br />
                    住宿费用：
                    	<input id="stayfee" type="text" style="width:100px" />
                    餐饮费用：
                    	<input id="foodfee" type="text" style="width:100px" />
                        
                    交通费用：
                        <input id="transpot" type="text" style="width:100px" />
                    其他费用：
                        <input id="otherfee" type="text" style="width:100px" /><br /><br />
                        合&nbsp;&nbsp;&nbsp;&nbsp;计：
                        <input id="totalfee" type="text" style="width:100px" />
                    备注信息：
                         <input id="ccbz" type="text" style="width:280px" />
                    <br /><br/>
                        出差事由：
                        <textarea id="reason3" rows="2" cols="100"></textarea><br />
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="easyui-linkbutton" iconCls="icon-search" onclick="apply3()">提交</a>
            </div>
		</div> 
    
    
    
     
    
    <script>
	/************************************加班申请***************************************/
	$('#trans_begin_date').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#trans_end_date').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});
	function apply(){
		var transdm="1";
		var begindate=$('#trans_begin_date').combo("getValue");
		var enddate=$("#trans_end_date").combo("getValue");
		var begintime=$('#trans_starttime').val();
		var endtime=$("#trans_endtime").val();
		var uid=$("#uid").val();
		var iszm=$("#iszm").val();
		if(begindate==""||enddate==""){
			$.messager.alert("提示","请同时填写开始日期和结束日期！");
			return false;
		}
		if(enddate<begindate){
			$.messager.alert("提示","结束日期不能早于开始日期！");
			return false;
		}
		if((enddate==begindate)&&(endtime<begintime)){
			$.messager.alert("提示","同一天结束时间不能早于开始时间！");
			return false;
		}
		var reason=$("#reason").val();
		if(reason==""){
			$.messager.alert("提示","请填写申请理由！");
			return false;
		}
		var begin=begindate+" "+begintime;
		var end=enddate+" "+endtime;
		$(".easyui-linkbutton").linkbutton("disable");
		
		if(uid!=""){
			$.ajax({
				url: "__APP__/Works/dealApply",
				data:{
					begindate:begindate,
					enddate:enddate,
					begintime:begintime,
					endtime:endtime,
					reason:reason,
					transdm:transdm,
					uid:uid,
					iszm:iszm
				},
				type:'POST',
				success:function(data){
				//	alert(data);
					if(data=="1"){
						$.messager.alert("提示","提交成功！");
						$(".easyui-linkbutton").linkbutton("enable");
						
					}				
				},
				error:function(XMLHttpRequest,textStatus,errorThrown){
					alert(''+errorThrown)
				}
			});	
		}else if(uid==""){
			$.ajax({
			url: "__APP__/Works/allJbApply",
			data:{
				begindate:begindate,
				enddate:enddate,
				begintime:begintime,
				endtime:endtime,
				reason:reason,
				transdm:transdm
			},
			type:'POST',
			success:function(data){
				if(data=="1"){
					
					$.messager.alert("提示","提交成功！");
					$(".easyui-linkbutton").linkbutton("enable");
				}				
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				alert(''+errorThrown)
			}
		});
		}
	}
	
	function applycx(){
		var transdm="1";
		var begindate=$('#trans_begin_date').combo("getValue");
		var enddate=$("#trans_end_date").combo("getValue");
		var begintime=$('#trans_starttime').val();
		var endtime=$("#trans_endtime").val();
		if(begindate==""||enddate==""){
			$.messager.alert("提示","请同时填写开始日期和结束日期！");
			return false;
		}
		if(enddate<begindate){
			$.messager.alert("提示","结束日期不能早于开始日期！");
			return false;
		}
		if((enddate==begindate)&&(endtime<begintime)){
			$.messager.alert("提示","同一天结束时间不能早于开始时间！");
			return false;
		}
		var reason=$("#reason").val();
		if(reason==""){
			$.messager.alert("提示","请填写申请理由！");
			return false;
		}
		var begin=begindate+" "+begintime;
		var end=enddate+" "+endtime;
		
		$(".easyui-linkbutton").linkbutton("disable");
		$.ajax({
			url: "__APP__/Works/allJbApply",
			data:{
				begindate:begindate,
				enddate:enddate,
				begintime:begintime,
				endtime:endtime,
				reason:reason,
				transdm:transdm
			},
			type:'POST',
			success:function(data){
				if(data=="1"){
					
					$.messager.alert("提示","提交成功！");
					$(".easyui-linkbutton").linkbutton("enable");
				}				
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				alert(''+errorThrown)
			}
		});	
	}
	
	/************************************休假申请*************************************/
	$('#trans_begin_date2').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#trans_end_date2').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});
	function apply2(){
		var transdm="3";
		var begindate=$('#trans_begin_date2').combo("getValue");
		var enddate=$("#trans_end_date2").combo("getValue");
		var begintime=$('#trans_starttime2').val();
		var endtime=$("#trans_endtime2").val();
		var holiday=$("#holiday").val();
		var uid=$("#uid2").val();
		if(holiday==""){
			$.messager.alert("提示","请休假类型！");
			return false;
		}
		if(begindate==""||enddate==""){
			$.messager.alert("提示","请同时填写开始日期和结束日期！");
			return false;
		}
		if(enddate<begindate){
			$.messager.alert("提示","结束日期不能早于开始日期！");
			return false;
		}
		if((enddate==begindate)&&(endtime<begintime)){
			$.messager.alert("提示","同一天结束时间不能早于开始时间！");
			return false;
		}
		var begin=begindate+" "+begintime;
		var end=enddate+" "+endtime;
		$(".easyui-linkbutton").linkbutton("disable");
		$.ajax({
			url: "__APP__/Works/dealApply",
			data:{
				begindate:begindate,
				enddate:enddate,
				begintime:begintime,
				endtime:endtime,
				transdm:transdm,
				holiday:holiday,
				uid:uid			
			},
			type:'POST',
			success:function(data){
				if(data=="1"){
					$.messager.alert("提示","提交成功！");
					$(".easyui-linkbutton").linkbutton("enable");
				}				
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				alert(''+errorThrown)
			}
		});	
	}
	/************************************出差申请*************************************/
	$('#trans_begin_date3').datebox({	
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100
	});
	$('#trans_end_date3').datebox({
			formatter:timeformatter,
			parser:timeparser,
			editable:false,
			width: 100		
	});
	function apply3(){
		$.messager.confirm('提示', '确认要提交并打印？', function(r){  
			if (r){
		
					var transdm="2";
					var uid=$("#uid3").val();
					var begindate=$('#trans_begin_date3').combo("getValue");
					var enddate=$("#trans_end_date3").combo("getValue");
					var begintime=$('#trans_starttime3').val();
					var endtime=$("#trans_endtime3").val();
					if(begindate==""||enddate==""){
						$.messager.alert("提示","请同时填写开始日期和结束日期！");
						return false;
					}
					if(enddate<begindate){
						$.messager.alert("提示","结束日期不能早于开始日期！");
						return false;
					}
					if((enddate==begindate)&&(endtime<begintime)){
						$.messager.alert("提示","同一天结束时间不能早于开始时间！");
						return false;
					}
					var place=$("#place").val();
					if(place==""){
						$.messager.alert("提示","请填写目的地！");
						return false;
					}
					var stayfee=$("#stayfee").val();
					if(stayfee==""){
						$.messager.alert("提示","请填写住宿费用！");
						return false;
					}
					var foodfee=$("#foodfee").val();
					if(foodfee==""){
						$.messager.alert("提示","请填写餐饮费用！");
						return false;
					}
					
					var transpot=$("#transpot").val();
					if(transpot==""){
						$.messager.alert("提示","请填写交通费用！");
						return false;
					}
					var otherfee=$("#otherfee").val();
					if(otherfee==""){
						otherfee=0;
					}
					var totalfee=$("#totalfee").val();
					if(totalfee==""||isNaN(totalfee)){
						$.messager.alert("提示","请正确填写合计！");
						return false;
					}
					
					
					var reason=$("#reason3").val();
					if(reason==""){
						$.messager.alert("提示","请填写出差事由！");
						return false;
					}
					var ccbz=$("#ccbz").val();
					
					var begin=begindate+" "+begintime;
					var end=enddate+" "+endtime;
					$(".easyui-linkbutton").linkbutton("disable");
					$.ajax({
						url: "__APP__/Works/dealApply",
						data:{
							begindate:begindate,
							enddate:enddate,
							begintime:begintime,
							endtime:endtime,
							reason:reason,
							transdm:transdm,
							stayfee:stayfee,
							foodfee:foodfee,
							otherfee:otherfee,
							transpot:transpot,
							totalfee:totalfee,
							place:place,
							ccbz:ccbz,
							uid:uid
						},
						type:'POST',
						success:function(data){
							if(data=="1"){
								$.messager.alert("提示","提交成功！");
								
								$(".easyui-linkbutton").linkbutton("enable");
							}				
						},
						error:function(XMLHttpRequest,textStatus,errorThrown){
							alert(''+errorThrown)
						}
					});	
			}
		});
	}
	
	
	
	
	
	
	
	
	$('#tt').tabs({ 
		border:false, 
		onSelect:function(title){ 
			
		} 
	}); 
	var pp = $('#tt').tabs('getSelected'); 
	var tab = pp.panel('options').tab; // 相应的 tab 对象
	
	</script>
    
</div>