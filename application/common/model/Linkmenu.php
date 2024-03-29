<?php
namespace app\common\model;
class Linkmenu extends \think\Model{
    /**
     * 生成spid 
     * 
     * @param int $pid 父级ID
     */
    public function get_spid($pid) {
        if (!$pid) {
            return 0; 
        }
        $pspid = $this->where(['id'=>$pid])->value('spid');
        if ($pspid) {
            $spid = $pspid . $pid . '|';
        } else {
            $spid = $pid . '|';
        }
        return $spid;
    }
    
    /**
     * 获取分类下面的所有子分类的ID集合
     * 
     * @param int $id
     * @param bool $with_self
     * @return array $array 
     */
    public function get_child_ids($id, $with_self=false) {
        $spid = $this->where(['id'=>$id])->value('spid');
        $spid = $spid ? $spid .= $id .'|' : $id .'|';
        $id_arr = $this->field('id')->where([['spid','like', $spid.'%']])->select();
        $array = [];
        foreach ($id_arr as $val) {
            $array[] = $val['id'];
        }
        $with_self && $array[] = $id;
        return $array;
    }
    
    /**
     * 检测分类是否存在
     * 
     * @param string $name
     * @param int $pid
     * @param int $id
     * @return bool 
     */
    public function name_exists($name, $pid, $menuid = 0,$id=0) {
        $where['name'] = $name;
        if($menuid)
        {
            $where['menuid'] = $menuid;
        }
        if($pid){
            $where['pid']  = $pid;
        }
        if($id>0){
            $where[] = ['id','neq',$id];
        }
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}