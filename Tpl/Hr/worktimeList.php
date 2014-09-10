<div class="main_include">

	<div id="ext_worktimelist"  style="padding:5px;height:auto">
        <select id="worktimelist_teamid" onchange="worktimelist_fetchbyteamid()">
        <?php for($i=0;$i<count($teamlist);$i++) {?>
            <option value="<?php echo $teamlist[$i]['tid'];?>"><?php echo $teamlist[$i]['teamname']?></option>
        <?php }?>
        </select>
        <a onclick="openWorktimeNew()" class="easyui-linkbutton" plain="true" data-options="iconCls:'icon-add'">新增</a>
    </div>

    <table class="easyui-datagrid"   
            id="grid_worktimelist"     
            toolbar="#ext_worktimelist"
            style="height:430px"
            title='排班管理'
            singleSelect="true"
            striped="true"s
            loadMsg='载入中...' 
            pagination="true"
            rownumbers="true"
            pageList="[5,10,15]"
            url="__APP__/Hr/fetchWorktimeList"
            data-options="queryParams: {
                            teamid: $('#worktimelist_teamid').val()
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


<script>
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
                        $('#grid_worktimelist').datagrid('reload',{
                            teamid: $('#worktimelist_teamid').val()
                        });
                    } else {
                        alert(data);
                    }
                }
            });  
        }   
    });  

}

function worktimelist_fetchbyteamid() {
    $('#grid_worktimelist').datagrid('reload',{
        teamid: $('#worktimelist_teamid').val()
    });
}

</script>


<div id="w_worktimeedit" class="easyui-window" title='修改' data-options="iconCls:'icon-edit',cache:false,collapsible:false,minimizable:false,maximizable:false,modal:true,closed:true" style="width:550px;height:auto;padding:10px;">  
</div> 

</div>