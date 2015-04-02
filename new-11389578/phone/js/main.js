var isPhone = (window.navigator.platform != "Win32");
var isAndroid = (window.navigator.userAgent.indexOf('Android') >= 0) ? true : false;
//var hostURL = "http://meibao.local/index.php?m=Api";
//var hostWebURL = "http://meibao.local";
var hostURL = "http://test.pdwjun.com/index.php?m=Api";
var hostWebURL = "http://test.pdwjun.com";
//	clearLocValReg(reg)


//checkFunction(hostWebURL+".index.php.m=Api&a=.*") //正则匹配 清除缓存
/**
 *
 * @param String inWndName 新窗口名称
 * @param String html        新窗口路径
 * @param String inAniID    打开动画
 * @param String f
 */
function openNewWin(inWndName, html, inAniID, f) {
    if (inAniID == 0) {
        uexWindow.open(inWndName, '0', html, 0, '', '', (f) ? f : 0);
        return;
    }
    if (inAniID)
        uexWindow.open(inWndName, '0', html, inAniID, '', '', (f) ? f : 0);
    else
        uexWindow.open(inWndName, '0', html, 10, '', '', (f) ? f : 0);
}

/**
 * 关闭窗口
 * @param string n 关闭窗口动画，默认-1
 */
function winClose(n) {
    if (n) {
        uexWindow.close(n);
        return;
    }
    if (parseInt(n) == 0) {
        uexWindow.close(n);
        return;
    }
    uexWindow.close(-1);
}


/**
 * 输出loag
 * @param String s 需要输出的信息
 * @param String a 添加的标注信息
 */
function logs(s, a) {
    if (typeof s == 'object') {
        s = JSON.stringify(s);
    }
    a = a ? a : "";
    if (!isPhone) {
        console.log(a + s);
    } else {
        uexLog.sendLog(a + s);
    }
}

/**
 * localStorage保存数据
 * @param String key  保存数据的key值
 * @param String value  保存的数据
 */
function setLocVal(key, value) {
    window.localStorage[key] = value;
}

/**
 * 根据key取localStorage的值
 * @param Stirng key 保存的key值
 */
function getLocVal(key) {
    if (window.localStorage[key])
        return window.localStorage[key];
    else
        return "";
}

/**
 * 所有localstorage的key值
 */
function listAllKeys() {
    var arr = Array();
    for (i = 0; i <= localStorage.length - 1; i++) {
        key = localStorage.key(i);
        arr.push(key);
    }
    return arr;
}

/**
 * 删除localstorage中匹配的key值
 */
function clearLocValReg(reg) {
    var arr = listAllKeys();
    var localKey = "";
    arr.forEach(function (key, value) {
        localKey = key.match(reg);
        if (localKey != "" && localKey != null) {
            clearLocVal(localKey)
            return true;
        }
    })
}


/**
 * 清除缓存
 * @param Striong key  保存数据的key，如果不传清空所有缓存数据
 */
function clearLocVal(key) {
    if (key)
        window.localStorage.removeItem(key);
    else
        window.localStorage.clear();
}

/**
 * alert 和 confirm 弹出框
 * @param String str 提示语
 * @param Function callback confirm的回调函数
 */
function $alert(str, callback) {
    if (callback) {
        uexWindow.cbConfirm = function (opId, dataType, data) {
            if (data == 0)
                callback();
        }
        uexWindow.confirm('提示', str, ['确定', '取消']);
    } else
        uexWindow.alert('提示', str, '确定');
}


/**
 * 在其他窗口中执行指定主窗口中的代码
 * @param String wn  需要执行代码窗口的名称
 * @param String scr 需要执行的代码
 */
function uescript(wn, scr) {
    uexWindow.evaluateScript(wn, '0', scr);
}

/**
 * 在其他窗口中执行指定浮动窗口中的代码
 * @param String wn  需要执行代码浮动窗口所在的主窗口的名称
 * @param String pn  需要执行代码的浮动窗口的名称
 * @param String scr 需要执行的代码
 */
function ueppscript(wn, pn, scr) {
    uexWindow.evaluatePopoverScript(wn, pn, scr);
}

/**
 * 判断是否是空
 * @param value
 */
function isDefine(value) {
    if (value == null || value == "" || value == "undefined" || value == undefined || value == "null" || value == "(null)" || value == 'NULL' || typeof(value) == 'undefined') {
        return false;
    }
    else {
        value = value + "";
        value = value.replace(/\s/g, "");
        if (value == "") {
            return false;
        }
        return true;
    }
}


/**
 * 给DOM对象赋值innerHTML
 * @param String id 对象id或者对象
 * @param String html html字符串
 * @param String showstr 当html不存在时的提示语
 */
