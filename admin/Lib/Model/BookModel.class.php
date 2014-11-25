<?php 
        class BookModel extends Model{
		
		   protected $_validate=array(
		     array('title','require','标题不能为空'),
			 array('zuozhe','require','作者不能为空'),
			 array('cover','require','封面不能为空'),

		   
		   );
		   
		   protected $_auto=array(
		    array('hits','1'),
			array('createtime','time',3,'function'),

	
	
		   
		   );
		   

		}


?>