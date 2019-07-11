<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/1/15
 * Time: 18:07
 * Question.php
 * version:v3.0.0
 */

namespace app\manage\controller;


use app\common\controller\ManageBase;

class Question extends ManageBase
{
    protected $beforeActionList = [
        'beforeIndex' => ['only'=>['index']]
    ];
    public function beforeIndex()
    {
        $this->_exclude = 'edit';
        $this->_data = [
            'view'    => [
                'c' => 'Answer',
                'a' => 'index',
                'str'    => '<a data-height="" data-width="" data-show_btn="false" data-id="add" data-uri="%s" data-title="查看回复" class="J_showDialog layui-btn layui-btn-xs layui-btn-normal" href="javascript:;">查看回复</a>',
                'param' => ['question_id'=>'@id@'],
                'isajax' => true,
                'replace'=> ''
            ],
        ];
    }
}