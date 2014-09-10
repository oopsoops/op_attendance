<div class="main_include">

<table width="auto" class="tb" style="padding:20px;">
    <tr>
        <th colspan="4">
            <div>排班情况</div>
        </th>
    </tr>
    <tr>
        <td>所属组别</td>
        <td colspan="3"><?php echo $worktime['teamname']?></td>
    </tr>
    <tr>
        <td>上班时间</td>
        <td><?php echo ($worktime)?substr($worktime['worktime1'],0,5):"未设定"?></td>
        <td>下班时间</td>
        <td><?php echo ($worktime)?substr($worktime['worktime2'],0,5):"未设定"?></td>
    </tr>
</table>

<!--
<div class="propertygroup">
<table class="easyui-propertygrid" style="width:300px;height:100px"  
		data-options="
        	url:'__APP__/Index/fetch_static',
        	showHeader:false,
            showGroup:true,
            fitColumns:true,
            scrollbarSize:0">

</table>  
</div>
-->
<!-- 
<div class="propertygroup">
<table class="easyui-propertygrid" style="width:300px;"  
		data-options="
        	url:'__APP__/Index/fetch_totalmsg',
        	showHeader:false,
            showGroup:true,
            fitColumns:true,
            scrollbarSize:0">

</table>  
</div>
-->

<div style="clear:both"></div>

<script>

function openTab(title,path) {
	$('#main').tabs('close',title);
	$('#main').tabs('add',{
						title:title,
						href:'__APP__/'+path,
						cache:false,
						closable:true
						});
}
</script>







</div>
