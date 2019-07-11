<?php /*a:3:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/index/index.html";i:1540983106;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;}*/ ?>
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

<!-- header S-->
<header id="header">
    <div class="city-box">
        <a href="javascript:;"><?php echo htmlentities($cityInfo['name']); ?></a>
    </div>
    <div class="logo-box">
        <img src="<?php echo htmlentities($site['mobile_logo']); ?>" alt="">
    </div>
    <div class="person-center" onclick="window.location.href='<?php echo url("user.index/index"); ?>'">
    <a href="<?php echo url('user.index/index'); ?>"></a>
    </div>
</header>
<!-- header E-->


<div class="select-city-box">
    <div class="mc-header">
        <a href="javascript:;" id="city-box-close" class="city-box-back"></a>
        <h3>选择城市</h3>
    </div>
    <div class="city-lists">
        <?php if(is_array($city['city']) || $city['city'] instanceof \think\Collection || $city['city'] instanceof \think\Paginator): $i = 0; $__LIST__ = $city['city'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <dl>
            <dt><?php echo htmlentities($key); ?></dt>
            <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <dd <?php if($val['is_hot'] == 1): ?>class="is-hot"<?php endif; ?>><a href="<?php echo config('mobile_domain'); ?>/<?php echo htmlentities($val['domain']); ?>/"><?php echo htmlentities($val['name']); ?></a></dd>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<div class="main">
    <?php if(is_array($module) || $module instanceof \think\Collection || $module instanceof \think\Paginator): $i = 0; $__LIST__ = $module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <?php echo action('home/Module/index',['tpl'=>'module/index/'.$vo['id']]); ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
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
<script>
    var swiper = new Swiper('.box', {
        pagination: {
            el: '.swiper-menu-pagination',
            type: 'fraction'
        }
    });
    // 头条---------------S
    var textH=$("#text-scroll li").height();
    var mt=textH;
    var timerA=null;

    timerA=setInterval(function(){
        textMove();
    },4000);
    setTimeout(timerA,2000);

    $(".headlines .text").hover(function(){
        clearInterval(timerA);
    },function(){
        timerA=setInterval(textMove,4000);
    });

    function textMove(){
        $("#text-scroll").animate({marginTop:-mt+'px'},function(){
            $(this).css({marginTop:0}).find('li:first').appendTo($(this));
        });

    }
    // 头条---------------E
    $(function(){
        $(".city-box").on('click',function(){
            $(".select-city-box").show();
        });
        $('#city-box-close').on('click',function(){
            $(".select-city-box").hide();
        }) ;
        setTimeout(takeCount,1000);
    });
    function takeCount() {
        setTimeout("takeCount()", 1000);
        $(".time-remain").each(function(){
            var obj = $(this);
            var tms = obj.data("down");
            if (tms>0) {
                tms = parseInt(tms)-1;
                var days = Math.floor(tms / (1 * 60 * 60 * 24));
                var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
                var minutes = Math.floor(tms / (1 * 60)) % 60;
                var seconds = Math.floor(tms / 1) % 60;

                if (days < 0) days = 0;
                if (hours < 0) hours = 0;
                if (minutes < 0) minutes = 0;
                if (seconds < 0) seconds = 0;
                obj.find("[time_id='d']").html(days);
                obj.find("[time_id='h']").html(hours);
                obj.find("[time_id='m']").html(minutes);
                obj.find("[time_id='s']").html(seconds);
                obj.data("down",tms);
            }
        });
    }
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