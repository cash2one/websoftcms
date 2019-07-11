<?php /*a:4:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/detail.html";i:1547019952;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/peitao.html";i:1544237904;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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
        <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt; <a href="<?php echo url('House/index'); ?>" title="新房">新房</a> &gt; <a href="javascript:void(0);" rel="nofollow"><?php echo htmlentities($info['title']); ?></a>
    </div>
</div>
<!-- 页面标识 E-->
<!-- 楼盘详情 S-->
<div class="house_detail newhouse_detail">
    <div class="comWidth">
        <!-- main_info S -->
        <div class="main_info">
            <div class="con_box clearfix">
                <div class="leftArea">
                    <!-- 轮播图 S -->
                    <div class="l_slide">
                        <ul class="bigImg">
                            <?php if($storage_open == 1 and $info['video']): ?>
                            <li style="height:396px;">
                                <video id="qiniu-video" class="video-js vjs-big-play-centered"></video>
                            </li>
                            <?php endif; if(!(empty($info['photo']) || (($info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator ) && $info['photo']->isEmpty()))): if(is_array($info['photo']) || $info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['photo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="javascript:;"><img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['cate_name']); ?>"></a>
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
                                    <?php endif; if(!(empty($info['photo']) || (($info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator ) && $info['photo']->isEmpty()))): if(is_array($info['photo']) || $info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['photo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li>
                                        <a href="javascript:;"><img src="<?php echo thumb($vo['url'],160,80); ?>" alt="<?php echo htmlentities($vo['cate_name']); ?>"></a>
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
                    <div class="hd_box clearfix">
                        <h2 class="fl"><?php echo htmlentities($info['title']); ?> </h2>
                        <!-- on表示已收藏 -->
                        <span class="collect_btn follow fr" data-model="house" data-id="<?php echo htmlentities($info['id']); ?>" data-uri="<?php echo url('Api/follow'); ?>">关注楼盘</span>
                    </div>
                    <div class="t_box clearfix">
                        <div class="price fl">
                            <span><strong><?php echo htmlentities($info['price']); ?></strong><?php echo htmlentities($info['unit']); ?></span>
                        </div>
                        <div class="calc fr">
                            <a href="<?php echo url('Tools/index'); ?>" target="_blank">房贷计算器</a>
                        </div>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">物业类型 : </span><span class="desc"><?php echo htmlentities($info['attr']['property_type']); ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">开盘时间 : </span><span class="desc"><?php if($info['opening_time'] > 0): ?><?php echo htmlentities(date('Y年m月d日',!is_numeric($info['opening_time'])? strtotime($info['opening_time']) : $info['opening_time'])); ?><?php endif; ?><?php echo htmlentities($info['opening_time_memo']); ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">交房时间 : </span><span class="desc"><?php if($info['complate_time'] > 0): ?><?php echo htmlentities(date('Y年m月d日',!is_numeric($info['complate_time'])? strtotime($info['complate_time']) : $info['complate_time'])); ?><?php endif; ?><?php echo htmlentities($info['complate_time_memo']); ?></span>
                    </div>
                    <div class="col_1 clearfix">
                        <span class="label">主力户型 : </span>
                        <span class="desc">
                            <?php $obj = model("house_type");$obj = $obj->where("house_id=$id");$obj = $obj->field("room,living_room,acreage");$obj = $obj->order("room asc");$name = $obj->limit(5)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;if($i > 1): ?>|<?php endif; ?><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅(<?php echo htmlentities($data['acreage']); ?>㎡)
					        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </span>
                    </div>

                    <div class="col_1 clearfix">
                        <span class="label">楼盘地址 : </span><span class="desc"><?php echo htmlentities($info['address']); ?></span>
                    </div>
                    <div class="agent_info clearfix">
                        <div class="c_con new-house fl" style="margin-top:16px;">
                            <div class="phone-text clearfix">
                                苦苦寻找楼盘信息？不如一个电话全部搞定
                            </div>
                            <div class="row">
                                <p class="phone">
                                    <?php echo htmlentities($info['sale_phone']['phone']); if(!(empty($info['sale_phone']['extension']) || (($info['sale_phone']['extension'] instanceof \think\Collection || $info['sale_phone']['extension'] instanceof \think\Paginator ) && $info['sale_phone']['extension']->isEmpty()))): ?>转<?php echo htmlentities($info['sale_phone']['extension']); ?><?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="r_con fr">
                            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo htmlentities($qq[0]); ?>&site=qq&menu=yes" target="_blank" class="btn consult">在线咨询</a>
                            <a href="javascript:void(0);" class="btn appoint J_dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="1" data-uri="<?php echo url('Dialog/subscribe'); ?>">预约看房</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--优惠-->
        <?php if($info['is_discount']): ?>
        <div class="discount">
            <?php echo htmlentities($info['discount']); ?>
            <a href="javascript:;" class="J_dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="2" data-uri="<?php echo url('Dialog/subscribe'); ?>"></a>
        </div>
        <?php endif; ?>
        <!-- main_info E -->
        <!-- 锚链接导航 S -->
        <div class="scroll_nav_wrap">
            <div class="scroll_nav">
                <div class="comWidth clearfix">
                    <ul>
                        <li class="active"><a href="<?php echo url('House/news',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>动态">楼盘动态</a></li>
                        <li><a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>在售户型">在售户型</a></li>
                        <li><a href="<?php echo url('House/question',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>用户问答">用户问答</a></li>
                        <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?><li><a href="<?php echo url('House/pano',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>全景相册">全景看房</a></li><?php endif; ?>
                        <li><a href="<?php echo url('House/photo',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>楼盘相册">楼盘相册</a></li>
                        <li><a href="<?php echo url('House/build',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>楼栋信息">楼栋信息</a></li>
                        <li><a href="<?php echo url('House/info',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>楼盘详情">楼盘详情</a></li>
                        <li><a href="<?php echo url('House/support',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>周边配套">周边配套</a></li>
                        <li><a href="<?php echo url('House/comment',['house_id'=>$info['id']]); ?>" target="_blank" title="<?php echo htmlentities($info['title']); ?>点评">楼盘点评</a></li>
                        <li><a href="javascript:void(0);">为你推荐</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 锚链接导航 E -->
        <div class="con_wrap" id="main">
            <div class="clearfix floor">
                <!-- 楼盘动态 S-->
                <div class="dynamic fl">
                    <div class="title clearfix">
                        <h2>楼盘动态</h2>
                        <a href="<?php echo url('House/news',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>动态" class="more">查看更多</a>
                    </div>
                    <div class="con_box">
                        <ul class="list">
                            <?php $obj = model("article");$obj = $obj->where("status=1 and house_id=$id");$obj = $obj->field("id,cate_id,title,create_time,description");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(5)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix">
                                <div class="r_con">
                                    <div class="hd clearfix">
                                        <h4 class="tit fl">[<?php echo getCateName('articleCate',$data['cate_id']); ?>] <a href="<?php echo url('News/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>"><?php echo htmlentities($data['title']); ?></a></h4>
                                        <p class="time fr"><?php echo htmlentities(date('Y-m-d',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?></p>
                                    </div>
                                    <p class="desc"><?php echo msubstr($data['description'],0,80); ?></p>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 楼盘动态 E-->
                <!-- 时间轴 S -->
                <div class="time_line fr">
                    <div class="title clearfix">
                        <h2>时间轴</h2>
                    </div>
                    <div class="con_box">
                        <ul class="list">
                            <li class="clearfix">
                                <div class="l_con">
                                    <span class="c"></span>
                                    <span class="l"></span>
                                </div>
                                <div class="r_con">
                                    <?php if($info['opening_time'] > 0): ?><p class="time"><?php echo htmlentities(date('Y年m月d日',!is_numeric($info['opening_time'])? strtotime($info['opening_time']) : $info['opening_time'])); ?></p><?php endif; ?>
                                    <p class="txt"><?php echo htmlentities($info['opening_time_memo']); ?></p>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="l_con">
                                    <span class="c"></span>
                                    <span class="l"></span>
                                </div>
                                <div class="r_con">
                                    <?php if($info['complate_time'] > 0): ?><p class="time"><?php echo htmlentities(date('Y年m月d日',!is_numeric($info['complate_time'])? strtotime($info['complate_time']) : $info['complate_time'])); ?></p><?php endif; ?>
                                    <p class="txt"><?php echo htmlentities($info['complate_time_memo']); ?></p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- 时间轴 E -->
            </div>
            <!-- 户型介绍 S -->
            <div class="house_type floor">
                <div class="title clearfix">
                    <h2>户型介绍</h2>
                    <a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>户型介绍" class="more">查看更多</a>
                    <ul class="tab_hd fr">
                        <li><a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>全部户型" class="on">全部户型（<span id="room_total"></span>）</a></li>
                        <?php if(is_array($info['room_count']) || $info['room_count'] instanceof \think\Collection || $info['room_count'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['room_count'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('House/room',['house_id'=>$info['id'],'room'=>$vo['room']]); ?>" title="<?php echo htmlentities($info['title']); ?><?php echo htmlentities($vo['room']); ?>室"><?php echo htmlentities($vo['room']); ?>室（<span class="room_count"><?php echo htmlentities($vo['total']); ?></span>）</a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="con_box">
                    <div class="picScroll">
                        <ul>
                            <?php $sale_status = getLinkMenuCache(5); $obj = model("house_type");$obj = $obj->where("house_id=$id");$obj = $obj->field("id,img,title,room,living_room,toilet,kitchen,sale_status,acreage");$obj = $obj->order("id");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('House/roomDetail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($info['title']); ?><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅<?php echo htmlentities($data['acreage']); ?>平米" class="img">
                                    <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>" />
                                    <!--  on在售 off售罄 for待售 -->
                                    <p class="sale_type <?php echo htmlentities($sale_status[$data['sale_status']]['alias']); ?>"><?php echo htmlentities($sale_status[$data['sale_status']]['name']); ?></p>
                                </a>
                                <div class="con">
                                    <p><?php echo htmlentities($data['title']); ?> <?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅<?php echo htmlentities($data['kitchen']); ?>厨<?php echo htmlentities($data['toilet']); ?>卫</p>
                                    <p>建筑面积<?php echo htmlentities($data['acreage']); ?>㎡ </p>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

                        </ul>
                        <a class="prev" href="javascript:void(0)"></a>
                        <a class="next" href="javascript:void(0)"></a>
                    </div>
                </div>
            </div>
            <!-- 户型介绍 E -->
            <!-- 用户问答 S -->
            <div class="question floor">
                <div class="title clearfix">
                    <h2>楼盘问答</h2>
                    <a href="<?php echo url('House/question',['house_id'=>$info['id']]); ?>" style="margin-top:10px;line-height: 45px;color:#fff;" title="<?php echo htmlentities($info['title']); ?>问答" class="more">我要提问</a>
                </div>
                <div class="con_box">
                    <ul class="list">
                        <?php $obj = model("question");$obj = $obj->where("house_id=$id and status=1");$obj = $obj->field("id,content");$obj = $obj->order("id desc");$name = $obj->limit(2)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <li>
                            <?php $question_id=$data['id']; ?>
                            <p class="ask"><a target="_blank" href="<?php echo url('Question/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['content']); ?>"><?php echo htmlentities($data['content']); ?></a></p>
                            <?php $obj = model("answer");$obj = $obj->where("question_id=$question_id and status=1");$obj = $obj->field("content,create_time");$obj = $obj->order("id");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($i % 2 );++$i;?>
                            <p class="anser">答：<?php echo htmlentities($answer['content']); ?></p>
                            <p class="time"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($answer['create_time'])? strtotime($answer['create_time']) : $answer['create_time'])); ?></p>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </li>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 用户问答 E -->
            <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?>
            <div class="build_picture similar_house floor">
                <div class="title clearfix">
                    <h2>全景看房</h2>
                </div>
                <div class="con_box">
                    <iframe src="<?php echo htmlentities($info['pano_url']); ?>" width="100%" height="500" scrolling="no" frameborder="0"></iframe>
                </div>
            </div>
            <?php endif; ?>
            <!-- 楼盘相册 S -->
            <div class="build_picture similar_house floor">
                <div class="title clearfix">
                    <h2>楼盘相册</h2>
                    <a href="<?php echo url('House/photo',['house_id'=>$id]); ?>" title="<?php echo htmlentities($info['title']); ?>相册" class="more">查看更多</a>
                    <ul class="tab_hd fr">
                        <?php if(is_array($info['photo_cate']['data']) || $info['photo_cate']['data'] instanceof \think\Collection || $info['photo_cate']['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['photo_cate']['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('House/photo',['house_id'=>$id,'cate_id'=>$vo['cate_id']]); ?>"><?php echo htmlentities($vo['name']); ?>（<?php echo htmlentities($vo['total']); ?>）</a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="con_box">
                    <ul class="list clearfix" id="photo">
                        <?php $obj = model("house_photo");$obj = $obj->where("house_id=$id and status=1");$obj = $obj->field("url,cate_name,title");$obj = $obj->order("ordid");$name = $obj->limit(8)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo htmlentities($data['url']); ?>" title="<?php echo htmlentities($data['cate_name']); ?>-<?php echo htmlentities($data['title']); ?>" rel="prettyPhoto[]">
                                <div class="img">
                                    <img src="/static/images/nopic.jpg" data-original="<?php echo thumb($data['url'],285,205); ?>" class="lazy" >
                                    <div class="mask">
                                        <p class="name"><?php echo htmlentities($data['title']); ?></p>
                                        <div class="opacity"></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 楼盘相册 E -->
            <?php if(!(empty($points) || (($points instanceof \think\Collection || $points instanceof \think\Paginator ) && $points->isEmpty()))): ?>
            <!-- 楼栋信息 S -->
            <div class="buildNum_info floor">
                <div class="title clearfix">
                    <h2>楼栋信息</h2>
                </div>
                <div class="con_box clearfix">
                    <div class="l_con fl" id="ldxx-img">
                        <div class="img"  draggable="false" id="img" style="position: absolute;cursor:move;">
                            <img src="<?php echo htmlentities($points['img']); ?>" alt="<?php echo htmlentities($info['title']); ?>楼栋信息">
                            <?php if(is_array($points['data']) || $points['data'] instanceof \think\Collection || $points['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $points['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;$point=explode(',',$vo['point']); ?>
                            <div class="tit ban <?php echo htmlentities($sale_status[$vo['sale']]['alias']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" style="left:<?php echo htmlentities($point[0]); ?>px;top:<?php echo htmlentities($point[1]); ?>px;cursor:pointer;">
                                <?php echo htmlentities($vo['title']); ?>
                                <div class="riangle"></div>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <div class="label">
                            <div class="item clearfix">
                                <span class="bg on"></span>
                                <span class="txt">在售</span>
                            </div>
                            <div class="item clearfix">
                                <span class="bg for"></span>
                                <span class="txt">待售</span>
                            </div>
                            <div class="item clearfix">
                                <span class="bg off"></span>
                                <span class="txt">售罄</span>
                            </div>
                            <div class="opacity"></div>
                        </div>

                    </div>
                    <div class="r_con fr">
                        <div class="tab_nav">
                            <ul class="clearfix" id="ban_lists" data-uri="<?php echo url('Api/getBanInfoById'); ?>">
                                <?php if(is_array($ban_lists) || $ban_lists instanceof \think\Collection || $ban_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $ban_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li><a href="javascript:;" data-id="<?php echo htmlentities($vo['id']); ?>" <?php if($i == 1): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['title']); ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <div class="b_l"></div>
                        </div>
                        <div id="ban_info"></div>
                    </div>
                </div>
            </div>
            <!-- 楼栋信息 E -->
            <?php endif; ?>
            <!-- 楼盘详情 S -->
            <div class="build_detail floor">
                <div class="title clearfix">
                    <h2>楼盘详情</h2>
                </div>
                <div class="con_box clearfix">
                    <table cellpadding="0" cellspacing="1" border="0" width="100%">
                        <tr>
                            <td width="33.33%">
                                <span class="tit">项目地址：</span>
                                <span class="txt"><?php echo htmlentities($info['address']); ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">开发商：</span>
                                <span class="txt"><?php echo htmlentities($info['developer_name']); ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">售楼处地址：</span>
                                <span class="txt"><?php echo htmlentities($info['sale_address']); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.33%">
                                <span class="tit">物业公司：</span>
                                <span class="txt"><?php if(empty($info['attr']['property_company']) || (($info['attr']['property_company'] instanceof \think\Collection || $info['attr']['property_company'] instanceof \think\Paginator ) && $info['attr']['property_company']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_company']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">开盘时间：</span>
                                <span class="txt"><?php if(!(empty($info['opening_time']) || (($info['opening_time'] instanceof \think\Collection || $info['opening_time'] instanceof \think\Paginator ) && $info['opening_time']->isEmpty()))): ?><?php echo htmlentities(date('Y-m-d',!is_numeric($info['opening_time'])? strtotime($info['opening_time']) : $info['opening_time'])); ?><?php endif; ?><?php echo htmlentities($info['opening_time_memo']); ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">交房时间：</span>
                                <span class="txt"><?php if(!(empty($info['complate_time']) || (($info['complate_time'] instanceof \think\Collection || $info['complate_time'] instanceof \think\Paginator ) && $info['complate_time']->isEmpty()))): ?><?php echo htmlentities(date('Y-m-d',!is_numeric($info['complate_time'])? strtotime($info['complate_time']) : $info['complate_time'])); ?><?php endif; ?><?php echo htmlentities($info['complate_time_memo']); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.33%">
                                <span class="tit">产权年限：</span>
                                <span class="txt"><?php if(empty($info['attr']['property_right']) || (($info['attr']['property_right'] instanceof \think\Collection || $info['attr']['property_right'] instanceof \think\Paginator ) && $info['attr']['property_right']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_right']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">物业类型：</span>
                                <span class="txt"><?php if(empty($info['attr']['property_type']) || (($info['attr']['property_type'] instanceof \think\Collection || $info['attr']['property_type'] instanceof \think\Paginator ) && $info['attr']['property_type']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_type']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">车位情况：</span>
                                <span class="txt"><?php if(empty($info['attr']['parking_space']) || (($info['attr']['parking_space'] instanceof \think\Collection || $info['attr']['parking_space'] instanceof \think\Paginator ) && $info['attr']['parking_space']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['parking_space']); ?><?php endif; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.33%">
                                <span class="tit">建筑类型：</span>
                                <span class="txt"><?php if(empty($info['attr']['building_type']) || (($info['attr']['building_type'] instanceof \think\Collection || $info['attr']['building_type'] instanceof \think\Paginator ) && $info['attr']['building_type']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['building_type']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">计划户数：</span>
                                <span class="txt"><?php if(empty($info['attr']['plan_number']) || (($info['attr']['plan_number'] instanceof \think\Collection || $info['attr']['plan_number'] instanceof \think\Paginator ) && $info['attr']['plan_number']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['plan_number']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">占地面积：</span>
                                <span class="txt"><?php if(empty($info['attr']['area_covered']) || (($info['attr']['area_covered'] instanceof \think\Collection || $info['attr']['area_covered'] instanceof \think\Paginator ) && $info['attr']['area_covered']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['area_covered']); ?><?php endif; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.33%">
                                <span class="tit">物业费用：</span>
                                <span class="txt"><?php if(empty($info['attr']['property_fee']) || (($info['attr']['property_fee'] instanceof \think\Collection || $info['attr']['property_fee'] instanceof \think\Paginator ) && $info['attr']['property_fee']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_fee']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">建筑面积：</span>
                                <span class="txt"><?php if(empty($info['attr']['area_build']) || (($info['attr']['area_build'] instanceof \think\Collection || $info['attr']['area_build'] instanceof \think\Paginator ) && $info['attr']['area_build']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['area_build']); ?><?php endif; ?></span>
                            </td>
                            <td width="33.33%">
                                <span class="tit">装修情况：</span>
                                <span class="txt"><?php if(empty($info['renovation']) || (($info['renovation'] instanceof \think\Collection || $info['renovation'] instanceof \think\Paginator ) && $info['renovation']->isEmpty())): ?>暂无资料<?php else: ?><?php echo getLinkMenuName(8,$info['renovation']); ?><?php endif; ?></span>
                            </td>
                        </tr>
                    </table>
                    <div class="house-content">
                        <?php echo $info['info']; ?>
                    </div>
                </div>
            </div>
            <!-- 楼盘详情 E -->
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
            <!-- 用户点评 S -->
            <div class="question floor">
                <div class="title clearfix">
                    <h2>楼盘点评</h2>
                    <a href="<?php echo url('House/comment',['house_id'=>$info['id']]); ?>" style="margin-top:10px;line-height: 45px;color:#fff;" title="<?php echo htmlentities($info['title']); ?>点评" class="more">我要点评</a>
                </div>
                <div class="con_box">
                    <div class="comment-list">
                        <?php $obj = model("comment");$obj = $obj->where("house_id = $id and status = 1 and pid=0");$obj = $obj->field("id,user_id,score,average_score,user_name,content,create_time,support");$obj = $obj->order("create_time desc");$name = $obj->limit(2)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                        <div class="comment-row clearfix">
                            <div class="comment-row-avatar fl">
                                <img src="<?php echo getAvatar($data['user_id'],45); ?>" alt="<?php echo htmlentities($data['user_name']); ?>">
                            </div>
                            <div class="comment-row-content fl">
                                <div class="comment-row-time">
                                    <span class="username"><?php echo htmlentities($data['user_name']); ?></span> <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?>
                                </div>
                                <div class="comment-row-integral">
                                    <span class="star">
                                        <span class="star integral" style="width:<?php echo htmlentities($data['average_score']/5*100); ?>%;"></span>
                                    </span>
                                    <span class="comment-row-per">
                                        <span class="comment-row-per">
                                价格：<?php echo htmlentities($data['score']['price']); ?> &nbsp;&nbsp;地段：<?php echo htmlentities($data['score']['place']); ?> &nbsp;&nbsp;配套：<?php echo htmlentities($data['score']['mating']); ?> &nbsp;&nbsp;交通：<?php echo htmlentities($data['score']['traffic']); ?> &nbsp;&nbsp;环境：<?php echo htmlentities($data['score']['science']); ?>
                            </span>
                                    </span>
                                </div>
                                <div class="comment-row-content">
                                    <?php echo htmlentities($data['content']); ?>
                                </div>
                                <div class="comment-reply">
                                    <a href="javascript:;" class="support" onclick="support(this,'<?php echo htmlentities($data['id']); ?>')">支持(<span><?php echo htmlentities($data['support']); ?></span>)</a> <a href="javascript:;" class="reply">查看回复</a>
                                </div>
                                <div class="comment-reply-content" id="comment-reply-content-<?php echo htmlentities($data['id']); ?>" style="display:none;">
                                    <?php $pid = $data['id']; $obj = model("comment");$obj = $obj->where("pid = $pid and status = 1");$obj = $obj->order("create_time desc");$name = $obj->limit(15)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                    <div class="comment-row clearfix">
                                        <div class="comment-row-avatar fl">
                                            <img src="<?php echo getAvatar($val['user_id'],45); ?>" alt="<?php echo htmlentities($val['user_name']); ?>">
                                        </div>
                                        <div class="comment-row-content fl">
                                            <div class="comment-row-time">
                                                <span class="username"><?php echo htmlentities($val['user_name']); ?></span> <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                                            </div>
                                            <div class="comment-row-content">
                                                <?php echo htmlentities($val['content']); ?>
                                            </div>
                                            <div class="comment-reply">
                                                <a href="javascript:;" class="support" onclick="support(this,'<?php echo htmlentities($val['id']); ?>')">支持(<span><?php echo htmlentities($val['support']); ?></span>)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        <p style="padding:10px 0;text-align:center;"><a href="<?php echo url('House/comment',['house_id'=>$info['id']]); ?>" target="_blank">查看更多∨</a></p>
                    </div>
                </div>
            </div>
            <!-- 用户点评 E -->
            <!-- 为您推荐 S -->
            <div class="similar_house floor">
                <div class="title clearfix">
                    <h2>为您推荐</h2>
                </div>
                <div class="con_box">
                    <ul class="list clearfix">
                        <?php if(is_array($nearby_house) || $nearby_house instanceof \think\Collection || $nearby_house instanceof \think\Paginator): $i = 0; $__LIST__ = $nearby_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                <div class="img">
                                    <img src="/static/images/nopic.jpg" data-original="<?php echo htmlentities($vo['img']); ?>" class="lazy" alt="<?php echo htmlentities($vo['title']); ?>">
                                </div>
                                <div class="ft_con clearfix">
                                    <p class="fl"><?php echo htmlentities($vo['title']); ?></p>
                                    <p class="price fr"><strong><?php echo htmlentities($vo['price']); ?></strong><?php echo htmlentities($vo['unit']); ?></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 为您推荐 E -->
        </div>
    </div>
</div>
<?php if(getSettingCache('site','red_packet') == 1 and $info['red_packet'] > 0): ?>
<div class="hb-right J_dialog"  data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="3" data-uri="<?php echo url('Dialog/subscribe'); ?>">
    <p class="hb-p1">最高<strong><?php echo htmlentities($info['red_packet']); ?></strong>元</p>
    <p class="hb-p2">买新房 领红包 人人有份</p>
    <div class="detailPopClose"></div>
</div>
<script>
    $(function(){
       $(".detailPopClose").on('click',function(e){
           e.stopPropagation();
           e.preventDefault();
           $(this).parent().hide();
       });
    });
</script>
<?php endif; ?>
<!-- 楼盘详情 E-->
<script type="text/html" id="template">
    <div class="m_info">
        <ul class="clearfix">
            <li>
                <span class="tit">单元:</span>
                <span class="txt">{{# if(d['ban_info']['unit']){ }}{{d.ban_info.unit}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">电梯数:</span>
                <span class="txt">{{# if(d['ban_info']['elevator']){ }}{{d.ban_info.elevator}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">楼层:</span>
                <span class="txt">{{# if(d['ban_info']['floor_num']){ }}{{d.ban_info.floor_num}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">户数:</span>
                <span class="txt">{{# if(d['ban_info']['room_num']){ }}{{d.ban_info.room_num}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">开盘时间:</span>
                <span class="txt">{{# if(d['ban_info']['open_time']){ }}{{d.ban_info.open_time}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">交房时间:</span>
                <span class="txt">{{# if(d['ban_info']['complate_time']){ }}{{d.ban_info.complate_time}}{{# } }}</span>
            </li>
        </ul>
    </div>
    <div class="s_info">
        <h4>{{d.ban_info.title}}</h4>
        <ul class="table clearfix">
            {{# if(d.type_lists.length>0){ }}
            <li class="thd">
                <ol>
                    <li class="th">名称</li>
                    <li class="th">户型</li>
                    <li class="th">价格</li>
                    <li class="th">状态</li>
                </ol>
            </li>
            <li class="tbd">
                {{# for(var i = 0, len = d.type_lists.length; i < len; i++){ }}
                <a href="{{d.type_lists[i].url}}">
                    <ol class="clearfix">
                        <li class="td">{{d.type_lists[i].title}}</li>
                        <li class="td">{{d.type_lists[i].room}}室{{d.type_lists[i].living_room}}厅{{d.type_lists[i].acreage}}㎡</li>
                        <li class="td">{{d.type_lists[i].price}}万</li>
                        <li class="td">{{d.type_lists[i].sale_status}}</li>
                    </ol>
                </a>
                {{# } }}
            </li>
            {{# } }}
        </ul>
    </div>
</script>
<script src="/static/storage/qiniuoss/qiniuplayer.min.js"></script>
<script type="text/javascript" src="/static/home/js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="/static/home/js/l_slide.js"></script>
<script type="text/javascript" src="/static/home/js/scroll_nav.js"></script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script type="text/javascript" src="/static/js/photo/jquery.prettyPhoto.js"></script>
<script type="text/javascript">
    var total = 0,storage = "<?php echo htmlentities($storage_open); ?>",video = "<?php echo htmlentities($info['video']); ?>" && storage == 1 ? true : false;
    $(function(){
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
        jQuery(".picScroll").slide({
            mainCell:"ul",
            effect:"leftLoop",
            vis:5,
            scroll:5,
            autoPage:true,
            switchLoad:"_src"
        });
        $(".room_count").each(function(){
           total += parseInt($(this).text());
        });
        $('#room_total').text(total);
        //图片拖动
        window.onload = function(){
            var draging = false, lastPoint;
            var body = document.body;
            var img = document.getElementById('img') || false;
            img.onmousedown = function(e){
                e = e || window.event;
                var x = e.clientX;
                var y = e.clientY;
                if(!lastPoint){
                    lastPoint = {};
                }
                lastPoint.x = x;
                lastPoint.y = y;
                draging = true;
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    return false;
                }
            }
            img.ondragstart = function(e){
                e = e || window.event;
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    return false;
                }
            }
            img.onmouseup = function(){
                draging = false;
                lastPoint = undefined;
            }
            if(document.addEventListener){
                body.addEventListener('mousemove',function(e){
                    onMouseMove(e);
                },false);
                body.addEventListener('mouseup',onMouseUp,false);
            }else{
                body.attachEvent('onmousemove',function(){
                    var event = window.event;
                    onMouseMove(event);
                })
                body.attachEvent('onmouseup',onMouseUp);
            }

            function onMouseMove(e){
                if(!draging){
                    return;
                }
                var img = document.getElementById('img');
                var ldxx_img = document.getElementById('ldxx-img');
                if(lastPoint){
                    var x = e.clientX , y = e.clientY;
                    var imgTop = parseFloat(img.style.top || '0');
                    var imgLeft = parseFloat(img.style.left || '0');
                    var changeX = x - lastPoint.x , changeY = y - lastPoint.y;
                    var dis_X = imgLeft + changeX;
                    var dis_Y = imgTop + changeY;
                    var sub_img = img.getElementsByTagName('img')[0];
                    var sub_img_width = sub_img.offsetWidth;
                    var sub_img_height = sub_img.offsetHeight;
                    var img_width = ldxx_img.offsetWidth;
                    var img_height = ldxx_img.offsetHeight;
                    var dis_w = img_width -  sub_img_width;
                    var dis_h = img_height - sub_img_height;
                    if(dis_X>0){
                        dis_X = 0;
                    }
                    if(dis_X < dis_w){
                        dis_X = dis_w;
                    }

                    if(dis_Y>0){
                        dis_Y = 0;
                    }
                    if(dis_Y < dis_h){
                        dis_Y = dis_h;
                    }

                    img.style.top = dis_Y + 'px';
                    img.style.left = dis_X + 'px';
                    lastPoint.x = x, lastPoint.y = y;
                }
            }
            function onMouseUp(){
                draging = false;
                lastPoint = undefined;
            }
        }
        getBanInfo($("#ban_lists a.active").data('id'));
        $("#ban_lists a").on('click',function(){
            var id = $(this).data('id');
            $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
            getBanInfo(id);
        });
        $(".ban").on('click',function(){
            var id = $(this).data('id');
            $("#ban_lists").find('.active').removeClass('active');
            $("#ban_lists").find("a[data-id='"+id+"']").addClass('active');
            getBanInfo(id);
        });
        //弹出回复框
        $(".reply-content").on('click',function(){
            var parent = $(this).parents('.comment-row-content'),re_list = parent.find('.comment-reply-content'),
                    re_box = parent.find('.comment-reply-box');
            re_list.slideUp();
            if(re_box.css('display') == 'block')
            {
                re_box.slideUp();
            }else{
                re_box.slideDown();
            }
        });
        $(".reply").on('click',function(){
            var parent = $(this).parents('.comment-row-content'),re_list = parent.find('.comment-reply-content'),
                    re_box = parent.find('.comment-reply-box');
            re_box.slideUp();
            if(re_list.css('display') == 'block')
            {
                re_list.slideUp();
            }else{
                re_list.slideDown();
            }
        });
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
    function support(obj,id)
    {
        var url = "<?php echo url('Api/support'); ?>",o = $(obj).find('span'),num = parseInt(o.text());
        $.get(url,{id:id},function(res){
            if(res.code == 1){
                o.text(num+1);
                layer.msg(res.msg,{icon:1});
            }else{
                layer.msg(res.msg,{icon:2});
            }
        });
    }
    function getBanInfo(id)
    {
        var url   = $("#ban_lists").data('uri');
        var param = {id:id};
        if(url)
        {
            $.get(url,param,function(result){
                if(result.code == 1)
                {
                    if(result.data){
                        var gettpl = document.getElementById('template').innerHTML;
                        laytpl(gettpl).render(result.data, function(html){
                            document.getElementById('ban_info').innerHTML = html;
                        });
                    }
                }else{
                    console.log('get data error');
                }
            });
        }

    }
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