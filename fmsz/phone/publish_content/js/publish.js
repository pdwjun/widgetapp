function getCate(){
	var url = hostURL+"&a=getCate";
	$.getJSON(url,callback,'json',getJSONError,'GET','');
	
}

function savedo(cid,title,content,photo,uid){
	var  url=hostURL +"&a=savemsg&title="+title+"&content="+content+"&cid="+cid+"&photo="+photo+"&uid="+uid;
	$.getJSON(url,saveBack,'json',getJSONError,'GET','');
}

function upload(data){


	var uploadHttp = hostURL +"&a=upphoto";
	 uexUploaderMgr.createUploader(1, uploadHttp);
	 uexUploaderMgr.uploadFile(1, data, "photo", '1'); 
}
