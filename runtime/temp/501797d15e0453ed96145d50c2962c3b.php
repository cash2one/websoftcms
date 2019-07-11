<?php /*a:3:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/index.html";i:1544494958;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 楼盘列表 S-->
<!-- 搜索栏 S -->
<div class="searBar ">
    <div class="comWidth clearfix">
        <div class="sear_box fl">
            <form action="<?php echo url('House/index'); ?>">
                <div class="ipt_area fl">
                    <input type="text" name="keyword" id="keyword" autocomplete="off" placeholder="输入楼盘名称" data-uri="<?php echo url('Ajax/searchHouse'); ?>" class="ipt">
                    <span class="placeholder">输入楼盘名称</span>
                    <ul id="search-box">
                    </ul>
                </div>
                <div class="btn_area fl">
                    <input type="submit" class="sbm_btn" value="搜索">
                </div>
            </form>
        </div>
        <a href="<?php echo url('Map/index'); ?>" class="map_btn fr">地图找房</a>
    </div>
</div>
<!-- 搜索栏 E -->
<div class="cm_house">
    <div class="comWidth">
        <!-- 页面标识 S-->
        <div class="page_tit">
            <a href="javascript:;" rel="nofollow">您的位置：</a> <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt; <a href="javascript:void(0);">新房</a>
        </div>
        <!-- 页面标识 E-->
        <!-- 筛选栏 S -->
        <div class="seleBar">
            <?php if(!(empty($metro) || (($metro instanceof \think\Collection || $metro instanceof \think\Paginator ) && $metro->isEmpty()))): ?>
            <div class="search-tab clearfix">
                <a href="<?php echo getUrl('House/index','search_type',[],1); ?>" title="按区域查询" <?php if($search['search_type'] == 1): ?>class="active"<?php endif; ?>><i class="iconfont">&#xe609;</i>按区域查询</a>
                <a href="<?php echo getUrl('House/index','search_type',[],2); ?>" title="按地铁查询" <?php if($search['search_type'] == 2): ?>class="active"<?php endif; ?>><i class="iconfont">&#xe61e;</i>按地铁查询</a>
            </div>
            <?php endif; ?>
            <div class="box">
                <?php if($search['search_type'] == 2): ?>
                <div class="item clearfix">
                    <h3>地铁:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','metro',$param,0); ?>" <?php if($search['metro'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($metro) || $metro instanceof \think\Collection || $metro instanceof \think\Paginator): $i = 0; $__LIST__ = $metro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','metro',$param,$vo['id']); ?>" <?php if($search['metro'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php if(!(empty($metro_station) || (($metro_station instanceof \think\Collection || $metro_station instanceof \think\Paginator ) && $metro_station->isEmpty()))): ?>
                <div class="item clearfix">
                    <h3>站点:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','metro_station',$param,0); ?>" <?php if($search['metro_station'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($metro_station) || $metro_station instanceof \think\Collection || $metro_station instanceof \think\Paginator): $i = 0; $__LIST__ = $metro_station;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','metro_station',$param,$vo['id']); ?>" <?php if($search['metro_station'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php endif; else: ?>
                <div class="item clearfix">
                    <h3>区域:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','area',$param,0); ?>" <?php if($search['area'] == $cityId): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','area',$param,$vo['id']); ?>" <?php if($search['area'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php if(!(empty($rading) || (($rading instanceof \think\Collection || $rading instanceof \think\Paginator ) && $rading->isEmpty()))): ?>
                <div class="item clearfix">
                    <h3>商圈:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','area',$param,$param['area']); ?>" <?php if($search['rading'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($rading) || $rading instanceof \think\Collection || $rading instanceof \think\Paginator): $i = 0; $__LIST__ = $rading;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','area',$param,$vo['id']); ?>" <?php if($search['rading'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <div class="item clearfix">
                    <h3>均价:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','price',$param,0); ?>" <?php if($search['price'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php $_result=getHousePrice();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','price',$param,$key); ?>" <?php if($search['price'] == $key): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="item clearfix">
                    <h3>特色:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('House/index','special',$param,0); ?>" <?php if($search['special'] == 0): ?>class="active"<?php endif; ?>>全部</a></li>
                        <?php if(is_array($special) || $special instanceof \think\Collection || $special instanceof \think\Paginator): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('House/index','special',$param,$vo['id']); ?>" <?php if($search['special'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="item clearfix">
                        <h3>更多:</h3>
                        <ul class="list" id="select">
                            <li>
                                <select name="type" id="type">
                                    <option value="0" data-uri="<?php echo getUrl('House/index','type',$param,0); ?>">楼盘类型</option>
                                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($vo['id']); ?>" data-uri="<?php echo getUrl('House/index','type',$param,$vo['id']); ?>" <?php if($search['type'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>
                            <li>
                                <select name="status" id="status">
                                    <option value="0" data-uri="<?php echo getUrl('House/index','status',$param,0); ?>">销售状态</option>
                                    <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): $i = 0; $__LIST__ = $status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($vo['id']); ?>" data-uri="<?php echo getUrl('House/index','status',$param,$vo['id']); ?>" <?php if($search['status'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>
                            <li>
                                <select name="renovation" id="renovation">
                                    <option value="0" data-uri="<?php echo getUrl('House/index','renovation',$param,0); ?>">装修程度</option>
                                    <?php if(is_array($renovation) || $renovation instanceof \think\Collection || $renovation instanceof \think\Paginator): $i = 0; $__LIST__ = $renovation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($vo['id']); ?>" data-uri="<?php echo getUrl('House/index','renovation',$param,$vo['id']); ?>" <?php if($search['renovation'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>

                        </ul>
                </div>
            </div>
        </div>
        <!-- 筛选栏 E -->
        <div class="main clearfix">
            <!-- 房子列表 S -->
            <div class="houseList_wrap leftArea cm_leftArea newhouse">
                <div class="head clearfix">
                    <div class="tit fl">
                        <h2><a href="<?php echo url('House/index'); ?>" <?php if($search['discount'] == 0): ?>class="active"<?php endif; ?>>全部楼盘</a></h2>
                        <h2><a href="<?php echo getUrl('House/index','discount',$param,1); ?>" <?php if($search['discount'] == 1): ?>class="active"<?php endif; ?>>优惠楼盘</a></h2>
                        <h2><a href="<?php echo url('Recommend/index'); ?>">推荐楼盘</a></h2>
                    </div>
                    <div class="tab fr">
                        <ul>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,0); ?>" style="background:none;" <?php if($search['sort'] == 0): ?>class="active"<?php endif; ?>>默认排序</a></li>
                            <?php if($search['sort'] == 1): ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,2); ?>" class="active up">价格</a></li>
                            <?php elseif($search['sort'] == 2): ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,1); ?>" class="active down">价格</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,1); ?>">价格</a></li>
                            <?php endif; if($search['sort'] == 3): ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,4); ?>" class="active down">开盘时间</a></li>
                            <?php elseif($search['sort'] == 4): ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,3); ?>" class="active up">开盘时间</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo getUrl('House/index','sort',$param,3); ?>">开盘时间</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="list_con">
                    <ul class="clearfix">
                        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
								<span class="l_img fl">
                                    <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
									<img src="/static/home/images/nopic.jpg" data-original="<?php echo thumb($vo['img'],220,160); ?>" class="lazy" alt="<?php echo htmlentities($vo['title']); ?>">
                                        <?php if(getSettingCache('site','red_packet') == 1 and $vo['red_packet'] > 0): ?><em class="red-packet"></em><?php endif; if($storage_open == 1 and $vo['video']): ?><em class="video-play-btn"></em><?php endif; ?>
                                    </a>
                                </span>
								<span class="r_con fr">
									<h3>
                                        <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                        <?php echo htmlentities($vo['title']); ?>
                                        <span class="house-status house-status-<?php echo htmlentities($vo['sale_status']); ?>"><?php echo getLinkMenuName(1,$vo['sale_status']); ?></span>
                                        </a>
                                    </h3>
									<p><span class="info"><?php echo htmlentities($vo['min_acreage']); ?>-<?php echo htmlentities($vo['max_acreage']); ?>m²</span><span class="l">|</span>
                                        <?php $id=$vo['id']; $obj = model("house_type");$obj = $obj->where("house_id=$id and status=1");$obj = $obj->field("id,room,house_id,living_room");$obj = $obj->group("room");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($i > 1): ?><span class="l">|</span><?php endif; ?><span class="info"><a href="<?php echo url('House/room',['house_id'=>$data['house_id'],'room'=>$data['room']]); ?>" target="_blank"><?php echo htmlentities($data['room']); ?>室</a></span>
                                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                                    </p>
									<p>
                                        <span class="tit"><?php echo getCityName($vo['city']); ?></span>
                                        <span class="address"><?php echo htmlentities($vo['address']); if(!(empty($vo['pano_url']) || (($vo['pano_url'] instanceof \think\Collection || $vo['pano_url'] instanceof \think\Paginator ) && $vo['pano_url']->isEmpty()))): ?><a href="<?php echo url('House/pano',['house_id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>全景" class="house-pano"></a><?php endif; ?></span>
                                    </p>
									<span class="label_list clearfix">
                                        <?php $tags = array_filter(explode(',',$vo['tags_id'])); if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $n = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;?>
                                        <i class="item "><?php echo getLinkMenuName(3,$val); ?></i>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <?php endif; ?>
									</span>
									<span class="price">
										<h5><strong><?php echo htmlentities($vo['price']); ?></strong><?php echo htmlentities($vo['unit']); ?></h5>
									</span>
								</span>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

                    </ul>
                </div>
                <div class="page_list clearfix">
                    <?php echo $pages; ?>
                </div>
            </div>
            <!-- 房子列表 E -->
            <!-- 右边内容 S -->
            <div class="cm_rightArea rightArea">
                <!-- 推荐楼盘 S -->
                <div class="rcmd_build mt_25">
                    <div class="title">
                        <h3>推荐楼盘</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <ul class="list">
                            <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix">
                                <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                    <div class="fl l_img">
                                        <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" width="120" height="80" alt="">
                                    </div>
                                    <div class="fr r_con">
                                        <p class="name"><?php echo htmlentities($vo['title']); ?></p>
                                        <p class="address"><?php echo getCityName($vo['city']); ?></p>
                                        <p class="price"><b><?php echo htmlentities($vo['price']); ?></b><?php if($vo['price'] > 0): ?><?php echo htmlentities($vo['unit']); ?><?php endif; ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 推荐楼盘 E -->
            </div>
            <!-- 右边内容 E -->
        </div>
    </div>
</div>
<!-- 楼盘列表 S-->
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li>
        <a href="{{d[i].url}}" target="_blank">
            <span>
                <em>{{d[i].price}}{{d[i].unit}}</em>
                 {{d[i].title}}
            </span>
            <span class="address">
                {{d[i].address}}
            </span>
        </a>
    </li>
    {{# } }}
</script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script type="text/javascript">
    $(function(){
        $("#select select").on('change',function(){
           var uri = $(this).find("option:selected").data('uri');
            window.location.href = uri;
        });
        $("#keyword").on('keyup click',function(e){
            e.preventDefault();
            e.stopPropagation();
            var keyword = $(this).val(),url = $(this).data('uri'),box = $('#search-box');
            $.get(url,{keyword: $.trim(keyword)},function(result){
                if(result.code == 1)
                {
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        $('#search-box').html(html);
                    });
                    box.show();
                }else{
                    box.hide();
                }
            });
        });
        $('body').on('click',function(){
            $('#search-box').hide();
        });
    })
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