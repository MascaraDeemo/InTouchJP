<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css"
          href="__PUBLIC__/easyui/themes/<?php echo (($_COOKIE["easyuiThemeName"])?($_COOKIE["easyuiThemeName"]):'default'); ?>/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/all.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/index.css"/>
    <script type="text/javascript" src="__PUBLIC__/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/ideaframe.js"></script>
    <script type="text/javascript">
        var roletype = "<?php echo session('roletype');?>";
        var billtype = "<?php echo session('billtype');?>";
        $(function(){
            if(roletype){
                if(roletype == "1"){
                    $("#iframepage").attr("src","__APP__/Good/good");
                }else if(roletype == "3"){
                    $("#iframepage").attr("src","__APP__/Good/good");
                }else if(roletype == "2"){
                    $("#iframepage").attr("src","__APP__/Good/good");
                }
            }
        });
        var _menus = "";
        if(roletype == "1"){
            _menus = {
                "menus": [
                    {"menuid": "1", "icon": "icon-magic", "menuname": "图书管理",
                        "menus": [
                            {"menuid": "12", "menuname": "图书管理列表", "icon": "icon-database", "url": "__APP__/Good/good"}
                        ]},
                    /*{"menuid": "1", "icon": "icon-magic", "menuname": "校园文化",
                        "menus": [
                            {"menuid": "12", "menuname": "校园文化列表", "icon": "icon-database", "url": "__APP__/Notice/notice"}
                        ]},*/
                    {"menuid": "1", "icon": "icon-magic", "menuname": "类别管理",
                        "menus": [
                            {"menuid": "12", "menuname": "类别列表", "icon": "icon-database", "url": "__APP__/Type/type"}
                        ]},
                    /*{"menuid": "1", "icon": "icon-magic", "menuname": "图书馆",
                        "menus": [
                            {"menuid": "12", "menuname": "图书馆列表", "icon": "icon-database", "url": "__APP__/Shop/shop"}
                        ]},*/
                    {"menuid": "1", "icon": "icon-magic", "menuname": "借阅管理",
                        "menus": [
                            {"menuid": "12", "menuname": "借阅管理", "icon": "icon-database", "url": "__APP__/Bill/bill"}
                        ]},


                    {"menuid": "56", "icon": "icon-role", "menuname": "用户管理",
                        "menus": [
                            {"menuid": "31", "menuname": "用户列表", "icon": "icon-users", "url": "__APP__/User/user"}
                        ]

                    }
                ]};
        }else if(roletype == "3"){
            _menus = {
                "menus": [
                    {"menuid": "1", "icon": "icon-magic", "menuname": "分期管理",
                        "menus": [
                            {"menuid": "12", "menuname": "分期管理列表", "icon": "icon-database", "url": "__APP__/Good/goodshop"}
                        ]},
                    {"menuid": "1", "icon": "icon-magic", "menuname": "类别管理",
                        "menus": [
                            {"menuid": "12", "menuname": "类别列表", "icon": "icon-database", "url": "__APP__/Type/type"}
                        ]},

                    {"menuid": "1", "icon": "icon-magic", "menuname": "订单管理",
                        "menus": [
                            {"menuid": "12", "menuname": "订单管理", "icon": "icon-database", "url": "__APP__/Bill/bill"}
                        ]}
                ]};
        }


    </script>
    <style type="text/css">
        .themeblock{
            width: 10px;
            height: 10px;

            display: inline-block;
        }
    </style>
</head>
<body class="easyui-layout" style="overflow-y: hidden" scroll="no">
<noscript>
    <div
            style="position: absolute; z-index: 100000; height: 2046px; top: 0px; left: 0px; width: 100%; background: white; text-align: center;">
        <img src="images/noscript.gif" alt='抱歉，请开启脚本支持！'/>
    </div>
</noscript>

<div region="south" split="true"
     style="height: 30px;">
    <div>
        <table width="100%">
            <tr>
                <td style="width: 20%;padding-right: 50px;" align="right">
                    <?php echo $_SESSION['username'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                        href="__APP__/Index/logout">退出</a>
                </td>
                <td style="width: 80%" align="right">
                    主题&nbsp;&nbsp;&nbsp;&nbsp;:<a href="__APP__/Index/changeThem/name/default" style="color: #2571EB;">经典</a>&nbsp;&nbsp;
                    <!--<a href="__APP__/Index/changeThem/name/default">经典</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <!--<a href="__APP__/Index/changeThem/name/cupertino">清新蓝</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <a href="__APP__/Index/changeThem/name/gray" style="color: #585858;">灰色</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/black" style="color: #000000;">酷黑</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/bootstrap" style="color: #585858;">bootstrap</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/ui-cupertino" style="color: #008198;">清新蓝</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/ui-dark-hive" style="color: #000000;">深黑</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/ui-pepper-grinder" style="color: #ECC73B;">花布</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/ui-sunny" style="color: #BF570C;">阳光</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro" style="color: #585858;">metro</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro-blue" style="color: #00AEEF;">metroblue</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro-gray" style="color: #454545;">metrogray</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro-green" style="color: #008900;">metrogreen</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro-orange" style="color: #D14625;">metroorange</a>&nbsp;&nbsp;
                    <a href="__APP__/Index/changeThem/name/metro-red" style="color: #7A0000;">metrored</a>&nbsp;&nbsp;


                </td>
                <!--<td style="width: 20%" align="right">-->
                    <!--模式：&nbsp;&nbsp;&nbsp;&nbsp;<a href="__APP__/Index/changeModel?name=index">桌面</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <!--<a href="__APP__/Index/changeModel/name/index2">经典</a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                <!--</td>-->
            </tr>
        </table>

    </div>
</div>
<div region="west" hide="true" split="true" title="导航菜单"
     style="width: 180px;" id="west">
    <div id="nav" class="easyui-accordion" fit="true" border="false">
        <!--  导航内容 -->

    </div>
</div>
<div id="mainPanle" region="center"
     style="background: #eee; overflow-y: hidden">
    <div id="tabs" class="easyui-tabs" fit="true" border="false">
        <div title="欢迎使用" style="padding: 0px; color: red; overflow: hidden;"
             closable="true">
            <iframe src="" id="iframepage" name="iframepage"
                    frameBorder=0 width="100%" height="100%" onLoad=""></iframe>
        </div>
    </div>
</div>
<div region="east" collapsed="true" id="datetool" title="日历"
     split="true" style="width: 180px; overflow: hidden;">
    <div class="easyui-calendar"></div>
    <embed width="160" height="70" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer"
           type="application/x-shockwave-flash" allowscriptaccess="always" name="honehoneclock" bgcolor="#ffffff"
           quality="high" src="__PUBLIC__/swf/honehone_clock_wh.swf" wmode="transparent">
    </embed>
</div>

<!--修改密码窗口-->

<div id="mm" class="easyui-menu" style="width: 150px;">
    <div id="mm-tabupdate">刷新</div>
    <div class="menu-sep"></div>
    <div id="mm-tabclose">关闭</div>
    <div id="mm-tabcloseall">全部关闭</div>
    <div id="mm-tabcloseother">除此之外全部关闭</div>
    <div class="menu-sep"></div>
    <div id="mm-tabcloseright">当前页右侧全部关闭</div>
    <div id="mm-tabcloseleft">当前页左侧全部关闭</div>
</div>
</body>
</html>
<script type="text/javascript">
</script>