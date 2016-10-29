//---------------------base-----------------------------//
/**
 * 删除左空格
 * @param arg
 * @return string
 * @since 1.0
 * @author wangl
 */
function ltrim(arg) {
	//var arg=arg.replace(/[\u3000]/g, "");
   // return arg.replace(/^\s*/, "");
    return arg.replace(/(^[' '|'　']*)/, '');
}

/**
 * 删除右空格
 * @param name
 * @return string
 * @since 1.0
 * @author wangl
 */
function rtrim(s) {
	//var s=s.replace(/[\u3000]/g, "");
    //return s.replace(/\s*$/, "");
    return s.replace(/([' '|'　']*$)/, '');
}

/**
 * 删除左右空格
 * @param name
 * @return string
 * @since 1.0
 * @author wangl
 */
function trim(s) {
  return rtrim(ltrim(s));
  //return s.replace(/[" "|"　"]/g,"");//去半角+全角空格
}

function replaceSpecialSign(str){
	if(typeof(str) != "undefined"){
		str = str.replace(/\\/g,"\\\\");
		str = str.replace(/<br\/>/g,"\n");
		str = str.replace(/</g,"&#60;")
		str = str.replace(/>/g,"&#62;");
		str = str.replace(/'/g,"&#8242;");
		str = str.replace(/"/g,"&#34;");
		return str;
	}
}


//弹出遮罩层
function openBackGround(){
	var divHeight = document.body.scrollHeight + document.documentElement.clientHeight;
	var maskCss = {
		position:"absolute",
		left:0,
		top:0,
		cursor:"wait",
		filter:"alpha(opacity=60)",
		display:"block",
		background:"#ccc",
		opacity:0.6,
		display:"block",
		width:"100%",
		height:divHeight,
		zIndex:"100000"
	}
	var maskMsgCss = {
		position:"absolute",
		padding:"10px 20px",
		left:($(document.body).outerWidth(true) - 190) / 2,
		top:($(window).height() - 45) / 2,
		cursor:"wait",
		border:"2px solid #ccc",
		color:"white",
		opacity:0.6,
		background:"black",
		filter:"alpha(opacity=60)",
		borderRadius:5,
		display:"block",
		width:"auto",
		zIndex:"100001"
	}
	var htm = "<div style=\"text-align:center;\">";
		htm += "<img src=\"data:image/gif;base64,R0lGODlhEAAQALMNAD8/P7+/vyoqKlVVVX9/fxUVFUBAQGBgYMDAwC8vL5CQkP///wAAAP///wAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFAAANACwAAAAAEAAQAAAEO5DJSau9OOvNex0IMnDIsiCkiW6g6BmKYlBFkhSUEgQKlQCARG6nEBwOgl+QApMdCIRD7YZ5RjlGpCUCACH5BAUAAA0ALAAAAgAOAA4AAAQ6kLGB0JA4M7QW0hrngRllkYyhKAYqKUGguAws0ypLS8JxCLQDgXAIDg+FRKIA6v0SAECCBpXSkstMBAAh+QQFAAANACwAAAAACgAQAAAEOJDJORAac6K1kDSKYmydpASBUl0mqmRfaGTCcQgwcxDEke+9XO2WkxQSiUIuAQAkls0n7JgsWq8RACH5BAUAAA0ALAAAAAAOAA4AAAQ6kMlplDIzTxWC0oxwHALnDQgySAdBHNWFLAvCukc215JIZihVIZEogDIJACBxnCSXTcmwGK1ar1hrBAAh+QQFAAANACwAAAAAEAAKAAAEN5DJKc4RM+tDyNFTkSQF5xmKYmQJACTVpQSBwrpJNteZSGYoFWjIGCAQA2IGsVgglBOmEyoxIiMAIfkEBQAADQAsAgAAAA4ADgAABDmQSVZSKjPPBEDSGucJxyGA1XUQxAFma/tOpDlnhqIYN6MEAUXvF+zldrMBAjHoIRYLhBMqvSmZkggAIfkEBQAADQAsBgAAAAoAEAAABDeQyUmrnSWlYhMASfeFVbZdjHAcgnUQxOHCcqWylKEohqUEAYVkgEAMfkEJYrFA6HhKJsJCNFoiACH5BAUAAA0ALAIAAgAOAA4AAAQ3kMlJq704611SKloCAEk4lln3DQgyUMJxCBKyLAh1EMRR3wiDQmHY9SQslyIQUMRmlmVTIyRaIgA7\" style=\"margin-right:8px;\" align=\"absmiddle\"/>";
		htm += "\u5904\u7406\u4e2d，\u8bf7\u7a0d\u5019...";
		htm += "</div>";
	$("<div id='maskBackgroundLoading'></div>").css(maskCss).appendTo("body");
	$("<div id='maskLoadMsg'></div>").html(htm).css(maskMsgCss).appendTo("body");
}

//隐藏遮罩层
function closeBackGround(){
	$("#maskLoadMsg").fadeOut(function(){
		$(this).remove();
	});
	$("#maskBackgroundLoading").fadeOut(function(){
		$(this).remove();
	});
//	setTimeout(function(){
//    }, 10);
}

//鼠标提示弹出框
function mouseTipDivOpen(e,value){
	if(value != ""){
		var _maskLoad = document.getElementById('tipMsg');
		var div = $("<div id='tipMsg' style='display:block;word-break:break-all;position:absolute;z-index:10001;font-family:Arial;font-size:10pt;border:1px solid #c5d2df;background-color:#e0e8f3;padding:5;'></div>");
		div.html(value).appendTo("body");
		if(_maskLoad == null){
			var target = document.getElementById("tipMsg");
			var value = 10;
			target.style.filter = "alpha(opacity="+value+") progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=4)";
			this.intervalDiv = setInterval(function(){
				value += 10;
				if(value >= 100){
					clearInterval(this);
				}
				target.style.filter = "alpha(opacity="+value+") progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=4)";
			},30)
		}
		$("#tipMsg").css("width","auto");
		$("#tipMsg").css("height","auto");
		var divWidth = $("#tipMsg").width();
		if(divWidth > 400){
			$("#tipMsg").css("width","450px");
			divWidth = 450;
		}
		var divHeight = $("#tipMsg").height();
		var mousex = e.pageX;
        var mousey = e.pageY;
		var winWidth = $(window).width();
        var winHeight = $(window).height();
        var scrollLeft = $(window).scrollLeft();
        var scrollTop = $(window).scrollTop();
        var marginRight = winWidth - (mousex + divWidth + 10 - scrollLeft);
        var marginBottom = winHeight - (mousey + divHeight + 10 - scrollTop);
        if(marginRight < 10){
        	mousex = e.pageX - divWidth;
        }
        if(marginBottom < 10){
        	mousey = e.pageY - divHeight;
        }
	 	div.css({"left":mousex+"px"});
		div.css({"top":mousey+"px"});
	}
}

//鼠标提示关闭弹出层
function mouseTipDivClose(){
	var _maskLoad = document.getElementById('tipMsg');
	if(_maskLoad != null){
		_maskLoad.parentNode.removeChild(_maskLoad);
	}
}

//固定电话，手机号码校验
function telNumberCheck(linkNumber){

	var tel = /^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
	var tel2=/^((400)-(\d{3})-(\d{4}))|((800)-(\d{3})-(\d{4}))|((955)\d{2})$/;
	var phone = /^0{0,1}(13[0-9]|15[0-9]|18[0-9])[0-9]{8}$/;
	if(!tel.test(linkNumber) && !phone.test(linkNumber) &&!tel2.test(linkNumber)){
		return false;
	}else{
		return true;
	}
}

function OpenForm( width,height,url)
{
    var screenwidth=document.body.clientWidth;
    var screenheight=document.body.clientHeight+200;
    window.open(url,'','height='+height+',width='+width+',top='+(screenheight-height)/2+',left='+(screenwidth-width)/2+',toolbar=no,menubar=no,scrollbars=yes,resizable=no,location=no,status=no');
}

/*
 * 打开工作流选择审批人界面
 * itemId 当前条目id比如提交公告审批itemId就为当前公告的id
 * wfWorkItemId当前条目关联的工作流id
 * model对应模型的名称比如“BidconfirePublicity”
 * */
function choseNodePerson(itemId,workItemId,model,closeDialog,refreshGrid){
	wfWorkItemModelId = itemId;
	wfWorkItemId = workItemId;
	wfWorkItemModel = model;
	commonRefreshGrid = refreshGrid;
	commonCloseDialog = closeDialog;
	nodeCombobox.combobox('options').url = contextPath + "/workflow/querryNextNode?itemId=" + wfWorkItemModelId + "&wfWorkItemId=" + wfWorkItemId + "&model=" + wfWorkItemModel;
	nodeCombobox.combobox('reload');
	commonFlowAuditPanel.dialog('open');
}
function getSubModuleListStates(subModuleName){
	$('#wfState').combobox({
		url			: contextPath+"/workflow/getSubModuleListStates?subModuleName="+subModuleName,
		valueField	: 'id',
		textField	: 'text',
		editable	: false
	});
}
/**
 * 对日期进行格式化
 * @param dateStr 日期字符串
 * @return 格式后的
 * @since 1.0
 * @author ganjp
 */
function formatDate(dateStr) {
	var dateObject = new Date(dateStr);
	if (isNaN(dateObject)) {
		if (dateStr.length>10) {
			return dateStr.substr(0,10);
		} else {
			return dateStr;
		}
	} else {
		var month = dateObject.getMonth() - 0 + 1;
		var day = dateObject.getDate() - 0;
		if (month < 10) {
				month = "0" + month;
		}
		if ( day < 10 ) {
			day = "0" + day;
		}
		return dateObject.getFullYear() + "-" + month + "-" + day;
	}
}
/**
 * 判断两日期的大小
 * @param d1
 * @param d2
 * @returns {Boolean}
 */
function compareDate(d1 , d2){
	var td1 = converToDate(d1);
	var td2 = converToDate(d2);
	var flag = -1;
	 if((td1 - td2) == 0){//a==b
        flag = 0;
     }
     if ((td1 - td2) < 0) {//a>b
        flag = 1;
     }
     if ((td1 - td2) > 0) {//a<b
        flag = -1;
     }
     if(flag == -1){
     	return false;
     }
	 return  true;
}
/**
 * 将一个字符串类型的转换为JsDate类型
 * @str 转换的字符串
 * @since 1.0
 * @author jiangtao.gao
 */
function converToDate(str){
    var sd= str.split("-");
    var sds = sd[0]+sd[1]+sd[2];
    return sds;
}

/**
 * 验证用户名
 * @param str
 * @returns {Boolean}
 */
function isChn(str){
	//var reg = /^[u4E00-u9FA5]+$/;

	var reg=/^[.A-Za-z0-9_-]+$/;

	if(!reg.test(str)){
	 return false;
	}
	return true;
	}


/**
* 校验所有输入字符的长度
* 参数1：字符串
* 参数2：验证长度
* 返回 提示信息
*/
function checkLength(str,length){
	if(len(str) >length){
		//$.messager.alert('提示信息',name + '长度不能超过'+length+'！');
		return true;
	}
	return false;
}
/**
* 获取字符串(字母，包括汉字)的长度
* 参数：字符串
* 返回 字符串长度
*/
function len(s) {
 	 var l = 0;
	 var a = s.split("");
	 for (var i=0;i<a.length;i++) {
	  if (a[i].charCodeAt(0)<299) {
		   l++;
		  } else {
		   l+=2;
		  }
	 }
 	return l;
}

/**
 * 设置系统统一的时间
 */
	var time = new Date();
	var year = time.getFullYear();
	var month = time.getMonth() + 1;
	var day = time.getDate();
	if (eval(month) < 10) {
		month = "0" + month;
	}
	;
	if (day < 10) {
		day = "0" + day;
	}
	var nowdate=year + "-" + month + "-" + day;
/**
 * 返回指定格式的时间
 * @param {Object} time
 */
function formatterTime(time) {
	var time = new Date(time);
	var year = time.getFullYear();
	var month = time.getMonth() + 1;
	var day = time.getDate();
	var hour = time.getHours();
	var min = time.getMinutes();
	var second = time.getSeconds();
	if (eval(month) < 10) {
		month = "0" + month;
	}
	;
	if (day < 10) {
		day = "0" + day;
	}
	;
	if (hour < 10) {
		hour = "0" + hour
	}
	;
	if (min < 10) {
		min = "0" + min
	}
	;
	if (second < 10) {
		second = "0" + second
	}
	;
	return year + "-" + month + "-" + day + " " + hour + ":" + min + ":"
			+ second;
}


serializeObject = function(form) {
	var o = {};
	$.each(form.serializeArray(), function(index) {
		if (o[this['name']]) {
			o[this['name']] = o[this['name']] + "," + this['value'];
		} else {
			o[this['name']] = this['value'];
		}
	});
	return o;
};



function compareDate(first,second,sign){
	if(!first || !second){
		return "";
	}
	if(!first.indexOf(sign) || !second.indexOf(sign)){
		return "";
	}
	fArray = first.split(sign);
	sArray = second.split(sign);
	var fDate = new Date(parseInt(fArray[0],10),parseInt(fArray[1],10),parseInt(fArray[2],10));
	var sDate = new Date(parseInt(sArray[0],10),parseInt(sArray[1],10),parseInt(sArray[2],10));
	var t = sDate.getTime()-fDate.getTime();
	var days = t/(1000*60*60*24);
	return days;
}

function getDate(){
	var myDate = new Date();
    //myDate.getYear();      //获取当前年份(2位)
    //myDate.getFullYear(); //获取完整的年份(4位,1970-????)
    //myDate.getMonth();      //获取当前月份(0-11,0代表1月)
    //myDate.getDate();      //获取当前日(1-31)
    //myDate.getDay();        //获取当前星期X(0-6,0代表星期天)
    //myDate.getTime();      //获取当前时间(从1970.1.1开始的毫秒数)
   // myDate.getHours();      //获取当前小时数(0-23)
   // myDate.getMinutes();    //获取当前分钟数(0-59)
   // myDate.getSeconds();    //获取当前秒数(0-59)
   // myDate.getMilliseconds(); //获取当前毫秒数(0-999)
   // myDate.toLocaleDateString();    //获取当前日期
    //var mytime=myDate.toLocaleTimeString();    //获取当前时间
    //myDate.toLocaleString( );
    return myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate();
}

function addDays(days){
	var newdate=new Date();
	var newtimems=newdate.getTime()+(days*24*60*60*1000);
	newdate.setTime(newtimems);
	return newdate.getFullYear()+"-"+(newdate.getMonth()+1)+"-"+newdate.getDate();
}

function convert(rows){
    function exists(rows, pid){
        for(var i=0; i<rows.length; i++){
            if (rows[i].id == pid) return true;
        }
        return false;
    }
	//找根节点
    var nodes = [];
    for(var i=0; i<rows.length; i++){
        var row = rows[i];
        if (!exists(rows, row.pid)){
            nodes.push({
                id:row.id,
                text:row.mname
            });
        }
    }

    var toDo = [];
    for(var i=0; i<nodes.length; i++){
        toDo.push(nodes[i]);
    }
    while(toDo.length){
        var node = toDo.shift();    // the parent node
        // get the children nodes
        for(var i=0; i<rows.length; i++){
            var row = rows[i];
            if (row.pid == node.id){
                var child = {id:row.id,text:row.mname};
                if (node.children){
                    node.children.push(child);
                } else {
                    node.children = [child];
                }
                toDo.push(child);
            }
        }
    }
    return nodes;
}