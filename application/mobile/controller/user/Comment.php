<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/4/8
 * Time: 17:59
 * Comment.php
 * version:v3.0.0
 */

namespace app\mobile\controller\user;
class Comment extends UserBase
{
    /**
     * @return mixed
     * 评论列表
     */
    public function index()
    {
        $where['c.user_id'] = $this->userInfo['id'];
        $join  = [['user u','u.id = c.broker_id','left']];
        $field = 'c.id,c.content,c.user_id,c.content,c.point,c.tags,c.broker_id,c.good,c.bad,c.status,c.create_time,u.nick_name';
        $lists = model('user_comment')->alias('c')
            ->field($field)
            ->where($where)
            ->join($join)
            ->order('c.create_time','desc')
            ->paginate(10);
        $this->assign('lists',$lists);
        $this->assign('pages',$lists->render());
        $this->assign('title','我的点评');
        return $this->fetch();
    }

    /**
     * @return \think\response\Json
     * 删除
     */
    public function delete()
    {
        $id = input('param.id/d',0);
        $return['code'] = 0;
        if($id)
        {
            $where['id'] = $id;
            $where['user_id'] = $this->userInfo['id'];
            if(model('user_comment')->where($where)->delete())
            {
                $return['code'] = 1;
                $return['msg']  = '删除成功';
            }else{
                $return['msg']  = '删除失败';
            }
        }else{
            $return['msg']      = '参数错误';
        }
        return json($return);
    }
}