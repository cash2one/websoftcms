<?php /*a:2:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/broker/index.html";i:1541130102;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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


<div class="main" style="margin-bottom:2rem;background: none;">
    <!-- 经纪人列表 S-->
    <div class="comment-list agent-list">
        <ul class="item">
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li class="clearfix">
                <div class="pic fl">
                    <a href="<?php echo url('Broker/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['nick_name']); ?>">
                        <img src="<?php echo getAvatar($vo['id'],90); ?>" alt="<?php echo htmlentities($vo['nick_name']); ?>">
                    </a>
                </div>
                <div class="comment-content fl">
                    <div class="username-level clearfix">
                        <div class="username fl">
                            <a href="<?php echo url('Broker/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['nick_name']); ?>">
                                <?php echo htmlentities($vo['nick_name']); ?>
                            </a>
                        </div>
                        <div class="level level-<?php echo htmlentities($vo['point']); ?> fl"></div><!-- 等级从0到5 -->
                        <a href="tel:<?php echo htmlentities($vo['mobile']); ?>" class="tel_phone fr">电话咨询</a>
                    </div>
                    <div class="desc_box">
                        <p>
                            <span>所属公司：</span>
                            <span><?php echo htmlentities($vo['company']); ?></span>
                        </p>
                        <p>
                            <span>服务区域：</span>
                            <span>
                                <?php $area=array_filter(explode(',',$vo['service_area'])); if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                            <?php echo getCityName($val,'-'); ?>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            </span>
                        </p>
                        <p><span>在售房源<?php echo htmlentities($vo['second_total']); ?>套  在租房源<?php echo htmlentities($vo['rental_total']); ?>套</span></p>
                    </div>
                    <div class="babel-list clearfix">
                        <?php $tags=array_filter(explode(',',$vo['tags'])); if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
                        <em><?php echo getLinkMenuName(13,$tag); ?></em>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="page_list">
        <?php echo $pages; ?>
    </div>
    <!-- 经纪人列表 E-->
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