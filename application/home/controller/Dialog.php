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

namespace app\home\controller;


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
            'type'     => $type
        ]);
        $this->assign('info',$this->getHouseInfo($house_id,$model));
        $this->assign('user_setting',$user);
        return $this->fetch();
    }
    private function getHouseInfo($house_id,$model)
    {
        $where['id'] = $house_id;
        $where['status'] = 1;
        $field = 'title,img,price,address,broker_id';
        $model == 'house' && $field .= ',unit';
        $info = model($model)->where($where)->field($field)->find();
        if($info)
        {
            $info = $info->toArray();
        }
        switch($model)
        {
            case 'house':
                $info['price'] = "<em class='price'>".$info['price']."</em>".$info['unit'];
                $info['price_txt'] = '均价';
                break;
            case 'second_house':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '售价';
                break;
            case 'rental':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '月租';
                break;
            case 'office':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '售价';
                break;
            case 'office_rental':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '月租';
                break;
            case 'shops':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '售价';
                break;
            case 'shops_rental':
                $info['price'] = "<em class='price'>".$info['price']."</em>";
                $info['price_txt'] = '月租';
                break;
        }
        return $info;
    }
}