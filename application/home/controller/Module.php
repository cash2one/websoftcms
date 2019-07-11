<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/9/5
 * Time: 16:30
 * Module.php
 * version:v3.0.0
 */

namespace app\home\controller;


class Module extends \think\Controller
{
    public function index($tpl = '')
    {
        if($tpl)
        {
            return $this->fetch($tpl);
        }
        return '';
    }
}