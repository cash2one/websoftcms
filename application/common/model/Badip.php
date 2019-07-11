<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:36
 */
class Badip extends \think\Model
{
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
    public function setExpiresAttr($value){
        $val = $value == 0 ? $value : (time()+$value*86400);
        return $val;
    }
}