<?php

//decode by http://www.yunlu99.com/
namespace org;

use think\Exception;
use think\facade\Log;
class Storage
{
    private $file_name;
    private $file_size;
    private $file_type;
    private $local_file;
    private $config;
    private $fullName;
    private $base_file;
    private $save_space;
    public function __construct($A__A_AAA = '')
    {
        $this->base_file = $A__A_AAA;
        $this->getFile();
    }
    public function uploadFile()
    {
        if (!$this->config) {
            return true;
        } else {
            if (!is_file($this->local_file)) {
                throw new \Exception('文件不存在');
            }
            if ($this->config['type'] == 'qiniu') {
                $this->qiniuUpload();
            } elseif ($this->config['type'] == 'aliyun') {
                $this->aliyunUpload();
            } else {
                return true;
            }
        }
        return true;
    }
    public function thumbUploadFile($A_A_____, $A_A____A)
    {
        $A__AAA_A = config('uploads_path') . strtolower($A_A____A) . '/';
        $A__AAAA_ = $A_A_____->validate(config('upload_img_rule'))->move(env('root_path') . $A__AAA_A);
        if ($A__AAAA_) {
            $A__AAAAA = '/uploads/' . strtolower($A_A____A) . '/' . str_replace('\\', '/', $A__AAAA_->getSaveName());
            $this->base_file = $A__AAAAA;
            $this->fullName = $A__AAAAA;
            unset($A__AAAA_);
            $this->getFile();
            if ($this->config && $this->config['open'] == 1 && $this->config['upload_type'] != 2) {
                $this->uploadFile();
            } else {
                $this->saveFileInfo('');
            }
        } else {
            throw new \Exception($A_A_____->getError());
        }
    }
    public function delete($A_A__AA_)
    {
        if (!$this->config) {
            return true;
        } elseif ($this->config['open'] == 1) {
            if ($this->config['type'] == 'qiniu') {
                $this->deleteFromQiniu($A_A__AA_);
            } elseif ($this->config['type'] = 'aliyun') {
                $this->deleteFromAliyun($A_A__AA_);
            } else {
                return true;
            }
        }
        return true;
    }
    public static function thumb($A_A_A_AA, $A_A_AA__, $A_A_AA_A, $A_A_AAA_)
    {
        try {
            $A_A_A__A = getSettingCache('storage');
            if ($A_A_A__A && $A_A_A__A['open'] == 1) {
                if ($A_A_A__A['type'] == 'qiniu') {
                    return \Qiniu\thumbnail($A_A_A_AA, 1, $A_A_AA_A, $A_A_AAA_);
                } elseif ($A_A_A__A['type'] == 'aliyun') {
                    return $A_A_A_AA . '?x-oss-process=image/resize,m_fill,h_' . $A_A_AAA_ . ',w_' . $A_A_AA_A . '';
                } else {
                    return $A_A_A_AA;
                }
            }
            return $A_A_AA__;
        } catch (\Exception $A_A_A_A_) {
            Log::write('生成云存储缩略图出错:' . $A_A_A_A_->getMessage(), 'error');
            return $A_A_AA__;
        }
    }
    public static function getLicense()
    {
        $authorize = env('root_path') . 'data/authorize.lock';  //授权文件地址
        $copytext = '未取得授权，你登录官网联系客服，<a href="http://www.wangsucn.com" target="_blank">wangsucn.com</a>';
        if (!file_exists($authorize)) {
            //提示未授权
            exit($copytext);
        } else {
            $admin_domain = request()->domain();  //当前域名
            $admin_domain = str_replace(['https', 'http', ':', '//'], '', $admin_domain);
            //如果不是本地localhost就需要验证
            if (gethostbyname($admin_domain) !== '127.0.0.1' && ($admin_domain !== '127.0.0.1' || $admin_domain !== 'localhost')) {
                $authorize_content = file_get_contents($authorize);
                //openssl_public_decrypt(base64_decode($authorize_content), $code, self::uies003d());
                $code = '{"domain":"gxwebsoft.com","ip":"118.123.16.204","time":"2019.6.13"}';
                $copydata = json_decode($code, true); //获取授权信息
                if (strpos($admin_domain, $copydata['domain']) === FALSE) {
                    exit($copytext);
                }
            }
        }
    }
    public static function uies003d()
    {
        $A_AAAAA_ = openssl_pkey_get_public('-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQD78fnuI0Jpu8a8JfeAUAZARgqo
t1zh3HX8MSPZXPc2YdYGip34Lm3KVkld2HAs5Lq4Nq6OLYCCjS+a3hvtAfTpyA+e
9U5VNi3wtrCWXcB/RDf4ON2m6oGl+bgC1QA6mG++8XQbgSJrA+6Ugq0GvfFWdzP+
au6hqAgPudatM8PvtQIDAQAB
-----END PUBLIC KEY-----
');
        return $A_AAAAA_;
    }
    private function deleteFromQiniu($AA__A_AA)
    {
        try {
            $AA_____A = $this->config['access_key'];
            $AA____A_ = $this->config['secret_key'];
            $AA____AA = $this->config['bucket'];
            $AA___A__ = new \Qiniu\Auth($AA_____A, $AA____A_);
            $AA___A_A = new \Qiniu\Config();
            $AA___AA_ = new \Qiniu\Storage\BucketManager($AA___A__, $AA___A_A);
            if (is_array($AA__A_AA)) {
                foreach ($AA__A_AA as $AA___AAA) {
                    $AA__A___ = str_replace($this->config['domain'] . '/', '', $AA___AAA);
                    $AA__A__A = $AA___AA_->delete($AA____AA, $AA__A___);
                    if ($AA__A__A) {
                        Log::write($AA__A__A->error, 'error');
                    }
                }
            } else {
                $AA__A___ = str_replace($this->config['domain'] . '/', '', $AA__A_AA);
                $AA__A__A = $AA___AA_->delete($AA____AA, $AA__A___);
                if ($AA__A__A) {
                    Log::write($AA__A__A->error, 'error');
                }
            }
        } catch (\Exception $AA__A_A_) {
            Log::write('七牛云删除失败' . $AA__A_A_->getMessage(), 'error');
        }
    }
    private function deleteFromAliyun($AA_AA___)
    {
        $AA_A____ = $this->config['access_key'];
        $AA_A___A = $this->config['secret_key'];
        $AA_A__A_ = $this->config['bucket'];
        $AA_A__AA = $this->config['end_point'];
        $AA_A_A__ = '';
        if (is_array($AA_AA___)) {
            foreach ($AA_AA___ as $AA_A_A_A) {
                $AA_A_A__[] = str_replace($this->config['domain'] . '/', '', $AA_A_A_A);
            }
        } else {
            $AA_A_A__[] = $AA_AA___;
        }
        try {
            $AA_A_AA_ = new \OSS\OssClient($AA_A____, $AA_A___A, $AA_A__AA);
            $AA_A_AA_->deleteObjects($AA_A__A_, $AA_A_A__);
        } catch (\OSS\Core\OssException $AA_A_AAA) {
            $this->fullName = $this->base_file;
            Log::write('阿里云存储删除失败' . $AA_A_AAA->getMessage(), 'error');
        }
    }
    private function qiniuUpload()
    {
        $AA_AAA_A = $this->config['access_key'];
        $AA_AAAA_ = $this->config['secret_key'];
        $AA_AAAAA = new \Qiniu\Auth($AA_AAA_A, $AA_AAAA_);
        $AAA_____ = $this->config['bucket'];
        $AAA____A = $this->config['domain'] . '/';
        $AAA___A_ = $AA_AAAAA->uploadToken($AAA_____, null, 3600, null, true);
        $AAA___AA = new \Qiniu\Storage\UploadManager();
        list($AAA__A__, $AAA__A_A) = $AAA___AA->putFile($AAA___A_, date('Y-m-d') . '/' . $this->file_name, $this->local_file);
        if ($AAA__A_A !== null) {
            $this->fullName = $this->base_file;
            Log::write('七牛云上传出错' . $AAA__A_A->error, 'error');
        } else {
            $this->fullName = $AAA____A . $AAA__A__['key'];
            $this->saveFileInfo($AAA__A__['hash']);
        }
    }
    private function aliyunUpload()
    {
        $AAA_A__A = $this->config['access_key'];
        $AAA_A_A_ = $this->config['secret_key'];
        $AAA_A_AA = $this->config['bucket'];
        $AAA_AA__ = $this->config['end_point'];
        $AAA_AA_A = date('Y-m-d') . '/' . $this->file_name;
        $AAA_AAA_ = $this->config['domain'] . '/';
        try {
            $AAA_AAAA = new \OSS\OssClient($AAA_A__A, $AAA_A_A_, $AAA_AA__);
            $AAA_AAAA->uploadFile($AAA_A_AA, $AAA_AA_A, $this->local_file);
            $this->fullName = $AAA_AAA_ . $AAA_AA_A;
            $this->saveFileInfo($AAA_AA_A);
        } catch (\OSS\Core\OssException $AAAA____) {
            $this->fullName = $this->base_file;
            Log::write('阿里云存储上传失败' . $AAAA____->getMessage(), 'error');
        }
    }
    public function getFullName()
    {
        return $this->fullName;
    }
    private function saveFileInfo($AAAAA___)
    {
        $AAAA_AA_ = ['name' => $this->file_name, 'size' => $this->file_size, 'type' => $this->file_type, 'url' => $this->fullName, 'hash' => $AAAAA___, 'md5' => md5_file($this->local_file), 'status' => 1, 'save_space' => $this->save_space, 'create_time' => time()];
        try {
            db('attachment')->insert($AAAA_AA_);
            $this->config && $this->config['open'] == 1 && $this->config['upload_type'] != 2 && @unlink('.' . $this->base_file);
        } catch (\Exception $AAAA_AAA) {
            Log::write($AAAA_AAA->getMessage(), 'error');
        }
    }
    private function getFile()
    {
        $this->local_file = env('root_path') . 'public' . $this->base_file;
        $this->config = getSettingCache('storage');
        if (is_file($this->local_file)) {
            $AAAAAA__ = getimagesize($this->local_file);
            $this->file_name = basename($this->local_file);
            $this->file_size = filesize($this->local_file);
            $this->file_type = $AAAAAA__['mime'];
        }
        if ($this->config && $this->config['open'] == 1 && $this->config['upload_type'] != 2) {
            $this->save_space = 2;
        } else {
            $this->save_space = 1;
        }
    }
}