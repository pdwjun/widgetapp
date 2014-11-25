<?php 

    class LinkAction extends CommonAction{
	
	   function index(){
            import('ORG.Util.Page');// 导入分页类			$count      = M('Link')->where('status=1')->count();// 查询满足要求的总记录数			$Page       = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数			$this->page       = $Page->show();// 分页显示输出			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性			$this->list = M('Link')->where('status=1')->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();			$this->display();
	   }	       	   function add(){             if(isset($_POST['submit'])){             	  if(M('Link')->add($_POST)){             	  	$this->success("添加友情链接成功！",U('index'));          	  	             	  }             }else{             	             	$this->display();             }	      	   }	            	 /**  	  * 删除文章  	  *   	  */  	 function del(){	                $qstr = $_GET['qstr'];  		  		  		  			if(isset($qstr)){			   $arr=explode(",",$qstr);			   $data=M("Link");			   foreach($arr as $val){			     $data->where("id=$val")->delete();			       			   }			   $this->success("删除成功！",U('index'));						}else{						  $data->where("id=".$_GET['id'])->delete();			    $this->success("删除成功！",U('index'));			}  	 }	   	   	   //更新	   function edit(){		  $id=$_GET['id'];		  if(isset($id)){		      if(isset($_POST['submit'])){		      	   M('Link')->where("id=".$id)->save($_POST);		      	   $this->success("更新成功！",U('index'));		      }else{		      	$this->li =M('Link')->where("id=".$id)->find();		      	$this->display();		      }               		  		  }else{		    $this->error("ID不存在！",U('index'));   		  		  }		  	   }
	
	}


?>