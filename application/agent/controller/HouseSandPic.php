<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2017/12/23
 * Time: 11:48
 * HouseSandPic.php
 * version:v3.0.0
 */

namespace app\agent\controller;
use \app\common\controller\AgentBase;

class HouseSandPic extends AgentBase
{
    public function delete()
    {
        \app\common\model\HouseSandPic::event('after_delete',function($obj){
            model('attachment')->deleteAttachment('',$obj->img);
        });
        parent::delete();
    }
}