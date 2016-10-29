<?php
// 微店
class WeshopAction extends Action {
	public function weshop($openid){
		session("openid",$openid);
		$this->display("weshop");
	}

	public function wechat() {
//        $echoStr= $_GET["echostr"];
//        echo $echoStr;
//        exit();
		$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
		$picTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<ArticleCount>1</ArticleCount>
							<Articles>
							<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>
							</Articles>
							<FuncFlag>1</FuncFlag>
							</xml> ";


		$postStr = $GLOBALS ["HTTP_RAW_POST_DATA"];
		$postObj = simplexml_load_string ( $postStr, 'SimpleXMLElement', LIBXML_NOCDATA );
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$msgType = $postObj->MsgType;
		$time = time ();
		if($msgType == "event"){
			$event = $postObj->Event;
			if($event == "CLICK"){
				$key = $postObj->EventKey;
				if($key == "tscx"){
					$sendType = "news";
					$title = "进入微信购物商城";
					$image = "http://ideaweshop-public.stor.sinaapp.com/upload/logo.jpg";
					$turl = "http://ideaweshop.sinaapp.com/clientuser/index.html?openid=".$fromUsername;
					$resultStr = sprintf ( $picTpl, $fromUsername, $toUsername, $time, $sendType, $title, "微信商店欢迎你!!", $image, $turl );
					echo $resultStr;
				}
				else if($key == "vk_lx"){
					$sendType = "news";
					$title = "我们的联系方式";
					$image = "http://ideaweshop-public.stor.sinaapp.com/upload/lianxi.png";
					$turl = "";
					$resultStr = sprintf ( $picTpl, $fromUsername, $toUsername, $time, $sendType, $title, "电话:1512312312\n邮箱:ideabobo@126.com", $image, $turl );
					echo $resultStr;
				}

			}else if($event == "subscribe"){
                $sendType = "news";
                $title = "进入微信购物系统";
                $image = "http://ideaweshop-public.stor.sinaapp.com/upload/logo.jpg";
                $turl = "http://ideaweshop.sinaapp.com/clientuser/index.html?openid=".$fromUsername;
                $resultStr = sprintf ( $picTpl, $fromUsername, $toUsername, $time, $sendType, $title, "直接发送商品名称可以搜索商品!", $image, $turl );
                echo $resultStr;
            }
		}else if($msgType == "text"){
			$keyword = $postObj->Content;
            $model = M("Good");
            $condition['gname']=array('like','%'.$keyword.'%');
            $good = $model->where($condition)->find();
            if($good){
                $sendType = "news";
                $title = $good['gname']."  ￥：".$good['price'];
                $image = sae_storage_root('Public').'/upload/'.$good['img'];
                $turl = "http://ideaweshop.sinaapp.com/clientuser/index.html?openid=".$fromUsername;
                $resultStr = sprintf ( $picTpl, $fromUsername, $toUsername, $time, $sendType, $title, $good['note'], $image, $turl );
                echo $resultStr;
            }else{
                $sendType = "news";
                $title = "没有找到您输入的商品,点击查看更多!";
                $image = "http://ideaweshop-public.stor.sinaapp.com/upload/logo.jpg";
                $turl = "http://ideaweshop.sinaapp.com/clientuser/index.html?openid=".$fromUsername;
                $resultStr = sprintf ( $picTpl, $fromUsername, $toUsername, $time, $sendType, $title, "微信商店欢迎你!!", $image, $turl );
                echo $resultStr;
            }

		}

// 		$ma = M("Man");
// 		$man = $ma->find($fromUsername);
// 		if($man){

// 		}else{
// 			$acct = M("Account");
// 			$account = $acct->find('gh_b551f6b809c3');
// 			$accessToken = $account['accesstoken'];
// 			$getUserInfoUrl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accessToken.'&openid='.$fromUsername.'&lang=zh_CN';
// 			$uinfo = file_get_contents($getUserInfoUrl);
// 			$userInfo = json_decode($uinfo,true);
// 			if($userInfo['errmsg'] == 'invalid credential'){
// 				$accessUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$account['appid'].'&secret='.$account['secret'];
// 				$accessinfo = file_get_contents($accessUrl);
// 				$accessinfo = json_decode($accessinfo,true);
// 				//if($accessinfo['access_token']){
// 					$accessToken = $accessinfo['access_token'];
// 					$account['accesstoken'] = $accessToken;
// 					$acct->create($account);
// 					$acct->save();
// 					$newInfoUrl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accessToken.'&openid='.$fromUsername.'&lang=zh_CN';
// 					$uinfo = file_get_contents($newInfoUrl);
// 					$userInfo = json_decode($uinfo,true);
// 				//}
// 			}
// 			$man['id'] = $userInfo['openid'];
// 			$man['province'] = $userInfo['province'];
// 			$man['country'] = $userInfo['country'];
// 			$man['city'] = $userInfo['city'];
// 			$man['sex'] = $userInfo['sex'];
// 			$man['nickname'] = $userInfo['nickname'];
// 			$man['subscribe'] = $userInfo['subscribe'];
// 			$man['language'] = $userInfo['language'];
// 			$man['headimgurl'] = $userInfo['headimgurl'];
// 			$man['subscribe_time'] = $userInfo['subscribe_time'];
// 			if($ma->create($man)){
// 				$ma->add();
// 			}
// 		}
	}

	public function valid(){
		$echoStr = $_GET["echostr"];
		echo $echoStr;
	}

	public function createMenu(){
		$menu = '{
    "button": [
        {
            "name": "查询",
            "sub_button": [
                {
                    "type": "click",
                    "name": "图书查询",
                    "key": "tscx"
                },
                {
                    "type": "click",
                    "name": "我的借阅",
                    "key": "wdjy"
                }
            ]
        },
        {
            "name": "我的信息",
            "type": "click",
            "key": "wdxx"
            "sub_button": [
            ]
        },
        {
            "name": "校园文化",
            "type": "click",
            "key": "xywh"
            "sub_button": [

            ]
        }
    ]
}';
	}
}

?>