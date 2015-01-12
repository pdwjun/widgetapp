<?php
$thisconfig = array(
	//'配置项'=>'配置值'

	 'APP_PASS'=>'good', 
     'SESSION_TIME' => '3600',  //Session超时时间
	 'PAGESIZE' =>'20',
    'URL_MODEL'             => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
	
	////////////支付宝参数//////////
	

    //////////////////////RBAC配置////////////////////////       
    
               'USER_AUTH_ON'=>true, //开启认证
                'USER_AUTH_TYPE'=>1, //默认认证，使用SESSION标记
                'USER_AUTH_KEY'=>'uid', //设置认证SESSION标记的名称
    'WWW_URL'=>'test.pdwjun.com',   //此处需要修改为域名地址，否则暖客栈编辑的图片无法查看
 'ADMIN_AUTH_KEY'=>'administrator', //管理员用户标记
    'USER_AUTH_MODEL'=>'Admin',  //验证用户表模型 shop_user
 'AUTH_PWD_ENCODER'=>'md5',
    'USER_AUTH_GATEWAY'  =>  '/Admin.php?m=Public&a=login',//默认的认证网关
 'NOT_AUTH_MODULE'  =>  'Public,Api',    //默认不需要认证的模块'A,B,C'
 'REQUIRE_AUTH_MODULE' =>  '',     //默认需要认证的模块
 'NOT_AUTH_ACTION'  =>  'exits',    //默认不需要认证的动作
 'REQUIRE_AUTH_ACTION' =>  '',    //默认需要认证的动作
 'GUEST_AUTH_ON'   =>  false,   //是否开启游客授权访问
 'GUEST_AUTH_ID'   =>  0,     //游客标记
 
 'RBAC_ROLE_TABLE'  =>  'hh85_role',
 'RBAC_USER_TABLE'  =>  'hh85_role_user',
 'RBAC_ACCESS_TABLE'  =>  'hh85_access',
 'RBAC_NODE_TABLE'  =>  'hh85_node', 

);

$baseconfig =include './config.inc.php';

return array_merge($baseconfig,$thisconfig);

?>