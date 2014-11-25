<?php

   class RbacAction extends CommonAction{
   	
   	   public  function index(){
   	   	
   	   	
   	   	
   	   }
   	   
 /////////////////////////////用户组（角色）管理///////////////////////////////////////////////  	   
   	   
   	   /**
   	    * 添加角色（用户组）
   	    * Enter description here ...
   	    */
   	   public function addRole(){
   	   	
   	   	  $this->display();
   	   	
   	   	
   	   }
       /**
        * 编辑用户组
        * Enter description here ...
        */
   	   public function editRole(){
   	   	
   	   	  $this->role = M('Role')->where("id=".I('id'))->find();
   	
   	   	  $this->display();
   	   }
   	   
   	   /**
   	    * 更新用户组
   	    */
   	   
   	   public  function updateRole(){
   	   	
   	      $reslut = M('Role')->save($_POST);
   	      if($reslut){
   	      	 $this->success("更新用户组成功",U('Rbac/role'));
   	      }else{
   	      	$this->error("更新用户组失败");
   	      }
   	   }
   	   /**
   	    * 删除用户组
   	    * Enter description here ...
   	    */
   	   public  function delRole(){
   	   	   if(isset($_GET['qstr'])){
   	   	   	 $arr =  explode(',', $_GET['qstr']);
   	   	   	 foreach ($arr as $v){
   	   	   	 	M('Role')->where("id=".$v)->delete();
   	   	   	 	
   	   	   	 }
   	   	   	 $this->success("删除用户组成功");
   	   	   	
   	   	   }else{
   	   	   	  if(isset($_GET['id'])){
   	   	   	  	
   	   	   	  	 $rs = M('Role')->where("id=".$_GET['id'])->delete();
 
   	   	   	  	 if($rs){
   	   	   	  	   $this->success("删除成功");	
   	   	   	  	 }else{
   	   	   	  	   $this->error("删除失败");
   	   	   	  	 }
   	   	   	  }else{
   	   	   	  	
   	   	   	  	$this->error("删除ID错误");
   	   	   	  }
   	   	   	
   	   	   }

   	   }
   	   
   	   /**
   	    * 处理用户组添加
   	    * Enter description here ...
   	    */
   	  public function addRoleHandel(){
   	  	
   	  	 $result = M("Role")->add($_POST);
   	  	 if($result){
   	  	 	$this->success("写入用户组成功",U('Rbac/role'));
   	  	 	
   	  	 }else{
   	  	 	$this->error("写入用户组失败");
   	  	 }
   	  }

   	  /**
   	 * 显示用户组
   	 */
   	  
   	  public  function role(){
   	  	 $this->role = M('Role')->select();
   	  	 $this->display();
   	  	
   	  }
   	  
   	  
  /////////////////////////////////////节点管理///////////////////////////// 	
  
   	  /**
   	   * 节点显示
   	   * Enter description here ...
   	   */
      public  function node(){
      	 $field = array('id','name','pid','remark','level','status');
      	$node = M('Node')->field($field)->order('sort')->select();
      	
      	$this->node = node_merge($node);
      	
      	$this->display();
      }  
      

   	  
   	  /**
   	   * 添加节点
   	   * Enter description here ...
   	   */
      
         	  
   	  public  function addNode(){
   	  	$this->pid = isset($_GET['pid'])?$_GET['pid']:0;
   	  	$this->level = isset($_GET['level'])?$_GET['level']:1;
   	  	
   	  	switch ($this->level){
   	  		case 1 :
   	  			$this->type="应用";
   	  			break;
   	  		case 2 :
   	  			$this->type="控制器";
   	  			break;
   	  		case 3 :
   	  			$this->type = "方法";
   	  			break;		
   	  			
   	  			
   	  	}
   	  	$this->display();
   	  }
   	  
   	  public  function addNodeHandel(){
   	  	if(M('Node')->add($_POST)){
   	  		$this->success("插入节点成功",U('Rbac/node'));
   	  	}else{
   	  		$this->error("插入节点错误");
   	  	}
   	  	
   	  }
   	  
   	  /**
   	   * 编辑节点
   	   */
   	  public  function editNode(){
   	  	
   	  	$node = M('Node')->where("id=".I('id'))->find();
   	  	switch ($node['level']){
   	  		case 1 :
   	  			$this->type="应用";
   	  			break;
   	  		case 2 :
   	  			$this->type="控制器";
   	  			break;
   	  		case 3 :
   	  			$this->type = "方法";
   	  			break;	   	  		
   	  		
   	  	}
   	  	
   	  	$this->node=$node;
   	  	$this->display();
   	  }
   	  
   	  public  function editNodeHandel(){

   	  	if(M('Node')->save($_POST)){
   	  		$this->success("更新成功",U('Rbac/node'));
   	  	}else{
   	  		$this->error("更新失败");
   	  	}
   	  	
   	  }
   	  
   	
   	 /**
   	  * 删除节点
   	  */
   	  
   	  public function  delNode(){
   	  	
   	  	if(isset($_GET['id'])){
   	  		
   	  		M('Node')->where("id=".$_GET['id'])->delete();
   	  		$this->success("删除节点成功",U('Rbac/node'));
   	  	}else{
   	  		$this->error("获取节点ID失败");
   	  	}
   	  }
   	  
 //////////////////////////////权限配置//////////////////////////////////////////////// 

   	  public function access(){
   	  	
   	  	 $field = array('id','name','pid','remark','level');
      	$node = M('Node')->field($field)->order('sort')->select();
      	$rid = I('id',0,'intval');

      	
      	//读取原有的权限
      	$access  = M('Access')->where("role_id=".$rid)->getField('node_id',true);

      	$this->rid=$rid;
      	$this->node = node_merge($node,$access);

      	$this->display();
   	  	
   	  }
   	  
   	  public function setAccess(){
   	  	
   	    $db = M('Access');
   	  	$rid = I('rid',0,'intval');
   	  	$db->where("role_id=".$rid)->delete();
   	  	$data=array();
   	  	foreach ($_POST['access'] as $v){
   	  		$tmp = explode("_", $v);
   	  		$data[] = array(
   	  		   'role_id'=>$rid,
   	  		   'node_id'=>$tmp[0],
   	  		   'level'=>$tmp[1]
   	  		);
   	  		
   	  	}
   	
   	   if($db->addAll($data)){
   	   	 $this->success("配置权限成功",U('Rbac/role'));
   	   }else{
   	   	  $this->error("权限配置失败");
   	   }
   	   
   	  }
   	  
   	  
   //////////////////////用户管理////////////////////////////
      
   	  /**
   	   * 
   	   * 显示用户列表
   	   */
   	  public function user(){
   	  	
   	  	$this->user = D('Admin')->order('uid')->relation(true)->select();
   	  	//dump($user);exit();
   	  	$this->display();
   	  } 
     /**
      * 
      * 添加用户
      */
   	  public function addUser(){
   	  	$this->role = M('Role')->select();
   	  	//dump($this->role);
   	  	$this->display();
   	  }
   	  
   	  /**
   	   * 
   	   * 添加用户处理
   	   */
   	  public function addUserHandel(){
   	  	$data = array(
   	  	   'username'=>I('username'),
   	  	   'password'=>I('password',0,'md5'),
   	  	   'nickname'=>I('nickname'),
   	  	   'logintime'=>mktime(),
   	  	   'loginip'=>get_client_ip(),
   	  	   'status'=>I('status',0)
   	  	);
   	     if(!I('role_id',0)){
   	    	$this->error("请选择用户组");
   	     }
   	  	$uid = M('Admin')->add($data);
   	  	$role =array();
   	  	if($uid){
   	  	    foreach ($_POST['role_id'] as $v){
   	  	    	$role[]= array(
   	  	    	   'role_id'=>$v,
   	  	    	   'user_id'=>$uid
   	  	    	);
   	  	    }
   	  	    if(M('RoleUser')->addAll($role)){
   	  	    	 $this->success("创建用户成功",U('Rbac/user'));
   	  	    }else{
   	  	     	$this->error("创建用户失败");
   	  	    }
   	  	}else{
   	  		$this->error("创建用户失败,请查看是否已经有这个用户了");
   	  	}
   	  }
   	  
   	  /**
   	   * 
   	   * 编辑用户
   	   */
   	  public function editUser(){
   	  	$this->user = M('Admin')->where("uid=".I('uid',0,'intval'))->find();
   	  	$this->uid=I('uid',0,'intval');
   	  	$this->role = M('Role')->select();
   	  	$this->display();
   	  }
   	  
   	  /**
   	   * 编辑用户处理
   	   */
   	  public  function editUserHander(){
   	    if(!I('role_id',0)){
   	    	$this->error("请选择用户组");
   	     }
   	  	$uid = I('uid',0,'intval');
   	  	$data = array(
   	  	   'uid' =>$uid,
   	  	  'username'=>I('username'),
   	  	   'password'=>I('password',0,'md5'),
   	  	   'nickname'=>I('nickname'),
   	  	   'status'=>I('status',0),
   	  	   'logintime'=>mktime()
   	  	);
   	  	if(M('Admin')->where("uid=".$uid)->save($data)){
   	  		//清空原有角色
   	  		M('RoleUser')->where("user_id=".$uid)->delete();
   	  		//更新角色关联表
   	  		$role = array();
   	  	   	 foreach($_POST['role_id'] as $v){
   	  	    	$role[]= array(
   	  	    	   'role_id'=>$v,
   	  	    	   'user_id'=>$uid
   	  	    	);
   	  	    }
   	  	    if(M('RoleUser')->addAll($role)){
   	  	    	 $this->success("更新用户成功",U('Rbac/user'));
   	  	    }else{
   	  	       	$this->error("更新用户角色失败");	
   	  	    }
   	  		
   	  		
   	  	}else{
   	  		
   	  		$this->error("更新用户失败");
   	  	}
   	  }
   	  
   	  /**
   	   * 
   	   * 删除用户
   	   */
   	  public function delUser(){
   	  	
   	  	$qstr = I('qstr',0);
        
   	  	if($qstr){
   	  		$arr = explode(",", $qstr);
  
   	  		foreach ($arr as $v){
   	  			  M('User')->where("uid=".$v)->delete();
   	  			 M('RoleUser')->where("user_id=".$v)->delete();

   	  		}
   	  		   	  			 $this->success("删除用户成功",U('Rbac/user'));
   	  	}else{
   	  		if(I('uid',0)){
   	  			 M('User')->where("uid=".I('uid'))->delete();
   	  			 M('RoleUser')->where("user_id=".I('uid'))->delete();
   	  			  $this->success("删除用户成功",U('Rbac/user'));
   	  		}else {
   	  			$this->error("删除用户ID错误");
   	  		}
   	  	}
   	  	
   	  }
   	  
   }
?>