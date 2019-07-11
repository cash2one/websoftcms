<?php /*a:4:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/estate/detail.html";i:1540365418;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/peitao.html";i:1544237904;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script>
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {     //移动终端浏览器版本信息
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                    iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            } (),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        };
        if (browser.versions.mobile) {
            window.location.href = "<?php echo config('mobile_domain'); ?>"+window.location.pathname;
        }
    </script>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/common.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/input.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/css.css">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
<!-- topBar S -->
<div class="topBar">
    <div class="comWidth clearfix">
        <div class="logo fl">
            <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">
                <img src="<?php echo htmlentities($site['pc_logo_white']); ?>" alt="<?php echo htmlentities($site['title']); ?>" />
            </a>
        </div>
        <div class="fl sele_city">
            <a href="javascript:;"  class="sele_city_btn"><?php echo htmlentities($cityInfo['name']); ?><img src="/static/home/images/icon/icon15.png" alt="" class="icon"></a>
            <div class="city_list clearfix">
                <i class="city-close">关闭</i>
                <?php if(is_array($top_nav_city['city']) || $top_nav_city['city'] instanceof \think\Collection || $top_nav_city['city'] instanceof \think\Paginator): $i = 0; $__LIST__ = $top_nav_city['city'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <dl class="clearfix">
                    <dt class="bold"><?php echo htmlentities($key); ?></dt>
                    <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <dd <?php if($val['is_hot'] == 1): ?>class="hot"<?php endif; ?>><a href="<?php echo url($controller.'/index@'.$val['domain']); ?>" title="<?php echo htmlentities($val['name']); ?>"><?php echo htmlentities($val['name']); ?></a></dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="navBar fl">
            <ul class="nav_list fl">
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 1): ?>
                <li <?php if($vo['model'] == $cur_url): ?>class="active"<?php endif; ?>>
                    <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"  target="<?php echo htmlentities($vo['open_type']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                    <?php if(isset($vo['_child'])): ?>
                    <ul>
                        <?php if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo htmlentities($val['url']); ?>" title="<?php echo htmlentities($val['title']); ?>" target="<?php echo htmlentities($val['open_type']); ?>"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="log_link fr">
            <?php if(!(empty($userInfo) || (($userInfo instanceof \think\Collection || $userInfo instanceof \think\Paginator ) && $userInfo->isEmpty()))): ?>
            <!-- 已登录状态 -->
            <div class="loged">
                <div class="user_info">
                    <img src="<?php echo getAvatar($userInfo['id'],30); ?>" width="30" height="30" alt="">
                    <span class="name"><?php echo hideStr($userInfo['nick_name']); ?></span>
                </div>
                <div class="slide_tog" style="display:none;">
                    <a href="<?php echo url('user.index/index'); ?>">用户中心</a>
                    <a href="<?php echo url('Login/logout'); ?>">退出登录</a>
                </div>
            </div>
            <?php else: ?>
            <!-- 未登录状态 -->
            <div class="not_log">
                <a href="<?php echo url('Login/index'); ?>">登录</a>
                /
                <a href="<?php echo url('Login/register'); ?>">注册</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- topBar E -->


<!-- 页面标识 S-->
<div class="page_tit">
    <div class="comWidth clearfix">
        <a href="javascript:;" rel="nofollow">您的位置：</a>
        <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt;
        <a href="<?php echo url('Estate/index'); ?>">小区</a> &gt;
        <a href="javascript:void(0);"><?php echo htmlentities($info['title']); ?></a>
    </div>
</div>
<!-- 页面标识 E-->
<!-- 楼盘详情 S-->
<div class="house_detail">
    <div class="comWidth">
        <!-- main_info S -->
        <div class="main_info">
            <div class="con_box clearfix">
                <div class="leftArea">
                    <!-- 轮播图 S -->
                    <div class="l_slide">
                        <ul class="bigImg">
                            <?php if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="javascript:;"><img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['title']); ?>"></a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; else: ?>
                            <li>
                                <a href="javascript:;"><img src="<?php echo htmlentities($info['img']); ?>" alt="<?php echo htmlentities($info['title']); ?>"></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <div class="smallScroll">
                            <a class="sPrev" href="javascript:void(0)">←</a>
                            <div class="smallImg">
                                <ul>
                                    <?php if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li>
                                        <a href="javascript:;"><img src="<?php echo thumb($vo['url'],158,78); ?>" alt="<?php echo htmlentities($vo['title']); ?>"></a>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                    <li>
                                        <a href="javascript:;"><img src="<?php echo thumb($info['img'],158,78); ?>" alt="<?php echo htmlentities($info['title']); ?>"></a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <a class="sNext" href="javascript:void(0)">→</a>
                        </div>
                    </div>
                    <!-- 轮播图 E -->
                </div>
                <div class="rightArea">
                    <div class="hd_box clearfix">
                        <h2 class="fl"><?php echo htmlentities($info['title']); ?></h2>
                        <span class="collect_btn follow fr" data-id="<?php echo htmlentities($info['id']); ?>" data-model="estate" data-uri="<?php echo url('Api/follow'); ?>">关注</span>
                    </div>
                    <div class="price clearfix">
                        <span><strong><?php echo htmlentities($info['price']); ?></strong><?php echo config('filter.second_price_unit'); ?></span>
                    </div>
                    <ul class="col_2_list clearfix">
                        <li>
                            <p class="tit">物业用途：</p>
                            <p class="txt"><?php echo getLinkMenuName(9,$info['house_type']); ?></p>
                        </li>
                        <li>
                            <p class="tit">物业费：</p>
                            <p class="txt"><?php if(!(empty($info['data']['property_fee']) || (($info['data']['property_fee'] instanceof \think\Collection || $info['data']['property_fee'] instanceof \think\Paginator ) && $info['data']['property_fee']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_fee']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">建筑年代：</p>
                            <p class="txt"><?php echo htmlentities($info['years']); ?>年</p>
                        </li>
                        <li>
                            <p class="tit">停车位：</p>
                            <p class="txt"><?php if(!(empty($info['data']['parking_space']) || (($info['data']['parking_space'] instanceof \think\Collection || $info['data']['parking_space'] instanceof \think\Paginator ) && $info['data']['parking_space']->isEmpty()))): ?><?php echo htmlentities($info['data']['parking_space']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">绿化率：</p>
                            <p class="txt"><?php if(!(empty($info['data']['greening_rate']) || (($info['data']['greening_rate'] instanceof \think\Collection || $info['data']['greening_rate'] instanceof \think\Paginator ) && $info['data']['greening_rate']->isEmpty()))): ?><?php echo htmlentities($info['data']['greening_rate']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">总户数：</p>
                            <p class="txt"><?php if(!(empty($info['data']['plan_number']) || (($info['data']['plan_number'] instanceof \think\Collection || $info['data']['plan_number'] instanceof \think\Paginator ) && $info['data']['plan_number']->isEmpty()))): ?><?php echo htmlentities($info['data']['plan_number']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">建筑类型：</p>
                            <p class="txt"><?php if(!(empty($info['data']['building_type']) || (($info['data']['building_type'] instanceof \think\Collection || $info['data']['building_type'] instanceof \think\Paginator ) && $info['data']['building_type']->isEmpty()))): ?><?php echo htmlentities($info['data']['building_type']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">产权年限：</p>
                            <p class="txt"><?php if(!(empty($info['data']['property_right']) || (($info['data']['property_right'] instanceof \think\Collection || $info['data']['property_right'] instanceof \think\Paginator ) && $info['data']['property_right']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_right']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">占地面积：</p>
                            <p class="txt"><?php if(!(empty($info['data']['area_covered']) || (($info['data']['area_covered'] instanceof \think\Collection || $info['data']['area_covered'] instanceof \think\Paginator ) && $info['data']['area_covered']->isEmpty()))): ?><?php echo htmlentities($info['data']['area_covered']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">建筑面积：</p>
                            <p class="txt"><?php if(!(empty($info['data']['area_build']) || (($info['data']['area_build'] instanceof \think\Collection || $info['data']['area_build'] instanceof \think\Paginator ) && $info['data']['area_build']->isEmpty()))): ?><?php echo htmlentities($info['data']['area_build']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">容积率：</p>
                            <p class="txt"><?php if(!(empty($info['data']['volume_ratio']) || (($info['data']['volume_ratio'] instanceof \think\Collection || $info['data']['volume_ratio'] instanceof \think\Paginator ) && $info['data']['volume_ratio']->isEmpty()))): ?><?php echo htmlentities($info['data']['volume_ratio']); else: ?>暂无资料<?php endif; ?></p>
                        </li>
                        <li>
                            <p class="tit">&nbsp;</p>
                            <p class="txt">&nbsp;</p>
                        </li>
                    </ul>
                    <div class="col_1 clearfix">
                        <span class="label">物业公司：</span><span class="desc"><?php if(!(empty($info['data']['property_company']) || (($info['data']['property_company'] instanceof \think\Collection || $info['data']['property_company'] instanceof \think\Paginator ) && $info['data']['property_company']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_company']); else: ?>暂无资料<?php endif; ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">开发商：</span><span class="desc"><?php if(!(empty($info['data']['developer']) || (($info['data']['developer'] instanceof \think\Collection || $info['data']['developer'] instanceof \think\Paginator ) && $info['data']['developer']->isEmpty()))): ?><?php echo htmlentities($info['data']['developer']); else: ?>暂无资料<?php endif; ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">详细位置：</span><span class="desc"><?php echo htmlentities($info['address']); ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">特色标签：</span>
                        <span class="label_list clearfix">
										<?php $tag = array_filter(explode(',',$info['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                        <i class="item item<?php echo htmlentities($i); ?>"><?php echo htmlentities($val); ?></i>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
						</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- main_info E -->
        <!-- 锚链接导航 S -->
        <div class="scroll_nav_wrap">
            <div class="scroll_nav">
                <div class="comWidth clearfix">
                    <ul>
                        <li class="active"><a href="javascript:;">小区简介</a></li>
                        <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?> <li><a href="javascript:;">小区全景</a></li><?php endif; ?>
                        <li><a href="javascript:;">优质二手房</a></li>
                        <li><a href="javascript:;">出租房</a></li>
                        <?php if(!(empty($record) || (($record instanceof \think\Collection || $record instanceof \think\Paginator ) && $record->isEmpty()))): ?><li><a href="javascript:;">成交记录</a></li><?php endif; ?>
                        <li><a href="javascript:;">周边配套</a></li>
                        <li><a href="javascript:;">附近小区</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 锚链接导航 E -->
        <div class="con_wrap clearfix">
            <div class="leftArea cm_leftArea">
                <!-- 小区简介 S -->
                <div class="top_sh_house similar_house floor">
                    <div class="title clearfix">
                        <h2>小区简介</h2>
                    </div>
                    <div class="con_box">
                        <?php echo $info['info']; ?>
                    </div>
                </div>
                <!-- 小区简介 E -->
                <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?>
                <div class="house_general floor">
                    <div class="title clearfix">
                        <h2>小区全景</h2>
                    </div>
                    <div class="desc">
                        <iframe src="<?php echo htmlentities($info['pano_url']); ?>" width="100%" height="550" scrolling="no" frameborder="0"></iframe>
                    </div>
                </div>
                <?php endif; ?>
                <!-- 优质二手房 S -->
                <div class="top_sh_house similar_house floor">
                    <div class="title clearfix">
                        <h2>优质二手房</h2>
                        <a href="<?php echo url('Second/index',['estate_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>二手房" class="more">查看全部二手房</a>
                    </div>
                    <div class="con_box">
                        <ul class="list clearfix">
                            <?php $estate_id=$info['id']; $obj = model("second_house");$obj = $obj->where("estate_id=$estate_id and status=1");$obj = $obj->field("id,title,img,city,room,living_room,acreage,price");$obj = $obj->order("create_time desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('Second/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                    <div class="img">
                                        <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" width="202" height="150" alt="<?php echo htmlentities($data['title']); ?>">
                                        <div class="mask">
                                            <p class="fl name"><?php echo htmlentities($data['title']); ?></p>
                                            <p class="fr address"><?php echo getCityName($data['city']); ?></p>
                                            <div class="opacity"></div>
                                        </div>
                                    </div>
                                    <div class="ft_con clearfix">
                                        <p class="type_area fl"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅-<?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                        <p class="price fr"><?php echo $data['price']; ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 优质二手房 E -->
                <!-- 精品出租房 S -->
                <div class="top_sh_house similar_house floor">
                    <div class="title clearfix">
                        <h2>精品出租房</h2>
                        <a href="<?php echo url('Rental/index',['estate_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>出租房" class="more">查看全部出租房</a>
                    </div>
                    <div class="con_box">
                        <ul class="list clearfix">
                            <?php $obj = model("rental");$obj = $obj->where("estate_id=$estate_id and status=1");$obj = $obj->field("id,title,img,city,room,living_room,acreage,price");$obj = $obj->order("id desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('Rental/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                    <div class="img">
                                        <img src="/status/images/nopic.jpg" data-original="<?php echo htmlentities($data['img']); ?>" class="lazy" width="202" height="150" alt="<?php echo htmlentities($data['title']); ?>">
                                        <div class="mask">
                                            <p class="fl name"><?php echo htmlentities($data['title']); ?></p>
                                            <p class="fr address"><?php echo getCityName($data['city']); ?></p>
                                            <div class="opacity"></div>
                                        </div>
                                    </div>
                                    <div class="ft_con clearfix">
                                        <p class="type_area fl"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅-<?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                        <p class="price fr"><?php echo $data['price']; ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 精品出租房 E -->
                <?php if(!(empty($record) || (($record instanceof \think\Collection || $record instanceof \think\Paginator ) && $record->isEmpty()))): ?>
                <!-- 成交记录 S -->
                <div class="deal_record floor">
                    <div class="title clearfix">
                        <h2>成交记录</h2>
                    </div>
                    <div class="con_box">
                        <table class="table_wrap" width="895" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="25%">户型</th>
                                <th width="25%">面积</th>
                                <th width="25%">成交价</th>
                                <th width="25%">签约时间</th>
                            </tr>
                            <?php if(is_array($record) || $record instanceof \think\Collection || $record instanceof \think\Paginator): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo htmlentities($vo['title']); ?></td>
                                <td><?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></td>
                                <td><?php echo htmlentities($vo['price']); ?>万</td>
                                <td><?php echo htmlentities($vo['complate_time']); ?></td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>
                    </div>
                </div>
                <!-- 成交记录 E -->
                <?php endif; ?>
            </div>
            <div class="rightArea cm_rightArea ">
                <!-- 推荐房源 S -->
                <div class="rcmd_house mt_73 ">
                    <div class="title">
                        <h3>推荐房源</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <ul class="clearfix">
                            <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('Second/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                    <div class="img">
                                        <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                                    </div>
                                    <div class="con">
                                        <div class="row clearfix">
                                            <p class="type_area fl"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅-<?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                            <p class="price fr"><?php echo htmlentities($vo['price']); if($vo['price'] > 0): ?><?php echo config('filter.second_price_unit'); ?><?php endif; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 推荐房源 E -->
            </div>
        </div>
        <!-- con_wrap -->
        <div class="con_wrap">
            <!-- 周边配套 S-->
            <div class="near_support clearfix floor">
    <div class="title clearfix">
        <h2>周边配套</h2>
    </div>
    <div class="con_box clearfix">
        <div class="l_box map fl" id="map">

        </div>
        <div class="r_box support_con fr">
            <ul class="nav clearfix map-nav">
                <li>
                    <a href="javascript:;" class="active" search-flag="bus">公交</a>
                </li>
                <li>
                    <a href="javascript:;" search-flag="school"> 教育</a>
                </li>
                <li>
                    <a href="javascript:;" search-flag="hospital">医疗</a>
                </li>
                <li>
                    <a href="javascript:;" search-flag="shopping">购物</a>
                </li>
                <li>
                    <a href="javascript:;" search-flag="life">生活</a>
                </li>
                <li>
                    <a href="javascript:;" search-flag="entertainment">娱乐</a>
                </li>
            </ul>

            <ul class="info_list clearfix"  id="result">
                <li>
                    <div class="l_con fl">
                        <h5 class="tit">
                            <i class="digit"></i>
                            <span class="text"></span>
                        </h5>
                    </div>
                    <div class="r_con fr">
                        <p class="distance"></p>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=<?php echo config('baidu_map_ak'); ?>"></script>
<script src="/static/js/peitao.js"></script>
<script>
    var lng = '<?php echo htmlentities($info['lng']); ?>';
    var lat = '<?php echo htmlentities($info['lat']); ?>';
    var streetView = 0;
    BMapApplication.title    = "<?php echo htmlentities($info['title']); ?>";
    BMapApplication.saleStatus = "<?php echo htmlentities((isset($info['sale_status']) && ($info['sale_status'] !== '')?$info['sale_status']:1)); ?>";
    BMapApplication.init({'lng' : lng, 'lat' : lat, 'mapContainerId' : 'map'});
    BMapApplication.getAreaMap('公交', 'bus');
    $('.map-nav a').click(function (evt){
        $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
        var iElem = $(this);
        BMapApplication.getAreaMap(iElem.text(), iElem.attr('search-flag'));
        evt.stopPropagation();
    });
</script>
            <!-- 周边配套 E-->
            <!-- 附近小区 S -->
            <div class="similar_house near_cmnt floor">
                <div class="title clearfix">
                    <h2>附近小区</h2>
                </div>
                <div class="con_box">
                    <ul class="list clearfix">
                        <?php if(is_array($near_by_estate) || $near_by_estate instanceof \think\Collection || $near_by_estate instanceof \think\Paginator): $i = 0; $__LIST__ = $near_by_estate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('Estate/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                <div class="img">
                                    <img src="/static/images/nopic.jpg" data-original="<?php echo htmlentities($vo['img']); ?>" class="lazy" alt="<?php echo htmlentities($vo['title']); ?>">

                                </div>
                                <div class="ft_con clearfix">
                                    <p class="type_area fl"><?php echo htmlentities($vo['title']); ?></p>
                                    <p class="price fr"><strong><?php echo htmlentities($vo['price']); ?></strong><?php echo config('filter.second_price_unit'); ?></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </div>
            </div>
            <!-- 附近小区 E -->
        </div>
    </div>
</div>
<!-- 楼盘详情 E-->

<!-- 楼盘列表 S-->
<script type="text/javascript" src="/static/home/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/static/home/js/scroll_nav.js"></script>
<script type="text/javascript" src="/static/home/js/l_slide.js"></script>

<div class="footer">
    <div class="comWidth">
    <div class="link_box clearfix">
        <div class="leftArea">
            <div class="house_link clearfix">
                <a href="<?php echo url('House/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>新楼盘</a>
                <a href="<?php echo url('Estate/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手小区</a>
                <a href="<?php echo url('Second/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手房</a>
                <a href="<?php echo url('Rental/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>出租房</a>
            </div>
            <?php if($controller == 'index'): ?>
            <div class="tab_link clearfix">
                <a href="javascript:;" style="text-decoration: none;">友情链接：</a>
                <?php $obj = model("link");$obj = $obj->where("cate_id=1 and status=1 and city = $cityId");$obj = $obj->field("name,url");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(40)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo htmlentities($data['url']); ?>" target="_blank" title="<?php echo htmlentities($data['name']); ?>"><?php echo htmlentities($data['name']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php else: ?>
            <div class="tab_link clearfix" style="margin-top:10px;">
                <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("house");$obj = $obj->where("$where_str");$obj = $obj->field("id,title");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(50)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('House/detail',['id'=>$data['id']]); ?>" target="_blank" title="<?php echo htmlentities($data['title']); ?>"><?php echo htmlentities($data['title']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php endif; ?>
            <div class="other_link">
                <?php $n = 0; if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 2): $n++; ?>
                <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <a href="<?php echo url('agent/Login/index@agent'); ?>">代理登录</a>
                <a href="javascript:;">服务热线：<?php echo htmlentities($site['telphone']); ?></a>
            </div>
        </div>
        <div class="rightArea">
            <div class="ewm">
                <img src="<?php echo htmlentities($site['weixin_qrcode']); ?>" width="140" height="140" alt="" class="img">
                <p>官方微信公众号</p>
            </div>
        </div>
    </div>
    <div class="bottom">
        <p>地址：<?php echo htmlentities($site['address']); ?> </p>
        <p>版权所有 &copy;2009-<?php echo date('Y'); ?> <?php echo htmlentities($site['company_name']); ?> All Rights Reserved. <?php echo $site['icp']; ?></p>
    </div>
</div>
<div class="scroll-top" id="scroll-top">
    <span class="text">返回顶部</span>
    <span class="ico"></span>
</div>
<?php echo $site['pc_js']; ?>
<script>
    $(function(){
        var h = $(window).height();
        $(document).on('scroll',function(){
            var top=$(document).scrollTop();
            if(top > h)
            {
                $("#scroll-top").show();
            }else{
                $("#scroll-top").hide();
            }
        });
        $("#scroll-top").on('click',function(){
            $('body,html').animate({scrollTop:0},300);
        })
    });
</script>
</div>
<script src="/static/js/plugins/jquery.lazyload.js"></script>
<script type="text/javascript" src="/static/home/js/common.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script>
    $("img.lazy").lazyload({
        threshold : 100,
        effect : "fadeIn"
        //event: "scrollstop"
    });
    $(function(){
       $('.follow').on('click',function(){
           var house_id = $(this).data('id'),model = $(this).data('model'),url = $(this).data('uri'),me = $(this);
           $.post(url,{house_id:house_id,model:model},function(result){
               if(result.code == 1)
               {
                   layer.msg(result.msg,{icon:1});
                   if(me.hasClass('on'))
                   {
                       me.removeClass('on').text(result.text);
                   }else{
                       me.addClass('on').text(result.text);
                   }
               }else{
                   layer.msg(result.msg,{icon:2});
               }
           });
       });
    });
</script>
</body>
</html>