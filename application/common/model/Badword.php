<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:36
 */
class Badword extends \think\Model
{
    public function getLevelAttr($value){
        $level = $this->levelArr();
        return $level[$value];
    }
    public function levelArr(){
        $level = [
          1 => '一般',
          2 => '危险'
        ];
        return $level;
    }
}