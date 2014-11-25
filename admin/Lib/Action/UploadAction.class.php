<?php 

   class UploadAction extends CommonAction{
   
        function index(){        	                      	               $this->display();
		}
      /**       * 上传文件 返回JSON       * Enter description here ...       */		      function upfile(){       	 	import('ORG.Net.UploadFile');       	 $path = date("Ym").'/';       	 $upload =new UploadFile();       	 $upload->maxSize =9998999;       	 $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');          $upload->savePath =  './data/photo/'.$path;// 设置附件上传目录         if(!file_exists("./data/photo/".$path)){    	     mkdir("./data/photo/".$path);          }           if(!$upload->upload()) {           	 echo($upload->getErrorMsg());           }else{           	   $info = $upload->getUploadFileInfo();            	             	    $filenames=C('SITE_URL').'/data/photo/'.$path.$info[0]['savename'];           	    echo($filenames);           }       	       }
	  function upload(){
		import('ORG.Net.UploadFile');
		$path=date("Ym").'/';
    $upload = new UploadFile();// 实例化上传类
    $upload->maxSize  = 3145728 ;// 设置附件上传大小
    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','rar','zip');// 设置附件上传类型
    $upload->savePath =  './data/photo/'.$path;// 设置附件上传目录    if(!file_exists("./data/photo/".$path)){    	mkdir("./data/photo/".$path);    }
    if(!$upload->upload()) {
	
	// 上传错误提示错误信息
        $this->error($upload->getErrorMsg());
    }else{
         $info = $upload->getUploadFileInfo(); //获取上传结果信息
		  $photopath= str_replace(".","",$info[0]['savepath']);
         $s=C('SITE_URL').$photopath.$info[0]['savename'];
          echo "<script>parent.notice('$s');</script>"; 
    }
		
	}
  }

?>