<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/news/index.html";i:1544780000;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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


<link rel="stylesheet" href="/static/mobile/css/swiper.min.css">
<div class="main" style="background: none;padding-bottom:1.95rem;">
    <!-- 新闻资讯 S-->
    <div class="news">
        <div class="tab_hd follow-h-switch clearfix">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide active"> <a href="<?php echo url('News/index'); ?>" <?php if($cate_id == 0): ?>class="on"<?php endif; ?>>全部</a></div>
                    <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="swiper-slide"><a href="<?php echo url('News/index',['cate'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['name']); ?>" <?php if($vo['id'] == $cate_id): ?>class="on"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <input type="hidden" name="cate_id" id="cate_id" value="<?php echo htmlentities($cate_id); ?>">
        </div>
        <div class="news-list">
            <!-- 新闻列表 && 2列 S -->
            <div>
                <ul id="lists" data-uri="<?php echo url('News/getNewsLists'); ?>" data-total="<?php echo htmlentities($total_page); ?>">
                    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(is_string($vo["img"])): ?>
                    <li class="col-2">
                        <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <span class="l_con ">
                              <h4 class="art_tit"><?php echo htmlentities($vo['title']); ?></h4>
                              <div class="ft">
                                  <span class="news-type"><?php echo htmlentities($vo['come_from']); ?>&nbsp;&nbsp;</span>
                                  <span class="time"><?php echo htmlentities($vo['create_time_date']); ?></span>
                              </div>
                            </span>
                            <span class="r_con">
                              <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" class="img">
                            </span>
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="col-3">
                        <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <h4 class="art_tit"><?php echo htmlentities($vo['title']); ?></h4>
                            <div class="list_img clearfix">
                                <?php if(is_array($vo['img']) || $vo['img'] instanceof \think\Collection || $vo['img'] instanceof \think\Paginator): $k = 0; $__LIST__ = $vo['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;if($k < 4): ?>
                                <img src="<?php echo htmlentities($val); ?>" alt="<?php echo htmlentities($vo['title']); ?>" onerror="this.src='/static/images/nopic.jpg'" class="img">
                                <?php endif; ?>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <div class="ft">
                                <span class="news-type"><?php echo htmlentities($vo['come_from']); ?>&nbsp;&nbsp;</span>
                                <span class="time"><?php echo htmlentities($vo['create_time_date']); ?></span>
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </ul>
                <div class="load-more">
                    <?php if($total_page > 1): ?>
                    <a href="javascript:;" id="load-more">加载更多</a>
                    <?php else: ?>
                    <p>数据加载完成</p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- 新闻列表 && 2列 E -->
        </div>
    </div>
    <!-- 新闻资讯 E-->
</div>
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    {{# if(Object.prototype.toString.call(d[i].img)=='[object Array]'){ }}
    <li class="col-3">
        <a href="{{d[i].url}}" title="{{d[i].title}}">
            <h4 class="art_tit">{{d[i].title}}</h4>
            <div class="list_img clearfix">
                {{# for(var j = 0, length = d[i].img.length; j < length; j++){ }}
                {{# if(j < 3){ }}
                <img src="{{d[i]['img'][j]}}" alt="{{d[i].title}}" onerror="this.src='/static/images/nopic.jpg'" class="img">
                {{# } }}
                {{# } }}
            </div>
            <div class="ft">
                <span class="news-type">{{d[i].come_from}}&nbsp;&nbsp;</span>
                <span class="time">{{d[i].create_time_date}}</span>
            </div>
        </a>
    </li>
    {{# }else{ }}
    <li class="col-2">
        <a href="{{d[i].url}}" title="{{d[i].title}}">
            <span class="l_con ">
              <h4 class="art_tit">{{d[i].title}}</h4>
              <div class="ft">
                  <span class="news-type">{{d[i].come_from}}&nbsp;&nbsp;</span>
                  <span class="time">{{d[i].create_time_date}}</span>
              </div>
            </span>
            <span class="r_con">
              <img src="{{d[i].img}}" onerror="this.src='/static/images/nopic.jpg'" alt="{{d[i].title}}" class="img">
            </span>
        </a>
    </li>
    {{# } }}

    {{# } }}

</script>
<script src="/static/mobile/js/swiper.min.js"></script>
<script src="/static/js/layer/laytpl.js"></script>
<script src="/static/mobile/js/getData.js"></script>
<script type="text/javascript">
    $(function(){
        var mySwiper = new Swiper('.swiper-container', {
            slidesPerView : 'auto'
        });
        $('#load-more').on('click',function() {
            Lists.requestParam = {cate_id: $('#cate_id').val()};
            Lists.getData();
        });
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