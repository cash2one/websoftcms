<?php
/**
 * 南宁市网宿信息科技有限公司
 * fangcms
 * User: zzlin QQ:170083662
 * Date: 2018/4/13
 * Time: 14:37
 * AgentCompany.php
 * version:v3.0.0
 */

namespace app\common\model;
class AgentCompany extends \think\Model
{
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
    protected function setPasswordAttr($value){
        if(!empty($value)){
            return passwordEncode($value);
        }
        return '';
    }
}