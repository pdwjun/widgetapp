<?php

   class DatabaseAction extends Action{
   	
   	
       public  function back(){
       	
       	  import('@.Tool.Databak');
       	  
       	  $data= new DbManage(C('DB_HOST'), C('DB_USER'), C('DB_PWD'), C('DB_NAME'), C('DB_CHARSET'));
       	  $data->backup();
       	  $this->success("备份数据库成功！");
       }
       public  function restore(){
       	
       	
       	
       }
       public  function getdata(){
       	
       	$dir = opendir("./backup");
       	while(($filename = readdir($dir))!== false){
  
      	   if ($filename != "." && $filename != "..") {
               $files[] = $filename ;
             
               }
         	}
             closedir($dir);
           //dump($files); exit();
            $this->assign("list",$files);
            $this->display();
       }
         
 
   	
   }
?>