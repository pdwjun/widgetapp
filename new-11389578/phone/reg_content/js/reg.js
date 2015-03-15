function regdo(username,password,yunqi,phone){
	var url = hostURL+"&a=reg&username="+username+"&password="+password+"&yunqi="+yunqi+"&phone="+phone;
	$.getJSON(url,callback,'json',getJSONError,'GET','');
}
