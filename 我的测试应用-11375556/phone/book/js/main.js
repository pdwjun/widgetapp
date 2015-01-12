function loads(keyword,page){
    if(keyword)
	    var url = hostURL+"&a=getdoclist&keyword=" + keyword;
    else
        var url = hostURL+"&a=getdoclist";
    if(page)
        url += "&page="+page;
   $.getJSON(url,callback,'json',getJSONError,'GET','', true);
}
function bookDoctor(id,uid,did,name, email, phone, expection, flydate){
    var url = hostURL+"&a=bookDoctor&id=" + id+"&uid="  + uid+"&did=" + did+"&email=" + email+"&name=" + name+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
    $.getJSON(url,saveBack,'json',getJSONError,'GET','');

}
function myorder(){
    var url = hostURL+"&a=myOrder&uid=" + getLocVal('uid');
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function orderDetail(id){
    var url = hostURL+"&a=orderDetail&id=" + id;
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function loadhospital(keyword,page){
    if(keyword)
        var url = hostURL+"&a=gethoslist&keyword=" + keyword;
    else
        var url = hostURL+"&a=gethoslist";
    if(page)
        url += "&page="+page;
    $.getJSON(url,callback,'json',getJSONError,'GET','', true);
}
function bookHospital(id,uid,hid,name, email, phone, expection, flydate){
    var url = hostURL+"&a=bookHospital&id=" + id+"&uid="  + uid+"&did=" + hid+"&email=" + email+"&name=" + name+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
    $.getJSON(url,saveBack,'json',getJSONError,'GET','');

}