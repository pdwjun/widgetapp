<?php 



    class ConfigAction extends CommonAction{
   
      function index(){
	  
	     $this->c = M('Webconfig')->where("id=1")->find();
	 
	    $this->display();
	  }
		 //更新配置


		 function update(){
            $data = $_POST;
            $data['createtime']=mktime();
           if(M('Webconfig')->where("id=1")->save($data)){
		     $this->success("更新配置成功");
		   }else{
		    $this->error("更新配置错误");
		   }
          
		 

		 }
		 
		 function admin(){
		 	
		 	 if(isset($_POST['submit'])){
		 	 	if($_POST['password']==$_POST['repass']){
		 	 		 $data= $_POST;
		 	 		 $data['password']=md5($_POST['password']);
		 	 	     M('Admin')->where("admin='administrator'")->save($data);
		 	 	   $this->success('修改管理员密码成功！');	
		 	 	}else{
		 	 		
		 	 		$this->error("两次输入密码不同！");
		 	 	}

		 	 }else{
		 	 	$this->li =M('Admin')->where("admin='administrator'")->find();
		 	 	
		 	 	$this->display();
		 	 }
		 	
		 }

	

	} 



?>