<?php 
    class PublicAction extends Action{
	
	        function verify(){
			
		import('ORG.Util.Image');
        Image::buildImageVerify();
			}
			
			public function login(){
				
				$this->display();
				
			}
			

	public function checkLogin() {
			  if(session('verify')!=md5($_POST['veriy'])) {
                     $this->error("验证码错误！",U('Public/login'));
                }
                if(I('username',0)&&I('password')){
                	 
                	//生成认证条件
                	$map=array();
                	$map['username']=I('username');
                	import('ORG.Util.RBAC');
                	$authinfo = RBAC::authenticate($map);
                	if(false === $authinfo){
                		
                		$this->error("用户账户不存在");
                		
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
                			$this->success("登录成功",U('Index/index'));
                			
                		}else{
                			$this->error("密码或则用户错误");
                		}
                	}
                  
                }else{
                	
                	$this->error("用户或则密码不能空",U('Public/login'));
                }


	    
    
           }
    
    
	
	}

?>