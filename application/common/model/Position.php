<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:36
 */
class Position extends \think\Model
{
    protected $type = [
        'data' => 'json',
    ];
    public function PositionCate(){
        return $this->hasOne('position_cate','id','cate_id')->joinType('left');
    }
}