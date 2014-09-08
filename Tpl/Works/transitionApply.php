<div class="main_include">
    <div id="ext_mosearchmanage"  style="padding:10px;height:auto">
    
    <div id="tt" class="easyui-tabs" style="width:1024px;height:500px;"> 
<div title="加班申请" style="padding:20px;"> 
<form id="transitionApply_Form" method="post">
     <?php if ($teamlist[0]['teamid']!=1&&$power==3){ ?>
        选择员工
        <select id="uid">
            <?php for($i=0;$i<count($teamlist);$i++){
                        echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username'];	
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
        选择员工
        <select id="uid2">
            <?php for($i=0;$i<count($teamlist);$i++){
                        echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username'];	
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
            <option value="病假">病假</option>
            <option value="婚假">婚假</option>
            <option value="产假">产假</option>
            <option value="其他">其他</option>
            
        </select>
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="apply2()">提交</a>
	
</div>
 
<div title="出差申请"   style="padding:20px;"> 
		<?php if ($teamlist[0]['teamid']!=1&&$power==3){ ?>
        选择员工
        <select id="uid3">
            <?php for($i=0;$i<count($teamlist);$i++){
                        echo "<option value='".$teamlist[$i]['uid']."'>".$teamlist[$i]['username'];	
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
        交通方式：
        	<input id="transpot" type="text" style="width:100px" />
        预算费用：
        	<input id="fee" type="text" style="width:100px" />
        出差事由：<br /><br/>
        	&nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp;
            <textarea id="reason3" rows="8" cols="100"></textarea><br />
            &nbsp;&nbsp;&nbsp;&nbsp; 
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="easyui-linkbutton" iconCls="icon-search" onclick="apply3()">提交</a>
</div>


 
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
		$.ajax({
			url: "__APP__/Works/dealApply",
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
		$.ajax({
			url: "__APP__/Works/dealApply",
			data:{
				begindate:begindate,
				enddate:enddate,
				begintime:begintime,
				endtime:endtime,
				transdm:transdm,
				holiday:holiday				
			},
			type:'POST',
			success:function(data){
				if(data=="1"){
					$.messager.alert("提示","提交成功！");
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
		var transdm="2";
		
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
		var transpot=$("#transpot").val();
		if(transpot==""){
			$.messager.alert("提示","请填写交通方式！");
			return false;
		}
		var fee=$("#fee").val();
		if(fee==""){
			$.messager.alert("提示","请填写预算！");
			return false;
		}
		var reason=$("#reason3").val();
		if(reason==""){
			$.messager.alert("提示","请填写申请理由！");
			return false;
		}
		var begin=begindate+" "+begintime;
		var end=enddate+" "+endtime;
		$.ajax({
			url: "__APP__/Works/dealApply",
			data:{
				begindate:begindate,
				enddate:enddate,
				begintime:begintime,
				endtime:endtime,
				reason:reason,
				transdm:transdm,
				fee:fee,
				transpot:transpot
			},
			type:'POST',
			success:function(data){
				if(data=="1"){
					$.messager.alert("提示","提交成功！");
				}				
			},
			error:function(XMLHttpRequest,textStatus,errorThrown){
				alert(''+errorThrown)
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