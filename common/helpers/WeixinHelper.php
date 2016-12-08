<?php
namespace common\helpers;

use Yii;

class WeixinHelper{

	/**
	 * 解析微信post过来的xml数据，返回array格式数据
	 */
	public static function wxXml2Array(){
		return Yii::$app->wechat->parseRequestData();
	}

	//接收事件消息
	public static function receiveEvent($array){
		$content = "";
		switch ($array['Event']){
			case "subscribe":
				$content = "
欢迎关注 熊喵er 陪玩中心，官网：（www.xmdailian.com）。
在这里，你可以随心所欲，傲娇的服务，只要呆萌的价格。
软妹、暖男、大神、御姐
只有你撩不到的，没有你想不到的
在这里，你还能参加各种电竞宝贝评选活动，详情请戳：
mbpeiwan.xmdailian.com/vote/index
在这里，还有丰厚奖金的LOL赛事活动参与，详情请戳：
http://lol.xmdailian.com/";
				// $content .= (!empty($array['EventKey']))?("\n来自二维码场景 ".str_replace("qrscene_","",$array['EventKey'])):"";
				break;
			case "unsubscribe":
				$content = "取消关注";
				break;
			case "SCAN":
				$content = "扫描场景 ".$array['EventKey'];
				break;
			case "CLICK":
				switch ($array['EventKey']){
					case "COMPANY":
						$content = array();
						$content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
						break;
					default:
						$content = "点击菜单：".$array['EventKey'];
						break;
				}
				break;
			case "LOCATION":
				$content = "上传位置：纬度 ".$array['Latitude'].";经度 ".$array['Longitude'];
				break;
			case "VIEW":
				$content = "跳转链接 ".$array['EventKey'];
				break;
			case "MASSSENDJOBFINISH":
				$content = "消息ID：".$array['MsgID']."，结果：".$array['Status']."，粉丝数：".$array['TotalCount']."，过滤：".$array['FilterCount']."，发送成功：".$array['SentCount']."，发送失败：".$array['ErrorCount'];
				break;
			default:
				$content = "receive a new event: ".$array['Event'];
				break;
		}
		if(is_array($content)){
			if (isset($content[0])){
				$result = self::transmitNews($array, $content);
			}else if (isset($content['MusicUrl'])){
				$result = self::transmitMusic($array, $content);
			}
		}else{
			$result = self::transmitText($array, $content);
		}
		return $result;
	}

