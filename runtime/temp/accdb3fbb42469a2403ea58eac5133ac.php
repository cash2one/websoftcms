<?php /*a:4:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/second/detail.html";i:1544496166;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/peitao.html";i:1544237904;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<link type="text/css" href="/static/js/photo/css/prettyPhoto.css" rel="stylesheet" />
<link rel="stylesheet" href="/static/storage/qiniuoss/qiniuplayer.min.css">
<!-- 页面标识 S-->
<div class="page_tit">
    <div class="comWidth clearfix">
        <a href="javascript:;" rel="nofollow">您的位置：</a>
        <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
        <a href="<?php echo url('Second/index'); ?>">二手房</a> &gt;
        <a href="javascript:void(0);"><?php echo htmlentities($info['title']); ?></a>
    </div>
</div>
<!-- 页面标识 E-->
<!-- 楼盘详情 S-->
<div class="house_detail">
    <div class="comWidth">
        <!-- main_info S -->
        <div class="main_info">
            <div class="hd_box clearfix">
                <h2 class="fl"><?php echo htmlentities($info['title']); ?></h2>
                <!-- on表示已收藏 -->
                <span class="collect_btn follow fr" data-id="<?php echo htmlentities($info['id']); ?>" data-model="second_house" data-uri="<?php echo url('Api/follow'); ?>">关注房源</span>
            </div>
            <div class="con_box clearfix">
                <div class="leftArea">
                    <!-- 轮播图 S -->
                    <div class="l_slide">
                        <ul class="bigImg">
                            <?php if($storage_open == 1 and $info['video']): ?>
                            <li style="height:396px;">
                                <video id="qiniu-video" class="video-js vjs-big-play-centered"></video>
                            </li>
                            <?php endif; if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
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
                                    <?php if($storage_open == 1 and $info['video']): ?>
                                    <li style="position:relative;">
                                        <a href="javascript:;">
                                            <img src="<?php echo thumb($info['img'],160,80); ?>" alt="视频" />
                                        </a>
                                        <img src="/static/images/video.png" class="video-play" alt="">
                                    </li>
                                    <?php endif; if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li>
                                        <a href="javascript:;"><img src="<?php echo thumb($vo['url'],160,80); ?>" alt="<?php echo htmlentities($vo['title']); ?>"></a>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                    <li>
                                        <a href="javascript:;"><img src="<?php echo thumb($info['img'],160,80); ?>" alt="<?php echo htmlentities($info['title']); ?>"></a>
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
                    <div class="t_box clearfix">
                        <div class="price fl">
                            <span><strong><?php echo $info['price']; ?></strong></span><span>	均价<?php echo $info['average_price']; ?></span>
                        </div>
                        <div class="calc fr">
                            <a href="<?php echo url('Tools/index'); ?>" target="_blank">房贷计算器</a>
                        </div>
                    </div>

                    <ul class="col_3_list clearfix">
                        <li>
                            <p class="tit"><?php echo htmlentities($info['room']); ?>室<?php echo htmlentities($info['living_room']); ?>厅</p>
                            <p class="txt">房型</p>
                        </li>
                        <li>
                            <p class="tit"><?php echo htmlentities($info['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                            <p class="txt">面积</p>
                        </li>
                        <li>
                            <p class="tit"><?php echo getLinkMenuName(4,$info['orientations']); ?></p>
                            <p class="txt">朝向</p>
                        </li>
                        <li>
                            <p class="tit"><?php echo getLinkMenuName(8,$info['renovation']); ?></p>
                            <p class="txt">装修</p>
                        </li>
                        <li>
                            <p class="tit"><?php echo getLinkMenuName(7,$info['floor']); ?>/<?php echo htmlentities($info['total_floor']); ?></p>
                            <p class="txt">楼层</p>
                        </li>
                        <li>
                            <p class="tit"><?php echo getLinkMenuName(9,$info['house_type']); ?></p>
                            <p class="txt">类型</p>
                        </li>
                    </ul>
                    <div class="col_1 clearfix">
                        <span class="label">小区 : </span><span class="desc"><?php echo htmlentities($estate['title']); ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">位置 : </span><span class="desc"><?php echo htmlentities($info['address']); ?></span>
                    </div>
                    <div class="agent_info clearfix" style="margin-top:30px;">
                        <img src="<?php echo getAvatar($info['broker_id'],90); ?>" width="90" height="90" alt="" class="per_img fl">
                        <div class="c_con fl">
                            <div class="row clearfix">
                                <p class="name fl"><?php echo htmlentities($info['contacts']['contact_name']); ?></p>
                                <!--ul class="star_list fl">
                                    <li class="on"></li>
                                    <li class="on"></li>
                                    <li class="on"></li>
                                    <li class="on"></li>
                                    <li class="off"></li>
                                </ul-->
                            </div>
                            <div class="row">
                                <p class="phone"><?php echo htmlentities($info['contacts']['contact_phone']); ?></p>
                            </div>
                        </div>
                        <div class="r_con fr">
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo htmlentities($qq[0]); ?>&site=qq&menu=yes" target="_blank" class="btn consult">在线咨询</a>
                            <a href="javascript:void(0);" class="btn appoint J_dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="second_house" data-type="1" data-uri="<?php echo url('Dialog/subscribe'); ?>">预约看房</a>
                        </div>
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
                        <li class="active"><a href="javascript:;">房源概况</a></li>
                        <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?> <li><a href="javascript:;">全景看房</a></li><?php endif; ?>
                        <li><a href="javascript:;">房源照片</a></li>
                        <li><a href="javascript:;">小区简介</a></li>
                        <li><a href="javascript:;">周边配套</a></li>
                        <li><a href="javascript:;">同小区房源</a></li>
                        <li><a href="javascript:;">你可能感兴趣的房源</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 锚链接导航 E -->
        <div class="con_wrap clearfix">
            <div class="leftArea cm_leftArea">
                <!-- 房源概况 S-->
                <div class="house_general floor">
                    <div class="title clearfix">
                        <h2>房源概况</h2>
                    </div>
                    <div class="house_support clearfix">
                        <h4>房屋配套</h4>
                        <ul>
                            <?php $val = getLinkMenuCache(12); $support = array_filter(explode(',',$info['supporting'])); if(is_array($support) || $support instanceof \think\Collection || $support instanceof \think\Paginator): $i = 0; $__LIST__ = $support;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <div class="icon_img">
                                    <img src="/static/home/images/icon2/<?php echo htmlentities($val[$vo]['alias']); ?>.png" alt="" class="icon">
                                </div>
                                <p><?php echo htmlentities($val[$vo]['name']); ?></p>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="bright_sopt clearfix">
                        <h4>房屋介绍</h4>
                        <div class="desc">
                            <?php echo $info['info']; ?>
                        </div>
                    </div>
                </div>
                <!-- 房源概况 E-->
                <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?>
                <div class="house_general floor">
                    <div class="title clearfix">
                        <h2>全景看房</h2>
                    </div>
                    <div class="desc">
                        <iframe src="<?php echo htmlentities($info['pano_url']); ?>" width="100%" height="550" scrolling="no" frameborder="0"></iframe>

                    </div>
                </div>
                <?php endif; ?>
                <!-- 房源照片 S-->
                <div class="house_picture floor">
                    <div class="title clearfix">
                        <h2>房源照片</h2>
                    </div>
                    <ul class="list list_box clearfix" id="photo">
                        <?php if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>" rel="prettyPhoto[]">
                                <img src="/static/images/nopic.jpg" data-original="<?php echo thumb($vo['url'],430,250); ?>" class="lazy" width="432" height="253">
                                <div class="mask">
                                    <p class="name"><?php echo htmlentities($vo['title']); ?></p>
                                    <div class="opacity"></div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </div>
                <!-- 房源照片 E-->
                <!-- 小区简介 S -->
                <div class="cmnt_profile floor">
                    <div class="title clearfix">
                        <h2>小区简介</h2>
                    </div>
                    <div class="con_box clearfix">
                        <div class="l_box fl">
                            <p class="cmnt_name"><?php echo htmlentities($estate['title']); ?></p>
                            <ul class="pro_list clearfix">
                                <li>
                                    <span class="tit">参考均价</span>
                                    <span class="txt"><?php echo htmlentities($estate['price']); ?><?php echo config('filter.second_price_unit'); ?></span>
                                </li>
                                <li>
                                    <span class="tit">建筑类型</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['building_type']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">建筑年代</span>
                                    <span class="txt"><?php echo htmlentities($estate['years']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">产权年限</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['property_right']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">总户数</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['plan_number']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">物业费</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['property_fee']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">绿化率</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['greening_rate']); ?></span>
                                </li>
                                <li>
                                    <span class="tit">停车位</span>
                                    <span class="txt"><?php echo htmlentities($estate['data']['parking_space']); ?></span>
                                </li>
                            </ul>
                            <div class="ft_desc clearfix">
                                <span><a href="<?php echo url('Second/index',['estate_id'=>$info['estate_id']]); ?>" title="<?php echo htmlentities($estate['title']); ?>在售二手房">在售二手房源（<?php echo htmlentities($info['total']); ?>套）</a></span>
                                <span><a href="<?php echo url('Rental/index',['estate_id'=>$info['estate_id']]); ?>" title="<?php echo htmlentities($estate['title']); ?>在租房源">在租房源（<?php echo htmlentities($info['rental_total']); ?>套）</a></span>
                            </div>
                        </div>
                        <div class="r_box fr">
                            <img src="/static/images/nopic.jpg" data-original="<?php echo htmlentities($estate['img']); ?>" class="lazy" alt="<?php echo htmlentities($estate['title']); ?>">
                        </div>
                    </div>
                </div>
                <!-- 小区简介 E -->
            </div>
            <div class="rightArea cm_rightArea ">
                <!-- 推荐房源 S -->
                <div class="rcmd_house mt_73">
                    <div class="title">
                        <h3>附近房源</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <ul class="clearfix">
                            <?php if(is_array($near_by_house) || $near_by_house instanceof \think\Collection || $near_by_house instanceof \think\Paginator): $i = 0; $__LIST__ = $near_by_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('Second/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                    <div class="img">
                                        <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                                    </div>
                                    <div class="con">
                                        <div class="row clearfix">
                                            <p class="type_area fl"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅-<?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                            <p class="price fr"><?php echo $vo['price']; ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 推荐房源 E -->
                <!-- 购房宝典S -->
                <div class="buy_way mt_25">
                    <div class="title">
                        <h3><?php echo getCateName('articleCate',2); ?></h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <ul class="list">
                            <?php $obj = model("article");$obj = $obj->where("cate_id=2 and status=1 and city=$cityId");$obj = $obj->field("id,title");$obj = $obj->order("create_time desc");$name = $obj->limit(8)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix"><a href="<?php echo url('News/detail',['id'=>$data['id']]); ?>"><?php echo htmlentities($data['title']); ?></a></li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 购房宝典E -->
            </div>
        </div>
        <!-- con_wrap -->
        <div class="con_wrap clearfix">
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
            <!-- 同小区房源 S -->
            <div class="similar_house floor">
                <div class="title clearfix">
                    <h2>同小区房源</h2>
                </div>
                <div class="con_box">
                    <ul class="list clearfix">
                        <?php $estate_id=$info['estate_id']; $obj = model("second_house");$obj = $obj->where("estate_id=$estate_id and status=1");$obj = $obj->field("id,title,room,living_room,acreage,price,img");$obj = $obj->order("id desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('Second/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                <div class="img">
                                    <img src="/static/images/nopic.jpg" data-original="<?php echo htmlentities($data['img']); ?>" class="lazy" alt="<?php echo htmlentities($data['title']); ?>">
                                </div>
                                <h5 class="name"><?php echo htmlentities($data['title']); ?></h5>
                                <div class="ft_con clearfix">
                                    <p class="type_area fl"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅-<?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                    <p class="price fr"><strong><?php echo $data['price']; ?></strong></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 同小区房源 E -->
            <!-- 感兴趣的房源 S -->
            <div class="similar_house floor">
                <div class="title clearfix">
                    <h2>感兴趣的房源</h2>
                </div>
                <div class="con_box">
                    <ul class="list clearfix">
                        <?php if(is_array($same_price_house) || $same_price_house instanceof \think\Collection || $same_price_house instanceof \think\Paginator): $i = 0; $__LIST__ = $same_price_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('Second/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                <div class="img">
                                    <img src="/static/images/nopic.jpg" data-original="<?php echo htmlentities($vo['img']); ?>" class="lazy" alt="<?php echo htmlentities($vo['title']); ?>">
                                </div>
                                <h5 class="name"><?php echo htmlentities($vo['title']); ?></h5>
                                <div class="ft_con clearfix">
                                    <p class="type_area fl"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅-<?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                    <p class="price fr"><strong><?php echo $vo['price']; ?></strong></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </div>
            </div>
            <!-- 感兴趣的房源 E -->
        </div>
    </div>
</div>
<!-- 楼盘详情 E-->
<script src="/static/storage/qiniuoss/qiniuplayer.min.js"></script>
<script type="text/javascript" src="/static/js/photo/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/static/home/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/static/home/js/l_slide.js"></script>
<script type="text/javascript" src="/static/home/js/scroll_nav.js"></script>
<script type="text/javascript">
    $(function(){
        var storage = "<?php echo htmlentities($storage_open); ?>",video = "<?php echo htmlentities($info['video']); ?>" && storage == 1 ? true : false;
        var options = {
            controls: true,
            url:  "<?php echo getVideoUrl($info['video']); ?>",
            type: 'hls',
            poster : "<?php echo htmlentities($info['img']); ?>",
            width  : 670,
            height : 396,
            preload: true,
            autoplay: false // 如为 true，则视频将会自动播放
        };
        // 判断播放器是否存在,渲染页面时如果为观看时间该元素才会存在
        video && new QiniuPlayer('qiniu-video', options);
        $("#photo:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
        $('.J_dialog').on('click',function(){
            var me=$(this),w = 750,h = 400,house_id=me.data('id'),model = me.data('model'),type = me.data('type'),url = me.data('uri');
            url = url + '?house_id='+house_id+'&type='+type+'&model='+model;
            layer.open({
                type: 2,
                title: false,
                fix:true,
                move:false,
                area: [w+'px', h+'px'],
                shade: 0.8,
                closeBtn: 1,
                shadeClose: true,
                content: url
            });
        });
    });
</script>

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