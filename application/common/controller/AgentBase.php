<?php
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 11:52
 */
namespace app\common\controller;


class AgentBase extends \think\Controller
{
    protected $_name = '';//数据表名
    protected $menuid = 0;
    protected $list_relation = false;
    protected $_ajaxedit = 0;
    protected $_exclude;
    protected $_data = [];
    protected $addAll = false;
    protected $big_menu = false;
    protected $sort;
    protected $_editAction = 'edit';
    protected $_delAction = 'delete';
    protected $controller_name;
    protected $action_name;
    protected $del_true = false;//标记是否是软删除
    protected $view_del = false;//是否包含软删除数据
    protected $list_field = '*';
    protected $param_extra = [];//菜单额外参数
    protected $errMsg = '';
    private $module   = '';
    protected $agentInfo;
    protected $agentId = 0;
    protected $onlyShowAgent = true;
    protected $queryData = [];
    public function initialize()
    {

        $this->checkUser();
        parent::initialize();
        $this->controller_name = request()->controller();//获取控制器名称
        $this->action_name = request()->action();//获取方法名
        $this->module      = request()->module();//获取模块名
        $this->check(true);//权限验证
        $this->_name = $this->controller_name;//数据表名 默认获取 子类控制器名称 所以控制器请以表名称命名
        $this->menuid = input('param.menuid/d', 0);
        if ($this->menuid) {
            $this->getSubMenu();//获取子菜单
        }
        $this->agentId = $this->agentInfo['company_id'];
        $this->assign('menuid', $this->menuid);
    }
    public function index()
    {
        $where['agent_id'] = $this->agentId;
        $map = $this->search();
        $this->onlyShowAgent && $map = array_merge($where,$map);
        $this->lists($map);
        $this->assign('options', $this->check());
        return $this->fetch();
    }

    /**
     * 列表处理
     *
     * @param array $map      条件数据
     * @param int   $pageSize 每页数据行数
     */
    protected function lists($map = [], $pageSize = 20)
    {
        //排序
        $model = model($this->_name);
        $mod_pk = $model->getPk();
        $sort = input('param.sort');
        if(!$sort && !$this->sort)
        {
            $sort[$mod_pk] = 'desc';
        }elseif($this->sort){
            $sort = $this->sort;
        }

        $model =  $model->field($this->list_field);
        if ($map) {
            $model = $model->where($map);
        }
        $model->order($sort);
        $pages = '';
        if ($pageSize) {
            $list = $model->paginate($pageSize,false,['query'=>$this->queryData]);//分页
            $pages = $list->render();

        } else {
            $list = $model->select();
        }
        $this->assign('pages', $pages);
        $this->assign('list', $list);
    }

    protected function search()
    {
        return [];
    }

    //添加方法
    public function add()
    {
        $this->checkIsTimeOut();
        return $this->fetch();
    }

    //执行添加操作
    public function addDo()
    {
        $this->checkIsTimeOut();
        $obj = model($this->_name);
        if (request()->isPost()) {
            $data = input('post.');
            $img = $this->uploadImg();
            if ($img) {
                $data['img'] = $img;
            }
            $this->onlyShowAgent && $data['agent_id'] = $this->agentId;
            if ($obj->allowField(true)->save($data)) {
                $msg = $this->errMsg ? $this->errMsg : '添加成功';
                $this->success($msg);
            } else {
                $msg = $this->errMsg ? $this->errMsg : '添加失败';
                $this->error($msg);
            }
        }
    }

    //编辑
    public function edit()
    {
        $obj = model($this->_name);
        $pk = $obj->getPk();
        $id = input($pk);
        if ($id) {
            if ($this->view_del) {//包含软删除数据
                $obj = $obj::withTrashed();
            }
            $info = $obj->find($id);
            $this->assign('info', $info);
            return $this->fetch();
        } else {
           $this->error('参数错误');
        }

    }

