<?php 

   class UploadAction extends CommonAction{
   
        function index(){
		}
      /**
	  function upload(){
		import('ORG.Net.UploadFile');
		$path=date("Ym").'/';
    $upload = new UploadFile();// 实例化上传类
    $upload->maxSize  = 3145728 ;// 设置附件上传大小
    $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','rar','zip');// 设置附件上传类型
    $upload->savePath =  './data/photo/'.$path;// 设置附件上传目录
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