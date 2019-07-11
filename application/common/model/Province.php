<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/4/19
 * Time: 9:55
 * Province.php
 * version:v3.0.0
 */

namespace app\common\model;
class Province extends \think\Model
{
    public function getLists()
    {
        $where['status'] = 1;
        $lists = $this->where($where)->field('id,name')->order(['ordid'=>'asc','id'=>'desc'])->select();
        return $lists;
    }
}