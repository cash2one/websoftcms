<?php
namespace app\common\model;
/**
 * Created by PhpStorm.
 * User: zzlin
 * Date: 2016/9/18
 * Time: 10:36
 */
class AgentMenu extends \think\Model
{
    public function adminMenu($pid, $with_self=false) {
        $pid = intval($pid);
        $menus = \org\AgentRole::getSubMenu($pid);
        return $menus;
    }

    public function subMenu($pid = '', $big_menu = false) {
        $array = $this->adminMenu($pid, false);
        $numbers = count($array);
        if ($numbers==0 && !$big_menu) {
            return '';
        }
        return $array;
    }
}