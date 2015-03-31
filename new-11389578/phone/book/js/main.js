function loads(keyword,page){
    if(keyword)
	    var url = hostURL+"&a=getdoclist&keyword=" + keyword;
    else
        var url = hostURL+"&a=getdoclist";
    if(page)
        url += "&page="+page;
   $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function bookDoctor(id,type,uid,fid,name, email, phone, expection, flydate){
    var url = hostURL+"&a=book&id=" + id+"&type="  + type+"&uid="  + uid+"&fid=" + fid+"&email=" + email+"&name=" + name+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
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
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function loadhouse(keyword,page){
    if(keyword)
        var url = hostURL+"&a=gethouselist&keyword=" + keyword;
    else
        var url = hostURL+"&a=gethouselist";
    if(page)
        url += "&page="+page;
    $.getJSON(url,callback,'json',getJSONError,'GET','');
}
function bookHospital(id,type,uid,fid,name, email, phone, expection, flydate){
    var url = hostURL+"&a=book&id=" + id+"&type="  +type +"&uid="  + uid+"&fid=" + fid+"&email=" + email+"&name=" + name+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
    $.getJSON(url,saveBack,'json',getJSONError,'GET','');
}
function bookHouse(id,type,uid,fid,name, email, phone, expection, flydate){
    var url = hostURL+"&a=book&id=" + id+"&type="  + type+"&uid="  + uid+"&fid=" + fid+"&email=" + email+"&name=" + name+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
    $.getJSON(url,saveBack,'json',getJSONError,'GET','');
}
function checkphoneorder(type,phone){
    var url = hostURL+"&a=checkphoneorder&type="  +type +"&phone=" + phone;
    $.getJSON(url,phoneorderBack,'json',getJSONError,'GET','');

}