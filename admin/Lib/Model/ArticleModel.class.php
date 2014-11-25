<?php
   class ArticleModel extends RelationModel{
   	
   	  protected  $_validate= array(
   	     
   	     array('title','require','标题不能为空'),
   	     array('content','require','内容不能为空'),
   	  
   	  
   	  );
   	  protected  $_auto=array(
   	  
   	      array('createtime','time','3','function'),
   	      array('hits','1'),
		  array('status','1'),
		  array('uid','1'),
   	  );
   		  protected $_link = array(
	  
	       'Admin'=>array(
		      'mapping_type'=>BELONGS_TO,
			  'mapping_name'=>'admins',
			  'class_name'=>'Admin',
			  'foreign_key'=>'uid',
		       'as_fields'=>'nickname', 
		   ),

	  
	  );
   }

?>