<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/4/11
 * Time: 9:06
 * Pages.php
 * version:v3.0.0
 */

namespace app\mobile\controller;
use app\common\controller\MobileBase;
class SinglePage extends MobileBase
{
    public function index()
    {
        $cate = input('param.cate');
        $join = [['pages p','p.cate_id = pc.id']];
        $where['pc.alias'] = $cate;
        $field = 'p.*,pc.alias';
        $info = model('pages_cate')->alias('pc')->join($join)->field($field)->where($where)->find();
        if($info)
        {
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            return $this->fetch('public/404');
        }
    }
}