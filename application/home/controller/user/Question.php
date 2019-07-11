<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/3/25
 * Time: 10:33
 * Question.php
 * version:v3.0.0
 */

namespace app\home\controller\user;
use app\common\controller\UserBase;
class Question extends UserBase
{
    public function index()
    {
        $where['user_id'] = $this->userInfo['id'];
        $field = 'id,house_id,content,create_time,reply_num';
        $lists = model('question')->where($where)->field($field)->order('create_time','desc')->paginate(10);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        return $this->fetch();
    }
}