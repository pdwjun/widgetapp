<?php
class InfoAction extends CommonAction{
	 private  $table_name;
   	 function __construct(){
   	 	
   	 	$this->table_name = "Info";
   	 	parent::__construct();
   	 }
	

  	function  index(){

					import('ORG.Util.Page');

					 $count=M('Info')->count();// 查询总数据记录

					 $Page = new Page($count,C('PAGESIZE'));

					 $show= $Page->show();

	                    $list = M($this->table_name)->order("createtime DESC")->limit($Page->firstRow.','.$Page->listRows)->select();

	                   
	                      $this->assign("list",$list);

						  $this->assign("page",$show);

                          $this->display();

       }

       function add(){
  	  	
   	  	if(isset($_POST['submit'])){
   	  	     $data = $_POST;
           $data['createtime']=mktime();
           $data['status']= 1 ;
   	  	    if(M($this->table_name)->add($data)){
   	  	    	$this->success("操作成功！",U('index'));
   	  	    }else{
   	  	    	
   	  	    	$this->error("操作失败");
   	  	    }
   	  	}else{
   	  		
   	  		$this->display();
   	  	}
       	
       }

  	   /**

  	    * 

  	    * 编辑文章

  	    */

    	function  edit(){
	              $id= htmlspecialchars($_GET['id']);
	              if(is_numeric($id)){
	              	  if(isset($_POST['submit'])){
	              	  	  $data = $_POST;
	              	  	  $data['createtime']=mktime();
	              	  	  M($this->table_name)->where("id=".$id)->save($data);
	              	  	  $this->success("更新成功！",U('index'));
	              	  }else{
	              	  	
	              	  	$this->li =M($this->table_name)->where("id=".$id)->find();
	              	  	$this->display();
	              	  }
	              	
	              }
  	 }


  	 /**

  	  * 删除

  	  * 

  	  */

  	 function del(){

	        $qstr = $_GET['qstr'];
  		  	$data=M("Info");  		  
			if(isset($qstr)){
			   $arr=explode(",",$qstr);

			   foreach($arr as $val){

			     $data->where("id=$val")->delete();
			       
			   }
			   $this->success("删除成功！",U('index'));			

			}else{

			  if(isset($_GET['id'])){

			  $data->where("id=".$_GET['id'])->delete();

			   $this->success("删除成功！",U('index'));

			  }else{

			  

			   $this->error("请选择要删除的ID");

			  }

			}

  	 }
  	 
  	 function shenhe(){
  	 	$id = is_numeric($_GET['id'])?$_GET['id']:exit();
  	 	M('Info')->where("id=".$id)->setField('status', 1);
  	 	$this->success("审核成功！");
  	 }
}
?>