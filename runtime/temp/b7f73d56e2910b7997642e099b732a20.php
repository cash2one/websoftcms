<?php /*a:3:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/group/index.html";i:1533263252;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;}*/ ?>
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

<style>
    .search-box{background: none;text-align:center;color:#fff;}
    .search-box::before{background: none;}
</style>
<!-- header-top S-->
<div class="header-top">
    <header id="header" class="h-list-head">
        <a href="javascript:;" class="go-back"></a>
        <div class="search-box">
            团购优惠
        </div>
        <a href="javascript:;">&nbsp;</a>
    </header>
</div>
<div id="select_bg"></div>
<!-- header-top E-->


<div class="main" style="background: #fff;padding-top:2.5rem;">
    <!-- 团购列表 S-->
    <div class="old-house house-show-box">
        <ul id="lists" data-uri="<?php echo url('Group/getGroupLists'); ?>" data-total="<?php echo htmlentities($total_page); ?>">
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('Group/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                    <div class="clearfix">
                        <div class="pic">
                            <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" />
                        </div>
                        <div class="intro-text">
                            <h4>
                                <?php echo htmlentities($vo['house_title']); ?>
                            </h4>
                            <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo htmlentities($vo['price']); ?></em><?php echo config('filter.house_price_unit'); ?></span></p>
                            <p style="padding-top:10px;">
                                <span class="time-remain" data-down="<?php echo htmlentities($vo['end_time']-time()); ?>"><i class="icon iconfont icon-clock text20"></i> <i class="text20" time_id="d">0</i> 天 <i class="text20" time_id="h">0</i> 小时 <i class="text20" time_id="m">0</i> 分钟  <i class="text20" time_id="s">0</i> 秒</span>
                            </p>
                        </div>
                    </div>
                    <div class="list-discount">
                        <span>惠</span><?php echo htmlentities($vo['discount']); ?>
                    </div>
                </a>

            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

        </ul>
        <div class="load-more">
            <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
            <a href="javascript:;" id="load-more">加载更多</a>
            <?php else: ?>
            <p>数据加载完成</p>
            <?php endif; ?>
        </div>
    </div>
    <!--二手房项目细节 E-->

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
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li>
        <div class="pic">
            <a href="{{d[i].url}}" title="{{d[i].title}}" class="clearfix">
                <img src="{{d[i].img}}" alt="{{d[i].title}}" onerror="this.src='/static/images/nopic.jpg'" />
            </a>
        </div>
        <div class="intro-text">
            <h4>
                <a href="{{d[i].url}}" title="{{d[i].house_title}}" class="clearfix">
                    {{d[i].house_title}}
                </a>
            </h4>
            <p class="price"><span>{{d[i].city}}</span><span class="price-num"><em>{{d[i].price}}</em></span></p>
            <p class="good">{{d[i].discount}}</p>
            <p style="padding-top:10px;">
                <span class="time-remain" data-down="{{d[i].end_time}}"><i class="icon iconfont icon-clock text20"></i> <i class="text20" time_id="d">0</i> 天 <i class="text20" time_id="h">0</i> 小时 <i class="text20" time_id="m">0</i> 分钟  <i class="text20" time_id="s">0</i> 秒</span>
            </p>
        </div>
    </li>
    {{# } }}

</script>
<script src="/static/js/layer/laytpl.js"></script>
<script src="/static/mobile/js/search.js"></script>
<script src="/static/mobile/js/getData.js"></script>
<script type="text/javascript">
    $(function(){
        $('#load-more').on('click',function(){
            Lists.requestParam = {};
            Lists.getData();
        });
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