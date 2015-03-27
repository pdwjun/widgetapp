function getList(page){
	     setLocVal('page',page);
	     var url = hostURL+"&a=getmsglist&page="+page;
		//检查网络 正则表达式匹配 清除本地缓存数据
		checkFunction(hostWebURL+".index.php.m=Api&a=getmsglist.*")
	   	$.getJSON(url,callback,'json',getJSONError,'GET','',true);
}

function getUserInfo(uid){
    var url =hostURL+"&a=get_user_info&uid="+uid;
	checkFunction(hostWebURL+".index.php.m=Api&a=get_user_info.*")
    $.getJSON(url,userBack,'json',getJSONError,'GET','');
}
function getMsgCateInfo(rid){
    var url = hostURL+"&a=get_cate_info&rid="+rid;
	checkFunction(hostWebURL+".index.php.m=Api&a=get_cate_info.*")
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



