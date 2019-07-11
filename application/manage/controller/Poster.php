<?php
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/21
 * Time: 17:19
 */

namespace app\manage\controller;
use app\common\controller\ManageBase;

class Poster extends ManageBase
{
    private $mod;
    private $space_id;
    protected $beforeActionList = [
      'beforeIndex'  => ['only' => 'index'],
        'beforeEdit' => ['only' => 'add,edit']
    ];
    public function initialize() {
        parent::initialize();
        $this->mod = model('poster');
        $this->space_id = input('param.space_id/d');
    }
    public function beforeIndex(){
        $big_menu = [
            'title' => '添加广告',
            'iframe' => url('Poster/add',['space_id'=>$this->space_id]),
            'id' => 'add',
            'width' => '500',
            'height' => '380'
        ];
        $this->assign('normal',true);
        $this->assign('big_menu', $big_menu);
    }
    public function search(){
        $city    = input('param.city/d',0);
        $keyword = input('param.keyword');
        $where   = [];
        ($space_id = input('param.space_id/d')) && $where['spaceid'] = $space_id;
        $city && $where[] = ['city_id','eq',$city];
        $keyword && $where[] = ['name','like','%'.$keyword.'%'];
        $data = [
            'city'=>$city,
            'space_id' => $space_id,
            'keyword'  => $keyword
        ];
        $this->queryData = $data;
        $this->assign('search',$data);
        return $where;
    }
    public function beforeEdit()
    {
        $id = input('param.id/d');
        $space_id = $this->space_id;
        if ($id) {
            $space = $this->mod->where('id', $id)->field('city_id,spaceid')->find();
            $space_id = $space['spaceid'];
            $city_id  = $space['city_id'];
            $city_spid = \think\Db::name('city')->where(['id'=>$city_id])->value('spid');
            if($city_spid == 0){
                $city_spid = $city_id;
            }else{
                $city_spid .= $city_id;
            }
            $this->assign('city_id',$city_spid);
        }
        $space_info = model('poster_space')->get($space_id);
        switch ($space_info->getData('type')) {
            case 'text':
                $type = [
                    'text' => '文字'
                ];
                break;
            case 'code' :
                $type = [
                    'code' => '代码'
                ];
                break;
            case 'banner':
            case 'couplet':
                $type = [
                    'images' => '图片',
                    'flash' => '动画'
                ];
                break;
            default :
                $type = [
                    'images' => '图片'
                ];
                break;
        }
        $this->assign('space_type', $type);
        $this->assign('space_info', $space_info);
    }
    public function addDo(){
        \app\common\model\Poster::event('after_insert',function($obj){
            //注册后置事件 添加成功后更新广告位统计数量
            $id = $obj->spaceid;
            model('poster_space')->where('id',$id)->setInc('items');
            return true;
        });
        parent::addDo();
    }
    //删除
    public function delete(){
        //注册后置事件 删除后更新广告位统计数量
        \app\common\model\Poster::event('after_delete',function($obj){
            $id = $obj->spaceid;
            model('poster_space')->where('id',$id)->setDec('items');
            if(isset($obj->setting['left']) || isset($obj->setting['right']))
            {
                $img = $obj->setting['left']['fileurl'];
                $img2 = $obj->setting['right']['fileurl'];
            }elseif(isset($obj->setting['fileurl'])){
                $img = $obj->setting['fileurl'];
                $img2 = '';
            }else{
                $img = '';
                $img2 = '';
            }
            model('attachment')->deleteAttachment('',$img,$img2);//删除图片
            return true;
        });
        parent::delete();
    }
    /**
     * 检查名称是否有重复
     */
    public function ajaxCheckName() {
        $name = input('param.name');
        $id = input('param.id/d');
        if ($this->name_exists($name,$id)) {
            $this->ajaxReturn(0, '广告已存在');
        } else {
            $this->ajaxReturn(1);
        }
    }

    private function name_exists($name,$id=0){
        $pk = $this->mod->getPk();
        $where['name'] = $name;
        $id && $where[$pk]    = ['neq',$id];
        $result=$this->mod->where($where)->count($pk);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }
}