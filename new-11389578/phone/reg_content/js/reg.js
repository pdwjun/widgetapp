function regdo(username,password,yunqi,phone){
	var url = hostURL+"&a=reg&username="+username+"&password="+password+"&yunqi="+yunqi+"&phone="+phone;
	$.getJSON(url,callback,'json',getJSONError,'GET','');
}
function recoverdo(username,password,phone){
    var url = hostURL+"&a=recover&username="+username+"&password="+password+"&phone="+phone;
    $.getJSON(url,recoverback,'json',getJSONError,'GET','');
}
