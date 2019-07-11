<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/10/25
 * Time: 20:49
 * Shops.php
 * version:v1.3
 */

namespace app\home\controller;


use app\common\controller\HomeBase;
use app\common\service\Metro;
class Shops extends HomeBase
{
    private $mod = 'shops';
    public function initialize()
    {
        $this->cur_url = 'ShopsRental';
        parent::initialize();
    }
    /**
     * @return mixed
     * 商铺出售列表
     */
    public function index()
    {
        $result = $this->getLists();
        $lists  = $result['lists'];
        $this->assign('area',$this->getAreaByCityId());//区域
        $this->assign('type',getLinkMenuCache(18));//商铺类型
        $this->assign('tags',getLinkMenuCache(20));//商铺特色
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('hot',$this->getHotShops());
        $this->assign('top_lists',$result['top']);
        return $this->fetch();
    }

    /**
     * @return mixed
     * 商铺出售详情页
     */
    public function detail()
    {
        $id = input('param.id/d',0);
        if($id)
        {
            $where['h.id']     = $id;
            $where['h.status'] = 1;
            $obj  = model($this->mod);
            $join = [[$this->mod.'_data d','h.id=d.house_id']];
            $info = $obj->alias('h')->join($join)->where($where)->find();
            if($info)
            {
                $info['file'] = json_decode($info['file'],true);
                $this->setSeo($info);
                updateHits($info['id'],'office');
                $estate = model('estate')->where('id',$info['estate_id'])->find();
                $info['total']        = $obj->where('estate_id',$info['estate_id'])->where('status',1)->count();
                $this->assign('info',$info);
                $this->assign('estate',$estate);
                $this->assign('near_by_house',$this->getNearByHouse($info['lat'],$info['lng'],$info['city']));
                $this->assign('love',$this->samePriceHouse($info->getData('price')));
            }else{
                return $this->fetch('public/404');
            }
        }else{
            return $this->fetch('public/404');
        }
        return $this->fetch();
    }

