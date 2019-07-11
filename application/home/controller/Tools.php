<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/29
 * Time: 18:15
 * Tools.php
 * version:v3.0.0
 */

namespace app\home\controller;
use app\common\controller\HomeBase;
class Tools extends HomeBase
{
    public function index()
    {
        return $this->fetch();
    }
}