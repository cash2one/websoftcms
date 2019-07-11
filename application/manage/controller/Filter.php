<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/6/1
 * Time: 9:28
 * Filter.php
 * version:v3.0.0
 */

namespace app\manage\controller;
use app\common\controller\ManageBase;
class Filter extends ManageBase
{
    protected $beforeActionList = [
        'beforeIndex' => ['only'=>'index']
    ];
    public function beforeIndex()
    {
        $big_menu = [
            'title' => '添加条件',
            'iframe' => url('Filter/add'),
            'id' => 'add',
            'width' => '600',
            'height' => '450'
        ];
        $this->_ajaxedit = true;
        $this->_exclude  = 'delete';
        $this->assign('big_menu', $big_menu);
    }
    //后置事件 生成文件
    public function addDo(){
        \app\common\model\Filter::event('after_insert',function(Filter $that,$obj){
           $that->doCache();
            return true;
        });
        parent::addDo();
    }
    //后置事件 生成文件
    public function editDo(){
        \app\common\model\Filter::event('after_update',function(Filter $that,$obj){
            $that->doCache();
            return true;
        });
        parent::editDo();
    }
    /**
     * 生成文件
     */
    public function doCache(){
        if(model('filter')->createFile()){
            return true;
        }
        return false;
    }
}