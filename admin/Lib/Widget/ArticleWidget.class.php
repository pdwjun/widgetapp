<?php 

   class ArticleWidget extends Widget{
   
   
           function render($data){
		   
	
			  $arr= explode(",",$data['params']);
			  $aa=array();
			  foreach($arr as $v){
			       $temp=explode("=",$v); //array("id","1")
				   $aa[$temp[0]]=$temp[1];
				   
	               }
			   $channelid=$aa['channel'];
			   $da=M("Article");
			   $where="";
			 
			  if($aa['type']=="top"){
			   
				   $list=$da->where("channelid=$channelid")->order("hits desc")->select();
			   }else{
			   			 
				  $list=$da->where("channelid=$channelid")->order("creat_time desc")->select();

			  }

			   $data['list']=$list;
			   $str= $this->renderFile($aa['type'],$data);
					    return $str;
	
		   }
   }

?>