<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>借阅</title>
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
        $(function () {
            $('#grid1').datagrid({
                title: '借阅列表',
                nowrap: false,
                striped: true,
                fit: true,
                url: "__APP__/Bill/getList",
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
                        //{field: 'ck', checkbox: true},
                        {title: '编号', width: 50, field: 'id', sortable: true},
                        {title: '图书', width: 300, field: 'gnames', sortable: true},
                        //{title: '借阅方式', width: 100, field: 'way', sortable: true},
                        //{title: '总价', width: 100, field: 'total', sortable: true},
                        {title: '用户id', width: 50, field: 'uid',sortable: true},
                        {title: '电话', width: 50, field: 'tel',sortable: true},
                        {title: '地址', width: 100, field: 'address',sortable: true},
                        //{title: '图书馆', width: 100, field: 'shop',sortable: true},
                        {title: '备注', width: 200, field: 'note',sortable: true},
                        {title: '时间', width: 100, field: 'ndate',sortable: true}
                    ]
                ]
                , toolbar: [
                    /*  {
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
                     '-', */
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
                    query();
                }
            }

        });

        function save() {
            $('#managForm').form('submit', {
                url: "__APP__/Bill/add",
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
            $("#gname").val(obj.gname);
            $("#type").combobox("setValue", obj.type);
            $("#price").numberbox('setValue', obj.price);
            $("#count").numberbox('setValue', obj.count);
            $("#jifen").numberbox('setValue', obj.jifen);
            $("#note").val(obj.note);
            $("#managerDialog").dialog('open');
        }

        function deleteItem(uuid) {
            openBackGround();
            $.post("__APP__/Bill/deleteItem", {id: uuid}, function (data) {
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
            //managForm.reset();
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
            $("#gname2").text(obj.gname);
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
            $("#sndate").datebox("setValue","");
        }



    </script>
</head>
<body>
<div id="main" class="easyui-layout" fit="true" style="width:100%;height:100%;">
    <div region="north" id="" style="height:70px;" border="false" title="查询条件">
            <form action="" id="searchForm" name="searchForm" method="post">
                <table cellpadding="5" cellspacing="0" class="tb_search">
                    <tr>
                        <td width="10%">
                            <label for="sgname">借阅时间：</label>
                            <input type="text" id="sndate" name="sndate" class="easyui-datebox" width="100%" maxlength="32"/>
                        </td>
                        <td width="10%">
                            <label for="sgname">图书名称：</label>
                            <input type="text" id="sgname" name="sgname" width="100%" maxlength="32"/>
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



</body>
</html>