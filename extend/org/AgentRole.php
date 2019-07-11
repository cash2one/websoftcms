<?php
namespace org;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:04
 */

class AgentRole
{
    /**
     * @param $role_id
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * 根据权限id获取对应的菜单
     */
    public static function getmanagemenu(){
        $agentInfo = \org\Crypt::decrypt( session('agentInfo'));
        $role_id   = $agentInfo['role_id'];
        $obj = model('agent_menu');
        //缓存权限菜单
        $where = ['id'=>$role_id];
        $menu  = cache('agentmenu_'.$role_id);
        $role_ids = model('agent_role')->where($where)->value('rule');
        if(!$menu){
            $map[] = ['id','in',$role_ids];
            $menu = $obj->where($map)->order('ordid asc')->select();
            $menu = cache('agentmenu_'.$role_id,$menu);
        }
        return $menu;
    }

    /**
     * @param string $info
     * @return array
     * 获取一级菜单
     */
    public static function getTopMenu(){
        $menu = self::getmanagemenu();
        $arr  = [];
        foreach($menu as $k=>$v){
            if($v['pid']==0 && $v['display']==1){
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * @param $pid
     * @param bool|false $with_self
     * @return array
     * 获取下级菜单
     */
    public static function getSubMenu($pid,$with_self=false){
        $menu = self::getmanagemenu();
        $subarr = [];
        foreach($menu as $k=>&$v){
            if(($v['pid']==$pid && $v['display']==1) || ($with_self ? $v['menuid']==$pid : '')){
                $v['url'] = url($v['module_name'].'/'.$v['action_name'],['menuid'=>$v['id']]).$v['data'];
                empty($v['icon']) && $v['icon'] = '&#xe63f;';
                $subarr[] = $v;
            }
        }
        return $subarr;
    }

    /**
     * @param string $c 控制器名称
     * @param string $a 方法名称
     * @param string $condigiotn 验证条件
     * @return bool
     */
    public static function check($c='',$a=''){
        $rights = self::getmanagemenu();
        $flag   = FALSE;
        $no_auth_controler = explode('|',strtolower(config('NOT_AUTH_MODULE')));
        $no_auth_action    = explode('|',strtolower(config('NOT_AUTH_ACTION')));
        if(in_array(strtolower($c),$no_auth_controler)) return TRUE;
        foreach($no_auth_action as $action){
            if(FALSE !== strpos(strtolower($a),$action)){
                return TRUE;
            }
        }
        foreach($rights as $v){
            if(strtolower($v['module_name'])==strtolower($c) && strtolower($v['action_name'])==strtolower($a)){
                return TRUE;
            }
        }
        return $flag;
    }
}