<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2017/12/22
 * Time: 11:41
 * HouseType.php
 * version:v3.0.0
 */

namespace app\agent\controller;
use app\common\controller\AgentBase;

class HouseType extends AgentBase
{
    private $house_id;
    public function initialize()
    {
        $this->house_id = input('param.house_id/d',0);
        $this->param_extra = ['house_id'=>$this->house_id];
        parent::initialize();
        $info = model('house')->getHouseInfo(['id'=>$this->house_id]);
        $this->assign('houseInfo',$info);
    }
    public function search()
    {
        $where['house_id'] = $this->house_id;
        $this->queryData = $where;
        return $where;
    }
    public function addDo()
    {
        \app\common\model\HouseType::event('after_insert',function($obj){
            $obj->getHouseTypeMinMaxValue($obj->house_id);
        });
        parent::addDo();
    }
    public function editDo()
    {
        \app\common\model\HouseType::event('after_update',function($obj){
            $obj->getHouseTypeMinMaxValue($obj->house_id);
        });
        parent::editDo();
    }


}