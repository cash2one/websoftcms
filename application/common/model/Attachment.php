<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/6/5
 * Time: 14:46
 * Attachment.php
 * version:v3.0.0
 */

namespace app\common\model;


class Attachment extends \think\Model
{
    /**
     * @param $info 富文本中的图片
     * @param $file 上传的多图片
     * 删除附件
     */
    public function deleteAttachment($info,$img = '',$file = '')
    {
        //获取要删除的图片名称
        $data  = $this->getFileMd5($info,$file,$img);
        //根据图片名称 删除
        $lists = $this->where('name','in',$data)->field('hash,url,save_space')->select();
        $tmp = [];
        if($lists)
        {
            if($this->where('name','in',$data)->delete())
            {
                foreach($lists as $v)
                {
                    if($v['save_space'] == 2)
                    {
                        $tmp[] = $v['url'];
                    }else{
                        //本地删除
                        (is_file('.'.$v['url'])) && @unlink('.'.$v['url']);
                        \think\facade\Log::write(date("Y-m-d H:i:s").'-'.request()->ip().$v['url'],'error');
                    }
                }

                if(!empty($tmp))
                {
                    //从云存储删除文件
                    $storage = new \org\Storage();
                    $storage->delete($tmp);
                    \think\facade\Log::write(date("Y-m-d H:i:s").'-'.request()->ip().json_encode($tmp),'error');
                }
            }

        }
    }

    /**
     * @param $data
     * 删除视频
     */
    public function deleteVideo($data)
    {
        $storage = new \org\Storage();
        $storage->delete($data);
    }
    private function getFileMd5($info,$file,$img)
    {
        $info_data = $this->filterContent($info);
        $temp = [];
        if($file)
        {
            if(is_string($file))
            {
                if(strpos($file,'://')===false){
                    $file = '.'.$file;
                }
                $temp[] =  @basename($file);
            }else{
                foreach($file as $v)
                {
                    if(strpos($v['url'],'://')===false){
                        $v['url'] = '.'.$v['url'];
                    }
                    $temp[] =  @basename($v['url']);
                }
            }
        }
        $data = array_merge($info_data,$temp);
        if(strpos($img,'://') === false)
        {
            $img = '.'.$img;
        }
        $data[] = @basename($img);
        return $data;
    }
    protected function filterContent($info){
        $ext = 'gif|jpg|jpeg|bmp|png';
        $temp = [];
        if(preg_match_all("/(href|src)=([\"|']?)([^ \"'>]+\.($ext))\\2/i", $info, $matches)){
            if(!empty($matches[3])){
                foreach($matches[3] as $v){
                    if(strpos($v,'://')===false){
                        $v = '.'.$v;
                    }
                    $temp[] = @basename($v);
                }
            }
        }
        return $temp;
    }
}