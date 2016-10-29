<?php
class WToolAction extends Action {
	public function wtool() {
		$this->display ();
	}
	public function getAccessToken() {
		$appid = $_REQUEST ['appid'];
		$secret = $_REQUEST ['secret'];
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
		$html = file_get_contents ( $url );
		echo $html;
	}
	public function getMenu() {
		$accessToken = $_REQUEST ['accessToken'];
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $accessToken;
		$html = file_get_contents ( $url );
		echo $html;
	}
	public function createMenu() {
		$menudata = $_REQUEST ['menudata'];
		$accessToken = $_REQUEST ['accessToken'];
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $accessToken;
		echo $this->doCreateMenu ( $menudata, $url );
	}
	public function doCreateMenu($menudata, $url) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt ( $ch, CURLOPT_AUTOREFERER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $menudata );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$tmpInfo = curl_exec ( $ch );
		if (curl_errno ( $ch )) {
			return curl_error ( $ch );
		}
		curl_close ( $ch );
		return $tmpInfo;
	}
	
	public function getUserInfo(){
		$accessToken = $_REQUEST ['accessToken'];
		$openid = $_REQUEST['openid'];
		$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accessToken.'&openid='.$openid.'&lang=zh_CN';
		$html = file_get_contents ( $url );
		echo $html;
	}
}

?>