<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<include file="./Tpl/head.php" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body class="easyui-layout">
<script>
function tree_select(node)
{
	//判断是否为子节点
	if($('#left_menu').tree('isLeaf',node.target))
	{
		$('#main').tabs('close',node.text);
		$('#main').tabs('add',{
							title:node.text,
							href:'__APP__/'+node.attributes.url,
							cache:false,
							closable:true
							});
		/*
		//如果该tabs不存在则创建新的tabs
		if(!$('#main').tabs('exists',node.text))
		{
			$('#main').tabs('add',{
								title:node.text,
								href:'__APP__/'+node.attributes.url,
								closable:true
								});
		} else {
		//tabs存在则选中它并更新
			 $('#main').tabs('select',node.text);
			 $('#main').tabs('update',{
									tab:$('#main').tabs('getTab',node.text),
									options:{
											href:'__APP__/'+node.attributes.url
									}
							 });
		}
		*/
	}
}
</script>
	<div data-options="region:'north',border:false" style="height:60px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 顶部 -->
        <include file="./Tpl/top.php" />
    </div>
    
	<div data-options="region:'west',split:true,title:'操作菜单'" style="width:150px;padding:10px;">
    <!-- 左边 -->
    	<!-- 树形菜单 -->
    	<ul id="left_menu" 
        	class="easyui-tree" 
            data-options="url:'__TPL__/json/<?php echo $_SESSION['menu']?>',method:'GET',onSelect:function(node){tree_select(node)}">
        </ul>
    </div>
    
	<div data-options="region:'south',border:false" style="height:50px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 底部 -->
    	<include file="./Tpl/footer.php" />
    </div>
	<div data-options="region:'center',title:'用户：<?php echo $_SESSION['username']?>&nbsp;【<?php echo $_SESSION['departmentname']?>】&nbsp;&nbsp;&nbsp;&nbsp;<a href=__APP__/Index/logout>退出</a>'">
    <!-- 中间 -->
    	<div id="main" class="easyui-tabs" data-options="fit:true">  
            <div title="我的首页" data-options="fit:true,cache:false,href:'__APP__/Index/home'" style="background:url(__TPL__/images/greenlight.jpg) no-repeat top right;">  
            </div>   
        </div>  
    </div>
    
</body>

</html>
