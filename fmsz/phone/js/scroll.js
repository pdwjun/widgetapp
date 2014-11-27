
function setPageBounce(downcb, upcb){
        var s = ['0', '0'];
        uexWindow.onBounceStateChange = function (type,status){
                if(downcb && type==0 && status==2) downcb();
                if(upcb && type==1 && status==2) upcb();
        }
        uexWindow.setBounce("1");
        if(downcb){
                s[0] = '1';
				uexWindow.setBounceParams(0,
				{"imagePath":"res://loading.png","textColor":"#aaa","levelText":"xxxx","pullToReloadText":"下拉刷新","releaseToReloadText":"释放刷新","loadingText":"加载中，请稍等"});
                uexWindow.notifyBounceEvent("0","1");
        }
        if(upcb){
                s[1] = '1';
				uexWindow.setBounceParams(1,
				{"imagePath":"res://loading.png","textColor":"#aaa","levelText":"xxxx","pullToReloadText":"上拉刷新","releaseToReloadText":"释放刷新","loadingText":"加载中，请稍等"});
                uexWindow.notifyBounceEvent("1","1");
        }
        uexWindow.showBounceView("0","#FFF",s[0]);
        uexWindow.showBounceView("1","#FFF",s[1]);
}