<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/20
 * Time: 14:41
 * Verfiy.php
 * version:v3.0.0
 */

namespace app\mobile\controller;
use think\captcha\Captcha;
class Verfiy
{
    public function index()
    {
        $config  = config('captcha.');
        $config['imageH'] = 40;
        $config['imageW'] = 80;
        $config['length'] = 3;
        $config['fontSize'] = 16;
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
}