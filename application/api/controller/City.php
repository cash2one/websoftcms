<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/7/9
 * Time: 11:31
 * City.php
 * version:v3.0.0
 */

namespace app\api\controller;


class City extends \think\Controller
{
    /**
     * @return \think\response\Json
     * 城市选择
     */
    public function index()
    {
        $return['code'] = 200;
        $return['data'] = $this->getCity();
        return json($return);
    }
    /**
     * @return array
     * 按字母顺序排列的全部城市
     */
    private function getCity()
    {
        $city = getCity();
        $hot  = [];
        $city_arr = [];
        foreach($city as $v)
        {
            if($v['is_hot'] == 1)
            {
                $hot[] = $v;
            }
            $first = strtoupper(substr($v['alias'],0,1));
            $city_arr[$first][] = $v;
        }
        ksort($city_arr);
        return $city_arr;
    }
}