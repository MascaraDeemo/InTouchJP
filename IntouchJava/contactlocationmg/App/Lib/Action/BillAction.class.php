<?php
// 本类由系统自动生成，仅供测试用途
class BillAction extends Action {
	public function bill(){
		$this->display();
	}

    public function add(){
		$n = M("Bill");
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

    public function deleteItem(){
    	$id = $_POST['id'];
    	$n = M("Bill");
    	$n->where("id=$id")->delete();
    	echo "success";
    }

    function getList(){

    	//Load('extend');
    	$n =M("Bill");
    	import("ORG.Util.Page"); //导入分页类
    	$page=$_POST["page"];
    	$rows=$_POST["rows"];
    	$sort=$_POST["sort"];
    	$order=$_POST["order"];
    	//dump($order);
    	if($_POST["sgname"]!=null&&$_POST["sgname"]!=""){
    		$condition['gnames']=array('like','%'.$_POST["sgname"].'%');
    	}
        if($_POST["sndate"]!=null&&$_POST["sndate"]!=""){
            $condition['ndate']=array('like','%'.$_POST["sndate"].'%');
        }
		$roletype = session("roletype");
		$sid="";
		if($roletype=="3"){
			$sid = session("sid");
		}
		if($sid!=null&&$sid!=""){
			$condition['sid']=$sid;
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

	public function pastItem(){
		$id = $_POST['id'];
		$n = M("Bill");
		$data = array('state'=>'1','statecn'=>'已兑换');
		$n->where("id=$id")->setField($data);
		echo "success";
	}

}
