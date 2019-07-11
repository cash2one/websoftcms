<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/9/10
 * Time: 14:56
 * Poster.php
 * version:v3.0.0
 */

namespace app\mobile\controller;
use app\common\controller\MobileBase;

class Poster extends MobileBase
{
    public function index()
    {
        $id = input('param.id/d',0);
        if(!$id)
        {
            return '';
        }
        return action('common/Poster/index',['id'=>$id,'city'=>$this->cityInfo['id']],'service');
    }
}