function setHtml(id, html, showstr) {
    var showval = isDefine(showstr) ? showstr : "";
    if ("string" == typeof(id)) {
        var ele = $$(id);
        if (ele != null) {
            ele.innerHTML = isDefine(html) ? html : showval;
        } else {
            alert("没有id为" + id + "的对象");
        }
    } else if (id != null) {
        id.innerHTML = isDefine(html) ? html : showval;
    }
}

/**
 * 设置平台弹动效果
 * @param int sta   0=无弹动效果   1=默认弹动效果  2=设置图片弹动
 * @param Function downcb 下拉
 * @param Function upcb   上拖
 */
function setPageBounce(sta, downcb, upcb) {
    if (sta == 0) return;
    var color = "#FFF";
    if (sta == 1) {
        var s = ['0', '0'];
        var str = '';
        uexWindow.onBounceStateChange = function (type, status) {
            if (downcb && type == 0 && status == 2) downcb();
            if (upcb && type == 1 && status == 2) upcb();
        }

        uexWindow.setBounce("1");

        if (downcb) {
            s[0] = '1';
            uexWindow.notifyBounceEvent("0", "1");
        }
        if (color) {
            uexWindow.showBounceView("0", color, s[0]);
        } else {
            uexWindow.showBounceView("0", "rgba(255,255,255,0)", s[0]);
        }


        if (upcb) {
            s[1] = '1';
            uexWindow.notifyBounceEvent("1", "1");
        }
        if (color) {
            uexWindow.showBounceView("1", color, s[1]);
        } else {
            uexWindow.showBounceView("1", "rgba(255,255,255,0)", s[1]);
        }
        //	uexWindow.showBounceView("1","rgba(255,255,255,0)",s[1]);
    }
    if (sta == 2) {
        uexWindow.onBounceStateChange = function (type, status) {
            uexLog.sendLog("type=" + type + "||status=" + status);
            if (downcb && type == 0 && status == 2) downcb();
            if (upcb && type == 1 && status == 2) upcb();
        }
        uexWindow.setBounce("1");

        var inJson = '{"imagePath":"res://reload.png","textColor":"#530606","pullToReloadText":"拖动刷新","releaseToReloadText":"释放刷新","loadingText":"加载中，请稍等"}'
        if (downcb) {
            uexWindow.setBounceParams('0', inJson);
            uexWindow.showBounceView('0', color, 1);
            uexWindow.notifyBounceEvent('0', 1);
        }
        if (upcb) {
            uexWindow.setBounceParams('1', inJson)
            uexWindow.showBounceView('1', color, 1);
            uexWindow.notifyBounceEvent('1', 1);
        }
    }
}

/***
 * 使弹动重置为初始位置
 * @param String type 弹动的类型 0-顶部弹动  1-底部弹动
 */
function resetBV(type) {
    uexWindow.resetBounceView(type);
}

/**
 * 显示加载框
 * @param String mes 显示的提示语
 * @param String t  毫秒数 窗口存在时间 有的话显示框不显示那个“圈”，并且在t时间后消失
 */
function $toast(mes, t) {
    uexWindow.toast(t ? '0' : '1', '5', mes, t ? t : 0);
}

/**
 * 手动关闭加载框
 */
function $closeToast() {
    uexWindow.closeToast();
}


/**
 * getJSON请求数据的错误回调函数
 * @param {Object} err 返回的错误对象
 */
function getJSONError(err) {
    $closeToast();
    resetBV(0);
    resetBV(1);
    if (err.message == 'network error!') {
        // alert('网络未连接');
        uexWindow.alert('提示', '网络未连接', '确定');
    } else if (err.message == 'json parse failed!') {
        //  alert('json解析失败');
        //$toast('json解析失败',1000);
    } else if (err.message == 'file does not exist!') {
        //$toast('文件不存在', 1000);
    } else if (err.message == 'read file failed!') {
        //$toast('文件读取错误', 1000);
    } else {
        //$toast('发现未知错误', 1000);
    }
}


/**设置安卓back和menu按键事件监听
 * @b: back键，1为监听。
 * @m: menu键，1为监听。
 * @cb1: back键监听处理回调方法。
 * @cb2: menu键监听处理回调方法。
 */
function addKeyListener(b, m, cb1, cb2) {
    uexWindow.onKeyPressed = function (keyCode) {
        if (keyCode == 0) {
            if (cb1)  cb1();
            //uexWidget.finishWidget(''); //退出应用
        }
        else {
            if (cb2) cb2();
        }
    }
    if (b) uexWindow.setReportKey('0', '1');
    if (m) uexWindow.setReportKey('1', '1');
}

function showimg(img) {
    uexImageBrowser.open(img);
}


function DateDiff(sDate1, sDate2) {
    var aDate, oDate1, oDate2, iDays
    aDate = sDate1.split("-")
    oDate1 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0])    //转换为12-18-2006格式
    aDate = sDate2.split("-")
    oDate2 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0])
    iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 / 24)    //把相差的毫秒数转换为天数
    return iDays
}

