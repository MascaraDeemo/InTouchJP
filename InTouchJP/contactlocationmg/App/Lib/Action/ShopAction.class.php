<?php

class ShopAction extends Action {
	public function shop(){
		$this->display();
	}

	function add(){
		$action = $_POST['action'];
		$this->upload();
		$n = M("Shop");
		if($action == "add"){
			$_POST['ownid'] = session("userid");
			if(!$n->create()){
				exit($n->getError());
			}
			$sid = $n->add();
			$user['passwd']="111111";
			$user['sid'] = $sid;
			$user['username'] = $_POST['sname'];
			$user['roletype'] = "3";
			$Umodel = M("User");
			$Umodel->add($user);
		}else{
			$n->create();
			$n->save();

		}
		echo "操作成功!";
	}

	
	public function  upload(){
        if($_FILES['img']['size'] != 0){
            import("@.ORG.UploadFile");
            $config=array(
                'allowExts'=>array('jpg','gif','png'),
                'savePath'=>'./public/upload/',
                'saveRule'=>'time',
            );
            $upload = new UploadFile($config);
            if (!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            } else {
                $uploadList = $upload->getUploadFileInfo();
                $_POST['img'] = $uploadList[0]['savename'];
            }
        }
	}

	function deleteItem(){
		$n = M("Shop");
		$ids = $_POST['id'];
		$n->where('id in ('.$ids.')')->delete();
	}


	function getList(){
		$n =M("Shop");
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"];
		$rows=$_POST["rows"];
		$sort=$_POST["sort"];
		$order=$_POST["order"];
		if($_POST["stitle"]!=null&&$_POST["stitle"]!=""){
			$condition['title']=array('like','%'.$_POST["stitle"].'%');
		}
		$count = $n->where($condition)->count(); //计算总数
		$result = '{"total":0,"rows":[]}';
		if($count>0){
			$list = $n->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
			$list=json_encode($list);
			$result = '{"total":'.$count.',"rows":' . $list . '}';
		}
		echo ($result);
	}

	public function shopList(){
		$n =M("Shop");
		$list = $n->select();
		echo json_encode($list);
	}

}

?>