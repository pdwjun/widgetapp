<?php   class UserAction extends Action{         private  $table_name;         function __construct(){         	         	parent::__construct();         	$this->table_name='User';         }        function index(){                import('ORG.Util.Page');			    $count=M($this->table_name)->count();// 查询总数据记录			    $Page = new Page($count,C('PAGESIZE'));			    $show= $Page->show();	            $list = M($this->table_name)->order("uid DESC")->limit($Page->firstRow.','.$Page->listRows)->select();	            $this->assign("list",$list);				$this->assign("page",$show);                $this->display();	     }	     	     function add(){	     		        	  if(isset($_POST['submit'])){		   	  	    $data = $_POST;		           $data['status']= 1 ;		   	  	    if(!D($this->table_name)->create($data)){                        $data['password'] = md5($data['password']);                        $this->error(D($this->table_name)->getError());		   	  	    }else{                        M($this->table_name)->add($data);                        $this->success("操作成功！",U('index'));		   	  	    }		   	  	   }else{		   	  				   	  		  $this->display();		   	     	}	     }		 		 function edit(){		 	        $id= htmlspecialchars($_GET['uid']);	              if(is_numeric($id)){	              	  if(isset($_POST['submit'])){	              	  	  $data = $_POST;	              	  	  $data['logintime']=mktime();                          if(!D($this->table_name)->create($data)) {                              $this->error(D($this->table_name)->getError());                          }{                              M($this->table_name)->where("uid=".$id)->save($data);                              $this->success("更新成功！",U('index'));                          }	              	  }else{	              	  		              	  	$this->li =M($this->table_name)->where("uid=".$id)->find();	              	  	              	  	$this->display();	              	  }	              		              }		 }		     	 /**  	  * 删除  	  *   	  */  	 function del(){	        $qstr = $_GET['qstr'];  		  	$data=M($this->table_name);  		  			if(isset($qstr)){			   $arr=explode(",",$qstr);			   foreach($arr as $val){			     $data->where("id=$val")->delete();			       			   }			   $this->success("删除成功！",U('index'));						}else{			  if(isset($_GET['id'])){			  $data->where("id=".$_GET['id'])->delete();			   $this->success("删除成功！",U('index'));			  }else{			  			   $this->error("请选择要删除的ID");			  }			}  	 }  }?>