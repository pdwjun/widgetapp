function getHouseList(page){
		$toast('数据加载中...');
		setLocVal('page',page);
		var url =hostURL+"&a=get_house_list&page="+page;
	  $.getJSON(url,callback,'json',getJSONError,'GET','');
}