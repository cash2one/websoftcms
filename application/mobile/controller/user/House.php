<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/4/8
 * Time: 20:47
 * House.php
 * version:v3.0.0
 */

namespace app\mobile\controller\user;


class House extends UserBase
{
    /**
     * @return mixed
     * 二手房列表
     */
    public function index()
    {
        $where['broker_id'] = $this->userInfo['id'];
        $field = 'id,title,city,estate_name,img,acreage,price,average_price,tags,room,living_room,address,renovation,orientations,status,top_time,timeout';
        $lists = model('second_house')->where($where)->field($field)->order(['top_time'=>'desc','id'=>'desc'])->paginate(10);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('title','我的二手房');
        return $this->fetch();
    }

    /**
     * @return mixed
     * 出租房列表
     */
    public function rental()
    {
        $where['broker_id'] = $this->userInfo['id'];
        $field = 'id,title,city,estate_name,img,acreage,price,tags,room,living_room,address,renovation,orientations,status,top_time,timeout';
        $lists = model('rental')->where($where)->field($field)->order(['top_time'=>'desc','id'=>'desc'])->paginate(10);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('title','我的出租房');
        return $this->fetch();
    }
}