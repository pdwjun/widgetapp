function loads(keyword,page){
    if(keyword)
	    var url = hostURL+"&a=getdoclist&keyword=" + keyword;
    else
        var url = hostURL+"&a=getdoclist";
    if(page)
        url += "&page="+page;
   $.getJSON(url,callback,'json',getJSONError,'GET','', true);
}
function bookDoctor(uid,did, email, phone, expection, flydate){
    var url = hostURL+"&a=bookDoctor&uid=" + uid+"&did=" + did+"&email=" + email+"&phone=" + phone+"&expection=" + expection+"&flydate=" + flydate;
    $.getJSON(url,saveBack,'json',getJSONError,'GET','');

}
function myorder(){
    var url = hostURL+"&a=myOrder&uid=" + getLocVal('uid');
    $.getJSON(url,callback,'json',getJSONError,'GET','',true);

}