<?php /*a:3:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/build.html";i:1531961470;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:81:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/footer_bar.html";i:1523007706;}*/ ?>
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
    .house-type-list{background-color: #fff;}
</style>
<div class="main" style="padding-bottom:2rem;">
    <div class="build-info">
        <div class="build-img">
            <div style="width:100%;overflow: auto;">
                <div style="margin-top:1rem;position:relative;height:300px;<?php if($points['width'] > 640): ?>transform: matrix(0.35, 0, 0, 0.39, -119, -101);<?php else: ?>transform: matrix(0.5, 0, 0, 0.6, -60, -70);<?php endif; ?>">
                    <div id="house-ban" class="pic-show" style="position:absolute;left:0;top:0;<?php if($points['width'] < 640): ?>width:<?php echo htmlentities($points['height']+10); ?>px;<?php endif; ?>">
                        <img src="<?php echo htmlentities($points['img']); ?>" alt="<?php echo htmlentities($info['title']); ?>楼栋信息" width="<?php echo htmlentities($points['width']); ?>" height="<?php echo htmlentities($points['height']); ?>">
                        <?php if(is_array($points['data']) || $points['data'] instanceof \think\Collection || $points['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $points['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;$point=explode(',',$vo['point']); ?>
                        <a href="javascript:;" data-position="<?php echo htmlentities($vo['point']); ?>" data-bid="<?php echo htmlentities($vo['id']); ?>" class="ban status-<?php echo htmlentities($vo['sale']); ?>" title="<?php echo htmlentities($vo['title']); ?>" style="transform: scale(1.2);position:absolute;left: <?php echo htmlentities($point[0]); ?>px; top: <?php echo htmlentities($point[1]); ?>px;"><i></i><?php echo htmlentities($vo['title']); ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="lists" data-uri="<?php echo url('Api/getBanInfoById'); ?>">

        </div>
    </div>
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
<script id="template" type="text/html">
    <div class="build-info-desc">
        <header class="head clearfix">
            <span class="name">{{d['ban_info']['title']}}</span>
            <span class="sale-status on">{{d['ban_info']['sale_status_name']}}</span> <!--在售 on，待售 for，售罄 off -->
        </header>
        <div class="date clearfix">
            <div class="fl">
                <span class="tit">开盘时间：</span><span class="time">{{# if(d['ban_info']['open_time']){ }}{{d.ban_info.open_time}}{{# } }}</span>
            </div>
            <div class="fr">
                <span class="tit">预计交房：</span><span class="time">{{# if(d['ban_info']['complate_time']){ }}{{d.ban_info.complate_time}}{{# } }}</span>
            </div>
        </div>
        <ul class="build-word clearfix">
            <li><span class="tit">单元：</span><span class="txt">{{# if(d['ban_info']['unit']){ }}{{d.ban_info.unit}}{{# } }}</span></li>
            <li><span class="tit">层数：</span><span class="txt">{{# if(d['ban_info']['floor_num']){ }}{{d.ban_info.floor_num}}{{# } }}</span></li>
            <li><span class="tit">户数：</span><span class="txt">{{# if(d['ban_info']['room_num']){ }}{{d.ban_info.room_num}}{{# } }}</span></li>
            <li><span class="tit">电梯数：</span><span class="txt">{{# if(d['ban_info']['elevator']){ }}{{d.ban_info.elevator}}{{# } }}</span></li>
        </ul>
    </div>
    {{# if(d.type_lists.length>0){ }}
    <div class="house-type-list">
        <ul>
            {{# for(var i = 0, len = d.type_lists.length; i < len; i++){ }}
            <li>
                <a href="{{d.type_lists[i].url}}">
                    <div class="l_img">
                        <img src="{{d.type_lists[i].img}}" onerror="this.src='/static/images/nopic.jpg'" alt="">
                    </div>
                    <div class="r_con">
                        <div class="t">
                            <span>{{d.type_lists[i].room}}室{{d.type_lists[i].living_room}}厅 </span>
                            <span>{{d.type_lists[i].acreage}}㎡</span>
                        </div>
                        <div class="c"><span>{{d.type_lists[i].title}}</span><span class="sale-status on">{{d.type_lists[i].sale_status}}</span></div> <!--on在售，for待售，off售罄-->
                        <div class="b"><span>{{d.type_lists[i].orientation}}朝向</span></div>
                        <div class="price"><b>{{d.type_lists[i].price}}</b>万</div>
                    </div>
                </a>
            </li>
            {{# } }}
        </ul>
    </div>
    {{# } }}
</script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script type="text/javascript">
    $(function(){
        getBanInfo($(".ban:first").data('bid'));
        $(".ban").on('click',function(){
            var id = $(this).data('bid');
            getBanInfo(id);
        });
    });
    function getBanInfo(id)
    {
        var url   = $("#lists").data('uri');
        var param = {id:id};
        $.get(url,param,function(result){
            if(result.code == 1)
            {
                if(result.data){
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        document.getElementById('lists').innerHTML = html;
                    });
                }
            }else{
                console.log('get data error');
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