<?php     class CommentAction extends Action{      	function  index(){						import('ORG.Util.Page');					 $count=M('Comment')->count();// 查询总数据记录					 $Page = new Page($count,C('PAGESIZE'));					 $show= $Page->show();	                    $temp = M('Comment')->order("createtime DESC")->limit($Page->firstRow.','.$Page->listRows)->select();	                    $list = array();                        foreach ($temp as $v){                        	 if($v['uid']==0){                        	 	$v['username'] ="游客";                        	 }else{                        	 	$v['username'] =M("User")->where("uid=".$v['uid'])->getField("username");                        	 }                        	                        	$v['company_title'] =M("Company")->where("id=".$v['company_id'])->getField('title');                        	$list[] =$v;                        }                        	                       $this->assign("list",$list);						  $this->assign("page",$show);                          $this->display();       }                     function add(){   	  	   	  	if(isset($_POST['submit'])){   	  	       $data = $_POST;           $data['createtime']=mktime();           $data['status']= 1 ;   	  	    if(M('Comment')->add($data)){   	  	    	$this->success("添加评论成功！",U('index'));   	  	    }else{   	  	    	   	  	    	$this->error("添加评论失败");   	  	    }   	  	}else{   	  		   	  		$this->display();   	  	}       	       }  	  	   /**  	    *   	    * 编辑文章  	    */    	function  edit(){	              $id= htmlspecialchars($_GET['id']);	              if(is_numeric($id)){	              	  if(isset($_POST['submit'])){	              	  	  $data = $_POST;	              	  	  M('Comment')->where("id=".$id)->save($data);	              	  	  $this->success("更新成功！",U('index'));	              	  }else{	              	  		              	  	$this->li =M('Comment')->where("id=".$id)->find();	              	  	$this->display();	              	  }	              		              }    		  		  	 }  	   	 /**  	  * 删除文章  	  *   	  */  	 function del(){	                $qstr = $_GET['qstr'];  		  					   $data=M("Article");  		  			if(isset($qstr)){			   $arr=explode(",",$qstr);			   foreach($arr as $val){			     $data->where("id=$val")->delete();			       			   }			   $this->success("删除成功！",__URL__."/index");						}else{						  if(isset($_GET['id'])){			  $data->where("id=".$_GET['id'])->delete();			   $this->success("删除成功！",__URL__."/index");			  }else{			  			   $this->error("请选择要删除的ID");			  }			}	                      	 }    	function shenhe(){		M('Comment')->where("id=".$_GET['id'])->setField('status','1');		$this->success("审核成功！");			}	}?>