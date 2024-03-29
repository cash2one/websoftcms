<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/21
 * Time: 14:42
 * Dialog.php
 * version:v3.0.0
 */

namespace app\mobile\controller;


class Dialog extends \think\Controller
{
    public function subscribe()
    {
        $house_id = input('get.house_id/d',0);
        $model    = input('get.model','house');
        $type     = input('get.type/d',0);
        $user     = getSettingCache('user');
        $this->assign('data',[
            'house_id' => $house_id,
            'model'    => $model,
            'type'     => $type,
            'broker_id' => $this->getBrokerIdByHouseId($model,$house_id)
        ]);
        $this->assign('user_setting',$user);
        return $this->fetch();
    }
    private function getBrokerIdByHouseId($model,$id)
    {
        $allow     = ['house','second_house','rental'];
        $broker_id = 0;
        if(in_array($model,$allow))
        {
            $broker_id = model($model)->where('id',$id)->value('broker_id');
        }
        return $broker_id;
    }
}