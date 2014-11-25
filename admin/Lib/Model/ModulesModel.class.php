<?php 

     class ModulesModel extends Model{
	 
	      protected $_validate = array(
		  
		      array('title','require','模块名不能为空'),
			  array('orders','number','排序必须为数字'),
			  array('content','require','介绍不能为空'),

		  
		  );
		  
		  protected $_auto = array(
		     array('diaoyong','diaoyong',3,'function'),
			 array('params','getParams',3,'function'),
		  );
		  }

?>