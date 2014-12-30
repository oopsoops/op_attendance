<div class="main_include">

	<div id="ext_worktimelist"  style="padding:5px;height:auto">
        <div class="toolbar_columns">
            <div>
                <select id="worktimelist_teamid" onchange="worktimelist_fetchbyteamid()">
                <?php for($i=0;$i<count($teamlist);$i++) {?>
                    <option value="<?php echo $teamlist[$i]['tid'];?>"><?php echo $teamlist[$i]['teamname']?></option>
                <?php }?>
                </select>
            </div>
            <div>
                <a onclick="openWorktimeNew()" class="easyui-linkbutton" plain="true" data-options="iconCls:'icon-add'">新增</a>
            </div>
            <div>
                <a onclick="openWorktimeClndr()" class="easyui-linkbutton" plain="true" data-options="iconCls:'icon-cal'">日历</a>
            </div>
            <div style="padding-left:160px">
                <label style="padding-right:10px">月份：</label>
                <select id="worktimelist_month" onchange="worktimelist_fetchbyteamid()">
                    <option value="0">去年12月</option>
                    <option value="1">1月</option>
                    <option value="2">2月</option>
                    <option value="3">3月</option>
                    <option value="4">4月</option>
                    <option value="5">5月</option>
                    <option value="6">6月</option>
                    <option value="7">7月</option>
                    <option value="8">8月</option>
                    <option value="9">9月</option>
                    <option value="10">10月</option>
                    <option value="11">11月</option>
                    <option value="12">12月</option>
                    <option value="13">明年1月</option>
                </select>
            </div>
        </div>
        <div style="clear:both"></div>
    </div>

    <table class="easyui-datagrid"   
            id="grid_worktimelist"     
            toolbar="#ext_worktimelist"
            style="height:430px"
            title='排班管理'
            singleSelect="true"
            striped="true"
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/fetchWorktimeList"
            data-options="queryParams: {
                            teamid: $('#worktimelist_teamid').val(),
                            month: $('#worktimelist_month').val()
                        },
                        onLoadSuccess: function() {
                            var month = $('#worktimelist_month').val();
                            if(month==13) {
                                //明年1月
                                date2 = new Date(date.getFullYear()+1,0,date.getDate());
                            } else if(month==0) {
                                date2 = new Date(date.getFullYear()-1,11,date.getDate());
                            } else {
                                date2 = new Date(date.getFullYear(),month-1,date.getDate());
                            }
                            initClndr('worktimelist_win',date2);
                            fetchClndr('worktimelist_win',date2,$('#grid_worktimelist').datagrid('getData'));
                        }"
            >
            
        <thead>
            <tr> 
                <!-- <th field="teamname" width="100" align="center">所在组</th> -->
                <th field="workdate1" width="100" align="center">起始日期</th>  
                <th field="workdate2" width="100" align="center">结束日期</th>
                <th field="worktime1" width="100" align="center">上班时间</th>  
                <th field="worktime2" width="100" align="center">下班时间</th>
                <th field="details" width="80" align="center" formatter="editWorktimeFormatter">修改</th>
                <th field="delete" width="80" align="center" formatter="delWorktimeFormatter">删除</th>
            </tr>  
        </thead>  
    </table>


    <div id="worktimelist_win" class="easyui-window" title='排班日历' data-options="iconCls:'icon-cal',cache:false,modal:false,closed:true,left:800,top:200" style="width:400px;height:350px;">  
        <table id="clndr" border="0" width="100%" height="90%"></table>
        <div class="notice" style="color:blue"> 蓝色：已排班</div>
        <div class="notice" style="color:red"> 红色：重复排班</div>
    </div>


<script>

var date = new Date();
$("#worktimelist_month").val(date.getMonth()+1);

var month = $('#worktimelist_month').val();
var date2 = new Date(date.getFullYear(),month-1,date.getDate());
initClndr('worktimelist_win',date2);

function openWorktimeClndr() {
    $("#worktimelist_win").window('open');
}

function editWorktimeFormatter(val,row){  
    return '<a href="javascript:void(0)" onclick="openWorktimeEdit('+row.id+')"><img src="__TPL__/images/invoice.png" width="16"/></a>';  
}
function delWorktimeFormatter(val,row){  
    return '<a href="javascript:void(0)" onclick="doDeleteWorktime('+row.id+')"><img src="__TPL__/images/del.png" width="16"/></a>';  
}
function openWorktimeEdit(id){
    $('#w_worktimeedit').window({href:'__APP__/Hr/w_worktimeedit/id/'+id});
    $('#w_worktimeedit').window({title:'修改'});
    $('#w_worktimeedit').window('open');
}

function openWorktimeNew(){
    var teamid = $('#worktimelist_teamid').val();
    $('#w_worktimeedit').window({href:'__APP__/Hr/w_worktimenew/teamid/'+teamid});
    $('#w_worktimeedit').window({title:'新增'});
    $('#w_worktimeedit').window('open');
}

function doDeleteWorktime(id) {

    $.messager.confirm('确认','确认要删除此项？',function(r){   
        if (r){   
           $.ajax({
                url:'__APP__/Hr/doWorktimeDel/id/'+id,
                success:function(data) {
                    if (data=="ok") {
                       worktimelist_fetchbyteamid();
                    } else {
                        alert(data);
                    }
                }
            });  
        }   
    });  

}

function worktimelist_fetchbyteamid() {
    $('#grid_worktimelist').datagrid('loadData',{total:0,rows:[]});
    $('#grid_worktimelist').datagrid('reload',{
        teamid: $('#worktimelist_teamid').val(),
        month: $('#worktimelist_month').val()
    });
}

</script>


<div id="w_worktimeedit" class="easyui-window" title='修改' data-options="iconCls:'icon-edit',cache:false,collapsible:false,minimizable:false,maximizable:false,modal:true,closed:true" style="width:550px;height:auto;padding:10px;">  
</div> 

</div>