function nowDate() {
    var d = new Date();
    var str = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
    return str;
}


function cc(dd, dadd) {
//可以加上错误处理
    var a = new Date(dd)
    a = a.valueOf()
    a = a - dadd * 24 * 60 * 60 * 1000
    a = new Date(a)

    return a.getFullYear() + '-' + (a.getMonth() + 1) + '-' + a.getDate();
}

function jj(dd, dadd) {
//可以加上错误处理
    var a = new Date(dd)
    a = a.valueOf()
    a = a + dadd * 24 * 60 * 60 * 1000
    a = new Date(a)

    return a.getFullYear() + '-' + (a.getMonth() + 1) + '-' + a.getDate();
}

//时间转成时间戳
function transdate(endTime) {
    var date = new Date();
    date.setFullYear(endTime.substring(0, 4));
    date.setMonth(endTime.substring(5, 7) - 1);
    date.setDate(endTime.substring(8, 10));
    date.setHours(endTime.substring(11, 13));
    date.setMinutes(endTime.substring(14, 16));
    date.setSeconds(endTime.substring(17, 19));
    return Date.parse(date);
}

function repliedTime(dateTimeStamp) {
    var minute = 1000 * 60;
    var hour = minute * 60;
    var day = hour * 24;
    var halfamonth = day * 15;
    var month = day * 30;
    var year = month * 12;
    var now = new Date().getTime();
    var diffValue = now - parseInt(dateTimeStamp) * 1000;
    if (diffValue < 0) {
        //若日期不符则弹出窗口告之
        //alert("结束日期不能小于开始日期！");
    }
    var yearC = diffValue / year;
    var monthC = diffValue / month;
    var weekC = diffValue / (7 * day);
    var dayC = diffValue / day;
    var hourC = diffValue / hour;
    var minC = diffValue / minute;
    if (yearC >= 1) {
        result = parseInt(yearC) + "年前";
    }
    else if (monthC >= 1) {
        result = parseInt(monthC) + "月前";
    }
    else if (weekC >= 1) {
        result = parseInt(weekC) + "周前";
    }
    else if (dayC >= 1) {
        result = parseInt(dayC) + "天前";
    }
    else if (hourC >= 1) {
        result = parseInt(hourC) + "小时前";
    }
    else if (minC >= 1) {
        result = parseInt(minC) + "分钟前";
    } else
        result = "刚刚发表";
    return result;

}
/**
 * 检查网络，判断是否清除localstorage
 * @param reg
 */
function checkFunction(reg) {
    uexDevice.getInfo(13);

    uexDevice.cbGetInfo = function (opCode, dataType, data) {

        var device = eval('(' + data + ')');
        var network = device.connectStatus;

        if (network == -1) {
            uexWindow.closeToast();
            //$$("msg").innerHTML = "网络异常，请检查是否连接网络";

        } else {
            clearLocValReg(reg)
        }

    }
}
/*
 默认图片
 */
function initImgURL(img) {
    if (img == "")
        img = 'image/headphoto.jpg';
    else
        img = hostWebURL + img;
    //setLocVal(img,img);
    return img;
}
function goURL(url) {
    var p = window.getComputedStyle($$("footer"), null);
    var h = window.getComputedStyle($$("header"), null);
    //uexWindow.openPopover("content", 0, url, "", 0, int(h.height), '', "", '', 0, int(p.height));
    zy_con("content", url, 0, int(h.height));
}
/*
 返回城市列表
 var type 1 2 月子中心所在城市 医生所在城市
 */
function getCityList(type) {
    var url = hostURL + "&a=get_city_list&type=" + type;
    $.getJSON(url, citylistcallback, 'json', getJSONError, 'GET', '');
}

String.prototype.Trim = function () {

    var m = this.match(/^\s*(\S+(\s+\S+)*)\s*$/);

    return (m == null) ? "" : m[1];

}

String.prototype.isMobile = function () {

    return (/^0*(1)\d{10}$/.test(this.Trim()));

}

String.prototype.isTel = function () {

    //"兼容格式: 国家代码(2到3位)-区号(2到3位)-电话号码(7到8位)-分机号(3位)"

    //return (/^(([0\+]\d{2,3}-)?(0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/.test(this.Trim()));

    return (/^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/.test(this.Trim()));

}

function chkphone(phone) {


    if (phone.isMobile() || phone.isTel()) {

        return true;

    }

    else {

        //alert("请输入正确的手机号码或电话号码\n\n例如:13916752109或0712-3614072");


        return false;

    }
}
function chkemail(strEmail) {
    var re_email = new RegExp("^([a-zA-Z0-9]+[_|\_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|.]?)*[a-zA-Z0-9]+.[a-zA-Z]{2,3}$");
    if (re_email.test(strEmail)) {
        //alert("请输入正确的邮箱！");
        return true;
    }
    else {
        return false;

    }
}