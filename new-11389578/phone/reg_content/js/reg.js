function regdo(username,password,yunqi){
	var url = hostURL+"&a=reg&username="+username+"&password="+password+"&yunqi="+yunqi;
	$.getJSON(url,callback,'json',getJSONError,'GET','');
}
