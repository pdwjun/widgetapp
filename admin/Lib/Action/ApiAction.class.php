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
      *  7  8:        00      get_user_info&uid="+uid;
      *  8  13:              get_msg_number&uid="+uid;
      *  9  2:        00      login&username="+username+"&password="+password;
      * 10  3:              getmsg&id="+id;
      * 11  17:             a=zan&id="+id;
      * 12  2:              getCate";
      * 13  8:              savemsg&title="+title+"&content="+content+"&cid="+cid+"&photo="+photo+"&uid="+uid;
      * 14  2:         00     reg&username="+username+"&password="+password+"&yunqi="+yunqi;
      * 15  7:              get_date";
      * 16  2:          00    get_cate_info&rid="+rid;
      * 17  2:              get_trip&uid="+uid;
      * 18  2:              save&uid="+uid+"&name="+name+"&password="+password+"&avatar="+avatar+"&phone="+phone+"&sheng="+sheng+"&remark="+remark+"&shi="+shi+"&yunqi="+yunqi;
      * 19  8:         00     get_user_info&uid="+uid;
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
      * get_cate_info
      *  4  3:              get_cate_info&id="+id;
      *
	  $$("content").innerHTML =data.content;
	  $$("title").innerHTML =data.name;
      */
     public function get_cate_info($rid){
         $model = M('Msg_cate');
         $data = $model->find($rid);
         if($data){
             echo json_encode($data);
         }
         else
             echo 0;

     }

     /*
      * 分页输出帖子列表
      * getmsglist
      *  4  3:              getmsglist&page="+page+"&uid="+uid;
      */
     public function getmsglist($page=1,$id=''){
         //10条
         import('ORG.Util.Page');
         $return_number = 10;
         $count=M('Msg')->count();// 查询总数据记录

         $Page = new Page($count,$return_number);
        $user_tab = M('User')->getTableName();
         $comment_tab = M('Comment')->getTableName();
        $msg_tab = M('Msg')->getTableName();
         //SELECT distinct hh85_msg.*,(select count(*) from hh85_comment where hh85_msg.id = hh85_comment.mid) as count FROM `hh85_msg` left join hh85_comment on  hh85_msg.id = hh85_comment.mid
         $list = M('Msg')->Distinct(1)->field($msg_tab.'.*,'.$user_tab.'.*, (select count(*) from '.$comment_tab.' where '.$comment_tab.'.mid = '.$msg_tab.'.id) as comment_count')->join('left join '.$comment_tab.' ON '.$msg_tab.'.id = '.$comment_tab.'.mid' )->join('left join '.$user_tab.' ON '.$user_tab.'.uid = '.$msg_tab.'.uid' )->order("createtime DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
         foreach($list as $key => $item){
             $arr = explode('|', $item['zan_uid']);
             if($arr[0]!="")
                $list[$key]['zan'] = count($arr);
             else
                 $list[$key]['zan'] = "0";

         }
         if($list){
             echo json_encode($list);
         }
         else
             echo 0;

     }

     /*
      * zan 点赞
      * msg表 zan_uid存储点赞的用户
      * 11  17:             a=zan&uid="+uid+"&mid="+mid;
      *
	  $$("content").innerHTML =data.content;
	  $$("title").innerHTML =data.name;
      */
     public function zan($uid,$mid){
        $model = M('Msg');
         $msg = $model->find($mid);
         $arr = array();
         $data['id'] = $mid;
         if($msg){
             $arr = explode('|',$msg['zan_uid']);
             $data['zan_uid'] = $msg['zan_uid'];
         }
         if(!in_array($uid,$arr)){
             if($arr[0]=="")
                 $data['zan_uid'] = $uid;
             else
                 $data['zan_uid'] .= '|'.$uid;
         }
         if($model->save($data)){
             echo $mid;
         }
         else
             echo 0;

     }

     /*
      * get_cate_info
      *  4  3:              get_cate_info&id="+id;
      *
	  $$("content").innerHTML =data.content;
	  $$("title").innerHTML =data.name;
      */
     public function getCate(){
         $model = M('Msg_cate');
         $data = $model->select();
         if($data){
             echo json_encode($data);
         }
         else
             echo 0;

     }

     /*
      * savemsg
      * 13  8:              savemsg&title="+title+"&content="+content+"&cid="+cid+"&photo="+photo+"&uid="+uid;
      *
      */
     public function savemsg(){
         if(I('title',0)&&I('content')){
             $data=array();
             $data['title']=I('title');
             $data['content']=I('content');
             $data['cid']=I('cid');
             $data['photo']=I('photo');
             $data['uid']=I('uid');

             $data['status']= 1 ;   //

             $mid = M('Msg')->add($data);
             echo $mid;

         }

     }

     /*
      * getmsg
      * 10  3:              getmsg&id="+id;
      *
      */
     public function getmsg(){
         $model = M('Msg');
         $model_tab = M('Msg')->getTableName();
         $user_tab = M('User')->getTableName();
         $list = $model->join('join '.$user_tab.' on '. $user_tab.'.uid=.'.$model_tab.'.uid ')->find(I('id'));
         if($list){
             foreach($list as $key => $item){
                 $arr = explode('|', $item['zan_uid']);
                 if($arr[0]!="")
                     $list[$key]['zan'] = count($arr);
                 else
                     $list[$key]['zan'] = "0";

             }
             echo json_encode($list);
         }
         else
             echo 0;

     }


     /*
      * get_msg_number
      *  8  13:              get_msg_number&uid="+uid;
      *
      */
     public function get_msg_number($uid){

     }

     /*
      * 返回 string 中有多少元素，多少个人赞
      */
     public function count_like($like_str){
         $arr = explode('|', $like_str);
         if($arr[0]=="")
             return 0;
         else
             return count($arr);
     }

 }
?>
