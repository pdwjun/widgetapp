<?php 

   class ChannelModel extends RelationModel{
       protected $_link=array(
	       'models'=>array(
		      'mapping_type'=>BELONGS_TO, 
		       'class_name'=>'Models',
			   'mapping_name'=>'getmodels',
			   'foreign_key'=>'modelsid', 
			
			   
		   ),
	   
	   );
	   
	   protected $_validate =array(
	   
	        array('channelname','require','频道名不能为空！'),
			array('htmlname','require','静态目录不能为空！'),
	   );
	   

   
   }


?>