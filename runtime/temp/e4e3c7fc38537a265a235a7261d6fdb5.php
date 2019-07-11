<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/room.html";i:1523009750;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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
    <!-- 新闻资讯 S-->
    <div class="house-type">
        <div class="tab_hd clearfix">
            <a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" <?php if($room == 0): ?>class="on"<?php endif; ?>>全部（<span id="total">0</span>）</a>
            <?php if(is_array($info['room_cate']) || $info['room_cate'] instanceof \think\Collection || $info['room_cate'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['room_cate'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo url('House/room',['house_id'=>$info['id'],'room'=>$vo['room']]); ?>" <?php if($room == $vo['room']): ?>class="on"<?php endif; ?>><?php echo htmlentities($vo['room']); ?>室(<span class="room-cate"><?php echo htmlentities($vo['total']); ?></span>)</a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="house-type-list">
            <ul>
                <?php $sale_status = getLinkMenuCache(5); if(is_array($room_list) || $room_list instanceof \think\Collection || $room_list instanceof \think\Paginator): $i = 0; $__LIST__ = $room_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <a href="<?php echo url('House/roomDetail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <div class="l_img">
                            <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                        </div>
                        <div class="r_con">
                            <div class="t">
                                <span><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅<?php echo htmlentities($vo['toilet']); ?>卫 </span>
                                <span><?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></span>
                            </div>
                            <div class="c"><span><?php echo htmlentities($vo['title']); ?></span><span class="sale-status on"><?php echo htmlentities($sale_status[$vo['sale_status']]['name']); ?></span></div> <!--on在售，for待售，off售罄-->
                            <?php if(!(empty($vo['orientation']) || (($vo['orientation'] instanceof \think\Collection || $vo['orientation'] instanceof \think\Paginator ) && $vo['orientation']->isEmpty()))): ?><div class="b"><span><?php echo getLinkMenuName(4,$vo['orientation']); ?>朝向</span></div><?php endif; ?>
                            <div class="price"><b><?php echo htmlentities($vo['price']); ?></b>万</div>
                        </div>
                    </a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="page_list">
                <?php echo $pages; ?>
            </div>
        </div>
    </div>
    <!-- 新闻资讯 E-->
</div>
<script type="text/javascript">
    var total = 0;
    $(function(){
        $(".room-cate").each(function(){
            total += parseInt($(this).text());
        });
        $("#total").text(total);
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