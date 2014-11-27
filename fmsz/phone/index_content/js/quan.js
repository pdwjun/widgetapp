function getList(page){
	     setLocVal('page',page);
	     var url = hostURL+"&a=getmsglist&page="+page;
	   	$.getJSON(url,callback,'json',getJSONError,'GET','');
}

function getUserInfo(uid){
	   var url =hostURL+"&a=get_user_info&uid="+uid;
	   $.getJSON(url,userBack,'json',getJSONError,'GET','',true);
}

function readInfo(uid){
	  var url=hostURL+"&a=get_msg_number&uid="+uid;
	  $.getJSON(url,readBack,'json',getJSONError,'GET','');
	
}

function readBack(data){
	 if(data==0){
	 	$$("msg").innerHTML="您还没有未读消息";
	 }else{
	 	$$("msg").innerHTML="您有"+data+"条未读回复";
	 }
}



