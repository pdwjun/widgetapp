function savedo(uid,password,avatar,name,img,phone,sheng,shi,yunqi,remark){
	var url = hostURL+"&a=userinfosave&uid="+uid+"&name="+name+"&img="+img+"&password="+password+"&avatar="+avatar+"&phone="+phone+"&sheng="+sheng+"&remark="+remark+"&shi="+shi+"&yunqi="+yunqi;

	$.getJSON(url,callback,'text',getJSONError,'GET','');
}

function getUserInfo(uid){
	var url = hostURL+"&a=get_user_info&uid="+uid;
	$.getJSON(url,getUserHand,'json',getJSONError,'GET','');
}

function mymsg(){
	var url = hostURL+"&a=myMsg&uid=" + getLocVal('uid');
	$.getJSON(url,mymsgcallback,'json',getJSONError,'GET','');
}
function setavatar(){
	
	 uexCamera.open();
}
function upload(data){


	var uploadHttp = hostURL +"&a=upload";
	uexUploaderMgr.createUploader(1, uploadHttp);
	uexUploaderMgr.uploadFile(1, data, "fileToUpload", '1');
}
