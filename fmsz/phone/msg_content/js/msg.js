function loads(id){
	
	var url =hostURL+"&a=getmsg&id="+id;
	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}

function zanback(data){
	 if(data==1){
	 		$toast("点赞成功",2000);
			$$("zan").innerHTML = parseInt($$("zan").innerHTML)+1;
	 }else{
	 	 $toast("点赞失败",2000);
	 }
}
	
function dozan(id){
	var url =hostURL +"&a=zan&id="+id;
	$.getJSON(url,zanback,'json',getJSONError,'GET','');
	
}



