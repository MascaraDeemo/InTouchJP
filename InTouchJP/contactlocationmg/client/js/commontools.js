/**
 * Created by ideabobo on 14-6-28.
 * commontools
 */
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

function ajaxCallback(action, data, cb,notshow) {
    if(!clientUrl){
        alert("请先设置服务端根路径");
        return;
    }
    !notshow && showLoader("Loading...");
    data = data || {};
    var retrytimes = 5;
    var count = 0;
    var connectServer = function(){
        !notshow && showLoader("Loading...");
        $.ajax({
            type: "GET",
            url: clientUrl + action,
            dataType: "jsonp",
            jsonp: "callback",
            contentType: "text/html; charset=utf-8",
            data: data,
            timeout:50000,
            async:true,
            success: function (data) {
                hideLoader();
                cb(data);
                console.log("success");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                hideLoader();
                console.log("error:"+XMLHttpRequest+" textStatus:"+textStatus+" errorThrown"+errorThrown);
            },
            complete:function(XMLHttpRequest, textStatus){
                console.log("complete:"+XMLHttpRequest+"textStatus:"+textStatus);
                if(textStatus == "timeout"){
                    if(count<retrytimes){
                        count++;
                        connectServer();
                        console.log(count);
                    }else{
                        showLoader("连接服务器超时！",true);
                    }

                }
            }
        });
    };
    connectServer();
}
/**
 * 判断是否所有的属性都有值
 * @param obj
 * @returns {boolean}
 */
function checkObjectValue(obj) {
    for(var p in obj){
        if(obj[p]!=undefined && obj[p]!=null){
            if($.trim(obj[p]) == ""){
                return true;
            }
        }
    }
    return false;
}

function getObjectById(id,goodlist){
    for(var i=0;i<goodlist.length;i++){
        var good = goodlist[i];
        if(good.id == id){
            return good;
        }
    }
    return null;
}

function getSearchParam(p){
    var search = window.location.search;
    if (/^[#\?]/.test(search))
        search = search.slice(1);
    var a = search.split("&"),
        o = {};
    for (var i = 0; i < a.length; i++) {
        var b = a[i].split("=");
        o[b[0]] = b[1];
    }
    return o[p];
}