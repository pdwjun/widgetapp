<?php 
        class SoftModel extends RelationModel{
		
		   protected $_validate=array(
		     array('oldpass','require','、旧密码不能为空'),
			 array('newpass','require','新密码不能为空'),
			 array('rppass','password','两次输入密码不同',0,'confirm'),
             // array('username','require','用户名不能为空'), 
		   
		   );
		   
	
		   
		   protected $_link=array(
		   
		      'category'=>array(
			     'mapping_type'=>BELONGS_TO,
				 'class_name'=>'category',
				 'mapping_name'=>'cates',
				 'foreign_key'=>'catid',
			  
			  ),
			  
			  'user'=>array(
			     
			  	 'mapping_type'=>BELONGS_TO,
				 'class_name'=>'user',
				 'mapping_name'=>'users',
				 'foreign_key'=>'publisher',
			  ),
		   
		   );
		}


?>