	//接收文本消息
	public static function receiveText($array){
		$keyword = trim($array['Content']);
		//多客服人工回复模式
		if (strstr($keyword, "您好") || strstr($keyword, "你好") || strstr($keyword, "在吗")){
			$result = self::transmitService($array);
		}
		//自动回复模式
		else{
			if (strstr($keyword, "文本")){
				$content = "这是个文本消息";
			}else if (strstr($keyword, "单图文")){
				$content = array();
				$content[] = array("Title"=>"单图文标题",  "Description"=>"单图文内容", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
			}else if (strstr($keyword, "图文") || strstr($keyword, "多图文")){
				$content = array();
				$content[] = array("Title"=>"多图文1标题", "Description"=>"", "PicUrl"=>"http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
				$content[] = array("Title"=>"多图文2标题", "Description"=>"", "PicUrl"=>"http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
				$content[] = array("Title"=>"多图文3标题", "Description"=>"", "PicUrl"=>"http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" =>"http://m.cnblogs.com/?u=txw1958");
			}else if (strstr($keyword, "音乐")){
				$content = array();
				$content = array("Title"=>"最炫民族风", "Description"=>"歌手：凤凰传奇", "MusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3", "HQMusicUrl"=>"http://121.199.4.61/music/zxmzf.mp3");
			}else{
				$content = date("Y-m-d H:i:s",time())."\n".$array['FromUserName']."\n技术支持 caozongchao";
			}
			if(is_array($content)){
				if (isset($content[0]['PicUrl'])){
					$result = self::transmitNews($array, $content);
				}else if (isset($content['MusicUrl'])){
					$result = self::transmitMusic($array, $content);
				}
			}else{
				$result = self::transmitText($array, $content);
			}
		}
		return $result;
	}

	//接收图片消息
	public static function receiveImage($array){
		$content = array("MediaId"=>$array['MediaId']);
		$result = self::transmitImage($array, $content);
		return $result;
	}

	//接收位置消息
	public static function receiveLocation($array){
		$content = "你发送的是位置，纬度为：".$array['Location_X']."；经度为：".$array['Location_Y']."；缩放级别为：".$array['Scale']."；位置为：".$array['Label'];
		$result = self::transmitText($array, $content);
		return $result;
	}

	//接收语音消息
	public static function receiveVoice($array){
		if (isset($array['Recognition']) && !empty($array['Recognition'])){
			$content = "你刚才说的是：".$array['Recognition'];
			$result = $this->transmitText($object, $content);
		}else{
			$content = array("MediaId"=>$array['MediaId']);
			$result = self::transmitVoice($array, $content);
		}
		return $result;
	}

	//接收视频消息
	public static function receiveVideo($array){
		$content = array("MediaId"=>$array['MediaId'], "ThumbMediaId"=>$array['ThumbMediaId'], "Title"=>"", "Description"=>"");
		$result = $this->transmitVideo($array, $content);
		return $result;
	}

	//接收链接消息
	public static function receiveLink($object){
		$content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
		$result = $this->transmitText($object, $content);
		return $result;
	}

	//回复文本消息
	public static function transmitText($array, $content){
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time(), $content);
		return $result;
	}

	//回复图片消息
	public static function transmitImage($array, $imageArray){
		$itemTpl = "<Image>
	<MediaId><![CDATA[%s]]></MediaId>
</Image>";
		$item_str = sprintf($itemTpl, $imageArray['MediaId']);
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time());
		return $result;
	}

	//回复语音消息
	public static function transmitVoice($array, $voiceArray){
		$itemTpl = "<Voice>
	<MediaId><![CDATA[%s]]></MediaId>
</Voice>";
		$item_str = sprintf($itemTpl, $voiceArray['MediaId']);
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time());
		return $result;
	}

	//回复视频消息
	public static function transmitVideo($array, $videoArray){
		$itemTpl = "<Video>
	<MediaId><![CDATA[%s]]></MediaId>
	<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
	<Title><![CDATA[%s]]></Title>
	<Description><![CDATA[%s]]></Description>
</Video>";
		$item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time());
		return $result;
	}

	//回复图文消息
	public static function transmitNews($array, $newsArray){
		if(!is_array($newsArray)){
			return;
		}
		$itemTpl = "    <item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
	</item>
";
		$item_str = "";
		foreach ($newsArray as $item){
			$item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
		}
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time(), count($newsArray));
		return $result;
	}

	//回复音乐消息
	public static function transmitMusic($array, $musicArray){
		$itemTpl = "<Music>
	<Title><![CDATA[%s]]></Title>
	<Description><![CDATA[%s]]></Description>
	<MusicUrl><![CDATA[%s]]></MusicUrl>
	<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";
		$item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time());
		return $result;
	}

	//回复多客服消息
	public static function transmitService($array){
		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
		$result = sprintf($xmlTpl, $array['FromUserName'], $array['ToUserName'], time());
		return $result;
	}

    /**
	 * 获取用户openid
	 */
	public static function getWxUserInfo($turl){
		if (!isset($_GET['code'])){
			//触发微信返回code码
			$url = Yii::$app->wechat->getOauth2AuthorizeUrl($turl, 'authorize', 'snsapi_userinfo');
			Header("Location: $url");
			exit();
		} else {
			//获取code码，以获取openid
			$code = $_GET['code'];
			$accessInfo = Yii::$app->wechat->getOauth2AccessToken($code);
			$session = Yii::$app->session;
			$session->set('oauth2AccessToken',$accessInfo['access_token']);
			$userInfo = Yii::$app->wechat->getSnsMemberInfo($accessInfo['openid'],$accessInfo['access_token']);
			return $userInfo;
		}
	}

	/**
     * 获取微信二维码的链接
     */
    public static function getQrcodeUrl($param){
        $result = Yii::$app->wechat->createQrCode($param);
        if ($result) {
            $url = Yii::$app->wechat->getQrCodeUrl($result['ticket']);
            return $url;
        }
    }
}