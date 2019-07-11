<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/7/7
 * Time: 9:10
 * Sms.php
 * version:v3.0.0
 */

namespace app\api\controller;


class Sms extends \think\Controller
{
    public function index()
    {
        return action('home/Sms/sendSms');
    }
}