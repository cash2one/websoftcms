<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/9/21
 * Time: 9:46
 * Office.php
 * version:v1.3
 */

namespace app\home\controller\user;
use app\common\controller\UserBase;
use app\common\service\Publish;
class Shops extends UserBase
{
    private $queryData;
    private $model = 'shops';
    /**
     * @return mixed
     * 商铺出售列表
     */
    public function index()
    {
        $where = $this->search();
        $field = "id,title,estate_name,price,img,acreage,status,update_time,top_time,timeout";
        $lists = model($this->model)->where($where)->field($field)->order(['top_time'=>'desc','id'=>'desc'])->paginate(15,false,['query'=>$this->queryData]);
        $this->assign('list',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
    /**
     * @return mixed
     * 添加商铺出售
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * @return mixed
     * 编辑商铺出售
     */
    public function edit()
    {
        $id    = input('param.id/d',0);
        $url   = request()->server('HTTP_REFERER');
        if(!$id){
            $this->error('参数错误');
        }else{
            $where['o.id']        = $id;
            $where['o.broker_id'] = $this->userInfo['id'];
            $join = [['shops_data d','d.house_id = o.id','left']];
            $info = model($this->model)->alias('o')->join($join)->field('o.*,d.info,d.mating,d.file')->where($where)->find();
            $info['file'] = json_decode($info['file'],true);
            $this->assign('back_url',$url);
            $this->assign('info',$info);
        }
        return $this->fetch();
    }

    /**
     * 保存商铺数据
     */
    public function save()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $data['broker_id'] = $this->userInfo['id'];
            $data['user_type'] = $this->userInfo['model'];
            $result = $this->validate($data,'app\manage\validate\Shops');//调用验证器验证
            if(true !== $result)
            {
                // 验证失败 输出错误信息
                $this->error($result);
            }else{
                if($data['price']>0 && $data['acreage']>0)
                {
                    //计算均价
                    $data['average_price'] = ceil($data['price'] * 10000 / $data['acreage']);
                }
                $data['industry'] = isset($data['industry'])?implode(',',$data['industry']):'';

                if(isset($data['id']) && !isset($data['timeout']))
                {
                    $return =  Publish::save($this->model,$data,$this->userInfo['id'],$this->userInfo['model']);
                }else{
                    $check = \app\common\service\PublishCount::check($this->userInfo['id'],$this->userInfo['model']);
                    if($check['code'] == 1){
                        $return =  Publish::save($this->model,$data,$this->userInfo['id'],$this->userInfo['model']);
                        $return['msg'] = isset($check['msg'])?$return['msg'].$check['msg']:$return['msg'];
                    }else{
                        $return['code'] = 0;
                        $return['msg']  = $check['msg'];
                        $return['url']  = '';
                    }
                }
                if($return['code'] == 1)
                {
                    $this->success($return['msg'],$return['url']);
                }else{
                    $this->error($return['msg']);
                }
            }
        }
    }

    /**
     *删除房源
     */
    public function delete()
    {
        $return = Publish::delete($this->userInfo['id'],$this->model);
        return json($return);
    }
    /**
     * @return \think\response\Json
     * 异步删除图片
     */
    public function deleteImg()
    {
        $return = Publish::deleteImg($this->model);
        return json($return);
    }
    /**
     * @return array
     * 搜索条件
     */
    private function search()
    {
        $status  = input('get.status');
        $keyword = input('get.keyword');
        $where   = [];
        $where['broker_id'] = $this->userInfo['id'];
        is_numeric($status) && $where['status'] = $status;
        $keyword && $where[] = ['title','like','%'.$keyword.'%'];
        $data = [
            'status' => $status,
            'keyword'=> $keyword
        ];
        $this->queryData = $data;
        $this->assign('search',$data);
        return $where;
    }
}