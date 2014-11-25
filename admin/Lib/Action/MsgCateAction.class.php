<?php
 class MsgCateAction extends CommonAction{
 	private $table_name;
 	 function __construct(){
 	 	$this->table_name='MsgCate';
 	 	parent::__construct();
 	 }
 	 public function index(){
	 	 
	 	$this->list = M($this->table_name)->select();
	 	$this->display("Category:index");
	 	
	 }
	 
	 public function add(){
	 	if($_POST['submit']){
	 		  M($this->table_name)->add($_POST);
	 		  $this->success("操作成功");
	 	}else{
	 		
	 		$this->display("Category:add");
	 	}
	 	
	 }
	 
	 Public function edit(){
	 	$id = is_numeric($_GET['id'])?intval($_GET['id']):Exit();
	 	if(isset($_POST['submit'])){
	 		 M($this->table_name)->where("id=".$id)->save($_POST);
	 		 $this->success("操作成功！",U('index'));
	 	}else{
	 		$this->li =M($this->table_name)->where("id=".$id)->find();
	 		$this->display("Category:edit");
	 	}
	 	
	 }
	 
	 function del(){
	 	$id = is_numeric($_GET['id'])?intval($_GET['id']):Exit();
	 	M($this->table_name)->where("id=".$id)->delete();
	 	 $this->success("操作成功！",U('index'));
	 	
	 }
 }
?>