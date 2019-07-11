<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/7/3
 * Time: 16:51
 * api.php
 * version:v3.0.0
 */
Route::domain('api', function () {
    Route::get('api/url','api/url/index');//全景相册链接
    Route::post('api/sms','api/sms/index');//短信
    Route::resource('api/subscribe','api/subscribe')->only(['index','save']);//预约报名
    Route::resource('api/question','api/question')->only(['save']);//提交问题
    Route::resource('api/index','api/index')->only(['index']);//首页
    Route::resource('api/house','api/house')->only(['index','read']);//新房
    Route::get('api/house_attr','api/house/houseAttr');//新房筛选条件
    Route::get('api/house/photo','api/house/photo');//新房相册
    Route::get('api/house/news','api/house/news');//新房资讯
    Route::get('api/house/room','api/house/room');//在售户型
    Route::get('api/house/question','api/house/question');//问答列表
    Route::get('api/house/answer','api/house/questionDetail');//回答列表
    Route::get('api/house_photo_cate','api/house/photoCate');//相册分类

    Route::resource('api/broker','api/broker')->only(['index','read']);//经纪人
    Route::get('api/broker_second','api/broker/second');
    Route::get('api/broker_rental','api/broker/rental');
    Route::get('api/broker_comment','api/broker/comment');

    Route::resource('api/office','api/office')->only(['index','read']);//写字楼
    Route::get('api/office_attr','api/office/officeAttr');//字字楼筛选条件

    Route::resource('api/office_rental','api/officeRental')->only(['index','read']);//写字楼
    Route::get('api/office_rental_attr','api/officeRental/officeAttr');//字字楼筛选条件

    Route::resource('api/shops','api/shops')->only(['index','read']);//商铺出售
    Route::get('api/shops_attr','api/shops/shopsAttr');//商铺出售

    Route::resource('api/shops_rental','api/shopsRental')->only(['index','read']);//商铺出租
    Route::get('api/shops_rental_attr','api/shopsRental/shopsAttr');//商铺出租筛选条件

    Route::resource('api/second','api/second')->only(['index','read']);//二手房
    Route::get('api/second_attr','api/second/secondAttr');//二手房筛选条件
    Route::resource('api/rental','api/rental')->only(['index','read']);//出租房
    Route::get('api/rental_attr','api/rental/rentalAttr');//出租房筛选条件
    Route::resource('api/estate','api/estate')->only(['index','read']);//小区
    Route::get('api/estate_attr','api/estate/estateAttr');//小区筛选条件
    Route::resource('api/group','api/group')->only(['index','read']);//团购
    Route::resource('api/article','api/news')->only(['index','read']);//文章
    Route::get('api/article/cate','api/news/cate');//文章分类
    Route::resource('api/city','api/city')->only(['index']);//首页城市切换
    Route::post('api/login','api/login/index');//登录
    Route::post('api/logout','api/login/logout');//退出登录
    Route::post('api/register','api/login/register');//注册
    Route::get('api/register/setting','api/login/getSetting');//获取用户配置
    /**
     * 用户中心
     */
    Route::rule('api/upload','api/upload/index');//图片上传
    Route::resource('api/user/info','api/user.userInfo')->only(['index','save']);//编辑资料
    Route::post('api/user/update_password','api/user.userInfo/updatePassword');//修改密码
    Route::get('api/search/house_attr','api/search/getHouseAttr');//二手房、出租房属性
    Route::post('api/publish/save_second','api/user.publish/saveSecond');//保存二手房
    Route::post('api/publish/save_rental','api/user.publish/saveRental');//保存出租房
    Route::rule('api/publish/delete','api/user.publish/delete');//删除房源
    Route::get('api/resources/second','api/user.resources/second');//二手房列表
    Route::get('api/resources/rental','api/user.resources/rental');//出租房列表
    Route::get('api/resources/read_second','api/user.resources/readSecond');//二手房编辑页
    Route::get('api/resources/read_rental','api/user.resources/readRental');//出租房编辑页
    Route::post('api/upload_avatar','api/user.upload/index');//上传头像
    /**模糊搜索**/
    Route::get('api/search/index','api/search/index');
    Route::get('api/search/second','api/search/second');
    Route::get('api/search/rental','api/search/rental');
    Route::get('api/search/estate','api/search/estate');
    Route::get('api/search/office','api/search/office');
    Route::get('api/search/office_rental','api/search/officeRental');
    Route::get('api/search/shops','api/search/shops');
    Route::get('api/search/shops_rental','api/search/shopsRental');
})->crossDomainRule();