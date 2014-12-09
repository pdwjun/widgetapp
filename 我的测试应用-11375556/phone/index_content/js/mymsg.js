function getList(page,uid){
	     setLocVal('page',page);
	     var url = hostURL+"&a=getmsglist&page="+page+"&uid="+uid;
	   	$.getJSON(url,callback,'json',getJSONError,'GET','');
}

function getUserInfo(uid){
	   var url =hostURL+"&a=get_user_info&uid="+uid;
	   $.getJSON(url,userBack,'json',getJSONError,'GET','',true);
}


