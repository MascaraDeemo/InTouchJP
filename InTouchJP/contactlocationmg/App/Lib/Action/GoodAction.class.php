<?php

class GoodAction extends Action {
	public function good(){
		$this->display();
	}

    public function goodshop(){
        $this->display();
    }

	function add(){
		$action = $_POST['action'];
		$this->upload();
		$n = M("Good");
		if($action == "add"){
			$_POST['count']="0";
            $_POST['xiaoliang']="0";
			if(!$n->create()){
				exit($n->getError());
			}
			$n->add();
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
		$n = M("Good");
		$ids = $_POST['id'];
		$n->where('id in ('.$ids.')')->delete();
	}


	function getList(){
		$n =M("Good");
		import("ORG.Util.Page"); //导入分页类
		$page=$_POST["page"];
		$rows=$_POST["rows"];
		$sort=$_POST["sort"];
		$order=$_POST["order"];
		if($_POST["sgname"]!=null&&$_POST["sgname"]!=""){
			$condition['gname']=array('like','%'.$_POST["sgname"].'%');
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
		$result = '{"total":0,"rows":[]}';
		if($count>0){
			$list = $n->where($condition)->page($page,$rows)->order(array($sort=>$order))->select();
			$list=json_encode($list);
			$result = '{"total":'.$count.',"rows":' . $list . '}';
		}
		echo ($result);
	}

}

?>