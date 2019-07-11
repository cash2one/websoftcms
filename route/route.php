<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
Route::domain('admin','manage');
Route::domain(config('url_domain_root'),'home');
Route::domain('m','mobile');
Route::domain('api','api');
Route::domain('192.168.0.101','api');
Route::domain('agent','agent');
Route::domain('*','home');
return [

];
