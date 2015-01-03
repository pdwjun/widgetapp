function loads(keyword){
	var url = hostURL+"&a=getdoclist&keyword=" + keyword;
   $.getJSON(url,callback,'json',getJSONError,'GET','');
}
