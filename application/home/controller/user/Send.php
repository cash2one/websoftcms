<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/25
 * Time: 16:38
 * Send.php
 * version:v3.0.0
 */

namespace app\home\controller\user;
use app\common\controller\UserBase;
use app\common\service\PublishCount;
class Send extends UserBase
{
    private $allow ;
    private $setting;
    public function initialize()
    {
        parent::initialize();
        $this->allow = ['second_house','rental'];
        $setting = getUserCate();
        $this->setting = $setting[$this->userInfo['model']]['data'];//用户设置
    }
    /**
     * 保存二手房
     */
    public function saveSecond()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $code   = 0;
            $msg    = '';
            $status = $this->setting['check_second'];
            $result = $this->validate($data,'app\manage\validate\SecondHouse');//调用验证器验证
            if(true !== $result)
            {
                // 验证失败 输出错误信息
                $msg = $result;
            }else{
                $obj = model('second_house');
                \think\Db::startTrans();
                try{
                    !empty($data['map']) && $location = explode(',',$data['map']);
                    $data['lng']     = isset($location[0]) ? $location[0] : 0;
                    $data['lat']     = isset($location[1]) ? $location[1] : 0;
                    $data['average_price'] = 0;
                    $data['broker_id'] = $this->userInfo['id'];
                    $data['user_type'] = $this->userInfo['model'];
                    $data['status']    = is_numeric($status)?$status:1;
                    $data['tags']      = isset($data['tags'])?implode(',',$data['tags']):0;
                    if($data['price']>0 && $data['acreage']>0)
                    {
                        $data['average_price'] = ceil($data['price'] * 10000 / $data['acreage']);
                    }
                    $img          = $this->uploadImg();
                    $data['file'] = $this->getPic();
                    if(isset($data['id']) && $data['id'])
                    {
                        if(isset($data['timeout']) && $data['timeout'])
                        {
                            //验证发布数量是否达到限制
                            $check  = PublishCount::check($this->userInfo['id'],$this->userInfo['model']);
                            if($check['code'] == 1){
                                $img && $data['img'] = $img;
                                (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                                $data['ratio'] = model('house_price')->addHousePrice($data['id'],$data['average_price'],'second_house');
                                if($obj->allowField(true)->save($data,['id'=>$data['id']]))
                                {
                                    $this->optionHouseData($data['id'],$data,'second_house',true);
                                }
                                $code = 1;
                                $msg = isset($check['msg'])?'上架成功！'.$check['msg']:'编辑房源信息成功';
                            }else{
                                $msg = $check['msg'];
                            }
                        }else{
                            $img && $data['img'] = $img;
                            (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                            $data['ratio'] = model('house_price')->addHousePrice($data['id'],$data['average_price'],'second_house');
                            if($obj->allowField(true)->save($data,['id'=>$data['id']]))
                            {
                                $this->optionHouseData($data['id'],$data,'second_house',true);
                            }
                            $code = 1;
                            $msg = '编辑房源信息成功';
                        }
                    }else{
                        //验证发布数量是否达到限制
                        $check  = PublishCount::check($this->userInfo['id'],$this->userInfo['model']);
                        if($check['code'] == 1){
                            $data['img'] = $img;
                            !isset($data['timeout']) && $data['timeout'] = 1;
                            (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                            if($obj->allowField(true)->save($data))
                            {
                                $house_id = $obj->id;
                                $this->optionHouseData($house_id,$data);
                                model('house_price')->addHousePrice($house_id,$data['average_price'],'second_house');
                                \app\manage\service\Price::calculationPrice($data['estate_id']);
                            }
                            $code = 1;
                            $msg = isset($check['msg'])?'发布成功！'.$check['msg']:'添加房源信息成功';
                        }else{
                            $msg = $check['msg'];
                        }
                    }
                    \think\Db::commit();
                }catch(\Exception $e){
                    \think\facade\Log::record('添加房源信息出错：'.$e->getMessage());
                    \think\Db::rollback();
                    $msg = $e->getMessage();
                }
            }
            $back_url = isset($data['back_url'])?$data['back_url']:null;
            if($code == 1)
            {
                $this->success($msg,$back_url);
            }else{
                $this->error($msg,$back_url);
            }
        }
    }

    /**
     * 保存出租房
     */
    public function saveRental()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            $code   = 0;
            $msg    = '';
            $status = $this->setting['check_rental'];
            $result = $this->validate($data,'app\manage\validate\Rental');//调用验证器验证
            if(true !== $result)
            {
                // 验证失败 输出错误信息
                $msg = $result;
            }else{
                $obj = model('rental');
                \think\Db::startTrans();
                try{
                    !empty($data['map']) && $location = explode(',',$data['map']);
                    $data['lng']     = isset($location[0]) ? $location[0] : 0;
                    $data['lat']     = isset($location[1]) ? $location[1] : 0;
                    $data['broker_id'] = $this->userInfo['id'];
                    $data['user_type'] = $this->userInfo['model'];
                    $data['status']    = is_numeric($status)?$status:1;
                    $img          = $this->uploadImg();
                    $data['file'] = $this->getPic();
                    if(isset($data['id']) && $data['id'])
                    {
                        if(isset($data['timeout']) && $data['timeout']) {
                            $check = PublishCount::check($this->userInfo['id'], $this->userInfo['model']);
                            if($check['code'] == 1)
                            {
                                $img && $data['img'] = $img;
                                (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                                $data['ratio'] = model('house_price')->addHousePrice($data['id'], $data['price'], 'rental');
                                if ($obj->allowField(true)->save($data, ['id' => $data['id']])) {
                                    $this->optionHouseData($data['id'], $data, 'rental', true);
                                }
                                $code = 1;
                                $msg = isset($check['msg'])?'上架成功！'.$check['msg']:'编辑房源信息成功';
                            }else{
                                $msg = $check['msg'];
                            }
                        }else{
                            $img && $data['img'] = $img;
                            (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                            $data['ratio'] = model('house_price')->addHousePrice($data['id'], $data['price'], 'rental');
                            if ($obj->allowField(true)->save($data, ['id' => $data['id']])) {
                                $this->optionHouseData($data['id'], $data, 'rental', true);
                            }
                            $code = 1;
                            $msg = '编辑房源信息成功';
                        }
                    }else{
                        $check = PublishCount::check($this->userInfo['id'],$this->userInfo['model']);
                        if($check['code'] == 1)
                        {
                            $data['img'] = $img;
                            !isset($data['timeout']) && $data['timeout'] = 1;
                            (empty($data['img']) && !empty($data['file'])) && $data['img'] = $data['file'][0]['url'];
                            if($obj->allowField(true)->save($data))
                            {
                                $house_id = $obj->id;
                                $this->optionHouseData($house_id,$data,'rental');
                                model('house_price')->addHousePrice($house_id,$data['price'],'rental');
                            }
                            $code = 1;
                            $msg = isset($check['msg'])?'发布成功！'.$check['msg']:'添加房源信息成功';
                        }else{
                            $msg = $check['msg'];
                        }

                    }
                    \think\Db::commit();
                }catch(\Exception $e){
                    \think\facade\Log::record('添加房源信息出错：'.$e->getMessage());
                    \think\Db::rollback();
                    $msg = $e->getMessage();
                }
            }
            $back_url = isset($data['back_url'])?$data['back_url']:null;
            if($code == 1)
            {
                $this->success($msg,$back_url);
            }else{
                $this->error($msg,$back_url);
            }
        }
    }
    /**
     * 异步删除图片
     */
    public function deleteImg(){
        $path = input('post.path');
        $id   = input('post.id/d',0);
        $field = input('post.field');
        $model = input('post.model','second_house');
        $return['code'] = 0;
        if($path){
            model('attachment')->deleteAttachment('',$path);
            if($id && $field && in_array($model,$this->allow)){
                model($model)->save([$field=>''],['id'=>$id]);
            }
            $return['code'] = 1;
        }else{
            $return['msg'] = '参数错误';
        }
        return json($return);
    }

    /**
     * @return \think\response\Json
     * 删除
     */
    public function delete()
    {
        $id    = input('param.id',0);
        $model = input('param.model','second_house');
        $return['code'] = 0;
        if(!$id)
        {
            $return['msg'] = '参数错误';
        }elseif(!in_array($model,$this->allow)){
            $return['msg'] = '不允许的数据模型';
        }else{
            $where[]       = ['id','in',$id];
            $where[]       = ['broker_id','eq',$this->userInfo['id']];
            $obj   = model($model);
            $lists = $obj->field('id,img')->where($where)->select();
            if($obj->where($where)->delete())
            {
                $this->deleteExtra($lists,$model);
                $return['code'] = 1;
                $return['msg'] = '删除成功';
            }else{
                $return['msg'] = '删除失败';
            }
        }
        return json($return);
    }

    /**
     * @param $data
     * @param $model
     * 删除扩展数据
     */
    private function deleteExtra($data,$model)
    {
        if(!$data->isEmpty())
        {
            foreach($data as $info)
            {
                $extra = model($model.'_data');
                $where = ['house_id'=>$info['id']];
                $detail = $extra::get($where);
                //删除房源图片
                if($extra->where($where)->delete())
                {
                    model('attachment')->deleteAttachment($detail['info'],$info['img'],$detail['file']);
                }
                //model('attachment')->deleteVideo($info['video']);//删除视频
                //删除价格数据
                db('house_price')->where(['house_id'=>$info['id'],'model'=>$model])->delete();
                //删除地铁关联数据
                \org\Relation::deleteByHouse($info['id'],$model);
                //删除学校关联数据
                \org\Relation::deleteByHouse($info['id'],$model,'school');
            }
        }
    }
    /**
     * @return string
     * 图片上传
     */
    private function uploadImg()
    {
        $img = '';
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            try{
                $dir  = "user/".$this->userInfo['id'];
                $file = request()->file('file');
                $upload = new \org\Storage();
                $upload->thumbUploadFile($file,$dir);
                $img = $upload->getFullName();
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
        return $img;
    }
    /**
     * @param $house_id
     * @param $data
     * 添加扩展数据
     */
    private function optionHouseData($house_id,$data,$model = 'second_house',$update = false)
    {
        if (empty($data['seo']['seo_title'])) {
            $info['seo_title'] = $data['title'];
        }else{
            $info['seo_title'] = $data['seo']['seo_title'];
        }
        $info['house_id']  = $house_id;
        $info['info']      = isset($data['info']) ? $data['info'] : '';
        $info['file']      = $data['file'];//$this->getPic();
        isset($data['supporting']) &&  $info['supporting'] = implode(',',$data['supporting']);
        if($update)
        {
            model($model.'_data')->allowField(true)->save($info,['house_id'=>$house_id]);
        }else{
            model($model.'_data')->allowField(true)->save($info);
        }
        //关联学校
        \org\Relation::addSchool($model,$data['lng'],$data['lat'],$house_id,$data['city']);
        //关联地铁站
        \org\Relation::addMetro($model,$data['lng'],$data['lat'],$house_id,$data['city']);
    }

    /**
     * @param $obj
     * 添加图片
     */
    private function getPic(){
        $insert = [];
        if(isset($_POST['pic']) && !empty($_POST['pic'])) {
            $images = $_POST['pic'];
            foreach ($images as $key => $v) {
                $insert[] = [
                    'url' => $v['pic'],
                    'title' => $v['alt'],
                ];
            }
        }
        return $insert;
    }
}