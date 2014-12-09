function logindo(username,password){
	var url= hostURL+"&a=login&username="+username+"&password="+password;
	$.getJSON(url,callback,'json',getJSONError,'GET','','');
}
