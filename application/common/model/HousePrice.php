<?php
/**
 * ���Ͼ���Ƽ����޹�˾
 * ����cmsϵͳ
 * User: zzlin QQ:170083662
 * Date: 2018/2/8
 * Time: 15:23
 * HousePrice.php
 * version:v3.0.0
 */

namespace app\common\model;


class HousePrice extends \think\Model
{
    /**
     * @param $house_id
     * @param $price
     * 添加价格
     */
    public function addHousePrice($house_id,$price,$model = 'house')
    {
        $rate = 0;
        //读取上一次价格
        $prev_price = $this->where(['house_id'=>$house_id,'model'=>$model])->order('create_time desc')->value('price');
        if($prev_price != $price && intval($price) > 0)
        {
            $data['price'] = $price;
            $data['create_time'] = time();
            $data['house_id'] = $house_id;
            $data['model']    = $model;
            //计算涨幅比
            if($prev_price)
            {
                $rate = number_format((($price - $prev_price) / $prev_price) * 100,1);
                unset($this->id);
            }
            $this->save($data);
        }
        return $rate;
    }
}