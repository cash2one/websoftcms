<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/25
 * Time: 9:20
 * Sub.php
 * version:v3.0.0
 */

namespace app\mobile\controller\user;
class Subscribe extends UserBase
{
    public function initialize()
    {
        parent::initialize();
        $this->assign('title','我的预约');
    }
    /**
     * @return mixed
     * 新房列表
     */
    public function index()
    {
        $field = 'h.id,h.title,h.img,h.sale_status,h.city,h.address,h.tags_id,h.price,h.unit,s.min_type,s.max_type,s.min_acreage,s.max_acreage';
        $lists = $this->getLists('house',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }

    /**
     * @return mixed
     * 二手房列表
     */
    public function second()
    {
        $field = "h.id,h.title,h.estate_name,h.city,h.img,h.room,h.living_room,h.toilet,h.price,h.average_price,h.tags,h.address,h.acreage,h.orientations,h.renovation";
        $lists = $this->getLists('second_house',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }

    /**
     * @return mixed
     * 出租房列表
     */
    public function rental()
    {
        $field = "h.id,h.title,h.city,h.estate_name,h.img,h.room,h.living_room,h.toilet,h.price,h.rent_type,h.tags,h.address,h.acreage,h.orientations,h.renovation";
        $lists = $this->getLists('rental',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return mixed
     * 写字楼出售列表
     */
    public function office()
    {
        $field = "h.id,h.title,h.city,h.estate_name,h.img,h.price,h.type,h.address,h.acreage,h.renovation";
        $lists = $this->getLists('office',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return mixed
     * 写字楼出租列表
     */
    public function officeRental()
    {
        $field = "h.id,h.title,h.city,h.estate_name,h.img,h.price,h.type,h.address,h.acreage,h.renovation";
        $lists = $this->getLists('office_rental',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return mixed
     * 商铺出售列表
     */
    public function shops()
    {
        $field = "h.id,h.title,h.city,h.estate_name,h.img,h.price,h.type,h.address,h.acreage,h.renovation";
        $lists = $this->getLists('shops',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return mixed
     * 商铺出租列表
     */
    public function shopsRental()
    {
        $field = "h.id,h.title,h.city,h.estate_name,h.img,h.price,h.type,h.address,h.acreage,h.renovation";
        $lists = $this->getLists('shops_rental',$field);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return \think\response\Json
     * 删除
     */
    public function delete()
    {
        $house_id = input('get.house_id/d',0);
        $model    = input('get.model');
        $return['code'] = 0;
        if($house_id)
        {
            $where['house_id'] = $house_id;
            $where['model']    = $model;
            if(model('subscribe')->where($where)->delete())
            {
                $return['code'] = 1;
                $return['msg']  = '删除成功';
            }else{
                $return['msg']  = '删除失败';
            }
        }else{
            $return['msg']      = '参数错误';
        }
        return json($return);
    }
    /**
     * @param $model
     * @param $field
     * @return \think\Paginator
     * 列表
     */
    private function getLists($model,$field)
    {
        $obj = model('subscribe');
        $where['f.user_id'] = $this->userInfo['id'];
        $where['f.model']   = $model;
        $where[] = ['f.house_id','gt',0];
        $join = [[$model.' h','f.house_id=h.id']];
        $field .= ',f.create_time';
        if($model == 'house')
        {
            $join = [
                [$model.' h','f.house_id=h.id'],
                ['house_search s','h.id = s.house_id','left']
            ];
        }
        $lists = $obj->alias('f')
            ->where($where)
            ->join($join)
            ->field($field)
            ->order('f.create_time','desc')
            ->group('f.house_id')
            ->paginate(10);
        return $lists;
    }
}