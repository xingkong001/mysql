<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		//获取参数signature nonce token timestamp echostr
		$nonce=$_GET['nonce'];
		$token='imooc';
		$timestamp=$_GET['timestamp'];
		$echostr=$_GET['echostr'];
		$signature=$_GET['signature'];
		//形成数组，然后按照字典序排序
		$array=array();
		$array=array($nonce,$timestamp,$token);
		sort($array);
		//拼接成字符串，sha1加密，然后与signature进行校验
		$str=sha1(implode($array));
		if($str==$signature && $echostr){
			//
			echo $echostr;
			exit;
		}else{
			$this->reponseMsg();
		}
		echo '你好';
	}
	//接收时间推送斌回复
	public function reponseMsg(){
		//获取到微信推送过来的post数据
		$postArr=$GLOBALS['HTTP_RAW_POST_DATA'];
		//处理消息类型，并回复类型和内容
		$postObj=simplexml_load_string($postArr);
		/*if(strtolower($postObj->MsgType)=='event'){
			if(mb_strtolower($postObj->Event=='subscribe')){
				//回复用户消息
				$toUser=$postObj->FromUserName;
				$fromUser=$postObj->ToUserName;
				$time=time();
				$msgType='text';
				$content='欢迎关注我们的微信公账号hello weixin';
				$template="<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Content><![CDATA[%s]]></Content>
							</xml>";
				$info=sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
				echo $info;
			}
		}*/
		//if(strtolower($postObj->MsgType)=='text'){
			// if($postObj->Content=='imooc'){
			// 	$template="<xml>
			// 					<ToUserName><![CDATA[%s]]></ToUserName>
			// 					<FromUserName><![CDATA[%s]]></FromUserName>
			// 					<CreateTime>%s</CreateTime>
			// 					<MsgType><![CDATA[%s]]></MsgType>
			// 					<Content><![CDATA[%s]]></Content>
			// 				</xml>";
			// 	$fromUser=$postObj->ToUserName;
			// 	$toUser=$postObj->FromUserName;
			// 	$time=time();
			// 	$content='imooc is very good is just test';
			// 	$msgType='text';
			// 	echo sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
			// }
			// if($postObj->Content=='tel'){
			// 	$template="<xml>
			// 					<ToUserName><![CDATA[%s]]></ToUserName>
			// 					<FromUserName><![CDATA[%s]]></FromUserName>
			// 					<CreateTime>%s</CreateTime>
			// 					<MsgType><![CDATA[%s]]></MsgType>
			// 					<Content><![CDATA[%s]]></Content>
			// 				</xml>";
			// 	$fromUser=$postObj->ToUserName;
			// 	$toUser=$postObj->FromUserName;
			// 	$time=time();
			// 	$content='18354270999';
			// 	$msgType='text';
			// 	echo sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
			// }
			if(strtolower($postObj->MsgType)=='text'){
			switch ($postObj->Content) {
				case 1:
				$content='您输入的数字式1';
					break;
				case 2:
				$content='您输入的数字式2';
				    break;
				case 3:
				$content='您输入的数字式3';
				    break;
				case 4:
				$content='<a href="http://www.baidu.com">百度</a>';
				    break;
				case 英文:
				$content='imooc is bucuo';
				    break;
				default:
				$content='不知道你说的什么';
					break;
			}
			$template="<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
						</xml>";
			$fromUser=$postObj->ToUserName;
			$toUser=$postObj->FromUserName;
			$time=time();
			$msgType='text';
			echo sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
			
		}
	}
}
