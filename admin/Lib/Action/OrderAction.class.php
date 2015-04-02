<?php

class OrderAction extends CommonAction
{
    private $table_name;

    function __construct()
    {

        $this->table_name = "Order";
        parent::__construct();
    }


    function  index()
    {

        import('ORG.Util.Page');

        $condition['type'] = $_REQUEST['type'];
        $count = M($this->table_name)->where($condition)->count();// 查询总数据记录

        $Page = new Page($count, C('PAGESIZE'));

        if(isset($_REQUEST['type'])&&$_REQUEST['type']!=''){
            $type = $_REQUEST['type'];
            //1：医生，2：医院 3：客栈
            if($type=='doctor'){
                $condition['type'] = 1;
            }
            if($type=='hospital'){
                $condition['type'] = 2;
            }
            if($type=='home'){
                $condition['type'] = 3;
            }
        }

        $show = $Page->show();

        $list = M($this->table_name)->order("createtime DESC")->where($condition)->limit($Page->firstRow . ',' . $Page->listRows)->select();


        $this->assign("list", $list);

        $this->assign("page", $show);

        $this->display();

    }

    function add()
    {

        if (isset($_POST['submit'])) {
            $data = $_POST;
            $data['createtime'] = mktime();
            $data['status'] = 1;
            $data['photo'] = trim($_POST['photo'], '|');
            if (M($this->table_name)->add($data)) {
                $this->success("操作成功！", U('index'));
            } else {

                $this->error("操作失败");
            }
        } else {

            $this->display();
        }

    }

    /**
     *
     * 编辑文章

     */

    function  edit()
    {
        $id = htmlspecialchars($_GET['id']);
        if (is_numeric($id)) {
            if (isset($_POST['submit'])) {
                $data = $_POST;
                $data['expection'] = strtotime($_POST['expection']);
                $data['flydate'] = strtotime($_POST['flydate']);
//	              	  	  $data['createtime']=mktime();
                M($this->table_name)->where("id=" . $id)->save($data);


                $param = array('type'=>$_REQUEST['type']);

                $this->success("更新成功！", U('index',$param));

            } else {

                $this->li = M($this->table_name)->where("id=" . $id)->find();
                $this->photo = explode('|', $this->li['photo']);
                $this->display();
            }

        }
    }


    /**
     * 删除
     *

     */

    function del()
    {

        $qstr = $_GET['qstr'];
        $data = M($this->table_name);
        if (isset($qstr) && $_GET['qstr'] != "") {
            $arr = explode(",", $qstr);

            foreach ($arr as $val) {

                $data->where("id=$val")->delete();

            }
            $param = array('type'=>$_REQUEST['type']);
            $this->success("删除成功！", U('index', $param));

        } else {

            if (isset($_GET['id']) && ($_GET['id'] != "")) {

                $data->where("id=" . $_GET['id'])->delete();

                $param = array('type'=>$_REQUEST['type']);
                $this->success("删除成功！", U('index', $param));

            } else {


                $this->error("请选择要删除的ID");

            }

        }

    }

}

?>