function savedo(uid,password,avatar,name,phone,sheng,shi,yunqi,remark){
	var url = hostURL+"&a=save&uid="+uid+"&name="+name+"&password="+password+"&avatar="+avatar+"&phone="+phone+"&sheng="+sheng+"&remark="+remark+"&shi="+shi+"&yunqi="+yunqi;

	$.getJSON(url,callback,'text',getJSONError,'GET','');
}

function getUserInfo(uid){
	var url = hostURL+"&a=get_user_info&uid="+uid;
	$.getJSON(url,getUserHand,'json',getJSONError,'GET','');
}

function setavatar(){
	
	 uexCamera.open();
}
function upload(data){


	var uploadHttp = hostURL +"&a=upavatar";
	//alert(uploadHttp+"图片地址："+data);
	 uexUploaderMgr.createUploader(1, uploadHttp);
	 uexUploaderMgr.uploadFile(1, data, "photo", '3'); 
}
