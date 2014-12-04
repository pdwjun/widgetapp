<?php 
 class IndexAction extends CommonAction{
  
    function index(){
	         
             $this->display();
	
	}
	
	//顶部页面
	function top(){
	     

		     $this->assign("site_url",$_SERVER['HTTP_HOST']);
		    $this->assign("username",$_SESSION['username']);
	        $this->display();

	}
    
	//注销登录
	function exits(){
	  
			   session_unset();
			   session_destroy();
			   $this->error("注销成功请重新登录！",U('Public/login'));  
	
	}
	
	//Rbac权限配置菜单
	
	function menu_rbac(){
		
		$this->display();
	}

    //后台首页
	
	function main(){
		

	   $this->assign("quanxian",$quanxian[0]['groups']);
	   $this->assign("Version","蜂鸟网站管理系统后台 v1.0");
	   $this->display();
	 
	}
	
	//内容菜单
	function menu_article(){

          $this->display();

	
	}

    function test(){
        $this->display();

    }
 }

?>