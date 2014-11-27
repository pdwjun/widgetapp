function dopublish(id,content,photo,uid){

		var url =hostURL+"&a=save_comment&id="+id+"&content="+content+"&photo="+photo+"&uid="+uid;

	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}

function upload(data){


	var uploadHttp = hostURL +"&a=upphoto";
	 uexUploaderMgr.createUploader(1, uploadHttp);
	 uexUploaderMgr.uploadFile(1, data, "photo", 3); 
}



