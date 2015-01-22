function loads(id){
	
	var url =hostURL+"&a=getmsg&id="+id;
	//checkFunction(hostURL+"&a=getmsg.*")
	  $.getJSON(url,callback,'json',getJSONError,'GET','',true);
    loadCom(1,id);
}
function loadCom(page,id){
    url = hostURL+'&a=getcomment&mid='+id+'&page='+page;
    $.getJSON(url,commentback,'json',getJSONError,'GET','',true);
}

function zanback(data){
	var zid = getLocVal('zid');
	 if(data==1){
	 		$toast("点赞成功",2000);
			$$("zan_"+zid).innerHTML = parseInt($$("zan_"+zid).innerHTML)+1;
	 }
	else if(data == 2){
		 $toast("取消点赞",2000);
		 $$("zan_"+zid).innerHTML = parseInt($$("zan_"+zid).innerHTML)-1;
	 }
	else{
		 $toast("点赞失败",2000);

	 }
}
	
function dozan(uid,mid){
	var url =hostURL +"&a=zan&uid="+uid+"&mid="+mid;
	$.getJSON(url,zanback,'json',getJSONError,'GET','');
}



