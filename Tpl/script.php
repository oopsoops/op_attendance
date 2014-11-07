<script>
function outObj(obj){
    var description = "";
    for(var i in obj){ 
        var property=obj[i]; 
        description+=i+" = "+property+"\n";
    } 
    $.messager.alert('123',description);
}


//日期选择框格式
function timeformatter(date){  
	var y = date.getFullYear();  
	var m = date.getMonth()+1;  
	var d = date.getDate();  
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);  
}  
function timeparser(s){  
	if (!s) return new Date();  
	var ss = s.split('-');  
	var y = parseInt(ss[0],10);  
	var m = parseInt(ss[1],10);  
	var d = parseInt(ss[2],10);  
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)){  
		return new Date(y,m-1,d);  
	} else {  
		return new Date();  
	}  
}  

//验证表单
$.extend($.fn.validatebox.defaults.rules, {  
    isFloat: {  
        validator: function(value, param){  
            return value.match(/^-?\d+[\.\d]?\d{0,}$/);
        },  
        message: '请输入正确的数字'  
    },
	isInt: {  
        validator: function(value, param){  
            return value.match(/^-?\d+$/);
        },  
        message: '请输入正确的数字'  
    }
}); 

function stylerIsrejected(val,row,index) {
	if(row.isrejected!='正常') {
		return 'color:red';	
	}
	return 'color:blue';
}

//grid格式
function formatCash(val,row){  
	if(val==null) return null;
	return val+'万元';  	
}



function formatCashYuan(val,row){  
	if(val==null) return null;
	return val+'元';  	
}
function formatMonth(val,row){  
	if(val==null) return null;
	return val+'个月'; 
}
function formatArea(val,row){  
	if(val==null) return null;
	return val+'平方米'; 
}
//反担保按钮
function formatGuarantee(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="openGuarantee('+row.pid+')"><img src="__TPL__/images/guarantee.png" width="16"/></a>';  
}
//打开反担保tab
function openGuarantee(pid){
	$('#main').tabs('close','反担保信息');
	$('#main').tabs('add',{
						title:'反担保信息',
						href:'__APP__/Guarantee/guarantee/pid/'+pid,
						cache:false,
						closable:true
						});
}
//项目详细按钮
function formatProjectDetails(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="openProjectDetails('+row.pid+')"><img src="__TPL__/images/details.png" width="16"/></a>';  
}
//打开项目详情tab
function openProjectDetails(pid){
	$('#main').tabs('close','项目详情');
	$('#main').tabs('add',{
						title:'项目详情',
						href:'__APP__/Project/project_details/pid/'+pid,
						cache:true,
						closable:true
						});
}
//资产按钮
function formatProperty(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="openProperty('+row.cid+')"><img src="__TPL__/images/property.png" width="16"/></a>';  
}
//打开资产tab
function openProperty(cid){
	$('#main').tabs('close','资产信息');
	$('#main').tabs('add',{
						title:'资产信息',
						href:'__APP__/Property/property/cid/'+cid,
						cache:false,
						closable:true
						});
}
//客户详细按钮
function formatClientDetails(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="openClientDetails('+row.cid+')"><img src="__TPL__/images/details.png" width="16"/></a>';  
}
//打开客户详情tab
function openClientDetails(cid){
	$('#main').tabs('close','客户详情');
	$('#main').tabs('add',{
						title:'客户详情',
						href:'__APP__/Client/client_details/cid/'+cid,
						cache:true,
						closable:true
						});
}
//提交按钮
function formatSubmit(val,row){  
	if(row.name==null) return null;
	if(row.statusid == <?php echo ($_SESSION['power']+0)?> || row.statusid==6 || row.statusid==7)
		return '<a href="javascript:void(0)" onclick="doSubmit('+row.pid+')"><img src="__TPL__/images/submit.png" width="16"/></a>';  
	else
		return '-';
}
//提交函数
function doSubmit(pid){
	//初始化窗口
	$('#w_submit').window('setTitle','提交项目');
	$('#w_submit').window({href:'__APP__/Project/w_submit/pid/'+pid});
	//打开窗口
	$('#w_submit').window('open');
}  
//驳回按钮
function formatReject(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="doReject('+row.pid+')"><img src="__TPL__/images/reject.png" width="16"/></a>';  
}
//驳回函数
function doReject(pid){
	//初始化窗口
	$('#w_reject').window('setTitle','驳回项目');
	$('#w_reject').window({href:'__APP__/Project/w_reject/pid/'+pid});
	//打开窗口
	$('#w_reject').window('open');
} 

//新增项目按钮
function formatNewProject(val,row){  
	if(row.name==null) return null;
		return '<a href="javascript:void(0)" onclick="openNewProject('+row.cid+')"><img src="__TPL__/images/projectadd.png" width="16"/></a>';  
}
//打开新增项目tab
function openNewProject(cid){
	$('#main').tabs('close','新增项目');
	$('#main').tabs('add',{
						title:'新增项目',
						href:'__APP__/Project/new_project/cid/'+cid,
						cache:true,
						closable:true
						});
}

function formatDocument(val,row){  
	if(row.name==null) return null;
	return '<a href="javascript:void(0)" onclick="openUpload('+row.pid+')"><img src="__TPL__/images/document.png" width="16"/></a>';  
}
function openUpload(pid){
	$('#main').tabs('close','项目文档');
	$('#main').tabs('add',{
						title:'项目文档',
						href:'__APP__/Upload/project_upload/pid/'+pid,
						cache:false,
						closable:true
						});
}



</script>
<div id="w_submit" class="easyui-window" title='提交项目' data-options="iconCls:'icon-save',cache:false,collapsible:false,minimizable:false,maximizable:false,modal:true,closed:true" style="width:350px;height:auto;padding:10px;">  
</div>  
<div id="w_reject" class="easyui-window" title='驳回项目' data-options="iconCls:'icon-save',cache:false,collapsible:false,minimizable:false,maximizable:false,modal:true,closed:true" style="width:400px;height:auto;padding:10px;">  
</div>  
 