    //保存编辑内容
    public function editDo()
    {
        $obj = model($this->_name);
        if (request()->isPost()) {
            $data = input('post.');
            if (!isset($data['id']) || empty($data['id'])) {
                $this->error('参数错误');
            }
            $img = $this->uploadImg();
            if ($img) {
                $data['img'] = $img;
            }
            //allowField 过滤非数据表字段
            $where['id'] = $data['id'];
            $this->onlyShowAgent && $where['agent_id'] = $this->agentId;
            if ($obj->allowField(true)->save($data, $where) || $this->errMsg == true) {
                $msg = $this->errMsg ? $this->errMsg : '编辑成功';
                $this->success($msg);
            } else {
                $msg = $this->errMsg ? $this->errMsg : '请修改后再提交！';
                $this->error($msg);
            }
        }
    }

    /**
     * ajax修改单个字段值
     */
    public function ajaxEdit()
    {
        //AJAX修改数据
        $mod = model($this->_name);
        $pk  = $mod->getPk();
        $id  = input($pk);
        $field = input('param.field');
        $val   = input('param.val');
        $mod->where([$pk => $id])->setField($field, $val);
        return $this->ajaxReturn(1);
    }

    /**
     * 删除
     */
    public function delete()
    {
        $mod = model($this->_name);
        $pk  = $mod->getPk();
        $ids = trim(input($pk), ',');
        if ($ids) {
            $this->onlyShowAgent && $where['agent_id'] = $this->agentId;
            $where[] = ['id','in',$ids];
            if (0 !== $mod::destroy($where, $this->del_true)) {
                $this->success('删除成功');
            } else {
                $msg = $this->errMsg ? $this->errMsg : '删除失败';
                $this->error($msg);
            }
        } else {
            $this->error('参数错误');
        }
    }

    //获取 子菜单
    private function getSubMenu()
    {
        $sub_menu = [];
        $sub_menu = model('agent_menu')->subMenu($this->menuid, $this->big_menu);
        $selected = '';
        if ($sub_menu) {
            $param['menuid'] = $this->menuid;
            if ($this->param_extra) {
                $param = array_merge($param, $this->param_extra);
            }
            foreach ($sub_menu as $key => $val) {
                $sub_menu[$key]['class'] = '';
                if (strpos($val['module_name'],$this->controller_name)!=false && $this->action_name == $val['action_name']) {
                    $sub_menu[$key]['class'] = $selected = 'on';
                }
                $sub_menu[$key]['url'] = url($val['module_name'] . '/' . $val['action_name'], $param) . $val['data'];
            }
            if (empty($selected)) {
                foreach ($sub_menu as $key => $val) {
                    if ($this->controller_name == $val['module_name'] && $this->action_name == $val['action_name']) {
                        $sub_menu[$key]['class'] = 'on';
                        break;
                    }
                }
            }
        }
        $this->assign('sub_menu', $sub_menu);
    }
    /**
     * 异步删除图片
     */
    public function deleteImg(){
        $path  = input('post.path');
        $id    = input('post.id/d',0);
        $field = input('post.field');
        $return['code'] = 0;
        if($path){
            model('attachment')->deleteAttachment('',$path);
            if($id && $field){
                model($this->_name)->save([$field=>''],['id'=>$id]);
            }
            $return['code'] = 1;
        }else{
            $return['msg'] = '参数错误';
        }
        return json($return);
    }
    /**
     * @return \think\response\Json
     * 删除视频
     */
    public function deleteVideo()
    {
        $path  = input('post.path');
        $id    = input('post.id/d',0);
        $field = input('post.field');
        $return['code'] = 0;
        if($path){
            model('attachment')->deleteVideo($path);
            if($id && $field){
                model($this->_name)->save([$field=>''],['id'=>$id]);
            }
            $return['code'] = 1;
        }else{
            $return['msg'] = '参数错误';
        }
        return json($return);
    }
    //异步上传图片
    public function ajaxUploadImg()
    {
        $img = $this->uploadImg();
        if ($img) {
          return $this->ajaxReturn(1, '上传成功', $img);
        } else {
           return $this->ajaxReturn(0, '请选择图片');
        }
    }

