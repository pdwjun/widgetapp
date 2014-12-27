function loads(id){
	
	var url =hostURL+"&a=getmsg&id="+id;
	  $.getJSON(url,callback,'json',getJSONError,'GET','',true);
    loadCom(1,id);
}
function loadCom(page,id){
    url = hostURL+'&a=getcomment&mid='+id+'&page='+page;
    $.getJSON(url,commentback,'json',getJSONError,'GET','',true);
}

function zanback(data){
	 if(data!=0){
	 		$toast("点赞成功",2000);
			$$("zan_"+data).innerHTML = parseInt($$("zan_"+data).innerHTML)+1;
	 }
}
	
function dozan(uid,mid){
	var url =hostURL +"&a=zan&uid="+uid+"&mid="+mid;
	$.getJSON(url,zanback,'json',getJSONError,'GET','');
}



