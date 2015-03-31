function getHouseList(page){
		$toast('数据加载中...');
		setLocVal('page',page);
		var url =hostURL+"&a=get_house_list&page="+page;
	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function houseinfo(){
	var url =hostURL+"&a=get_house_info&id="+getLocVal('hid');
	$.getJSON(url,callback,'json',getJSONError,'GET','');
}
function hospitalinfo(){
    var url =hostURL+"&a=get_hospital_info&id="+getLocVal('hid');
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}

function doctorinfo(){
    var url =hostURL+"&a=get_doctor_info&id="+getLocVal('did');
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}