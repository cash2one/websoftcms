<?php
/**
 * 南宁市网宿信息科技有限公司
 * 房产分销管理系统
 * User: zzlin QQ:170083662
 * Date: 2017/11/28
 * Time: 15:05
 * House.php
 * version:v3.0.0
 */

namespace app\agent\validate;


class SecondHouse extends \think\Validate
{
    protected $rule = [
        'title'      => 'require',
        'price'      => 'number'
    ];
    protected $message = [
        'title' => '房源名称必需填写',
        'price' => '价格只能为数字',
    ];
}