<?php

/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2017/12/20
 * Time: 14:14
 * editor.php
 * version:v3.0.0
 */
namespace addons\editor;
use think\Addons;
class Editor extends Addons
{
    public $info = [
        'name' => 'editor',	// 插件标识
        'title' => '编辑器',	// 插件名称
        'description' => '富文本编辑器',	// 插件简介
        'status' => 1,	// 状态
        'author' => 'junyv',
        'version' => '0.1'
    ];
    public function install()
    {
        return;
    }
    public function uninstall()
    {
        return;
    }
    public function ueditor($param = [])
    {
        $init_data = [
            'width' => 850,
            'height' => 500,
            'upload' => false,
            'mini'   => false
        ];
        if(is_array($param['id']))
        {
            $param['id'] = json_encode($param['id']);
        }
        $param = array_merge($init_data,$param);
        $this->assign('param',$param);
        return $this->fetch('ueditor');
    }
    public function ueditorUpload()
    {
        return $this->fetch('../addons/editor/upload.html');
    }
}