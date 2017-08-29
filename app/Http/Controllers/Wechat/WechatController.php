<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    //实现valid验证方法：实现对接微信公众平台
    public function valid()
    {
        //接收随机字符串
        $echoStr = $_GET["echostr"];

        //valid signature , option
        //进行用户数字签名验证
        if($this->checkSignature()){
            //如果成功，则返回接收到的随机字符串
            echo $echoStr;
            //退出
            exit;
        }
    }

    //定义自动回复功能
    public function responseMsg()
    {
        //get post data, May be due to the different environments
        //接收用户端发送过来的XML数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        //判断XML数据是否为空
        if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                //通过simplexml进行xml解析
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                //手机端
                $fromUsername = $postObj->FromUserName;
                //微信的公众平台
                $toUsername = $postObj->ToUserName;
                //接收用户发送的关键词
                $keyword = trim($postObj->Content);
                //接收用户消息类型
                $msgType = $postObj->MsgType;
                //定义$longitude与$latitude接收用户发送的经纬度信息
                $latitude = $postObj->Location_X;
                $longitude = $postObj->Location_Y;
                //时间戳
                $time = time();
                //文本发送模板
                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";
                //音乐发送模板
                $musicTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Music>
                            <Title><![CDATA[%s]]></Title>
                            <Description><![CDATA[%s]]></Description>
                            <MusicUrl><![CDATA[%s]]></MusicUrl>
                            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                            </Music>
                            </xml>";
                //图文发送模板
                $newsTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            %s
                            </xml>";

                if($msgType=='text') {
                    //判断用户发送关键词是否为空
                    if(!empty( $keyword ))
                    {
                        if($keyword=='文本') {
                            //回复类型，如果为“text”，代表文本类型
                            $msgType = "text";
                            //回复内容
                            $contentStr = "您发送的是文本消息";
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //把XML数据返回给手机端
                            echo $resultStr;
                        } elseif($keyword=='?' || $keyword=='？') {
                            //定义回复类型
                            $msgType=='text';
                            //回复内容
                            $contentStr = "【1】特种服务号码\n【2】通讯服务号码\n【3】银行服务号码\n您可以通过输入【】方括号的编号获取内容哦！";
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //返回数据到微信客户端
                            echo $resultStr;
                        } elseif ($keyword=='1') {
                            //定义回复类型
                            $msgType=='text';
                            //回复内容
                            $contentStr = "常用特种服务号码：\n匪警：110\n火警：119";
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //返回数据到微信客户端
                            echo $resultStr;
                        } elseif ($keyword=='2') {
                            //定义回复类型
                            $msgType=='text';
                            //回复内容
                            $contentStr = "常用通讯服务号码：\n中移动：10086\n中电信：10000";
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //返回数据到微信客户端
                            echo $resultStr;
                        } elseif ($keyword=='3') {
                            //定义回复类型
                            $msgType=='text';
                            //回复内容
                            $contentStr = "常用银行服务号码：\n工商银行：95588\n建设银行：95533";
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //返回数据到微信客户端
                            echo $resultStr;
                        } elseif ($keyword=='音乐') {
                            //定义回复类型
                            $msgType='music';
                            //定义音乐标题
                            $title = '冰雪奇缘';
                            //定义音乐描述
                            $desc = '《冰雪奇缘》原声大碟...';
                            //定义音乐链接
                            $url = 'http://czbk888.duapp.com/music.mp3';
                            //定义高清音乐链接
                            $hqurl = 'http://czbk888.duapp.com/music.mp3';
                            //格式化字符串
                            $resultStr = sprintf($musicTpl, $fromUsername, $toUsername, $time, $msgType, $title, $desc, $url, $hqurl);
                            //返回XML数据到微信客户端
                            echo $resultStr;
                        } elseif ($keyword=='图文') {
                            //定义回复类型
                            $msgType='news';
                            //定义返回图文数量
                            $count = 4;
                            //组装Articles节点信息
                            $str = '<Articles>';
                            for($i=1;$i<=$count;$i++) {
                                $str .= "<item>
                                        <Title><![CDATA[微信开发教程{$i}]]></Title>
                                        <Description><![CDATA[传智播客微信开发教程...]]></Description>
                                        <PicUrl><![CDATA[http://czbk888.duapp.com/images/{$i}.jpg]]></PicUrl>
                                        <Url><![CDATA[http://www.itcast.cn]]></Url>
                                        </item>";
                            }
                            $str .= '</Articles>';
                            //格式化字符串
                            $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType, $count, $str);
                            //输出XML数据并返回到微信客户端
                            echo $resultStr;
                        } else {
                            //定义回复类型
                            $msgType='text';
                            //定义url链接操作
                            $url = "http://www.tuling123.com/openapi/api?key=9009fc44f168cfc7055c8a469821ce9b&info={$keyword}";
                            //模拟发送http中的get请求
                            $str = file_get_contents($url);
                            //格式化json字符串为对象或数组
                            $json = json_decode($str);
                            //定义回复内容
                            $contentStr = $json->text;
                            //格式化字符串
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            //返回数据到微信客户端
                            echo $resultStr;
                        }
                    }else{
                        echo "Input something...";
                    }
                } elseif($msgType=='image') {
                    //回复类型，如果为“text”，代表文本类型
                    $msgType = "text";
                    //回复内容
                    $contentStr = "您发送的是图片消息";
                    //格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    //把XML数据返回给手机端
                    echo $resultStr;
                } elseif($msgType=='location') {
                    //回复类型
                    $msgType='text';
                    //定义接口请求地址
                    $url = "http://api.map.baidu.com/telematics/v3/reverseGeocoding?location={$longitude},{$latitude}&coord_type=gcj02&output=json&ak=2pReiGS2nQV9Gi7tslO9r2UZ";
                    //模拟http中的get请求
                    $str = file_get_contents($url);
                    //转化json格式数据为数组或对象
                    $json = json_decode($str);
                    //回复内容
                    $contentStr = "您发送的是地理位置信息，您的位置：{$json->description}";
                    //格式化字符串
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    //返回XML数据到微信客户端
                    echo $resultStr;
                }

        }else {
            echo "";
            exit;
        }
    }

    //定义checkSignature
    private function checkSignature()
    {
        // you must define TOKEN by yourself
        //判断TOKEN密钥是否定义
        if (!defined("TOKEN")) {
            //如果没有定义抛出异常
            throw new Exception('TOKEN is not defined!');
        }
        //接收微信加密签名
        $signature = $_GET["signature"];
        //接收时间戳
        $timestamp = $_GET["timestamp"];
        //接收随机数
        $nonce = $_GET["nonce"];
        //把TOKEN常量赋值给$token变量
        $token = TOKEN;
        //把相关参数组装为数组（密钥、时间戳、随机数）
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        //通过字典法进行排序
        sort($tmpArr, SORT_STRING);
        //把排序后的数组转化字符串
        $tmpStr = implode( $tmpArr );
        //通过哈希算法对字符串进行加密操作
        $tmpStr = sha1( $tmpStr );

        //与加密签名进行对比
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
