<?php 
    class LinkModel extends Model{
	  
	   protected $_validate =array(
	          array('title','require','网站名不能为空'),
			  array('weburl','require','网站地址不能为空'),
			  array('description','require','网站介绍不能为空'),
	   
	   );

	
	}


?>