<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>条目列表</title>
<link rel="stylesheet" type="text/css"
      href="__PUBLIC__/easyui/themes/<?php echo (($_COOKIE["easyuiThemeName"])?($_COOKIE["easyuiThemeName"]):'default'); ?>/easyui.css"/>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"/>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/all.css"/>
<script type="text/javascript" src="__PUBLIC__/easyui/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/json2.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript">
var roletype = "<?php echo session('roletype');?>";
$(function () {
    $('#grid1').datagrid({
        title: '内容列表',
        nowrap: false,
        striped: true,
        fit: true,
        url: "__APP__/Notice/getList",
        idField: 'id',
        pagination: true,
        rownumbers: true,
        pageSize: 10,
        pageNumber: 1,
        singleSelect: true,
        fitColumns: true,
        pageList: [10, 20, 50, 100, 200, 300, 500, 1000],
        sortName: 'id',
        sortOrder: 'desc',
        columns: [
            [
                {field: 'ck', checkbox: true},
                //{title: 'id', width: 50, field: 'id', sortable: true},
                {title: '标题', width: 100, field: 'title', sortable: true},
                {title: '内容', width: 50, field: 'note',sortable: true},
                {title: '时间', width: 100, field: 'ndate',sortable: true}
            ]
        ], toolbar: [
            {
                text: '新增',
                id: "tooladd",
                disabled: false,
                iconCls: 'icon-add',
                handler: function () {
                    $("#action").val("add");

                    $("#managerDialog").dialog('open');

                    managForm.reset();
                }
            },
            '-',
            {
                text: '修改',
                id: 'tooledit',
                disabled: false,
                iconCls: 'icon-edit',
                handler: function () {
                    $("#action").val("edit");
                    var selected = $('#grid1').datagrid('getSelected');
                    if (selected) {
                        edit(selected);
                    } else {
                        $.messager.alert("提示", "请选择一条记录进行操作");

                    }
                }
            },
            '-',
            {
                text: '删除',
                id: 'tooldel',
                disabled: false,
                iconCls: 'icon-remove',
                handler: function () {
                    var rows = $('#grid1').datagrid('getSelections');
                    if (rows.length) {
                        var ids = "";
                        for (var i = 0; i < rows.length; i++) {
                            ids += rows[i].id + ",";
                        }
                        ids = ids.substr(0, (ids.length - 1));
                        $.messager.confirm('提示', '确定要删除吗？', function (r) {
                            if (r) {
                                deleteItem(ids);
                            }
                        });

                    } else {
                        $.messager.alert("提示", "请选择一条记录进行操作");
                        
                    }
                }
            }
        ]
    });

    document.onkeydown=function (e){
        e = e ? e : event;
        if(e.keyCode == 13){
            e.preventDefault();
            query();
        }
    };
/*    $("#type").combobox({
        method:"get",
        url:'__APP__/Type/typeList',
        valueField: 'id',
        textField: 'title'
    });*/

/*    $("#stime").combobox({
        method:"get",
        url:'__APP__/Stime/listobj',
        valueField: 'id',
        textField: 'title'
    });*/

//    var lays = $(".layout-panel");
//    for(var i=0;i<lays.length;i++){
//        $(lays[i]).addClass(randAnimation());
//    }

//    $(".easyui-dialog").dialog({
//        onBeforeClose:function(){
//            $(".easyui-dialog").addClass(randAnimation());
//        }
//    });

});

function save() {
/*    var typecn = $("#type").combobox("getText");
    $("#typecn").val(typecn);*/
    $('#managForm').form('submit', {
        url: "__APP__/Notice/add",
        onSubmit: function () {
            return inputCheck();
        },
        success: function (data) {
            closeBackGround();
            $.messager.alert("提示", data, "info", function () {
                closeFlush();
            });

        }
    });
}

function edit(obj) {
	var id = obj.id;
    $("#id").val(id);
    $("#title").val(obj.title);
    //$("#type").combobox("setValue", obj.type);
    //$("#price").numberbox('setValue', obj.price);
    //$("#restcount").numberbox('setValue', obj.restcount);
    $("#note").val(obj.note);
    //$("#address").val(obj.address);
    $("#managerDialog").dialog('open');
}

