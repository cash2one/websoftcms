<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/photo.html";i:1531835180;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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


<link rel="stylesheet" href="/static/css/pic-preview.css">
<div class="main" style="background: none;padding-bottom:2rem;">
    <div class="house-type">
        <div class="tab_hd clearfix">
            <a href="<?php echo url('House/photo',['house_id'=>$info['id']]); ?>" <?php if($cate_id == 0): ?>class="on"<?php endif; ?>>全部（<?php echo htmlentities($cate['total']); ?>）</a>
            <?php if(is_array($cate['data']) || $cate['data'] instanceof \think\Collection || $cate['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cate['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo url('House/photo',['house_id'=>$info['id'],'cate_id'=>$vo['cate_id']]); ?>" title="<?php echo htmlentities($vo['name']); ?>" <?php if($cate_id == $vo['cate_id']): ?>class="on"<?php endif; ?>><?php echo htmlentities($vo['name']); ?>(<?php echo htmlentities($vo['total']); ?>)</a>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>

    <div class="build-picture" style="padding-top:.5rem;">
        <div class="picture-item">
            <ul class="list clearfix" data-am-widget="gallery" data-am-gallery="{ pureview: true }">
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo htmlentities($vo['url']); ?>"><img src="<?php echo htmlentities($vo['url']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>"></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
       
    </div>
    <div class="page_list">
        <?php echo $pages; ?>
    </div>
</div>
<script src="/static/js/plugins/amazeui.min.js"></script>

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