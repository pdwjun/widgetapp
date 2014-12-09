function loads(uid){
	var url = hostURL+"&a=get_trip&uid="+uid;
   $.getJSON(url,callback,'json',getJSONError,'GET','');
}