function deleteItem(uuid) {
    openBackGround();
    $.post("__APP__/Notice/deleteItem", {id: uuid}, function (data) {
        closeBackGround();
        closeFlush();
    });
}

function cancel() {
    $.messager.confirm('提示', '是否要关闭？', function (r) {
        if (r) {
            closeFlush();
        }
    });

}

function query() {
    $('#grid1').datagrid('load', serializeObject($('#searchForm')));
}


function closeFlush() {
    managForm.reset();
    $("#managerDialog").dialog('close');
    $("#grid1").datagrid("reload");
}

function inputCheck() {
    if (!($("#managForm").form("validate"))) {
        return false;
    }
    openBackGround();
    return true;
}

function show(index) {

    var rows = $("#grid1").datagrid('getRows');
    var obj = rows[index];
    var id = obj.id;
    $("#id2").text(obj.id);
    $("#title2").text(obj.title);
    $("#gbrand2").text(obj.gbrand);
    $("#intime2").text(obj.intime);
    $("#gmodel2").text(obj.gmodel);
    $("#gcolor2").text(obj.gcolor);
    $("#gprice2").text(obj.gprice);
    $("#note2").text(obj.note);
    $("#gnumber2").text(obj.gnumber);

    $("#viewDialog").dialog('open');
    //});
}


function setNull(){
    searchForm.reset();
}



</script>
</head>
<body>
<div id="main" class="easyui-layout" fit="true" style="width:100%;height:100%;">
    <div region="north" id="" style="height:70px;" border="false" title="查询条件">
            <form id="searchForm">
                <table cellpadding="5" cellspacing="0" class="tb_search">
                    <tr>
                        <td width="10%">
                            <label for="stitle">名称：</label>
                            <input type="text" id="stitle" name="stitle" width="100%" maxlength="32"/>
                        </td>
                        <td width="10%">
                            <a href="#" onclick="query();" id="querylink" class="easyui-linkbutton"
                               iconCls="icon-search">查询</a>
                            <a href="#" onclick="setNull();" class="easyui-linkbutton" iconCls="icon-redo">重置</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <div region="center" border="false" style="overflow:hidden;">

        <table id="grid1" border="false"></table>

    </div>
</div>


<div id="managerDialog" class="easyui-dialog" title="内容管理" style="width:650px;height:400px;" toolbar="#dlg-toolbar"
     buttons="#dlg-buttons2" resizable="true" modal="true" closed='true'>
    <form id="managForm" name="managForm" method="post" enctype="multipart/form-data">
        <input type="hidden" id="action" name="action"/>
        <input type="hidden" id="id" name="id"/>
        <input type="hidden" id="typecn" name="typecn"/>
        <table cellpadding="1" cellspacing="1" class="tb_custom1" width="98%">
            <tr>
                <th width="30%" align="right"><label>标题：</label></th>
                <td width="70%" colspan="3">
                    <input id="title" name="title" style="width: 400px;" class="easyui-validatebox"  type="text" required="true"
                           validType="length[0,100]"/>
                </td>
            </tr>


            <tr>
                <th width="30%" align="right"><label>配图：</label></th>
                <td colspan="3" width="30%">
                    <input type="file" name="img" id="img" style="width:200px;word-wrap: break-word;word-break:break-all;"/>
                </td>
            </tr>
            <tr>
                <th width="30%" align="right"><label>内容：</label></th>
                <td colspan="3" width="70%">
                    <textarea rows="" cols="" style="width:400px;height: 200px;" id="note" name="note"></textarea>
                </td>
            </tr>
        </table>


    </form>
    <div id="dlg-buttons2">
        <a href="#" class="easyui-linkbutton" onclick="save();">保存</a>
        <a href="#" class="easyui-linkbutton" onclick="cancel();">取消</a>
    </div>
</div>



</body>
</html>