<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<include file="./Tpl/head.php" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body class="easyui-layout">

	<div data-options="region:'north',border:false" style="height:60px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 顶部 -->
    	<include file="./Tpl/top.php" />
    </div>
    
	<div data-options="region:'south',border:false" style="height:50px;padding:10px;background:url(__TPL__/images/cube.jpg) repeat;">
    <!-- 底部 -->
    	<include file="./Tpl/footer.php" />
    </div>
	<div data-options="region:'center',title:''" style="background:url(__TPL__/images/bg.png) repeat;">
    <!-- 中间 -->
    	
            <div title="登陆页面" style="padding:120px;">  
            	<form id="form_login" method="post" action="__APP__/Index/login">
                <table border="0" align="center" style="color:gray;font-size:1.4em;">
                	<tr>
                    	<td rowspan="4"><img src="__TPL__/images/man.png" width="125"/></td>
                    	<th colspan="3"><h2 style="text-align:left">用户登录</h2></th>
                    </tr>
                	<tr>
                    	<td align="center">用户名</td>
                        <td align="center"><input type="text" name="loginname" tabindex="1" style="width:120px;"/></td>
                        <td rowspan="2" width="100" align="center"><a href="#" onclick="login_submit()" class="easyui-linkbutton" tabindex="3">登录</a></td>
                    </tr>
                    <tr>
                    	<td align="center">密&nbsp;&nbsp;&nbsp;&nbsp;码</td>
                        <td align="center"><input type="password" name="password" onkeypress="if(event.keyCode==13){login_submit()}"  tabindex="2" style="width:120px;"/></td>
                    </tr>
                </table>
            	</form>
            </div>
        
    </div>
    <script>
	function login_submit() {
		$("#form_login").submit();	
	}
	</script>
</body>

</html>
