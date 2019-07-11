<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/5/21
 * Time: 8:29
 * Upgrade.php
 * version:v3.0.0
 */

namespace app\manage\controller;

set_time_limit(0);
class Upgrade
{
    private $file_name = 'upgrade.zip';
    /**
     * @return \think\response\Json
     * 在线升级
     */
    public function index()
    {
        $is_download = cache('file_download');
        $url     = input('get.uri');
        $data['code'] = 1;
        if($is_download && $is_download['download'] != 0)
        {
            $data['code'] = 0;
            $data['msg']  = '请稍候，有文件正在下载中……';
        }elseif(file_exists(env('root_path').$this->file_name)){
            $data['code'] = 100;
        }else{
            $this->download($url,env('root_path').$this->file_name);
            $data['code'] = 200;
        }
        return json($data);
    }

    /**
     * 解压升级包
     */
    public function decompression()
    {
        $file = env('root_path').$this->file_name;
        $return['code'] = 0;
        if(!file_exists($file))
        {
            $return['msg'] = '升级包不存在';
        }else{
            $zip = new \ZipArchive();
            $res = $zip->open($file);
            if($res === true){
                try{
                    $zip->extractTo(env('root_path'));
                    $zip->close();
                    $return['code'] = 1;
                    $return['msg']    = "升级成功";
                    $this->executeSql();//执行升级sql文件
                    @unlink($file);
                }catch(\Exception $e){
                    \think\facade\Log::write($e->getMessage(),'error');
                    $return['msg'] = '升级失败请检查站点下所有目录是否有写入权限！您也可以登录服务器手动解压更新包'.$e->getMessage();
                }
            }else{
                $return['msg'] = '解压缩失败,请手动解压！';
            }
        }
        return json($return);
    }
    /**
     * @return \think\response\Json
     * 取得文件下载进度
     */
    public function getDownloadProgress()
    {
        $data = cache('file_download');
        $rate = ($data && isset($data['total']) && $data['total'] > 0) ? floor(($data['download'] / $data['total']) * 100) : 0;
        $return['code'] = 1;
        $return['data'] = $rate;
        if($rate == 100)
        {
            cache('file_download',null);
        }
        return json($return);
    }
    /**
     * @param $url
     * @param $fileName
     * 下载文件
     */
    private function download($url, $fileName)
    {
        try{
            $ch = curl_init();
            $fp = fopen($fileName, 'wb');
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 900);
            curl_setopt($ch, CURLOPT_NOPROGRESS, false);
            curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'downloadCallback');
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }catch(\Exception $e){
            return json(['code'=>'400','msg'=>$e->getMessage()]);
        }
    }
    /**
     * 执行升级sql文件
     */
    private function executeSql()
    {
        $sql_file = env('root_path').'upgrade.sql';
        if(file_exists($sql_file))
        {
            $content = file_get_contents($sql_file);
            $content = str_replace("\r", "\n", $content);
            $content = explode(";\n", $content);
            $flag    = true;
            foreach ($content as $value) {
                $value = trim($value);
                if(empty($value))
                {
                    continue;
                }
                if(substr($value, 0, 8) == 'DESCRIBE') {
                    $query = db()->query($value);
                    $query && $flag = false;
                }else{
                    if(!$flag)
                    {
                        $flag = true;
                        continue;
                    }
                    db()->execute($value);
                }
            }
            @unlink($sql_file);
        }
    }
}