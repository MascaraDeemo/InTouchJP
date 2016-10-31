
    var focuslist = [];
var mobilelist = [];
var shoplist = [];
var billlist = [];
var goodlist = [];
var focusobj = null;
var focushop = null;
var gouwuche = "gouwuche";

$(function(){
    var p = {};
    p.tpl = '<li><a onclick="toContact(%s);">'+
                '<img src="'+fileurl+'%s">'+
                '<h2>%s</h2>'+
                '<p>Last Status：%s</p></a>'+
            '<span onclick="toRequest2(%s);" style="float:right;position: absolute;right: 50px;top: 10px;z-index: 99999;">Request</span><span onclick="toDail2(%s);" style="float:right;position: absolute;right: 50px;top: 45px;z-index: 99999;">Dial</span></li>';
    p.colums = ["id","img","username","status","id","id"];
    $("#contactlist").data("property",JSON.stringify(p));


    var p6 = {};
    p6.tpl = '<li><a href="#" onclick="">'+
        '<h2>%s</h2>'+
        '<p>%s</p>'+
        '<p>%s</p>'+
        '</a></li>';
    p6.colums = ["ndate","note","username"];
    $("#replays").data("property",JSON.stringify(p6));


    var pm = {};
    pm.tpl = '<li><a href="#" onclick="">'+
        '<h2>%s:</h2>'+
        '<p>%s</p>'+
        '<p>%s</p>'+
        '</a></li>';
    pm.colums = ["username","note","ndate"];
    $("#msglist").data("property",JSON.stringify(pm));
});




function toMain(){
    changePage('mainpage');
    listMyContact();
    startTimmer();
}

function toContact(id){
    var obj = getObjectById(id,focuslist);
    focusobj = obj;
    changePage('contactpage');
    $("#ctntitle").text(obj.username);
    $("#rmyImage2").attr("src",fileurl+obj.img);
    $("#title2").text(obj.title);
    $("#tel2").text(obj.tel).attr("href","tel:"+obj.tel);
    $("#dept").text(obj.dept);
    $("#email2").text(obj.email).attr("href","mailto:"+obj.email);
    $("#laststatus").text(obj.status);
    $("#lastlocation").text(obj.address);

}

function listMyContact(){
    ajaxCallback("listMyContact",{},function(data){
        focuslist = data;
        $("#contactlist").refreshShowListView(data);
    });
}

function saveContact(){
    var fdata = serializeObject($("#contactform"));
    fdata.uid = userinfo.id;
    fdata.username = userinfo.username;
    uplaodImg(function (r){
        fdata.img = r;
        ajaxCallback("saveContact",fdata,function(data){
            showTipTimer("Success",function (){
                toMain();
            });
            myObj.insertContact(fdata.title,fdata.tel,fdata.email,fdata.qq);
        });
    });

}

function toAdd(){
    changePage('contactmgpage');
    $("#contactform")[0].reset();
    $("#rmyImage1").attr("src","");
    $("#action").val("add");
    $("#id").val("");
}

function toEdit(){
    var obj = focusobj;
    changePage('contactmgpage');
    $("#rmyImage1").attr("src",fileurl+obj.img);
    $("#title").val(obj.title);
    $("#tel").val(obj.tel);
    $("#qq").val(obj.qq);
    $("#email").val(obj.email);
    $("#birth").val(obj.birth);
    $("#sex").val(obj.sex);
    $("#id").val("");
    $("#action").val("edit");
}


function delContact(){
    ajaxCallback("delContact",{id:focusobj.id},function(data){
       showTipTimer("Success",function (){
           toMain();
       });
    });
}
var count = 0;
function addTOContact(title,tel,len){
    count = 0;
    var fdata = {};
    fdata.title = title;
    fdata.tel = tel;
    fdata.uid = userinfo.id;
    fdata.username = userinfo.username;
    fdata.action = "add";

    var flag = true;

    if(focuslist){
        for(var i=0;i<focuslist.length;i++){
            if(focuslist[i].title==title){
                flag = false;
                break;
            }
        }
    }

    if(flag){

        ajaxCallback("saveContact",fdata,function(data){
            count++;
            showLoader("Synchronized"+count+"Contacts",true);
            listMyContact();

        });
    }
    hideLoader();
    changePage('mainpage');
}

