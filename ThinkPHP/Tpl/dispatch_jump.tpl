<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<include file="./Tpl/head.php" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Refresh" content="<{$waitSecond}>; URL=<{$jumpUrl}>"/>
<style>
html, body{margin:0; padding:0; border:0 none;font:14px Tahoma,Verdana;line-height:150%;background:white}
a{text-decoration:none; color:#174B73; border-bottom:1px dashed gray}
a:hover{color:#F60; border-bottom:1px dashed gray}
div.message{margin:10% auto 0px auto;clear:both;padding:5px;border:1px solid silver; text-align:center; width:45%}
span.wait{color:blue;font-weight:bold}
span.error{color:red;font-weight:bold}
span.success{color:blue;font-weight:bold}
div.msg{margin:20px 0px}
</style>
<script>
    function refresh(){
        location.href ="<?php echo $jumpUrl ?>";
    }
    setTimeout("refresh()", <?php echo $waitSecond ?>000);
</script>
</head>
<body class="easyui-layout">
	<div data-options="region:'north',border:false" style="height:60px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 顶部 -->
        <img src="__TPL__/images/logo.png" height="40" style="float:left"/> 
    </div>
    
	<div data-options="region:'south',border:false" style="height:50px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 底部 -->
    	footer
    </div>
	<div data-options="region:'center',title:''" style="background:url(__TPL__/images/bg.png) repeat;">
    <!-- 中间 -->
        <div class="message" style="margin-left:350px;">
            <div class="msg">
                <present name="message" >
                <span class="success">{$msgTitle}{$message}</span>
                <else/>
                <span class="error">{$msgTitle}{$error}</span>
                </present>
                </div>
                <div class="tip">
                <present name="closeWin" >
                    页面将在<span class="wait">{$waitSecond}</span> 秒后关闭, 点<a href="{$jumpUrl}">这里</a>立即关闭页面.
                <else/>
                    页面将在<span class="wait">{$waitSecond}</span> 秒后跳转, 点<a href="{$jumpUrl}">这里</a>立即跳转页面.
                </present>
            </div>
        </div>
    </div>
    
</body>

</html>