    /**
     * @return array
     * 获取商铺出售列表
     */
    private function getLists()
    {
        $time    = time();
        $where   = $this->search();
        $sort    = input('param.sort/d',0);
        $keyword = input('get.keyword');
        $field = "id,title,estate_name,contact_name,user_type,update_time,img,price,average_price,tags,renovation,address,acreage,type,floor,total_floor";
        $obj   = model($this->mod);
        $lists = $obj->where($where)->where('top_time','lt',$time)->field($field)->order($this->getSort($sort))->paginate(10,false,['query'=>['keyword'=>$keyword]]);
        if($lists->currentPage() == 1)
        {
            $top = $obj->removeOption()->where($where)->where('top_time','gt',$time)->field($field)->order(['top_time'=>'desc','id'=>'desc'])->select();
        }else{
            $top = false;
        }
        return ['lists'=>$lists,'top'=>$top];
    }
    /**
     * @param $lat
     * @param $lng
     * @param int $city
     * @return array|\PDOStatement|string|\think\Collection
     * 附近房源
     */
    private function getNearByHouse($lat,$lng,$city = 0)
    {
        $obj = model($this->mod);
        if($lat && $lng){
            $point      = "*,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(({$lat}*PI()/180-lat*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(lat*PI()/180)*POW(SIN(({$lng}*PI()/180-lng*PI()/180)/2),2)))*1000) as distance2";
            $bindsql    = $obj->field($point)->buildSql();
            $fields_res = 'id,title,estate_name,price,acreage,img,distance2';
            $lists      = $obj->table($bindsql.' d')->field($fields_res)->where('status',1)->where('distance2','<',2000)->where('timeout','gt',time())->limit(3)->select();
        }else{
            $where['status'] = 1;
            $city && $where['city'] = $city;
            $where[] = ['timeout','gt',time()];
            $lists = $obj->where($where)->field('id,title,estate_name,price,acreage,img')->limit(3)->select();
        }
        return $lists;
    }
    /**
     * @param $price
     * @param int $num
     * @return array|\PDOStatement|string|\think\Collection
     * 价格相似房源
     */
    private function samePriceHouse($price,$num = 4)
    {
        $min_price = $price - 100;
        $max_price = $price + 100;
        $where[] = ['status','eq',1];
        $where[] = ['price','between',[$min_price,$max_price]];
        $where[] = ['timeout','gt',time()];
        $city    = $this->getCityChild();
        $city && $where[] = ['city','in',$city];
        $lists = model($this->mod)
            ->where($where)
            ->field('id,title,img,acreage,price')
            ->order('create_time desc')
            ->limit($num)
            ->select();
        return $lists;
    }
    /**
     * @return array
     * 搜索条件
     */
    private function search()
    {
        $param['area']       = input('param.area/d', $this->cityInfo['id']);
        $param['rading']     = 0;
        $param['tags']       = input('param.tags/d',0);
        $param['price']      = input('param.price/d',0);
        $param['acreage']    = input('param.acreage/d',0);//面积
        $param['type']       = input('param.type/d',0);//类型
        $param['sort']       = input('param.sort/d',0);//排序
        $param['user_type']  = input('param.user_type/d',0);//1个人房源  2中介房源
        $param['metro']      = input('param.metro/d',0);//地铁线
        $param['metro_station'] = input('param.metro_station/d',0);//地铁站点
        $param['area'] == 0 && $param['area'] = $this->cityInfo['id'];
        $data['status']         = 1;
        $keyword   = input('get.keyword');
        $seo_title = '';
        if(!empty($param['type']))
        {
            $data['type'] = $param['type'];
            $seo_title .= '_'.getLinkMenuName(18,$param['type']);
        }
        if(!empty($param['user_type']))
        {
            $data['user_type'] = $param['user_type'];
        }
        if($keyword)
        {
            $param['keyword'] = $keyword;
            $data[] = ['title|estate_name','like','%'.$keyword.'%'];
            $seo_title .= '_'.$keyword;
        }
        if(!empty($param['area']))
        {
            $data[] = ['city','in',$this->getCityChild($param['area'])];
            $rading = $this->getRadingByAreaId($param['area']);
            //读取商圈
            $param['rading'] = 0;
            if($rading && array_key_exists($param['area'],$rading))
            {
                $param['rading']  = $param['area'];
                $param['area']    = $rading[$param['area']]['pid'];
            }
            $this->assign('rading',$rading);
        }
        if(!empty($param['price']))
        {
            $data[] = getBussinessCondition('shops_price','price',$param['price']);
            $price  = config('filter.shops_price');
            isset($price[$param['price']]) && $seo_title .= '_'.$price[$param['price']]['name'];
        }
        if(!empty($param['acreage']))
        {
            $data[] = getBussinessCondition('shops_acreage','acreage',$param['acreage']);
            $acreage = config('filter.shops_acreage');
            isset($acreage[$param['acreage']]) && $seo_title .= '_'.$acreage[$param['acreage']]['name'];
        }
        if(!empty($param['tags'])){
            $data[] = ['','exp',\think\Db::raw("find_in_set({$param['tags']},tags)")];
            $seo_title .= '_'.getLinkMenuName(20,$param['tags']);
        }
        $data[] = ['timeout','gt',time()];
        $search = $param;
        $seo_title = trim($seo_title,'_');
        $area    = (isset($param['rading']) && $param['rading']) ? $param['rading'] : $param['area'];
        $citySeo = $this->getCityInfoById($area);
        $seo_keys = str_replace('_',',',$seo_title);
        $seo_desc = '';
        if($citySeo)
        {
            $seo_title = $citySeo['seo_title'].'商铺出售'.$seo_title;
            $seo_keys  = $citySeo['seo_keys'].'商铺出售,'.$seo_keys;
            $seo_desc = $citySeo['seo_desc'];
        }
        $seo_title && $this->setSeo(['seo_title'=>$seo_title,'seo_keys'=>trim($seo_keys,','),'seo_desc'=>$seo_desc]);

        $data = array_filter($data);
        unset($param['rading']);
        $this->assign('search',$search);
        $this->assign('param',$param);
        return $data;
    }
    /**
     * @param int $num
     * @return array|\PDOStatement|string|\think\Collection
     * 热门房源
     */
    private function getHotShops($num = 5)
    {
        $where['status'] = 1;
        $where[] = ['timeout','gt',time()];
        $city = $this->getCityChild();
        $city && $where[] = ['city','in',$city];
        $lists = model($this->mod)->field('id,title,img,price,estate_name,acreage')->where($where)->order('hits desc,id desc')->limit($num)->select();
        return $lists;
    }
    /**
     * @param $sort
     * @return array
     * 排序
     */
    private function getSort($sort)
    {
        switch($sort)
        {
            case 0:
                $order = ['ordid'=>'asc','id'=>'desc'];
                break;
            case 1:
                $order = ['price'=>'asc','id'=>'desc'];
                break;
            case 2:
                $order = ['price'=>'desc','id'=>'desc'];
                break;
            case 3:
                $order = ['average_price'=>'asc','id'=>'desc'];
                break;
            case 4:
                $order = ['average_price'=>'desc','id'=>'desc'];
                break;
            case 5:
                $order = ['acreage'=>'asc','id'=>'desc'];
                break;
            case 6:
                $order = ['acreage'=>'desc','id'=>'desc'];
                break;
            default:
                $order = ['ordid'=>'asc','id'=>'desc'];
                break;
        }
        return $order;
    }
}