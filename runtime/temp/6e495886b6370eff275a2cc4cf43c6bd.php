<?php /*a:3:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/broker/rental.html";i:1540366746;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:83:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/broker/broker_info.html";i:1541130154;}*/ ?>
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


<style>
    .item,.house-show-box{font-size:.7rem;}
</style>
<div class="main" style="padding-bottom:1.92rem;">
    <!-- 经纪人概况 S-->
    <style>
    .page_list{background-color: #fff;padding-bottom:1rem;}
</style>
<div class="agent-survey mb20">
    <div class="pic"><img src="<?php echo getAvatar($userInfo['id'],90); ?>" alt="<?php echo htmlentities($userInfo['nick_name']); ?>"></div>
    <div class="survey">
        <h3><?php echo htmlentities($userInfo['nick_name']); ?></h3>
        <p>
            所属公司：
            <em><?php echo htmlentities($userInfo['userInfo']['company']); ?></em>
        </p>
        <p>服务范围：<em>

            <?php $area=array_filter(explode(',',$userInfo['userInfo']['service_area'])); if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <?php echo getCityName($val,'-'); ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </em></p>
        <p>
            <?php $tags=array_filter(explode(',',$userInfo['userInfo']['tags'])); if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
            <em><?php echo getLinkMenuName(13,$tag); ?></em>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </p>
    </div>
    <ul class="star-level clearfix">
        <?php $__FOR_START_1549106428__=1;$__FOR_END_1549106428__=6;for($i=$__FOR_START_1549106428__;$i < $__FOR_END_1549106428__;$i+=1){ ?>
        <li <?php if($i <= $userInfo["userInfo"]["point"]): ?>class="on"<?php endif; ?>></li>
        <?php } ?>

    </ul>
</div>
    <!-- 经纪人概况 E-->
    <!-- 在租房源 S-->
    <div class="broker-shop-house">
        <h2>在租房源</h2>
        <div class="old-house house-show-box">
            <ul>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
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
                        <p class="price"><span><?php echo getCityName($vo['city']); ?></span><span class="price-num"><em><?php echo $vo['price']; ?></em></span></p>
                        <p class="detail-text"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅 <?php echo htmlentities($vo['acreage']); ?> <?php echo config('filter.acreage_unit'); ?>&nbsp;&nbsp;<?php echo getLinkMenuName(8,$vo['renovation']); ?></p>
                        <p class="good">
                            <?php $tag = array_filter(explode(',',$vo['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                            <em><?php echo htmlentities($val); ?></em>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

            </ul>
        </div>
    </div>
    <!-- 在租房源 E-->
    <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
    <div class="page_list">
        <?php echo $pages; ?>
    </div>
    <?php endif; ?>
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