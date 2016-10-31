<?php
// 本类由系统自动生成，仅供测试用途
class TypeAction extends Action {
	public function type(){
		$this->display();
	}

    public function add(){
		$n = M("Type");
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
    	$n = M("Type");
    	$n->where("id=$id")->delete();
    	echo "success";
    }

    function getList(){

    	//Load('extend');
    	$n =M("Type");
    	import("ORG.Util.Page"); //导入分页类
    	$page=$_POST["page"];
    	$rows=$_POST["rows"];
    	$sort=$_POST["sort"];
    	$order=$_POST["order"];
    	//dump($order);
    	if($_POST["sgname"]!=null&&$_POST["sgname"]!=""){
    		$condition['title']=array('like','%'.$_POST["sgname"].'%');
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

    public function typeList(){
        $n =M("Type");
        $list = $n->select();
        echo json_encode($list);
    }
}
