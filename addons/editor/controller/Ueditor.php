<?php

/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2017/12/18
 * Time: 16:28
 * Ueditor.php
 * version:v3.0.0
 */
namespace addons\editor\controller;
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ERROR);
class Ueditor
{
    public function index()
    {
        $up = new \ueditor\upload\Upload();
        $up->pre_fix  = false;
        $up->option();
    }
    public function install()
    {
        return true;
    }
    public function uninstall()
    {
        return true;
    }
}