<?php /*a:4:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/rental/detail.html";i:1546856028;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/peitao.html";i:1523094390;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/mobile/js/font-size.js"></script>
    <link rel="stylesheet" href="/static/mobile/css/base.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="/static/mobile/css/style.css?t=<?php echo time(); ?>">

</head>
<body>


<link rel="stylesheet" href="/static/mobile/css/swiper.min.css">
<div class="main">
    <!-- 返回键 S-->
    <a href="javascript:;" class="detail-go-back"></a>
    <!-- 返回键 E-->
    <!-- 房子图片滚动展示 S-->
    <div class="scroll-roomPic-box">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['title']); ?>" onerror="this.src='/static/images/nopic.jpg'">
                </div>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlentities($info['img']); ?>" alt="<?php echo htmlentities($info['title']); ?>" onerror="this.src='/static/images/nopic.jpg'">
                </div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- 房子图片滚动展示 E-->

    <!-- 房子细节介绍 S-->
    <div class="house-detail-intro">
        <h3><?php echo htmlentities($info['title']); if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?><a href="<?php echo url('Ajax/pano'); ?>?pano_url=<?php echo base64_encode($info['pano_url']); ?>" title="<?php echo htmlentities($info['title']); ?>全景" class="house-pano"></a><?php endif; ?></h3>
        <ul class="price-house-area">
            <li>
                <p>租金</p>
                <em><b><?php echo $info['price']; ?></b></em>
            </li>
            <li>
                <p>户型</p>
                <em><b><?php echo htmlentities($info['room']); ?></b>室<b><?php echo htmlentities($info['living_room']); ?></b>厅<b><?php echo htmlentities($info['toilet']); ?></b>卫</em>
            </li>
            <li>
                <p>面积</p>
                <em><b><?php echo htmlentities($info['acreage']); ?></b><?php echo config('filter.acreage_unit'); ?></em>
            </li>
        </ul>
        <ul class="intro-small-detail">
            <li class="top-three"><span>户型：<em><?php echo htmlentities($info['room']); ?>室<?php echo htmlentities($info['living_room']); ?>厅</em></span><span>面积：<em><?php echo htmlentities($info['acreage']); ?><?php echo config('filter.acreage_unit'); ?></em></span></li>
            <li class="top-three"><span>方式：<em><?php echo getLinkMenuName(10,$info['rent_type']); ?></em></span><span>朝向：<em><?php echo getLinkMenuName(4,$info['orientations']); ?></em></span></li>
            <li class="top-three"><span>装修：<em><?php echo getLinkMenuName(8,$info['renovation']); ?></em></span><span>楼层：<em class="floor"><?php echo getLinkMenuName(7,$info['floor']); ?>/<?php echo htmlentities($info['total_floor']); ?></em></span></li>
            <li class="top-three"><span>支付：<em><?php echo getLinkMenuName(11,$info['pay_type']); ?></em></span></li>
            <li class="after-three">
                <span>更新：</span>
                <em><?php echo getTime($info['update_time'],'mohu'); ?></em>
            </li>
            <li class="after-three"><a href="<?php echo url('Estate/detail',['id'=>$info['estate_id']]); ?>"><span>小区：<em><?php echo htmlentities($estate['title']); ?></em></span></a></li>
            <li class="after-three"><a href="javascript:;"><span>地址：<em><?php echo htmlentities($info['address']); ?></em></span></a></li>
        </ul>
    </div>
    <!-- 房子细节介绍 E-->

    <!-- 房源描述 S-->
    <div class="house-res">
        <h2>房源介绍</h2>
        <ul class="house-confi-point">
            <?php $val = getLinkMenuCache(12); $support = array_filter(explode(',',$info['supporting'])); if(is_array($support) || $support instanceof \think\Collection || $support instanceof \think\Paginator): $i = 0; $__LIST__ = $support;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li class="<?php echo htmlentities($val[$vo]['alias']); ?>"><?php echo htmlentities($val[$vo]['name']); ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
        <div class="info">
            <?php echo $info['info']; ?>
        </div>
    </div>
    <!-- 房源描述 E-->

    <!-- 位置周边 S-->
    <div class="per-pos">
        <h2>位置周边</h2>
        <div class="mapshow-per-pos">
    <div class="hb support">
        <em class="active" search-flag="bus">公交</em>
        <em search-flag="school">教育</em>
        <em search-flag="hospital">医疗</em>
        <em search-flag="shopping">购物</em>
        <em search-flag="life">生活</em>
        <em search-flag="entertainment">娱乐</em>
    </div>
    <div class="mapshow-box" id="map">
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo config('baidu_map_ak'); ?>"></script>
<script src="/static/js/peitao.js"></script>
<script>
    var lng = '<?php echo htmlentities($info['lng']); ?>';
    var lat = '<?php echo htmlentities($info['lat']); ?>';
    var streetView = 0;
    BMapApplication.isMobile = true;
    BMapApplication.title    = "<?php echo htmlentities($info['title']); ?>";
    BMapApplication.saleStatus = "<?php echo htmlentities((isset($info['sale_status']) && ($info['sale_status'] !== '')?$info['sale_status']:1)); ?>";
    BMapApplication.init({'lng' : lng, 'lat' : lat, 'mapContainerId' : 'map'});
    BMapApplication.getAreaMap('公交', 'bus');
    $('.support em').click(function (evt){
        $(this).addClass('active').siblings().removeClass('active');
        var iElem = $(this);
        BMapApplication.getAreaMap(iElem.text(), iElem.attr('search-flag'));
        evt.stopPropagation();
    });
</script>
    </div>
    <!-- 位置周边 E-->

    <!-- 同小区房源 S-->
    <div class="village-lease-room">
        <h2>附近房源</h2>
        <div class="old-house house-show-box">
            <ul>
                <?php if(is_array($near_by_house) || $near_by_house instanceof \think\Collection || $near_by_house instanceof \think\Paginator): $i = 0; $__LIST__ = $near_by_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <div class="pic">
                        <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                        </a>
                    </div>
                    <div class="intro-text">
                        <h4>
                            <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                <?php echo htmlentities($vo['title']); ?>
                            </a>
                        </h4>
                        <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo $vo['price']; ?></em></span></p>
                        <p class="detail-text"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅 <?php echo htmlentities($vo['acreage']); ?>  <?php echo config('filter.acreage_unit'); ?> <?php echo getLinkMenuName(8,$vo['orientations']); ?></p>
                        <p class="good">
                            <?php $tag = array_filter(explode(',',$vo['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                            <em><?php echo htmlentities($val); ?></em>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!-- 同小区房源 E-->

    <!-- 猜你喜欢 S-->
    <div class="village-lease-room">
        <h2>猜你喜欢</h2>
        <div class="old-house house-show-box">
            <ul>
                <?php if(is_array($same_price_house) || $same_price_house instanceof \think\Collection || $same_price_house instanceof \think\Paginator): $i = 0; $__LIST__ = $same_price_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <div class="pic">
                        <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                        </a>
                    </div>
                    <div class="intro-text">
                        <h4>
                            <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                                <?php echo htmlentities($vo['title']); ?>
                            </a>
                        </h4>
                        <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo $vo['price']; ?></em></span></p>
                        <p class="detail-text"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅 <?php echo htmlentities($vo['acreage']); ?>  <?php echo config('filter.acreage_unit'); ?> <?php echo getLinkMenuName(8,$vo['orientations']); ?></p>
                        <p class="good">
                            <?php $tag = array_filter(explode(',',$vo['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                            <em><?php echo htmlentities($val); ?></em>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <a href="<?php echo url('Rental/index'); ?>" class="more-house-btn">更多房源</a>
    </div>
    <!-- 猜你喜欢 E-->
    <!-- 白块  S-->
    <div class="white-block"></div>
    <!-- 白块  E-->

    <!-- 导航行为 S-->
    <div class="nav-act">
        <a href="javascript:;" class="follow" data-id="<?php echo htmlentities($info['id']); ?>" data-model="rental" data-uri="<?php echo url('Api/follow'); ?>">关注</a>
        <a href="<?php echo url('Ajax/consult'); ?>" class="consult">咨询</a>
        <a href="tel:<?php if(!(empty($info['contacts']['contact_phone']) || (($info['contacts']['contact_phone'] instanceof \think\Collection || $info['contacts']['contact_phone'] instanceof \think\Paginator ) && $info['contacts']['contact_phone']->isEmpty()))): ?><?php echo htmlentities($info['contacts']['contact_phone']); else: ?><?php echo htmlentities($site['telphone']); ?><?php endif; ?>" class="call-tel">拨打电话</a>
        <a href="javascript:;" class="order-l-house dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="rental" data-type="1" data-uri="<?php echo url('Dialog/subscribe'); ?>">预约看房</a>
    </div>
    <!-- 导航行为 E-->

    <!-- footer S-->
<footer class="footer">
    <p class="link">
        <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 2): if(!(empty($vo['url']) || (($vo['url'] instanceof \think\Collection || $vo['url'] instanceof \think\Paginator ) && $vo['url']->isEmpty()))): $url = $vo['url']; else: if(!(empty($vo['alias']) || (($vo['alias'] instanceof \think\Collection || $vo['alias'] instanceof \think\Paginator ) && $vo['alias']->isEmpty()))): 
        $url=url($vo['model'].'/'.$vo['action'],['cate'=>$vo['alias']]);
         else: 
        $url=url($vo['model'].'/'.$vo['action']);
         ?>
        <?php endif; ?>
        <?php endif; ?>
        <a href="<?php echo htmlentities($url); ?>"><?php echo htmlentities($vo['title']); ?></a>
        <?php endif; ?>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </p>
    <p class="copy">&copy;<?php echo date('Y'); ?>-<?php echo htmlentities($site['title']); ?>版权所有  <?php echo $site['icp']; ?> </p>
</footer>
<?php echo $site['mobile_js']; ?>
<!-- footer E-->
</div>

<script src="/static/mobile/js/swiper.min.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/mobile/js/subscribe.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop : true,
        autoplay: 4000,//可选选项，自动滑动
        initialSlide :0,
        pagination : '.swiper-pagination',
        paginationType: 'fraction',
    });
</script>

<div style="max-width: 750px;margin:0 auto;position: relative;">
    <div class="footer-bar">
        <ul>
            <li <?php if($controller == "index"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Index/index'); ?>"><i class="icon iconfont icon-daohangshouye"></i><div>首页</div></a></li>
            <li <?php if($controller == "house"): ?>class="active"<?php endif; ?>><a href="<?php echo url('House/index'); ?>"><i class="icon iconfont icon-ziyuan"></i><div>新房</div></a></li>
            <li <?php if($controller == "second"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Second/index'); ?>"><i class="icon iconfont icon-second"></i><div>二手</div></a></li>
            <li <?php if($controller == "rental"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Rental/index'); ?>"><i class="icon iconfont icon-rental"></i><div>出租</div></a></li>
            <li <?php if($controller == "user"): ?>class="active"<?php endif; ?>><a href="<?php echo url('user.index/index'); ?>"><i class="icon iconfont icon-yonghu"></i><div>我的</div></a></li>
        </ul>
    </div>
</div>
<div style="display:none;" id="weixin-share" data-desc="<?php if(isset($info)): ?><?php echo msubstr(strip_tags($info['info']),0,50); else: ?><?php echo htmlentities($site['seo_desc']); ?><?php endif; ?>"></div>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    $(function(){
       $('.detail-go-back,.go-back').on('touchend',function(){
           window.history.back();
       }) ;
        var img_url = "<?php echo config('mobile_domain'); ?><?php echo htmlentities((isset($info['img']) && ($info['img'] !== '')?$info['img']:$site['pc_logo'])); ?>";
        var shareData = {
            title: "<?php echo !empty($share_title) ? htmlentities($share_title) : htmlentities($seo['title']); ?>",
            link: window.location.href,
            desc: $("#weixin-share").data('desc'),
            imgUrl: img_url,
            success:function(){

            }
        };
        var jssdkconfig = <?php echo $sdk_config; ?> || { jsApiList:[] };
        wx.config(jssdkconfig);
        wx.ready(function () {
            wx.onMenuShareAppMessage(shareData);
            wx.onMenuShareTimeline(shareData);
            wx.onMenuShareQQ(shareData);
            wx.onMenuShareWeibo(shareData);
        });
    });
</script>
</body>
</html>