function dopublish(uid,mid,cid,content){
    //$uid,$mid,$cid,$content
		var url =hostURL+"&a=save_comment&uid="+uid+"&mid="+mid+"&cid="+cid+"&content="+content;

	  $.getJSON(url,replyback,'json',getJSONError,'GET','');
}

function upload(data){


	var uploadHttp = hostURL +"&a=upphoto";
	 uexUploaderMgr.createUploader(1, uploadHttp);
	 uexUploaderMgr.uploadFile(1, data, "photo", 3); 
}



