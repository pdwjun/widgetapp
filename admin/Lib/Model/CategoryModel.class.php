<?php 
        class CategoryModel extends Model{
		

		
		 protected $_validate=array(
		    
			array('name','require','分类名不能为空！'),
			array('htmlname','require','静态目录不能为空！'),
		
		 
		 );
		 
		 protected $_auto=array(
		 

		   array('pid','getPid',3,'function'),

			array('cid','getCid',3,'function'),
			array('htmlname','getPath',3,'function'),
		 
		 );
		 

		
		}


?>