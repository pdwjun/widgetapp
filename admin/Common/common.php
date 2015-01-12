<?php
   function node_merge($node,$access = null,$pid = 0){
   	
   	$arr = array();
   	foreach ($node as $v){
   		
   		//判断是否已经配置权限
   		if(is_array($access)){
   			//判断当前节点是否在用户权限表中 如果是设置access为1
   	       if(in_array($v['id'], $access)){
   	       	  $v['access']= 1;
   	       }else{
   	       	  $v['access']= 0;
   	       }
   		}
   		if($v['pid']==$pid){
   			
   			$v['child']= node_merge($node,$access,$v['id']);
   			$arr[]=$v;
   		}
   		
   	}
   	return $arr;
   	
   	
   }
  function cate_tree_list($str,$cid){
   	static  $arr=array();
   	 foreach ($str as $v){
   	 	if($v['cid']==$cid){
           $level =count(explode("-", $v['level']));
           
   	 		if($v['cid']==0){
   	 		  $v['level'] = "";
   	 		}else{
   	 	      $v['level'] =str_repeat("&nbsp;", ($level*2));
   	 		}
   	 		$arr[]=$v;
   	 		cate_tree_list($str, $v['id']);
   	 	}
   	 }
   	 return  $arr;
   }
    
   /**
    * 
    * Enter description here ...
    * @param $str 分类数组
    * @param $cid 父ID
    * @param $id 当前分类ID
    */
   function cate_tree($str,$cid,$id){
   	 static  $arr;
   	 foreach ($str as $v){
   	 	if($v['cid']==$cid){
   	 		$name="";
   	 		if($v['cid']!=0){
   	 		  $name = "&nbsp;&nbsp;".$v['name'];
   	 		}else{
   	 			$name = $v['name'];
   	 		}
   	 		if($v['id']==$id){
   	 			   	 		$arr=$arr."<option value=".$v['id']." selected>".$name."</option>";
   	 		}else{
   	 			   	 		$arr=$arr."<option value=".$v['id'].">".$name."</option>";
   	 		}

   	 		cate_tree($str, $v['id'],$id);
   	 	}
   	 }
   	 return  $arr;
   }
   
   function get_number($number){
   	
     switch ($number){
     	case 1:
     		$num="";
     		break;
     	case 2:
     		$num=str_repeat("&nbsp;", $number*2)."+";
     		break;	
     		
     	case 3:
     	  $num=str_repeat("&nbsp;", $number*3)."+";
     	break;	
     	
     }
   	return  $num;
   }
   
   //////////////////////////////////////////////////////
//Orderlist数据表，用于保存用户的购买订单记录；
/* Orderlist数据表结构；
CREATE TABLE `tb_orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,购买者userid
  `username` varchar(255) DEFAULT NULL,购买者姓名
  `ordid` varchar(255) DEFAULT NULL,订单号
  `ordtime` int(11) DEFAULT NULL,订单时间
  `productid` int(11) DEFAULT NULL,产品ID
  `ordtitle` varchar(255) DEFAULT NULL,订单标题
  `ordbuynum` int(11) DEFAULT '0',购买数量
  `ordprice` float(10,2) DEFAULT '0.00',产品单价
  `ordfee` float(10,2) DEFAULT '0.00',订单总金额
  `ordstatus` int(11) DEFAULT '0',订单状态
  `payment_type` varchar(255) DEFAULT NULL,支付类型
  `payment_trade_no` varchar(255) DEFAULT NULL,支付接口交易号
  `payment_trade_status` varchar(255) DEFAULT NULL,支付接口返回的交易状态
  `payment_notify_id` varchar(255) DEFAULT NULL,
  `payment_notify_time` varchar(255) DEFAULT NULL,
  `payment_buyer_email` varchar(255) DEFAULT NULL,
  `ordcode` varchar(255) DEFAULT NULL,
  `isused` int(11) DEFAULT '0',
  `usetime` int(11) DEFAULT NULL,
  `checkuser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

*/
//在线交易订单支付处理函数
//函数功能：根据支付接口传回的数据判断该订单是否已经支付成功；
//返回值：如果订单已经成功支付，返回true，否则返回false；
function checkorderstatus($ordid){
    $Ord=M('Orderlist');
    $ordstatus=$Ord->where('ordid='.$ordid)->getField('ordstatus');
    if($ordstatus==1){
        return true;
    }else{
        return false;    
    }
}

//处理订单函数
//更新订单状态，写入订单支付后返回的数据
function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['payment_trade_no']      =$parameter['trade_no'];
    $data['payment_trade_status']  =$parameter['trade_status'];
    $data['payment_notify_id']     =$parameter['notify_id'];
    $data['payment_notify_time']   =$parameter['notify_time'];
    $data['payment_buyer_email']   =$parameter['buyer_email'];
    $data['ordstatus']             =1;
    $Ord=M('Orderlist');
    $Ord->where('ordid='.$ordid)->save($data);
} 


//获取一个随机且唯一的订单号；
function getordcode(){
    $Ord=M('Orderlist');
    $numbers = range (10,99);
    shuffle ($numbers); 
    $code=array_slice($numbers,0,4); 
    $ordcode=$code[0].$code[1].$code[2].$code[3];
    $oldcode=$Ord->where("ordcode='".$ordcode."'")->getField('ordcode');
    if($oldcode){
        getordcode();
    }else{
        return $ordcode;
    }
}
//获取TEMPCLASSID
function get_temp_cid($cid,$tbs="NewsCategory"){
	static  $arr;
	if($cid != 0){
	  $list = M($tbs)->where("id=".$cid)->find();	
	  $arr = $arr."|".$list['id']."|";
	  get_temp_cid($list['cid']);
	}
	return  $arr;
}
//数组排序
function array_sort($arr,$keys,$type='asc'){ 
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
} 

function getkeshi($id){
	
	$name  = M('Keshi')->where("id=".$id)->getField('name');
	return $name;
}

/*日志操作记录*
 * 
 */
function journal($name,$msg,$times){
	$data['name']=$name; //操作人
	$data['msg']=$msg;
	$data['createtime']=$times;
	if(M('Journal')->add($data)){
		return true;
	}

	
}

function getUname($uid){

    $username = M('User')->where("uid=".$uid)->getField('username');
    return $username;
}
function getDname($id){

	$username = M('Doctor')->where("id=".$id)->getField('name');
	return $username;
}
function getHname($id){

	$username = M('Hospital')->where("id=".$id)->getField('name');
	return $username;
}
function getRname($id){

	$username = M('House')->where("id=".$id)->getField('name');
	return $username;
}
function getMsgTitle($id){

    $field = M('Msg')->where("id=".$id)->getField('title');
    return $field;
}
//根据mid得到圈子的名称
function getMsgCate($id){
    $field = M('Msg')->where("id=".$id)->getField('cid');
    $field = M('Msg_cate')->where("id=".$field)->getField('name');
    return $field;
}
  function cutStr($str,$lend){
     $str = strip_tags($str);
	if(mb_strlen($str,"utf-8")>$lend){
		$str = mb_substr($str, 0,$lend,"utf-8")."...";
	}
	return $str;
}

?>