<?php 

    class ConfigModel extends Model{
	
	   protected $_validate =array(
	   
	      array('site_name','require','网站名不能为空'),
		  array('site_url','require','网站地址不能为空'),  
	   	  array('site_mail','require','网站邮箱不能为空'),


	   );
	   
	   protected $_auto=array(
	   
	     array('DEBUG','setdebug',3,'function'),
	   
	   );
	
	
	}

?>