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
         if(I('username',0)&&I('password')){
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
         $user = M('User');
         $data = $user->find($uid);
         if($data){
             echo json_encode($data);
         }
         else
             echo 0;

     }

     /*
      * get_house_info
      *
      */
     public function get_house_info($id){
         $user = M('House');
         $data = $user->find($id);
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
         $nowPage = isset($_REQUEST['page'])?$_REQUEST['page']:1;
         //SELECT distinct hh85_msg.*,(select count(*) from hh85_comment where hh85_msg.id = hh85_comment.mid) as count FROM `hh85_msg` left join hh85_comment on  hh85_msg.id = hh85_comment.mid
         $list = M('Msg')->Distinct(1)
             ->field($msg_tab.'.*,'.$user_tab.'.*, (select count(*) from '.$comment_tab.' where '.$comment_tab.'.mid = '.$msg_tab.'.id and status=1) as comment_count')
             ->join('left join '.$comment_tab.' ON '.$msg_tab.'.id = '.$comment_tab.'.mid' )
             ->join('left join '.$user_tab.' ON '.$user_tab.'.uid = '.$msg_tab.'.uid' )
             ->where($msg_tab.'.status=1')
             ->page($nowPage.','.$Page->listRows)
             ->order("createtime DESC")
             ->select();
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
         $zan = 1;
         if($msg){
             $arr = explode('|',$msg['zan_uid']);
             $data['zan_uid'] = $msg['zan_uid'];
         }
         if(!in_array($uid,$arr)){  //已经赞过，就取消赞 即-1，返回状态为2
             if($arr[0]=="")
                 $data['zan_uid'] = $uid;
             else
                 $data['zan_uid'] .= '|'.$uid;
         }else{
             $zan = 2;  //
             unset($arr[array_search($uid , $arr)]);
             $data['zan_uid'] = implode('|',$arr);
         }
         if($model->save($data)){
             echo $zan;
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
             if(I('img')!="")
                 $data['img'] = I('img');

             $data['uid']=I('uid');
             $data['createtime']=time();

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
     /**
      *
      */
     public function getmsg(){
         $model = M('Msg');
         $user_tab = M('User')->getTableName();
         $comment_tab = M('Comment')->getTableName();
         $msg_tab = M('Msg')->getTableName();
         $where = $msg_tab.".status=1";
         if(isset($_REQUEST['id'])&&$_REQUEST['id']!="")
             $where .= ' and '. $msg_tab. '.id='. I('id');
         $list = $model->Distinct(1)
             ->field($msg_tab.'.*,'.$user_tab.'.*, (select count(*) from '.$comment_tab.' where '.$comment_tab.'.mid = '.$msg_tab.'.id and status=1) as comment_count')
             ->join('left join '.$comment_tab.' ON '.$msg_tab.'.id = '.$comment_tab.'.mid' )
             ->join('left join '.$user_tab.' ON '.$user_tab.'.uid = '.$msg_tab.'.uid' )
             ->where($where)
             ->order($msg_tab. '.createtime desc')
             ->find();
         if($list){
             $arr = explode('|', $list['zan_uid']);
             if($arr[0]!="")
                 $list['zan'] = count($arr);
             else
                 $list['zan'] = "0";

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

     /*
      * 返回 回复列表
      */
     public function getcomment($mid){
         $model = M('Comment');
         import('ORG.Util.Page');
         $return_number = 10;
         $count=$model->count();// 查询总数据记录

         $nowPage = isset($_REQUEST['page'])?$_REQUEST['page']:1;
         $Page = new Page($count,$return_number);
         $user_tab = M('User')->getTableName();
         $list = $model->join($user_tab.' on '. $user_tab.'.uid = '. $model->getTableName().'.uid')
             ->page($nowPage.','.$Page->listRows)
             ->order('createtime asc')
             ->where('mid='.$mid.' and '. $model->getTableName().'.status=1')->select();
         if(!empty($list))
             echo json_encode($list);
         else
             echo 0;
     }

     /*
      * save_comment    //发布回复内容
      * var url =hostURL+"&a=save_comment&id="+id+"&content="+content+"&photo="+photo+"&uid="+uid;
      *
      */
     public function save_comment($uid,$mid,$cid,$content){
         $model = M('Comment');
         $_REQUEST['createtime'] = time();
         $_REQUEST['image'] = $_REQUEST['img'];
         $_REQUEST['touid'] = $this->get_to_id($cid);
         $_REQUEST['content'] = htmlspecialchars($_REQUEST['content']);
         if($uid==""||$content=""||$mid=="")
             echo "false";
         elseif($model->add($_REQUEST))
            echo $cid;
         else
             echo "false";

     }
     public function upload(){

         $target_dir = "/data/photo/";
         file_put_contents($_SERVER['DOCUMENT_ROOT'] . $target_dir.'log', print_r($_FILES, 1));
         $ext = strtolower(substr(strrchr($_FILES["fileToUpload"]["name"],'.'),1));
         $target_file = $target_dir .rand(0,10000).date('YmdHis').'.'.$ext;

         $uploadOk = 1;
         $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
         if (isset($_POST["submit"])) {
             $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
             if ($check !== false) {
//                 echo "File is an image - " . $check["mime"] . ".";
//                 echo "0";
             } else {
//                 echo "File is not an image.";
                 echo "0";
                 return true;
             }
         }
            // Check file size
         if ($_FILES["fileToUpload"]["size"] > 10000000) {
//             echo "Sorry, your file is too large.";
             echo "0";
         }
            // Allow certain file formats
         if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
             && $imageFileType != "gif"
         ) {
//             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             echo "0";
         }
            // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
//             echo "Sorry, your file was not uploaded.";
             echo "0";
            // if everything is ok, try to upload file
         } else {
             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $target_file)) {
                 echo $target_file;
             } else {
                 echo "0";
//                 echo "Sorry, there was an error uploading your file.";
             }
         }

     }
     public function getdoclist(){
         $keyword = '';
         if(isset($_REQUEST['keyword']))
             $keyword = $_REQUEST['keyword'];

         import('ORG.Util.Page');
         $return_number = 10;
         $where = array();
         $may = array();
         $count=M('Doctor')->count();// 查询总数据记录
         if($keyword!=''){
             $list = explode(' ', $keyword); //空格可查询多个关键字
             foreach($list as $i => $item){
                 if($i == 0)
                     $where['grade'] = array('egt', $item);
                 else
                 {
                     $item = '%'. $item.'%';
                     $map['name'] = array('like', $item,'or');
                     $map['content'] = array('like', $item,'or');
                     $map['hospital'] = array('like', $item,'or');
                     $map['city'] = array('like', $item,'or');
                 }
             }

         }
         if(!empty($map))
         {
             $map['_logic'] = 'or';
             $where['_complex'] = $map;
         }
         $Page = new Page($count,$return_number);
         $nowPage = isset($_REQUEST['page'])?$_REQUEST['page']:1;
         //SELECT distinct hh85_msg.*,(select count(*) from hh85_comment where hh85_msg.id = hh85_comment.mid) as count FROM `hh85_msg` left join hh85_comment on  hh85_msg.id = hh85_comment.mid
         $list = M('Doctor')
             ->page($nowPage.','.$Page->listRows)
             ->where($where)
//             ->order("createtime DESC")
             ->select();
//         $list[] = M('Doctor')->getLastSql();
         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }


     /*
      * 我的预约
      */
     public function myOrder(){
         $model = M('Order');
         $where['uid'] = I('uid');
         $list = $model->where($where)->order('createtime desc')->select();

         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }
     /*
      * 我的发贴
      */
     public function myMsg(){
         $model = M('Msg');
         $where['uid'] = I('uid');
         $list = $model->where($where)->order('createtime desc')->select();

         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }
     /*
      * 预约信息
      */
     public function orderDetail(){
         $model = M('Order');
         $where['id'] = I('id');
         $list = $model->where($where)->find();

         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }

     public function gethoslist(){
         $keyword = '';
         if(isset($_REQUEST['keyword']))
             $keyword = $_REQUEST['keyword'];

         import('ORG.Util.Page');
         $return_number = 10;
         $where = array();
         $may = array();
         $count=M('Hospital')->count();// 查询总数据记录
         if($keyword!=''){
             $list = explode(' ', $keyword); //空格可查询多个关键字
             foreach($list as $i => $item){
                 if($i == 0)
                     $where['grade'] = array('egt', $item);
                 else
                 {
                     $item = '%'. $item.'%';
                     $map['name'] = array('like', $item,'or');
                     $map['content'] = array('like', $item,'or');
                     $map['city'] = array('like', $item,'or');
                 }
             }

         }
         if(!empty($map))
         {
             $map['_logic'] = 'or';
             $where['_complex'] = $map;
         }
         $Page = new Page($count,$return_number);
         $nowPage = isset($_REQUEST['page'])?$_REQUEST['page']:1;
         //SELECT distinct hh85_msg.*,(select count(*) from hh85_comment where hh85_msg.id = hh85_comment.mid) as count FROM `hh85_msg` left join hh85_comment on  hh85_msg.id = hh85_comment.mid
         $list = M('Hospital')
             ->page($nowPage.','.$Page->listRows)
             ->where($where)
//             ->order("createtime DESC")
             ->select();
         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }

     public function gethouselist(){
         $keyword = '';
         if(isset($_REQUEST['keyword']))
             $keyword = $_REQUEST['keyword'];

         import('ORG.Util.Page');
         $return_number = 10;
         $where = array();
         $may = array();
         $count=M('House')->count();// 查询总数据记录
         if($keyword!=''){
             $list = explode(' ', $keyword); //空格可查询多个关键字
             foreach($list as $i => $item){
                 if($i == 0)
                     $where['grade'] = array('egt', $item);
                 else
                 {
                     $item = '%'. $item.'%';
                     $map['name'] = array('like', $item,'or');
                     $map['content'] = array('like', $item,'or');
                     $map['city'] = array('like', $item,'or');
                 }
             }

         }
         if(!empty($map))
         {
             $map['_logic'] = 'or';
             $where['_complex'] = $map;
         }
         $Page = new Page($count,$return_number);
         $nowPage = isset($_REQUEST['page'])?$_REQUEST['page']:1;
         //SELECT distinct hh85_msg.*,(select count(*) from hh85_comment where hh85_msg.id = hh85_comment.mid) as count FROM `hh85_msg` left join hh85_comment on  hh85_msg.id = hh85_comment.mid
         $list = M('House')
             ->page($nowPage.','.$Page->listRows)
             ->where($where)
//             ->order("createtime DESC")
             ->select();
         if($list){
             echo json_encode($list);
         }
         else
             echo 0;
     }
     //uid,did, email, phone, expection, flydate
     //预约
     public function bookDoctor(){
         $model = M("Order");

         if(I('uid',0)&&I('did',0)){
             $data=array();
             $data['uid']=I('uid');
             $data['fid']=I('did');
             $data['type']=1; //1：医生，2：医院 3：客栈
             $data['phone']=I('phone');
             $data['name']=I('name');
             $data['email']=I('email');
             $data['expection']=strtotime(I('expection'));
             $data['flydate'] = strtotime(I('flydate'));

             $data['createtime']=time();

             $data['status']= 0 ;   //
             if(I('id')!='')
                 $id = $model->where('id='. I('id'))->save($data);
             else
                 $id = $model->add($data);
             echo $id;

         }
     }

     //uid,did, email, phone, expection, flydate
     //预约
     public function bookHospital(){
         $model = M("Order");

         if(I('uid',0)&&I('hid',0)){
             $data=array();
             $data['uid']=I('uid');
             $data['fid']=I('hid');
             $data['type']=2; //1：医生，2：医院 3：客栈
             $data['phone']=I('phone');
             $data['name']=I('name');
             $data['email']=I('email');
             $data['expection']=strtotime(I('expection'));
             $data['flydate'] = strtotime(I('flydate'));

             $data['createtime']=time();

             $data['status']= 0 ;   //
             if(I('id')!='')
                 $id = $model->where('id='. I('id'))->save($data);
             else
                 $id = $model->add($data);
             echo $id;

         }
     }

     //uid,did, email, phone, expection, flydate
     //预约
     public function bookHouse(){
         $model = M("Order");

         if(I('uid',0)&&I('hid',0)){
             $data=array();
             $data['uid']=I('uid');
             $data['fid']=I('hid');
             $data['type']=3; //1：医生，2：医院 3：客栈
             $data['phone']=I('phone');
             $data['name']=I('name');
             $data['email']=I('email');
             $data['expection']=strtotime(I('expection'));
             $data['flydate'] = strtotime(I('flydate'));

             $data['createtime']=time();

             $data['status']= 0 ;   //
             if(I('id')!='')
                 $id = $model->where('id='. I('id'))->save($data);
             else
                 $id = $model->add($data);
             echo $id;

         }
     }

     /*
      * usersave    //保存用户信息
      * savedo(uid,password,avatar,name,phone,sheng,shi,yunqi,remark);
      */
     public function userinfosave(){
         if(I('uid',0)){
             $data=array();
             $data['uid'] = I('uid');
             if(I('password')!="")
                $data['password']=md5(I('password'));
             if(I('img')!="")
                 $data['img']=I('img');
             $data['nickname']=I('name');
             $data['sheng']=I('sheng');
             $data['phone']=I('phone');
             $data['yunqi'] = I('yunqi');

             $id = M('User')->save($data);
             if($id)
                 echo 1;
             else
                 echo 0;

         }

     }

     /*
      * 返回城市列表
      * @type string 类型 1：月子中心所在城市 2：医生所在城市
      */
     public function get_city_list($type){
         $model = $type=="1"?M('House'):M('Doctor');
         $list = $model->Distinct(true)->field('city')->select();
         if(!empty($list))
             echo json_encode($list);
         else
             echo "";
     }
     /*
      * 根据被回复的comment的cid，得到comment用户的id
      */
     public function get_to_id($cid){
         $model = M('Comment');
         $comment = $model->find($cid);
         return $comment->uid;
     }
 }
?>
