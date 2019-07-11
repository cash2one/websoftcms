<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/1/15
 * Time: 16:54
 * Comment.php
 * version:v3.0.0
 */

namespace app\manage\controller;


use app\common\controller\ManageBase;

class Comment extends ManageBase
{
    public function initialize()
    {
        parent::initialize();
        $this->_name = 'user_comment';
    }
    public function index()
    {
        $where = $this->search();
        $join  = [['user b','b.id = c.broker_id']];
        $field = 'c.*,b.nick_name';
        $lists = model('user_comment')->alias('c')->join($join)->field($field)->where($where)->order('c.create_time desc')->paginate(20);
        $this->_exclude = 'edit';
        $this->assign('list',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('options',$this->check());
        return $this->fetch();
    }
    public function search(){
        $map = [];
        $status = input('get.status');
        is_numeric($status) && $map['c.status'] = $status;
        $data = [
            'status'  => $status,
        ];
        $this->queryData = $data;
        $this->assign('search', $data);
        return $map;
    }
}