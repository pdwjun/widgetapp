function dopublish(uid,mid,cid,content,image){
    //$uid,$mid,$cid,$content
		var url =hostURL+"&a=save_comment&uid="+uid+"&mid="+mid+"&cid="+cid+"&content="+content+"&image="+image;

	  $.getJSON(url,replyback,'json',getJSONError,'GET','');
}

function upload(data){
	var uploadHttp = hostURL +"&a=upload";
	uexUploaderMgr.createUploader(1, uploadHttp);
	uexUploaderMgr.uploadFile(1, data, "fileToUpload", '1');
}



