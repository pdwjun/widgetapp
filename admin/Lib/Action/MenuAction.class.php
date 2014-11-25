<?php
class MenuAction extends CommonAction{
	
	 public function index(){
	 	 
	 	$this->list = M('Menu')->select();
	 	$this->display();
	 	
	 }
	 
	 public function add(){
	 	if($_POST['submit']){
	 		  M('Menu')->add($_POST);
	 		  $this->success("操作成功");
	 	}else{
	 		
	 		$this->display();
	 	}
	 	
	 }
	 
	 Public function edit(){
	 	$id = is_numeric($_GET['id'])?intval($_GET['id']):Exit();
	 	if(isset($_POST['submit'])){
	 		 M('Menu')->where("id=".$id)->save($_POST);
	 		 $this->success("操作成功！",U('index'));
	 	}else{
	 		$this->li =M('Menu')->where("id=".$id)->find();
	 		$this->display();
	 	}
	 	
	 }
	 
	 function del(){
	 	$id = is_numeric($_GET['id'])?intval($_GET['id']):Exit();
	 	M('Menu')->where("id=".$id)->delete();
	 	 $this->success("操作成功！",U('index'));
	 	
	 }
	
}
?>