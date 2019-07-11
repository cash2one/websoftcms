<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/6/2
 * Time: 6:25
 * Group.php
 * version:v3.0.0
 */

namespace app\common\model;


class Group extends \think\Model
{
    protected $type = [
      'file' => 'json'
    ];
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
}