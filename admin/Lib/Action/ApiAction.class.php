<?php
header('Access-Control-Allow-Origin: *');

 class ApiAction extends CommonAction{
     /*
      *  1  3:              save_comment&id="+id+"&content="+content+"&photo="+photo+"&uid="+uid;
      *  2  11:             upphoto";
      *  3  4:              get_house_list&page="+page;
      *  4  3:              getmsglist&page="+page+"&uid="+uid;
      *  5  8:              get_user_info&uid="+uid;
      *  6  3:              getmsglist&page="+page;
      *  7  8:              get_user_info&uid="+uid;
      *  8  13:              get_msg_number&uid="+uid;
      *  9  2:              login&username="+username+"&password="+password;
      * 10  3:              getmsg&id="+id;
      * 11  17:             a=zan&id="+id;
      * 12  2:              getCate";
      * 13  8:              savemsg&title="+title+"&content="+content+"&cid="+cid+"&photo="+photo+"&uid="+uid;
      * 14  2:              reg&username="+username+"&password="+password+"&yunqi="+yunqi;
      * 15  7:              get_date";
      * 16  2:              get_cate_info&rid="+rid;
      * 17  2:              get_trip&uid="+uid;
      * 18  2:              save&uid="+uid+"&name="+name+"&password="+password+"&avatar="+avatar+"&phone="+phone+"&sheng="+sheng+"&remark="+remark+"&shi="+shi+"&yunqi="+yunqi;
      * 19  8:              get_user_info&uid="+uid;
      * 20  19:             a=upavatar";
      * 22  3:              get_house_info&id="+houseid;
	  * 23  27:              showtrip&id="+tid;

      */
     private $table_name;
 	 public function index(){
	 	 
	 	$this->list = M($this->table_name)->select();
	 	$this->display("Category:index");
	 	
	 }

     /*
      * 登陆
      */
	 public function login(){
        if(I('username',0)&&I('password')){

             //生成认证条件
             $map=array();
             $map['username']=I('username');
             import('ORG.Util.RBAC');
             $authinfo = RBAC::authenticate($map, 'User');
             if(false === $authinfo){

                 echo 0;

             }else{
                 if($authinfo['password']==I('password',0,'md5')){

                     $_SESSION[C('USER_AUTH_KEY')]=$authinfo['uid'];
                     $_SESSION['username']=$authinfo['username'];
                     $_SESSION['logintime'] = mktime();
                     if($authinfo['administrator']== C('ADMIN_AUTH_KEY')){

                         $_SESSION[C('ADMIN_AUTH_KEY')] = true;

                     }

                     RBAC::saveAccessList();
                     //var_dump($_SESSION); exit();
                     $arr = array('uid'=>$authinfo['uid'],'yunqi'=>$authinfo['yunqi'],'yuchan'=>$authinfo['yuchan']);
                     echo json_encode($arr);

                 }else{
                     echo 0;
                 }
             }

         }else{

             echo "用户或则密码不能空";
         }
	 }

     /*
      * 注册
      * reg&username="+username+"&password="+password+"&yunqi="+yunqi;
      * setLocVal('uid',data.uid);
			setLocVal('yunqi',data.yunqi);
			uexWindow.evaluateScript("index",'0', "openCon(4)");
			uexWindow.open("index",0,"index.html",'1','','',4)

      */
     public function reg(){
         if(I('username',0)&&I('password')&&I('yunqi')){
            //生成认证条件
             $data=array();
             $data['username']=I('username');
             $data['password']=md5(I('password'));
             $data['yunqi']=I('yunqi');

             $data['status']= 1 ;

             if(!D('User')->create($data)){
                 echo 0;
                 //echo D('User')->getError();
             }else{
                 $uid = M('User')->add($data);

                 $arr = array('uid'=>$uid,'yunqi'=>$data['yunqi']);
                 echo json_encode($arr);
             }
         }
     }

     /*
      * get_user_info
      *  8  13:              get_user_info&uid="+uid;
      *
      */
     public function get_user_info($uid){
//         $file = 'test.log';
//         file_put_contents($file, $uid);
         $user = M('User');
         $data = $user->find($uid);
         if($data){
             echo json_encode($data);
         }
         else
             echo 0;

     }

     /*
      * getmsglist
      *  4  3:              getmsglist&page="+page+"&uid="+uid;
      *
      */
     public function getmsglist($page,$uid){

     }


     /*
      * get_msg_number
      *  8  13:              get_msg_number&uid="+uid;
      *
      */
     public function get_msg_number($uid){

     }
	 
 }
?>
