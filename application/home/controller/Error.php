<?php
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/10/16
 * Time: 19:02
 */

namespace app\home\controller;

/**
 * Class Error
 * @package app\home\controller
 * 空控制器
 */
class Error extends \think\Controller
{
    public function index($url = null){
        $this->assign('url',base64_decode($url));
        return $this->fetch('public/404');
    }
    public function _empty()
    {
        return $this->fetch('public/404');
    }
}