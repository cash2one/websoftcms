<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/1/15
 * Time: 18:40
 * Answer.php
 * version:v3.0.0
 */

namespace app\manage\controller;


use app\common\controller\ManageBase;

class Answer extends ManageBase
{

    public function index()
    {
        $join = [['question q','q.id = a.question_id']];
        $field = 'a.*,q.content as questioin_con';
        $lists = model('answer')->alias('a')->join($join)->field($field)->order('a.create_time desc')->paginate(20);
        $this->_exclude = 'edit';
        $this->assign('list',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('options',$this->check());
        return $this->fetch();
    }
}