<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/news/detail.html";i:1530331702;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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


<div class="main" style="padding-bottom:1.95rem;">
    <!-- 新闻资讯 S-->
    <div class="news">

        <!-- 新闻资讯详情 S -->
        <div class="news-detail">
            <div class="head">
                <h3><?php echo htmlentities($info['title']); ?></h3>
                <div class="ft">
                    <span class="news-type"><?php if(empty($info['come_from']) || (($info['come_from'] instanceof \think\Collection || $info['come_from'] instanceof \think\Paginator ) && $info['come_from']->isEmpty())): ?><?php echo htmlentities($site['title']); else: ?><?php echo htmlentities($info['come_from']); ?><?php endif; ?></span>
                    <span class="time">&nbsp;&nbsp;<?php echo htmlentities(date('Y-m-d H:i',!is_numeric($info['create_time'])? strtotime($info['create_time']) : $info['create_time'])); ?></span>
                </div>
            </div>
            <div class="art_desc">
                <?php echo $info['info']; ?>
            </div>
            <?php if(!(empty($house_info) || (($house_info instanceof \think\Collection || $house_info instanceof \think\Paginator ) && $house_info->isEmpty()))): ?>
            <ul class="house-show-box">
                <li>
                    <a href="<?php echo htmlentities($house_info['url']); ?>" title="<?php echo htmlentities($house_info['title']); ?>">
                        <div class="clearfix">
                            <div class="pic">
                                <img src="<?php echo htmlentities($house_info['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($house_info['title']); ?>">
                            </div>
                            <div class="intro-text">
                                <h4 class="saleing">
                                    <?php echo htmlentities($house_info['title']); ?>
                                </h4>
                                <p class="price"><span><?php echo getCityName($house_info['city']); ?></span><span class="price-num"><em><?php echo htmlentities($house_info['price']); ?></em><?php echo htmlentities($house_info['unit']); ?></span></p>
                                <p style="font-size:.65rem;margin-top:5px;">
                                    <a href="tel:<?php echo htmlentities($house_info['sale_phone']['phone']); if(!(empty($house_info['sale_phone']['extension']) || (($house_info['sale_phone']['extension'] instanceof \think\Collection || $house_info['sale_phone']['extension'] instanceof \think\Paginator ) && $house_info['sale_phone']['extension']->isEmpty()))): ?>,<?php echo htmlentities($house_info['sale_phone']['extension']); ?><?php endif; ?>"><?php echo htmlentities($house_info['sale_phone']['phone']); if(!(empty($house_info['sale_phone']['extension']) || (($house_info['sale_phone']['extension'] instanceof \think\Collection || $house_info['sale_phone']['extension'] instanceof \think\Paginator ) && $house_info['sale_phone']['extension']->isEmpty()))): ?>转<?php echo htmlentities($house_info['sale_phone']['extension']); ?><?php endif; ?></a>
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
        <!-- 新闻资讯详情 E -->

        <div class="news-list mt20">
            <div class="title">
                <h3>相关资讯</h3>
            </div>
            <!-- 新闻列表 && 2列 S -->
            <div class="col-2">
                <ul>
                    <?php if(is_array($relation) || $relation instanceof \think\Collection || $relation instanceof \think\Paginator): $i = 0; $__LIST__ = $relation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a href="<?php echo url('News/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <span class="l_con ">
                              <h4 class="art_tit"><?php echo htmlentities($vo['title']); ?></h4>
                              <div class="ft">
                                  <span class="news-type"><?php if(empty($vo['come_from']) || (($vo['come_from'] instanceof \think\Collection || $vo['come_from'] instanceof \think\Paginator ) && $vo['come_from']->isEmpty())): ?><?php echo htmlentities($site['title']); else: ?><?php echo htmlentities($vo['come_from']); ?><?php endif; ?></span>
                                  <span class="time">&nbsp;&nbsp;<?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                              </div>
                            </span>
                            <span class="r_con">
                              <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" class="img">
                            </span>
                        </a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <!-- 新闻列表 && 2列 E -->
        </div>
    </div>
    <!-- 新闻资讯 E-->
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