    protected function uploadImg()
    {
        $img = '';
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
           try{
               $dir  = $this->agentInfo['company_id'].'/' . strtolower($this->controller_name);
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

    private function checkUser()
    {
        if (!session('agentInfo')) {
            $this->redirect('Login/index');
        }else{
            $this->agentInfo = \org\Crypt::decrypt(session('agentInfo'));
        }
    }
    private function checkIsTimeOut()
    {
        $time = model('agent_company')->where('id',$this->agentId)->value('service_time_end');
        if($time < time())
        {
            exit('您的服务时间已到期，请联系服务商！');
        }
    }
    protected function ajaxReturn($code = 0, $msg = '', $data = '')
    {
        $return['code'] = $code;
        $return['msg']  = $msg;
        $return['data'] = $data;
        return json($return);
    }

    /**
     * @param bool   $isauto        是否是自动验证 默认为手动验证
     * @param array  $data          = array(
     *                              'c'=>要验证的控制器名称
     *                              'a'=>要验证的方法名称
     *                              'str'=>返回的字符串 (其中url请用%s替代 不设置将返回空)
     *                              'replace'=>可选 （如果木有权限的时候返回的提示字符 默认返回无权限）
     *                              'param'=>url参数变量用@id@（固定格式）替代 该参数将会附到url链接中
     *                              )
     *
     * @exclude string; 排除默认列表中的值
     *
     * @param string $returntype    返回的类型 默认返回字符串 取值str|arr arr返回数组
     *
     * @return array|string
     */
    protected function check($isauto = false, $returntype = 'str')
    {
        //如果是自动验证
        $return   = [];
        $editstr  = '<a href="%s" class="layui-btn layui-btn-xs">编辑</a>';
        $editajax = '<a data-height="500" data-width="500" data-id="edit" data-uri="%s" data-title="编辑 - %s" class="J_showDialog layui-btn layui-btn-xs layui-btn-normal" href="javascript:;">编辑</a>';
        $c = $this->controller_name;
        $a = $this->action_name;
        $default = [
            'edit' => [
                'c' => $c,
                'a' => $this->_editAction,
                'str' => '',
                'param' => ['id' => '@id@'],
                'isajax' => $this->_ajaxedit,
                'replace' => ''
            ],
            'delete' => [
                'c' => $c,
                'a' => $this->_delAction,
                'param' => ['id' => '@id@'],
                'str' => '<a data-uri="%s" data-msg="确定要删除 %s 吗？" class="J_confirm layui-btn layui-btn-xs layui-btn-danger" href="javascript:;">删除</a>',
                'isajax' => 1,
                'replace' => ''
            ]
        ];
        $optionarr = ['edit', 'delete'];
        if(is_array($this->_exclude)){
            $dif_arr = array_diff($optionarr,$this->_exclude);
            if(empty($dif_arr))
            {
                $default = [];
            }
        }else{
            if (!empty($this->_exclude) && in_array($this->_exclude, $optionarr)) {
                unset($default[$this->_exclude]);
            }
        }
        if ($isauto) {
            if (!\org\AgentRole::check($c, $a)) {
                $this->error('无权限操作');
            }
        } else {
            if (empty($this->_data)) {
                $data = $default;
            } else {
                $data = array_merge($this->_data, $default);
            }
            //二维数组的处理方法
            foreach ($data as $k => $v) {
                $c = $v['c'];
                $a = $v['a'];
                $param = $v['param'];
                if (!isset($param['menuid'])) {
                    $param['menuid'] = '@menuid@';
                }
                if ($this->param_extra) {
                    $param = array_merge($this->param_extra,$param );
                }
                $str = $k == 'edit' ? ($v['isajax'] == 1 ? $editajax : $editstr) : $v['str'];
                $replace = isset($v['replace']) && !empty($v['replace']) ? $v['replace'] : '无权限';
                if (\org\AgentRole::check($c, $a)) {
                    $return[] = sprintf($str, urldecode(url($c . '/' . $a, $param)), '@name@');
                } else {
                    $return[] = '<span class="disabled-link">' . $replace . '</span>';
                }
            }
            if ($returntype == 'str') {
                $return = implode('', $return);
            }
            return $return;
        }
    }

}
