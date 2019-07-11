<?php

/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2017/12/23
 * Time: 17:12
 * Estate.php
 * version:v3.0.0
 */
namespace app\agent\controller;
use \app\common\controller\AgentBase;
class Estate extends AgentBase
{
    private $model = 'estate';
    private $estate_id;
    protected $beforeActionList = [
        'beforeIndex' => ['only'=>['index']]
    ];
    public function initialize(){
        $this->estate_id = input('param.estate_id/d',0);
        $this->param_extra = ['estate_id'=>$this->estate_id];
        parent::initialize();
    }
    public function beforeIndex()
    {
        $this->_data = [
            'record' => [
                'c' => 'TransactionRecord',
                'a' => 'add',
                'str' => '<a href="%s" class="layui-btn layui-btn-xs">成交记录</a>',
                'param' => ['estate_id' => '@id@', 'menuid' => 32],
                'isajax' => 0,
                'replace' => ''
            ],
        ];
    }


    /**
     * @return array
     * 搜索条件
     */
    public function search()
    {
        $city    = input('get.city/d',0);
        $status  = input('get.status');
        $keyword = input('get.keyword');
        $where   = [];
        is_numeric($status) && $where['status'] = $status;
        $keyword && $where[] = ['title','like','%'.$keyword.'%'];
        if($city)
        {
            $city_child = model('city')->get_child_ids($city,true);
            $where[] = ['city','in',$city_child];
        }
        $data = [
            'city' => $city,
            'status' => $status,
            'keyword'=> $keyword
        ];
        $this->queryData = $data;
        $this->assign('search',$data);
        return $where;
    }
    public function addDo(){
        \app\common\model\Estate::event('before_insert',function(Estate $estate,$obj){
            if($obj->checkTitleExists($obj->title))
            {
                $estate->errMsg = '该小区已存在!';
                return false;
            }
            $map       = explode(',',input('post.map'));
            $obj->lat  = isset($map[1])?$map[1]:0;
            $obj->lng  = isset($map[0])?$map[0]:0;
            if (empty($obj->seo_title)) {
                $obj->seo_title = $obj->title;
            }
            if (empty($obj->seo_keys)) {
                $obj->seo_keys = $estate->setSeo($obj->title);
            }
            $images = $estate->getPic();
            if($images){
                $obj->file = $images;
            }
            if (isset($_POST['position'])) {
                $data['rec_position'] = 1;
            }
            return true;
        });

        parent::addDo();
    }
    public function editDo(){
        \app\common\model\Estate::event('before_update',function(Estate $estate,$obj){
            if($obj->checkTitleExists($obj->title,$obj->id))
            {
                $estate->errMsg = '该小区已存在!';
                return false;
            }
            $map       = explode(',',input('post.map'));
            $obj->lat  = isset($map[1])?$map[1]:0;
            $obj->lng  = isset($map[0])?$map[0]:0;
            $images = $estate->getPic();
            if($images){
                $obj->file = $images;
            }
            if (!isset($_POST['position'])) {
                $obj->rec_position = 0;
            } else {
                $obj->rec_position = 1;
            }
            return true;
        });

        parent::editDo();
    }

    /**
     * 删除
     */
    public function delete()
    {
        \app\common\model\Estate::event('after_delete',function($obj){
            if($obj->img)
            {
                //删除数据同时删除图片
                $img = '.'.$obj->img;
                file_exists($img) && @unlink($img);
            }
            if($obj->file)
            {
                foreach($obj->file as $v)
                {
                    $img = '.'.$v['url'];
                    file_exists($img) && @unlink($img);
                }
            }
        });
        parent::delete();
    }

    /**
     * 异步获取小区列表
     */
    public function ajaxGetEstate()
    {
        $keyword = input('get.keyword');
        $where['status'] = 1;
        $where[] = ['city','in',$this->getAgentCity()];
        $keyword && $where[] = ['title','like','%'.$keyword.'%'];
        $lists = model('estate')->where($where)->field('id,title,lng,lat,address')->paginate(10);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
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
    //关键词设置
    private function setSeo($title)
    {
        $seo_keys = "title,title二手房,title二手房价格,title怎么样,title出租房";
        $seo_keys = str_replace('title', $title, $seo_keys);
        return $seo_keys;
    }
    /**
     *获取代理城市
     */
    public function getAgentCity()
    {
        $agent_id = $this->agentInfo['company_id'];
        $city = model('agent_company')->where(['id'=>$agent_id])->value('city');
        $city_id_arr = [];
        $city_str    = '';
        $city_id     = 0;
        try{
            if(strpos($city,','))
            {
                $city_arr = explode(',',$city);
                foreach($city_arr as $v)
                {
                    $city_id_arr = model('city')->get_child_ids($v,true);
                    $city_str .= implode(',',$city_id_arr).',';
                }
                $city_id = trim($city_arr,',');
            }else{
                $city_id = model('city')->get_child_ids($city,true);
            }
        }catch(\Exception $e){
            \think\facade\Log::write($e->getMessage());
        }
        return $city_id;
    }
}