function addTOMobile(title,tel,len){
    count = 0;
    var fdata = {};
    fdata.title = title;
    fdata.tel = tel;
    fdata.uid = userinfo.id;
    fdata.username = userinfo.username;
    fdata.action = "add";

    var flag = true;

    if(mobilelist){
        for(var i=0;i<mobilelist.length;i++){
            if(mobilelist[i].displayName==title){
                flag = false;
                break;
            }
        }
    }
    //alert(flag);
    if(flag){
        count++;
        showLoader("Synchronized"+count+"Contacts",true);
        myObj.insertContact(fdata.title,fdata.tel,"","");
    }
    hideLoader();
    changePage('mainpage');
}


function toStatus(){
    changePage('statuspage');
}

function toRequest(){
    changePage('requestpage');
    //listReplay();
    refreshServerChatList();

}
var chatTimmer = null;
var _oldlength = 0;
function startMsgTimmer(){
    clearInterval(chatTimmer);
    chatTimmer = setInterval(function(){
        var activePageId = $.mobile.activePage.attr('id');
        if(activePageId=="requestpage"){
            ajaxCallback("listMyMessage",{uid:userinfo.id,fid:focusobj.id},function(data){
                if(data.length!=_oldlength){
                    $("#msglist").refreshShowListView(data);
                    _oldlength = data.length
                }
            },true);
        }else{
            ajaxCallback("listToMyMessage",{uid:userinfo.id},function(data){
                if(data.length!=_oldlength){
                    showLoader("You hava a message!",true);
                    _oldlength = data.length;
                }

            },true);
        }

    },1000);
}

var chatTimmer2 = null;
var _oldlength2 = 0;
function startQuickRequesttimmer(){
    clearInterval(chatTimmer2);
    chatTimmer2 = setInterval(function (){
        ajaxCallback("listToMyMessage2",{uid:userinfo.id},function(data){
            if(data.length!=_oldlength2){
                _oldlength2 = data.length;
                showComfire("tip!",data.username +" Request your location?",function (index){
                    if(index==1){
                        myLocation.getLocation();
                    }else{

                    }
                });

            }

        },true);
    },5000);
}

function toRequest2(id){
    focusobj = getObjectById(id,focuslist);
    changePage('requestpage');
    listReplay();
}
function listReplay(){
    ajaxCallback("listReplay",{pid:focusobj.id},function(data){
        $("#replays").refreshShowListView(data);
    });
}
function addReplay(){
    /*var note = $("#rnote").val();
    ajaxCallback("addReplay",{pid:focusobj.id,uid:userinfo.id,username:userinfo.username,note:note},function(data){
        listReplay();
        $("#rnote").val("");
    });*/

    var obj = {};
    obj.uid = userinfo.id;
    obj.fid = focusobj.id;
    obj.note = $("#msgaarea").val();
    obj.username = userinfo.username;
    obj.fusername = focusobj.username;
    obj.type = 1;
    obj.attach = "";
    ajaxCallback("addMessage",obj,function(data){
        refreshServerChatList();
    });

    $("#msgaarea").val("");
}

function refreshServerChatList(){
    ajaxCallback("listMyMessage",{uid:userinfo.id,fid:focusobj.id},function(data){
        _oldlength = data.length;
        $("#msglist").refreshShowListView(data);
    });
}

function quickRequest(){
    ajaxCallback("addReplay",{uid:userinfo.id,fid:focusobj.id,username:userinfo.username,fusername:focusobj.username},function(data){
        showLoader("Request Success!",true);
    });

}

function setText2(el,toel){
    var text = $(el).text();
    $("#"+toel).val(text);
}

function saveStatus(){
    var status = $("#status").val();
    ajaxCallback("saveStatus",{id:userinfo.id,status:status},function(data){
        userinfo = data;
        showLoader("Success!",true);
    });
}


function saveQuickReplay(){
    var quickreplay = $("#quickreplay").val();
    ajaxCallback("saveQuickreplay",{id:userinfo.id,quickreplay:quickreplay},function(data){
        userinfo = data;
        showLoader("Success!",true);
    });
}

function sendEmail(){
    myObj.sendEmail(focusobj.email,"Mailing test");
}

function openMap(){
    myObj.openMap(focusobj.latitude,focusobj.longitude);
}