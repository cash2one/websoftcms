<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/6/1
 * Time: 9:52
 * Filter.php
 * version:v3.0.0
 */

namespace app\common\model;


class Filter extends \think\Model
{
    protected $type = [
        'values'    => 'json'
    ];
    public function createFile()
    {
        $data = $this->column('values','keys');
        if($data)
        {
            foreach($data as &$v)
            {
                $v = json_decode($v,true);
            }
            //生成文件
            $file_path = env('root_path').'config/filter.php';
            @file_put_contents($file_path, "<?php \nreturn " . stripslashes(var_export($data, true)) . ";", LOCK_EX);
        }
    }
}