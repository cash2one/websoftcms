<?php /*a:3:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/news.html";i:1523008286;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:81:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/footer_bar.html";i:1523007706;}*/ ?>
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

<!-- 头部 S-->
<div class="mc-header">
    <a href="javascript:;" class="go-back"></a>
    <h3><?php echo htmlentities((isset($title) && ($title !== '')?$title:$site["title"])); ?></h3>
</div>
<!-- 头部 E-->


<div class="main" style="background: none;">
    <div class="build_dynamic">
        <ul class="list">
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('News/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                    <h3 class="name"><?php echo htmlentities($vo['title']); ?></h3>
                    <p class="m_con"><?php echo htmlentities($vo['description']); ?></p>
                    <time><?php echo htmlentities(date('Y年m月d日',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></time>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
    </div>
    <div class="page_list">
        <?php echo $pages; ?>
    </div>
    <!-- 导航行为 S-->
<div class="nav-act">
    <a href="javascript:;" class="follow" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-uri="<?php echo url('Api/follow'); ?>">关注</a>
    <a href="<?php echo url('Ajax/consult'); ?>" class="consult">咨询</a>
    <a href="tel:<?php echo htmlentities($info['sale_phone']['phone']); if(!(empty($info['sale_phone']['extension']) || (($info['sale_phone']['extension'] instanceof \think\Collection || $info['sale_phone']['extension'] instanceof \think\Paginator ) && $info['sale_phone']['extension']->isEmpty()))): ?>,<?php echo htmlentities($info['sale_phone']['extension']); ?><?php endif; ?>" class="call-tel">拨打电话</a>
    <a href="javascript:;" class="order-l-house dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="1" data-uri="<?php echo url('Dialog/subscribe'); ?>">预约看房</a>
</div>
<!-- 导航行为 E-->
<script src="/static/js/layer/layer.js"></script>
<script src="/static/mobile/js/subscribe.js"></script>

</div>


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