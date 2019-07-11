<?php /*a:5:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/support.html";i:1527591232;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:72:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/nav.html";i:1544411302;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/peitao.html";i:1544237904;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 楼盘详情 S-->
<div class="newhouse_detail">
    <!-- 页面标识 S-->
    <div class="page_tit">
        <div class="comWidth">
            <a href="javascript:;" rel="nofollow">您的位置：</a>
            <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
            <a href="<?php echo url('House/index'); ?>">新房</a> &gt;
            <a href="<?php echo url('House/detail',['id'=>$info['id']]); ?>"><?php echo htmlentities($info['title']); ?></a> &gt;
            <a href="javascript:void(0);">周边配套</a>
        </div>
    </div>
    <!-- 页面标识 E-->
    <?php $sale_status = getLinkMenuCache(1); ?>
<div class="head">
    <div class="comWidth clearfix">
        <h2><?php echo htmlentities($info['title']); ?></h2>
        <p class="sale_state house-status-<?php echo htmlentities($info['sale_status']); ?>"><?php echo htmlentities($sale_status[$info['sale_status']]['name']); ?></p>
        <ul class="label_list">
            <?php $tags = array_filter(explode(',',$info['tags_id'])); if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $n = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;?>
            <li class="item "><?php echo getLinkMenuName(3,$val); ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
        </ul>
        <span class="collect_btn follow" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-uri="<?php echo url('Api/follow'); ?>">关注楼盘</span>
    </div>
</div>
<div class="sub_nav">
    <div class="comWidth clearfix">
        <ul>
            <li><a href="<?php echo url('House/detail',['id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>">首页</a></li>
            <li><a href="<?php echo url('House/news',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘动态" <?php if($action == "news"): ?>class="active"<?php endif; ?>>楼盘动态</a></li>
            <li><a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>在售户型" <?php if($action == "room" or $action == "roomdetail"): ?>class="active"<?php endif; ?>>在售户型</a></li>
            <li><a href="<?php echo url('House/question',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>用户问答" <?php if($action == "question" or $action == "questiondetail"): ?>class="active"<?php endif; ?>>用户问答</a></li>
            <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?><li><a href="<?php echo url('House/pano',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>全景相册" <?php if($action == "pano"): ?>class="active"<?php endif; ?>>全景看房</a></li><?php endif; ?>
            <li><a href="<?php echo url('House/photo',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘相册" <?php if($action == "photo"): ?>class="active"<?php endif; ?>>楼盘相册</a></li>
            <li><a href="<?php echo url('House/build',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼栋信息" <?php if($action == "build"): ?>class="active"<?php endif; ?>>楼栋信息</a></li>
            <li><a href="<?php echo url('House/info',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘详情" <?php if($action == "info"): ?>class="active"<?php endif; ?>>楼盘详情</a></li>
            <li><a href="<?php echo url('House/comment',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘点评" <?php if($action == "comment"): ?>class="active"<?php endif; ?>>楼盘点评</a></li>
            <li><a href="<?php echo url('House/support',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>周边配套" <?php if($action == "support"): ?>class="active"<?php endif; ?>>周边配套</a></li>
        </ul>
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
<?php endif; ?>
    <div class="house_detail" style="padding:0;">
        <div class="con_wrap comWidth clearfix " id="main">
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
        </div>
    </div>
</div>
<!-- 楼盘详情 E-->

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