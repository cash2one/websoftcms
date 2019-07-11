<?php
/**
 * 南宁市网宿信息科技有限公司
 * websoftcms
 * User: zzlin QQ:170083662
 * Date: 2018/2/11
 * Time: 9:42
 * home.php
 * version:v3.0.0
 */
$city   = 1;
$info   = getCityInfoByCityId();
if($info)
{
    $city = $info['id'];
}
Route::group('', function () {
    $alias = '';
    if($domain = getCityInfoByCityId())
    {
        $alias = $domain['domain'].'/';
    }
    // 动态注册域名的路由规则
    Route::get($alias.'loupan-<area>-<metro>-<metro_station>-<price>-<special>-<type>-<status>-<renovation>-<sort>-<discount>-<search_type>', 'House/index')
        ->pattern(['area' => '\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','special'=>'\d+','type'=>'\d+','status'=>'\d+','renovation'=>'\d+','sort'=>'\d+','discount'=>'\d+','search_type'=>'\d+']);
    Route::get($alias.'loupan-news-<house_id>','House/news')->pattern(['house_id'=>'\d+']);
   // Route::get('loupan-room-<house_id>-<room>','House/room')->pattern(['house_id'=>'\d+','room'=>'\d+']);
    Route::get($alias.'loupan-room-detail-<id>','House/roomDetail')->pattern(['id'=>'\d+']);
    Route::get($alias.'loupan-room-<house_id>-<room?>','House/room')->pattern(['house_id'=>'\d+','room'=>'\d+']);
    Route::get($alias.'loupan-photo-<house_id>-<cate_id?>','House/photo')->pattern(['house_id'=>'\d+','cate_id'=>'\d+']);
    Route::get($alias.'loupan-info-<house_id>','House/info')->pattern(['house_id'=>'\d+']);
    Route::get($alias.'loupan-support-<house_id>','House/support')->pattern(['house_id'=>'\d+']);
    Route::get($alias.'loupan-question-<house_id>','House/question')->pattern(['house_id'=>'\d+']);
    Route::get($alias.'loupan-question-detail-<id>','House/questionDetail')->pattern(['id'=>'\d+']);
    Route::get($alias.'loupan-build-<house_id>','House/build')->pattern(['house_id'=>'\d+']);
    Route::get($alias.'loupan-pano-<house_id>','House/pano')->pattern(['house_id'=>'\d+']);
    Route::get($alias.'loupan-s<search_type>','House/index')->pattern(['search_type'=>'\d+']);
    Route::get($alias.'loupan-<id>','House/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'loupan','House/index');

    Route::get($alias.'tuijianloupan-<area>-<price>-<special>-<type>-<status>-<renovation>-<sort>', 'Recommend/index')
        ->pattern(['area' => '\d+','price'=>'\d+','special'=>'\d+','type'=>'\d+','status'=>'\d+','renovation'=>'\d+','sort'=>'\d+']);
    Route::get($alias.'tuijianloupan','Recommend/index');
    //写字楼出售
    Route::get($alias.'xiezilou/shou-<area>-<metro>-<metro_station>-<price>-<acreage>-<type>-<tags>-<sort>-<user_type>-<search_type>','Office/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','type'=>'\d+','tags'=>'\d+','sort'=>'\d+','user_type'=>'\d+','search_type'=>'\d+']);
    Route::get($alias.'xiezilou/shou-s<search_type>','Office/index')->pattern(['search_type'=>'\d+']);

    Route::get($alias.'xiezilou/shou-<id>','Office/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'xiezilou/shou','Office/index');

    //写字楼出租
    Route::get($alias.'xiezilou/zu-<area>-<metro>-<metro_station>-<price>-<acreage>-<type>-<tags>-<sort>-<user_type>-<search_type>','OfficeRental/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','type'=>'\d+','tags'=>'\d+','sort'=>'\d+','user_type'=>'\d+','search_type'=>'\d+']);
    Route::get($alias.'xiezilou/zu-s<search_type>','OfficeRental/index')->pattern(['search_type'=>'\d+']);
    Route::get($alias.'xiezilou/zu-<id>','OfficeRental/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'xiezilou/zu','OfficeRental/index');

    //商铺出售
    Route::get($alias.'shangpu/shou-<area>-<metro>-<metro_station>-<price>-<acreage>-<type>-<tags>-<sort>-<user_type>','Shops/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','type'=>'\d+','tags'=>'\d+','sort'=>'\d+','user_type'=>'\d+']);
    Route::get($alias.'shangpu/shou-<id>','Shops/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'shangpu/shou','Shops/index');

    //商铺出租
    Route::get($alias.'shangpu/zu-<area>-<metro>-<metro_station>-<price>-<acreage>-<type>-<lease_type>-<tags>-<sort>-<user_type>','ShopsRental/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','type'=>'\d+','lease_type'=>'\d+','tags'=>'\d+','sort'=>'\d+','user_type'=>'\d+']);
    Route::get($alias.'shangpu/zu-<id>','ShopsRental/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'shangpu/zu','ShopsRental/index');

    Route::get($alias.'news-<cate>','News/index')->pattern(['cate'=>'\d+']);
    Route::get($alias.'news/<id>','News/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'news','News/index');
    Route::get($alias.'ajaxgetnewslists','News/getNewsLists');
    Route::post($alias.'subscribe','Api/subscribe');
    //二手房
    Route::get($alias.'erf-<area>-<metro>-<metro_station>-<price>-<acreage>-<room>-<type>-<renovation>-<orientations>-<user_type>-<tags>-<sort>-<search_type>-<estate_id?>','Second/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','room'=>'\d+','type'=>'\d+','renovation'=>'\d+','orientations'=>'\d+','user-type'=>'\d+','tags'=>'\d+','sort'=>'\d+','search_type'=>'\d+','estate_id'=>'\d+']);
    Route::get($alias.'erf-s<search_type>','Second/index')->pattern(['search_type'=>'\d+']);
    Route::get($alias.'erf-<id>','Second/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'erf','Second/index');
    //出租房
    Route::get($alias.'chuzu-<area>-<metro>-<metro_station>-<price>-<acreage>-<room>-<type>-<renovation>-<rental_type>-<user_type>-<sort>-<search_type>-<estate_id?>','Rental/index')
        ->pattern(['area'=>'\d+','metro'=>'\d+','metro_station'=>'\d+','price'=>'\d+','acreage'=>'\d+','room'=>'\d+','type'=>'\d+','renovation'=>'\d+','rental_type'=>'\d+','user_type'=>'\d+','sort'=>'\d+','search_type'=>'\d+','estate_id'=>'\d+']);
    Route::get($alias.'chuzu-s<search_type>','Rental/index')->pattern(['search_type'=>'\d+']);
    Route::get($alias.'chuzu-<id>','Rental/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'chuzu','Rental/index');
    //小区
    Route::get($alias.'xiaoqu-<area>-<price>-<years>-<type>-<sort>','Estate/index')->pattern(['area'=>'\d+','price'=>'\d+','years'=>'\d+','type'=>'\d+','sort'=>'\d+']);
    Route::get($alias.'xiaoqu-<id>','Estate/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'xiaoqu','Estate/index');
    //学校
    Route::get($alias.'xuexiao-<area>-<type>','School/index')->pattern(['area'=>'\d+','type'=>'\d+']);
    Route::get($alias.'xuexiao-<id>','School/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'xuexiao','School/index');
    //经纪人
    Route::get($alias.'jinjiren-<area>-<sort>','Broker/index')->pattern(['area'=>'\d+','sort'=>'\d+']);
    Route::get($alias.'jinjiren-erf-<id>','Broker/second')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-chuzu-<id>','Broker/rental')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-xizilou-shou/<id>','Broker/office')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-xizilou-zu/<id>','Broker/officeRental')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-shangpu-shou/<id>','Broker/shops')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-shangpu-zu/<id>','Broker/shopsRental')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-comment-<id>','Broker/comment')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren-<id>','Broker/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'jinjiren','Broker/index');
    Route::get($alias.'question-<id>','Question/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'question-cate-<answer?>','Question/index')->pattern(['answer'=>'\d+']);
    Route::get($alias.'tuangou-<id>','Group/detail')->pattern(['id'=>'\d+']);
    Route::get($alias.'getgrouplists','Group/getGroupLists');
    Route::get($alias.'tuangou','Group/index');
    //单页
    Route::get($alias.'single-<cate>','SinglePage/index')->pattern(['cate'=>'\w+']);
    Route::get($alias.'single','SinglePage/index');
    Route::get(trim($alias,'/'),'Index/index');
})->crossDomainRule()->append(['city'=>$city]);




