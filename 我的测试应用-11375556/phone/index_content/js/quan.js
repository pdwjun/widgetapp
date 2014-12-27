function getList(page){
	     setLocVal('page',page);
	     var url = hostURL+"&a=getmsglist&page="+page;
	   	$.getJSON(url,callback,'json',getJSONError,'GET','',true);
}

function getUserInfo(uid){
    var url =hostURL+"&a=get_user_info&uid="+uid;
    $.getJSON(url,userBack,'json',getJSONError,'GET','',true);
}
function getMsgCateInfo(rid){
    var url = hostURL+"&a=get_cate_info&rid="+rid;
    $.getJSON(url,msg_cate_Back,'json',getJSONError,'GET','',true);
}

function readInfo(uid){
	  var url=hostURL+"&a=get_msg_number&uid="+uid;
	  $.getJSON(url,readBack,'json',getJSONError,'GET','',true);
}

function readBack(data){
	 if(data==0){
	 	$$("msg").innerHTML="您还没有未读消息";
	 }else{
	 	$$("msg").innerHTML="您有"+data+"条未读回复";
	 }
}



