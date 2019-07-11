<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/7/5
 * Time: 20:49
 * Url.php
 * version:v3.0.0
 */

namespace app\api\controller;


class Url extends \think\Controller
{
    public function index()
    {
        $url = input('get.url');
        $this->assign('url',base64_decode($url));
        return $this->fetch();
    }
}