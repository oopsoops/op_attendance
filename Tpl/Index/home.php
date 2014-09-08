<div class="main_include">

<div class="propertygroup">
<table class="easyui-propertygrid" style="width:300px;"  
		data-options="
        	url:'__APP__/Index/fetch_static',
        	showHeader:false,
            showGroup:true,
            fitColumns:true,
            scrollbarSize:0">

</table>  
</div>
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
