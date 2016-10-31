
var _openid=null;
var _topage = "main";
_openid = getSearchParam("openid");
_topage = getSearchParam("page");
$(function(){
    
    var uinfo = localStorage['userinfo'];
    var f = localStorage['welcomed'];
        if(uinfo && $.trim(uinfo)!=""){
            uinfo  = JSON.parse(uinfo);
            $("#lusername").val(uinfo.username);
            $("#lpasswd").val(uinfo.passwd);
            uinfo.remember = "1";
            login(uinfo);
        }

});
var userinfo = null;
function login(uinfo){
    var fdata = uinfo || serializeObject($("#loginform"));
    if($.trim(fdata.username)=="" || $.trim(fdata.passwd) == ""){
        showLoader("Please check input！",true);
        return;
    }
    ajaxCallback("login",fdata,function(data){
       if(data.info && data.info=="fail"){
           showLoader("User Name or Passwd Not Match!",true);
           changePage("loginpage");
       }else{
           showLoader("Login Success!",true);
           startMsgTimmer();
           startQuickRequesttimmer();
           userinfo = data;
           if(fdata.remember == "1"){
                localStorage["userinfo"] = JSON.stringify(data);
           }else{
               localStorage["userinfo"] = "";
           }
           toMain();
       }
    });
}

function logout(){
    userinfo = null;
    localStorage['userinfo'] = "";
    toLogin();
}

function toRegister(){
    changePage("registerpage");
}

function toLogin(){
    $($(':input','#loginform').get(1)).val("");
    changePage("loginpage");
}

function register(){

    var fdata = serializeObject($("#registerform"));
    if($.trim(fdata.username) == "" || $.trim(fdata.passwd) == "" || $.trim(fdata.tel) == ""){
        showLoader("Fill in All information",true);
        return;
    }
    if(fdata.tel.length<11){
        showLoader("Wrong phone format",true);
        return;
    }
    if(fdata.passwd != fdata.passwd2){
        showLoader("Password not match",true);
        return;
    }

    fdata.openid = _openid;
        ajaxCallback("checkUser",fdata,function(d){
            if(d.info == "success"){
                ajaxCallback("register",fdata,function(r){
                    if(r.info=="success"){
                        showLoader("Registration complete",true);
                        toLogin();
                    }else{
                        showLoader("Registration Failed",true);
                    }
                });
            }else{
                showLoader("Username already exist",true);
            }
        });


}

function toSetting(){
    changePage('settingpage');
    $("#mying").attr("src",fileurl+userinfo.img);
}

function myinfo(){
    if(!userinfo){
        changePage("loginpage");
        return;
    }
    changePage("userinfopage");
    $("#editbutton").hide();
    $("#vusername").text(userinfo.username);
    $("#vtel").val(userinfo.tel);
    $("#vqq").val(userinfo.qq);
    $("#vwechat").val(userinfo.wechat);
    $("#vsex").val(userinfo.sex);
    $("#vbirth").val(userinfo.birth);
    $("#vemail").val(userinfo.email);
    $("#vaddress").val(userinfo.address);
    $("#rmyImage1").attr("src",fileurl+userinfo.img);
}

function editUserInfo(){
    $("#editbutton").show();
}

function updateUserInfo(){
    var fdata = serializeObject($("#userform"));
    fdata.id = userinfo.id;
    uplaodImg(function (img){
        fdata.img = img;
        ajaxCallback("updateUser",fdata,function(r){
            if(r.info == "success"){
                showLoader("Success!",true);
                userinfo.qq = fdata.qq;
                userinfo.tel = fdata.tel;
                userinfo.wechat = fdata.wechat;
                userinfo.email = fdata.email;
                userinfo.birth = fdata.birth;
                userinfo.sex = fdats.sex;
                userinfo.img = img;
            }else{
                showLoader("Save failed",true);
            }
        });
    });

}

function toChangePasswd(){
    $("#pusername").text("User Name:"+userinfo.username);
    changePage("passwdpage");
}

function changePasswd(){
    var fdata = serializeObject($("#passwdform"));
    fdata.id = userinfo.id;
    if(fdata.oldpasswd != userinfo.passwd){
        showLoader("Wrong origin password",true);
        return;
    }
    if($.trim(fdata.passwd) == ""){
        showLoader("Password can not be blank",true);
        return;
    }
    if(fdata.passwd != fdata.passwd2){
        showLoader("Password not match",true);
        return;
    }
    ajaxCallback("changePasswd",fdata,function(r){
        if(r.info == "success"){
            showLoader("Success!",true);
            setTimeout(function(){
                toLogin();
            },2000);
        }else{
            showLoader("Save failed",true);
        }
    });
}






