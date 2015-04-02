function firstMsg(){
    var url =hostURL+"&a=firstMsg";
    $.getJSON(url,msgCallback,'json',getJSONError,'GET','');
}

function loads() {
    var checkUp = getLocVal('checkUp');

    if (!checkUp) {
        //没有更新到本地
        //$toast('从远程获取数据', 1000);
        var url = hostURL + "&a=get_date";
        $.getJSON(url, callback, 'json', getJSONError, 'GET', '');
        setLocVal('checkUp', 'ok');
    } else {
        //$toast('从本地获取数据', 1000);
        createDB();


        uexDataBaseMgr.selectSql(dbname, 1, "SELECT * FROM category");
        closeDB();
        //Sql语句的查询的回调
        uexDataBaseMgr.cbSelectSql = function (opId, dataType, data) {
            var rs = eval('(' + data + ')');

            var ss = treeList(rs);
            loadLoction(ss);

        }


    }


}

function treeList(data) {


    var str = new Array();
    var x = 0;

    for (var i = 0; i < data.length; i++) {

        if (data[i]['cid'] == '0') {

            str[x] = data[i];
            var ss = new Array();
            for (var j = 0; j < data.length; j++) {

                if (data[j]['cid'] == data[i]['_id']) {
                    ss.push(data[j]);
                    str[x]['list'] = ss;

                }

            }

            //str[i]=v;
            x = x + 1;


        }

    }


    return str;

}

function loadList(cid) {

    createDB();
    uexDataBaseMgr.selectSql(dbname, 1, "SELECT * FROM category WHERE cid=" + cid);
    closeDB();
    uexDataBaseMgr.cbSelectSql = function (opId, dataType, dataa) {
        var vv = eval('(' + dataa + ')');
        if (vv == '') {

        } else {

            return vv;


        }


    }

}

 								
