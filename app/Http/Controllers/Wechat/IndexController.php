<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        //定义TOKEN密钥
        define("TOKEN", "weixin");
        //实例化微信对象
        $wechatObj = new WechatController();
        //验证成功后，注释掉valid方法
        //$wechatObj->valid();
        //开启自动回复功能
        $wechatObj->responseMsg();
    }


}
