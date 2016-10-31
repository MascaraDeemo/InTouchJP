
function uplaodImg(callback){
    if(uploadFileUrl){
        uploadFile(uploadFileUrl,uploadUrl,function(r){
            var img = r.response;
            callback && callback(img);
        },function(error){
            showLoader(error,true);
        });
    }else{
        showLoader("Please select file",true);
    }
}