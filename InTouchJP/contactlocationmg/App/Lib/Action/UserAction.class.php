<?php
// 本类由系统自动生成，仅供测试用途
class UserAction extends Action {
	public function user(){
		$this->display();
	}

    public function add(){
		$n = M("User");
		$action = $_POST['action'];
		if($action == "add"){
			$n->create();
			$n->add();
		}else{
			$n->create();
			$n->save();
		}
		echo "success";
    }

    public function addTec(){
        $n = M("User");
        $_POST['roletype'] = 2;
        $username = $_POST['username'];
        $count = $this->check($username);
        if($count>0){
            echo "1";
        }else{
            if($n->create()){
                $n->add();
//                $tid = $_POST['tid'];
//                $t = M("Tech");
//                $tech = $t->find($tid);
//                $tech['uid'] = $uid;
//                if($t->create($tech)){
//                    $t->save();
//                    echo "success";
//                }
                echo "success";
            }else{
                echo "fail";
            }
        }

    }

    public function userAdd(){
    	$n = M("User");
    	if($n->create()){
    		$n->add();
    		session("username",$_POST['username']);
    		session("roletype",$_POST['roletype']);
    		session("billtype",$_POST['billtype']);
    		echo "success";
    	}
    }

    public function deleteItem(){
    	$id = $_POST['id'];
    	$n = M("User");
    	$n->where("id=$id")->delete();
    	echo "success";
    }

    public function setLevel(){
        $n = M("User");
        $id = $_POST['tid'];
        $level = $_POST['level'];
        $condition['tid'] = $id;
        $obj = $n->where($condition)->find();
        $obj['level'] = $level;
        if($n->create($obj)){
            $n->save();
            echo "success";
        }
    }

    public function getList(){

    	//Load('extend');
    	$n =M("User");
    	import("ORG.Util.Page"); //导入分页类
    	$page=$_POST["page"];
    	$rows=$_POST["rows"];
    	$sort=$_POST["sort"];
    	$order=$_POST["order"];
    	//dump($order);
    	if($_POST["susername"]!=null&&$_POST["susername"]!=""){
    		$condition['username']=array('like','%'.$_POST["susername"].'%');
    	}
        if($_POST["sroletype"]!=null&&$_POST["sroletype"]!=""){
            $condition['roletype']=array('like','%'.$_POST["sroletype"].'%');
        }
    	$count = $n->where($condition)->count(); //计算总数
    	//$p = new Page($count,$rows);order($sort+','+$order)->
    	$result = '{"total":0,"rows":[]}';
    	if($count > 0){
    		$list = $n->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
    		//dump($list);
    		$list=json_encode($list);
    		$result = '{"total":'.$count.',"rows":' . $list . '}';
    	}
    	echo ($result); //输出json数据
    }

    public function check($username){
    	$n = M("User");
    	$condition["username"] = $username;
    	$list = $n->where($condition)->select();
    	$count = count($list);
    	return $count;
    }
    public function checkback(){
        $tid = $_REQUEST['tid'];
        $n = M("User");
        $condition["tid"] = $tid;
        $list = $n->where($condition)->select();
        $count = count($list);
        echo $count;
    }

    public function checkAjax($username){
        $n = M("User");
        $condition["username"] = $username;
        $list = $n->where($condition)->select();
        $count = count($list);
        echo $count;
    }

    public function bill(){
    	$n = M("User");
    	$username = session("username");
    	$condition['username'] = $username;
    	$u = $n->where($condition)->find();
		if($u){
			$billtype = $u['billtype'];
			$hasbill = $u['hasbill'];
			if($hasbill){
				if($billtype == "1"){
					$this->display("cuslist");
				}else if($billtype == "2"){
					$this->display("prolist");
				}
			}else{
				if($billtype == "1"){
					$this->display("cusadd");
				}else if($billtype == "2"){
					$this->display("proadd");
				}
			}
		}
    }

    public function saveCharge(){
        $id = $_REQUEST['id'];
        $model = M("User");
        $user = $model->find($id);
        $money = $user['money'];
        $am = $_REQUEST['money'];
        $am = intval($am);
        $user['money'] = $money+$am;
        $model->save($user);
        echo "success";
    }
}

?>