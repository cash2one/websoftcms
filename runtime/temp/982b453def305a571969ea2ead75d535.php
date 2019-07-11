<?php /*a:3:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/estate/index.html";i:1540785108;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;}*/ ?>
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

<!-- header-top S-->
<div class="header-top">
    <header id="header" class="h-list-head">
        <a href="javascript:;" class="go-back"></a>
        <div class="search-box">
            <input type="text" id="keyword" placeholder="请输入楼盘名或地址">
        </div>
        <a href="<?php echo url('Map/estate'); ?>" class="map-find-room">地图找房</a>
    </header>
    <!-- 筛选 S -->
    <div class="lr-select-box">
        <div class="select_head" id="select_head">
            <div class="item" id="area" data-id="0">
                <span class="tit">区域</span>
                <span class="iconfont icon-xialajiantouxiangxia"></span>
            </div>
            <div class="item" id="price" data-id="0">
                <span class="tit">均价</span>
                <span class="iconfont icon-xialajiantouxiangxia"></span>
            </div>
            <div class="item" id="years" data-id="0">
                <span class="tit">房龄</span>
                <span class="iconfont icon-xialajiantouxiangxia"></span>
            </div>
            <div class="item" id="type" data-id="0">
                <span class="tit">类型</span>
                <span class="iconfont icon-xialajiantouxiangxia"></span>
            </div>
        </div>
        <div class="select_body" id="select_body">
            <div class="item common">
                <div class="item_box">
                    <ul class="one-level" data-uri="<?php echo url('Api/getCityChild'); ?>">
                        <li data-id="0" class="active"><a href="javascript:;">不限</a></li>
                        <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo htmlentities($vo['id']); ?>"><a href="javascript:;"><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <ul class="two-level">
                    </ul>
                </div>
            </div>
            <div class="item common">
                <div class="item_box attr">
                    <ul>
                        <li data-id="0" class="active"><a href="javascript:;">不限</a></li>
                        <?php $_result=getEstatePrice();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo htmlentities($key); ?>"><a href="javascript:;"><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>

            </div>
            <div class="item common">
                <div class="item_box attr">
                    <ul>
                        <li data-id="0" class="active"><a href="javascript:;">不限</a></li>
                        <?php $_result=getYears();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo htmlentities($key); ?>"><a href="javascript:;"><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <div class="item common">
                <div class="item_box attr">
                    <ul>
                        <li data-id="0" class="active"><a href="javascript:;">不限</a></li>
                        <?php if(is_array($house_type) || $house_type instanceof \think\Collection || $house_type instanceof \think\Paginator): $i = 0; $__LIST__ = $house_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo htmlentities($vo['id']); ?>"><a href="javascript:;"><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- 筛选 E -->
    <ul id="search-lists" data-uri="<?php echo url('Ajax/searchEstate'); ?>"></ul>
</div>
<div id="select_bg"></div>
<!-- header-top E-->


<div class="main" style="background: #fff;padding-top:4.5rem;">
    <!-- 小区项目细节 S-->
    <div class="house-show-box village-house-box">
        <ul id="lists" data-uri="<?php echo url('Estate/getEstateLists'); ?>" data-total="<?php echo htmlentities($total_page); ?>">
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="pic">
                    <a href="<?php echo url('Estate/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" />
                    </a>
                </div>
                <div class="intro-text">
                    <h4>
                        <a href="<?php echo url('Estate/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <?php echo htmlentities($vo['title']); ?>
                        </a>
                    </h4>
                    <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo htmlentities($vo['price']); ?></em><?php echo config('filter.second_price_unit'); ?></span></p>
                    <p>
                        <span class="time"><em><?php echo htmlentities($vo['years']); ?></em>年建成</span>&nbsp;&nbsp;
                        <span class="saleing-num">在售<em><?php echo htmlentities($vo['second_total']); ?></em>套&nbsp;&nbsp;在租<em><?php echo htmlentities($vo['rental_total']); ?></em>套</span>
                    </p>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="load-more">
            <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
            <a href="javascript:;" id="load-more">加载更多</a>
            <?php else: ?>
            <p>数据加载完成</p>
            <?php endif; ?>
        </div>
    </div>
    <!--小区项目细节 E-->
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
<script type="text/html" id="search-template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li><a href="{{d[i].url}}"><span>{{d[i].price}}</span><em>{{d[i].title}}</em></a></li>
    {{# } }}
</script>
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
                <a href="{{d[i].url}}" title="{{d[i].title}}" class="clearfix">
                    {{d[i].title}}
                </a>
            </h4>
            <p class="price"><span>{{d[i].city}}</span><span class="price-num"><em>{{d[i].price}}</em>{{d[i].unit}}</span></p>
            <p>
                <span class="time"><em>{{d[i].years}}</em>年建成</span>&nbsp;&nbsp;
                <span class="saleing-num">在售<em>{{d[i].second_total}}</em>套&nbsp;&nbsp;在租<em>{{d[i].rental_total}}</em>套</span>
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
            Lists.requestParam = getParam();
            Lists.getData();
        });
    });
    function getParam()
    {
        var area = $('#area').attr('data-id'),price = $('#price').attr('data-id'),
                type = $('#type').attr('data-id'),years = $('#years').attr('data-id');
        return {
            area : area,
            price : price,
            type  : type,
            years  : years
        };
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