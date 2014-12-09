function getHouseInfo(houseid){

	  var url =hostURL+"&a=get_house_info&id="+houseid;
	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}
