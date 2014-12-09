function loads(rid){
     var url = hostURL+"&a=get_cate_info&rid="+rid;
	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}
