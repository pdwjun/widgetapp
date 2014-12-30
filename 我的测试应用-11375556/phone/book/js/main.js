function loads(uid){
	var url = hostURL+"&a=getdoclist";
   $.getJSON(url,callback,'json',getJSONError,'GET','');
}
