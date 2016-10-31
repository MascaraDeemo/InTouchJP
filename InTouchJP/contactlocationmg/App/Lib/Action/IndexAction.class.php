<?php

class IndexAction extends Action {
    public function index(){
		if(session('username')){
            $this->display('index');

		}else{
			$this->display('login');
		}
    }

    public function youke(){
		$this->display("index2");
    }

    public function register(){
    	$this->display("register");
    }

    public function logout(){
		session("username",null);
		session("roletype",null);
		$this->display("login");
    }

	public function login(){
		$u = M("User");
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];
		$condition['username']=$username;
		$condition['passwd']=$passwd;
		$user = $u->where($condition)->find();
		if($user){
			session("username",$user['username']);
			session("roletype",$user['roletype']);
			session("userid",$user['id']);
			session("sid",$user['sid']);
		}
		echo json_encode($user);
	}

    public function shengCombobox(){
    	$n = M("Provinces");
    	$list = $n->field("id,name")->select();
    	$list[0]['selected'] = "true";
    	echo json_encode($list);
    }

    public function schoolCombobox($id){
    	$n = M("Univs");
    	$list = $n->where("pid=$id")->field("id,name")->select();
    	$list[0]['selected'] = "true";
    	echo json_encode($list);
    }

   	public function changeThem($name){
   		cookie('easyuiThemeName',$name);
   		$this->index();
   	}

   	public function changeModel($name){
   		cookie('displayModel',$name);
   		$this->index();
   	}

	public function getApp() {
		$app = 'http://'.$this->_server('HTTP_HOST').__APP__;
		$n = M("User");
		$roletype = session('roletype');
		if($roletype == "1"){
				echo '[{
			"id" : "1",
			"text" : "订做管理",
			"href" : "'.$app.'/Customize/customize",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/customize.png",
			"cnf":{

			}
			}, {
			"id" : "2",
			"text" : "成品管理",
			"href" : "'.$app.'/Product/product",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/product.png"
			}, {
			"id" : "3",
			"text" : "用户管理",
			"href" : "'.$app.'/User/user",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/aftersall.png"
			}
					, {
			"id" : "4",
			"text" : "技术管理",
			"href" : "'.$app.'/Tech/tech",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/tec.png"
			}, {
			"id" : "5",
			"text" : "交易账户管理",
			"href" : "'.$app.'/Account/account",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/account.png"
			}
					, {
			"id" : "6",
			"text" : "账簿管理",
			"href" : "'.$app.'/Note/note",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/goods.png"
			}, {
			"id" : "7",
			"text" : "专业管理",
			"href" : "'.$app.'/Major/major",
			"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/user.png"
			}
			]';
		}else if($roletype == "3"){
			echo '[{
					"id" : "1",
					"text" : "我的订单",
					"href" : "'.$app.'/User/bill",
					"icon" : "'.__ROOT__.'/Public/easyui/themes/windows/icons/customize.png",

					"cnf":{

						}
					}
					]';
		}
	}

	public function getStart(){
		$app = 'http://'.$this->_server('HTTP_HOST').__APP__;
		echo '[{
    "id":"startMenu1",
    "text":"主题皮肤",
    "href":"",
    "children":[{
	    "id":"startMenu11",
	    "text":"经典",
	    "href":"'.$app.'/Index/changeThem/name/default",
		"gout" : true,
	    "iconCls":""
    },{
        "id":"startMenu12",
        "text":"阳光",
        "href":"'.$app.'/Index/changeThem/name/sunny",
		"gout" : true,
        "iconCls":""
    },{
        "id":"startMenu13",
        "text":"花布",
        "href":"'.$app.'/Index/changeThem/name/pepper-grinder",
		"gout" : true,
        "iconCls":""
    },{
        "id":"startMenu14",
        "text":"metro",
        "href":"'.$app.'/Index/changeThem/name/metro",
		"gout" : true,
        "iconCls":""
    },{
        "id":"startMenu15",
        "text":"清新蓝",
        "href":"'.$app.'/Index/changeThem/name/cupertino",
		"gout" : true,
        "iconCls":""
    },{
        "id":"startMenu15",
        "text":"灰色",
        "href":"'.$app.'/Index/changeThem/name/gray",
		"gout" : true,
        "iconCls":""
    }],
	"iconCls":""
},{
    "id":"startMenu4",
    "text":"显示模式",
    "href":"",
    "children":[{
	    "id":"startMenu41",
	    "text":"经典",
	    "href":"'.$app.'/Index/changeModel/name/index2",
	    "gout" : true,
	    "iconCls":""
    },{
        "id":"startMenu42",
        "text":"桌面",
        "href":"'.$app.'/Index/changeModel/name/index2",
       	"gout" : true,
        "iconCls":""
    }],
	"iconCls":""
},{
    "id":"startMenu2",
    "text":"退出",
    "href":"'.$app.'/Index/logout",
    "gout" : true,
	"iconCls":""
}]';
	}

}

?>