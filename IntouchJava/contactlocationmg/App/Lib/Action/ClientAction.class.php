<?php

class ClientAction extends Action {
	function login(){
		$username = $_REQUEST['username'];
		$passwd = $_REQUEST['passwd'];
		$condition['username'] = $username;
		$condition['passwd'] = $passwd;
		$m = M("User");
		$obj = $m->where($condition)->find();
		if($obj){
            $rlt = $obj;
		}else{
            $rlt['info'] = "fail";
		}
        $this->renderJsonpObj($rlt);
	}

	function register(){
		$m = M("User");
        $_REQUEST['roletype'] = "2";
        if($m->create($_REQUEST)){
            $m->add();
            $this->render("success");
        }

	}

    function checkUser(){
        $username = $_REQUEST['username'];
        $model = M("User");
        $condition['username'] = $username;
        $user = $model->where($condition)->find();
        if($user){
            $this->render("fail");
        }else{
            $this->render("success");
        }
    }

    public function getUserById($id){
        $model = M("User");
        $obj = $model->find($id);
        return $obj;
    }

    public function saveUser($user){
        $model = M("User");
        $model->save($user);
    }

    public function updateUser(){
        $model = M("User");
        $model->save($_REQUEST);
        $this->render("success");
    }

    public function changePasswd(){
        $id = $_REQUEST['id'];
        $model = M("User");
        $user = $model->find($id);
        $user['passwd'] = $_REQUEST['passwd'];
        $model->save($user);
        $this->render("success");
    }

    public function resetPasswd(){
        $username = $_REQUEST['username'];
        $model = M("User");
        $condition['username'] = $username;
        $user = $model->where($condition)->find();
        if($user){
            $birth = $_REQUEST['birth'];
            if($user['birth'] == $birth){
                $user['passwd'] = $_REQUEST['passwd'];
                $model->save($user);
                $this->render("success");
            }else{
                $this->render("0");
            }
        }else{
            $this->render("-1");
        }
    }

    function userinfo(){
        $id = $_REQUEST['id'];
        $model = M("User");
        $obj = $model->find($id);
        if($obj){
            $this->renderJsonpObj($obj);
        }else {
            $this->render(null);
        }
    }
/**************************************************用户相关结束***************************************************/
    public function render($msg){
        $result['info'] = $msg;
        $result = json_encode($result);
        $callback = $_GET['callback'];
        echo $callback."($result)";
    }

    public function renderJsonpObj($obj){
        $result = json_encode($obj);
        $callback = $_GET['callback'];
        echo $callback."($result)";
    }

    public function  upload(){
        import("@.ORG.UploadFile");
        $config=array(
            //'allowExts'=>array('jpg','gif','png'),
            'savePath'=>'./public/upload/',
            'saveRule'=>'time',
            'maxSize'=>-1
        );
        $upload = new UploadFile($config);
        if (!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        } else {
            $uploadList = $upload->getUploadFileInfo();
            $_REQUEST['img'] = $uploadList[0]['savename'];
        }
        echo($uploadList[0]['savename']);
    }

    public function download(){
        $attach = $_REQUEST['attach'];
        $filepath = './Public/upload/'.$attach;
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=".$attach);
        readfile($filepath);

    }
/************************************************公共方法结束***************************************************************/


    public function listMyContact(){
        $model = M('User');
        //$uid = $_REQUEST['uid'];
        //$condition['uid'] = $uid;
        $obj = $model->select();
        $this->renderJsonpObj($obj);
    }


    public function saveContact(){
        $model = M('Contact');
        $action = $_REQUEST['action'];
        if(!$_REQUEST['img']){
            $_REQUEST['img']="photo.jpg";
        }
        if($model->create($_REQUEST)){
            if($action=="add"){
                $model->add();
            }else{
                $model->save();
            }
        }
        $this->render("success");

    }

    public function delContact(){
        $id = $_REQUEST['id'];
        $model = M('Contact');
        $model->delete($id);
        $this->render("success");
    }

    public function addReplay(){
        $_REQUEST['ndate'] = date('Y-m-d H:i:s');
        $model = M("Replay");
        $model->add($_REQUEST);
        $this->render("success");
    }

    public function listReplay(){
        $model = M('Replay');
        $pid = $_REQUEST['pid'];
        $condition['pid'] = $pid;
        $list = $model->where($condition)->select();
        $this->renderJsonpObj($list);
    }

    public function saveStatus(){
        $model = M('User');
        $user = $model->find($_REQUEST['id']);
        $user['status'] = $_REQUEST['status'];
        $model->create($user);
        $model->save();
        $this->renderJsonpObj($user);
    }

    public function saveQuickreplay(){
        $model = M('User');
        $user = $model->find($_REQUEST['id']);
        $user['quickreplay'] = $_REQUEST['quickreplay'];
        $model->create($user);
        $model->save();
        $this->renderJsonpObj($user);
    }

    public function updateLocation(){
        $model = M('User');
        $user = $model->find($_REQUEST['id']);
        $user['longitude'] = $_REQUEST['longitude'];
        $user['latitude'] = $_REQUEST['latitude'];
        $user['address'] = $_REQUEST['address'];
        $model->create($user);
        $model->save();
        $this->renderJsonpObj($user);
    }



    /************************************************常用功能结束***************************************************************/

}
