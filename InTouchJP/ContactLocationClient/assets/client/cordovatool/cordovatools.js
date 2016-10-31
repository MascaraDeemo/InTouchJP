function exitApp(){
    navigator.app.exitApp();
}

var cordovaFlag = false;
var uploadFileUrl = null;
document.addEventListener("deviceready", onDeviceReady, false);
var pictureSource;
var destinationType;
var watchID = null;
function onDeviceReady() {
    pictureSource = navigator.camera.PictureSourceType;
    destinationType = navigator.camera.DestinationType;
    cordovaFlag = true;

function getContacts(type){

    var options = new ContactFindOptions();
    options.filter = "";
    options.multiple = true;
    var filter = ["displayName", "phoneNumbers"];
    navigator.contacts.find(filter, function(contacts){
        showLoader("Loading Contacts");
        var len = contacts.length;
        mobilelist = contacts;
        if(type==1){
            for (var i = 0; i < focuslist.length; i++) {
                var title = focuslist[i].title;
                var tel = focuslist[i].tel;
                addTOMobile(title,tel,len);
            }
        }else{
            for (var i = 0; i < contacts.length; i++) {
                var title = contacts[i].displayName;
                var tel = contacts[i].phoneNumbers[0].value;
                addTOContact(title,tel,len);
            }
        }

    }, function(contactError){
        alert('onError!');
    }, options);
}

function getMsgs(){

}

function showComfire(title,msg,callback){
    navigator.notification.confirm(
        msg,
        function(buttonIndex){
            callback && callback(buttonIndex);
        },
        title,
        ['Confirm','Cancel']
    );
}

function getFilePic(source, element) {
    navigator.camera.getPicture(function (imageURI) {
        //alert(imageURI);
        console.log("imageURI:"+imageURI);
        uploadFileUrl = imageURI;
        var pre = uploadFileUrl.substring(0,4);
        if(pre!="file"){
        	uploadFileUrl = myObj.getPath(uploadFileUrl);
        }
        if(element){
            //alert(uploadFileUrl);
            $("#" + element).attr("src", uploadFileUrl);
        }else{
            $("#path") && $("#path").text(imageURI);
            $("#path2") && $("#path2").text(imageURI);
        }

    }, function () {
        if (source == pictureSource.CAMERA)
            console.log('Loading Camera Failed');
        else
            console.log('Loading Album Failed');
    }, {
        quality: 100,
        destinationType: destinationType.FILE_URI,
        sourceType: source
    });
}

function getFileAttach(callback) {
    navigator.camera.getPicture(function (imageURI) {
        callback && callback(imageURI);
    }, function () {

    }, {
        quality: 50,
        destinationType: destinationType.FILE_URI,
        sourceType: 0
    });
}

function captureSound(){
    navigator.device.capture.captureAudio(captureSuccess, captureError, {limit:1});
}


var captureSuccess = function(mediaFiles) {
    changePage("lushuaddpage","none");
    var i, path, len;
    for (i = 0, len = mediaFiles.length; i < len; i += 1) {
        path = mediaFiles[i].fullPath;
        uploadFileUrl = path;
        $("#soundbar").attr("src",path);
        // do something interesting with the file
    }
};


var captureError = function(error) {
    navigator.notification.alert('Error code: ' + error.code, null, 'Capture Error');
};

// start audio capture



function uploadBroken(message) {
    alert(message);
};


function uploadProcessing(progressEvent) {

    if (progressEvent.lengthComputable) {
        var loaded = progressEvent.loaded;
        var total = progressEvent.total;
        var percent = parseInt((loaded / total) * 100);
        showLoader("Uploading Files:" + percent + "%");

    }
};

function uploadFile(fileURI, url, success, fail) {
    var options = new FileUploadOptions();
    options.fileKey = "file";
    options.fileName = fileURI.substr(fileURI.lastIndexOf('/') + 1);
    options.mimeType = "multipart/form-data";
    options.chunkedMode = false;
    ft = new FileTransfer();
    var uploadUrl = encodeURI(url);
    console.log(fileURI);
    ft.upload(fileURI, uploadUrl, success, fail, options);
    ft.onprogress = uploadProcessing;
}


function localFile(fileUrl,filename) {
    fileUrl = fileUrl || downloadUrl+"?attach="+focusobj.attach;
    filename = filename || focusobj.attach;
    window.requestFileSystem(LocalFileSystem.PERSISTENT,  5*1024*1024, function(fileSystem){
        fileSystem.root.getDirectory("file_mobile", {create:true},
            function(fileEntry){ },
            function(){  console.log("Creation Failed");});

        var _localFile = "file_mobile/"+filename;
        var _url = fileUrl;
        fileSystem.root.getFile(_localFile, null, function(fileEntry){
            showLoader("The File has been downloaded",true);
        }, function(){
            fileSystem.root.getFile(_localFile, {create:true}, function(fileEntry){
                var targetURL = fileEntry.toURL();
                download(_url,targetURL);
            },function(){
                alert('Downloaded Picture Failed');
            });
        });

    }, function(evt){
        console.log("Loading System File Failed");
    });
}


function download(fileUrl,targetUrl){
    showLoader("Downloading");
    var fileTransfer = new FileTransfer();
    var uri = encodeURI(fileUrl);

    fileTransfer.download(uri,targetUrl,
        function(entry) {
            showLoader("Download Success",true);
            console.log("download complete: " + entry.fullPath);
        },
        function(error) {
            console.log("download error source " + error.source);
            console.log("download error target " + error.target);
            console.log("upload error code" + error.code);
        },
        false
    );
}


function uploadSuccess(r) {
    alert('Upload Success:' + r.response);
}


function uploadFailed(error) {
    alert('Upload Failed');
}

function openJisuanqi(){
    cordova.exec(function(data){

    }, null, "Plugs", "jisuanqi", []);
}


function toBaidu(city,address){
    cordova.exec(function(){},function(){},"Plugs","tobaidu",[{city: city,str:address}]);
}

function toShare(subject,text){
    cordova.exec(function(){},function(){},"Plugs","share",[{subject: subject,text:text}]);
}

function toDail(el){
    cordova.exec(function(){},function(){},"Plugs","toDail",[{tel:el}]);
}

function toDail2(){
    cordova.exec(function(){},function(){},"Plugs","toDail",[{tel:focusobj.tel}]);
}

function toAddress(el){
    var address = $(el).text();
    address = address.split(":")[1];
    cordova.exec(function(){},function(){},"Plugs","toAddress",[{address:address}]);
}

function uplaodImg(callback){
    if(uploadFileUrl){
        uploadFile(uploadFileUrl,uploadUrl,function(r){
            var img = r.response;
            callback && callback(img);
        },function(error){
            showLoader(error,true);
        });
    }else{

        callback && callback(userinfo.img);
    }
}

function uploadAttach(fileUrl,callback){
    if(fileUrl){
        uploadFile(fileUrl,uploadUrl,function(r){
            var img = r.response;
            callback && callback(img);
        },function(error){
            showLoader(error,true);
        });
    }else{
        showLoader("Select Your Picture",true);
    }
}

function scanCode(callback){
    cordova.exec(function(data){
        callback && callback(data);
    }, null, "Plugs", "scan", []);
}

