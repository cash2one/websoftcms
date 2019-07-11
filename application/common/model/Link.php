<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:36
 */
class Link extends \think\Model
{
    public function linkCate(){
      return $this->hasOne('link_cate','id','cate_id')->joinType('left');
    }
}