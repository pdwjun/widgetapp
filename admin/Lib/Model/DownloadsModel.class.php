<?php 
  class DownloadsModel extends RelationModel{
  
     protected $_link=array(
	 
	    'Server'=>array(
		  'mapping_type'=>BELONGS_TO,
		  'mapping_name'=>'servers',
		  'class_name'=>'Server',
		  'foreign_key'=>'serverid',
		  
		),
	 
	 );
	 
	 protected $_auto=array(
	    array('softid','getSoftId',3,'callback'), 
	   
	 );
	 protected $validate=array(
	    array('title','require','下载名不能为空'),
	    array('filesize','require','文件大小不能为空'),
		array('address','require','下载地址不能为空'),
	 
	 );
	 
	 function getSoftId(){
	     $id=$_GET['softid'];

		 if(isset($id)){
		    return $id;
		 }else{
		 return 0;
		 }
	 
	 }
  
  }


?>