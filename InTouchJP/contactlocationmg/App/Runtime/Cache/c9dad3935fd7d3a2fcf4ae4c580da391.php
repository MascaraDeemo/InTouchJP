<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>网上图书馆后台</title>
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css"
              href="__PUBLIC__/easyui/themes/<?php echo (($_COOKIE["easyuiThemeName"])?($_COOKIE["easyuiThemeName"]):'default'); ?>/easyui.css"/>
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"/>
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/all.css"/>
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css"/>
        <script type="text/javascript" src="__PUBLIC__/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/json2.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/style.css" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/animations.css"/>
		<script src="__PUBLIC__/js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style>
		<![endif]-->

		<style>
			body {
				background: #7f9b4e url(__PUBLIC__/images/bg2.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
        <script type="text/javascript">

            $(function () {
                document.onkeydown=function (e){
                    e = e ? e : event;
                    if(e.keyCode == 13){
                        login();
                    }
                }
            });

            function login() {
                var username = $("#username").val();
                var passwd = $("#passwd").val();
                if(trim(username) == "" || trim(passwd) == ""){
                    $.messager.alert("提示", '请输入用户名和密码！');
                    return;
                }
                openBackGround();
                $.post("__APP__/Index/login",{username:username,passwd:passwd},function(data){
                    closeBackGround();
                    data = JSON.parse(data);
                    if (data == null) {
                        $.messager.alert("提示", '用户名或密码错误！');
                    } else {
                        //$.messager.alert("提示", '登录成功！');
                        window.location.href = "__APP__/Index/index";
                    }
                });
            }


        </script>
    </head>
    <body>
        <div class="container">
			
			<header>
				
			</header>
			
			<section class="main">
				<form class="form-4">
				    <h1>图书管理后台登陆</h1>
				    <p>
				        <label for="username">用户名</label>
				        <input type="text" name="username" id="username" placeholder="用户名..." required>
				    </p>
				    <p>
				        <label for="passwd">密码</label>
				        <input type="password" name='passwd' id="passwd" placeholder="密码..." required>
				    </p>

				    <p>
				        <input type="button" onclick="login();" value="登陆">
				    </p>       
				</form></section>
			
        </div>
        <script type="text/javascript">
            //$(".main").addClass(randAnimation());
        </script>
    </body>
</html>