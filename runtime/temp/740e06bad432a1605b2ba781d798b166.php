<?php /*a:4:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/estate/detail.html";i:1547018316;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/peitao.html";i:1523094390;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;}*/ ?>
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


<link rel="stylesheet" href="/static/mobile/css/swiper.min.css">
<div class="main">
    <!-- 返回键 S-->
    <a href="javascript:" class="detail-go-back"></a>
    <!-- 返回键 E-->
    <!-- 房子图片滚动展示 S-->
    <div class="scroll-roomPic-box">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['title']); ?>" onerror="this.src='/static/images/nopic.jpg'">
                </div>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlentities($info['img']); ?>" alt="<?php echo htmlentities($info['title']); ?>" onerror="this.src='/static/images/nopic.jpg'">
                </div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- 房子图片滚动展示 E-->

    <!-- 房子细节介绍 S-->
    <div class="house-detail-intro village-detail-intro">
        <div class="i-name-price">
            <div class="itemName"><?php echo htmlentities($info['title']); if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?><a href="<?php echo url('Ajax/pano'); ?>?pano_url=<?php echo base64_encode($info['pano_url']); ?>" title="<?php echo htmlentities($info['title']); ?>全景" class="house-pano"></a><?php endif; ?></div>
            <div class="itemPrice">均价：<em><?php echo htmlentities($info['price']); ?></em><?php echo config('filter.second_price_unit'); ?></div>
        </div>
        <ul class="price-house-area mb20">
            <li>
                <a href="<?php echo url('Second/index',['estate_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>二手房"><em><span><?php echo htmlentities($info['second_total']); ?></span>套</em></a>
                <p>二手房源</p>
            </li>
            <li>
                <a href="<?php echo url('Rental/index',['estate_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>出租房"><em><span><?php echo htmlentities($info['rental_total']); ?></span>套</em></a>
                <p>出租房源</p>
            </li>
            <li>
                <em><span><?php echo htmlentities($info['complate_num']); ?></span>套</em>
                <p>最近成交</p>
            </li>
        </ul>

    </div>
    <!-- 房子细节介绍 E-->
    <div class="intro-small-detail village-small-detail mb20">
        <h2>基本信息</h2>
        <ul id="intro">
            <li class="top-three"><span>建筑年代：<em class="year"><?php echo htmlentities($info['years']); ?></em></span><span>建筑类型：<em><?php if(!(empty($info['data']['building_type']) || (($info['data']['building_type'] instanceof \think\Collection || $info['data']['building_type'] instanceof \think\Paginator ) && $info['data']['building_type']->isEmpty()))): ?><?php echo htmlentities($info['data']['building_type']); else: ?>暂无资料<?php endif; ?></em></span></li>
            <li class="top-three"><span>物业类型：<em class="num-house"><?php echo getLinkMenuName(9,$info['house_type']); ?></em></span><span>物业费：<em><?php if(!(empty($info['data']['property_fee']) || (($info['data']['property_fee'] instanceof \think\Collection || $info['data']['property_fee'] instanceof \think\Paginator ) && $info['data']['property_fee']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_fee']); else: ?>暂无资料<?php endif; ?></em></span></li>
            <li class="top-three"><span>总户数：<em><?php if(!(empty($info['data']['plan_number']) || (($info['data']['plan_number'] instanceof \think\Collection || $info['data']['plan_number'] instanceof \think\Paginator ) && $info['data']['plan_number']->isEmpty()))): ?><?php echo htmlentities($info['data']['plan_number']); else: ?>暂无资料<?php endif; ?></em></span><span>产权年限：<em><?php if(!(empty($info['data']['property_right']) || (($info['data']['property_right'] instanceof \think\Collection || $info['data']['property_right'] instanceof \think\Paginator ) && $info['data']['property_right']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_right']); else: ?>暂无资料<?php endif; ?></em></span></li>
            <li class="after-three"><a href="javascript:;"><span>地址：<em><?php echo htmlentities($info['address']); ?></em></span></a></li>
            <li class="top-three" style="display:none;"><span>绿化率：<em><?php if(!(empty($info['data']['greening_rate']) || (($info['data']['greening_rate'] instanceof \think\Collection || $info['data']['greening_rate'] instanceof \think\Paginator ) && $info['data']['greening_rate']->isEmpty()))): ?><?php echo htmlentities($info['data']['greening_rate']); else: ?>暂无资料<?php endif; ?></em></span><span>容积率：<em><?php if(!(empty($info['data']['volume_ratio']) || (($info['data']['volume_ratio'] instanceof \think\Collection || $info['data']['volume_ratio'] instanceof \think\Paginator ) && $info['data']['volume_ratio']->isEmpty()))): ?><?php echo htmlentities($info['data']['volume_ratio']); else: ?>暂无资料<?php endif; ?></em></span></li>
            <li class="top-three" style="display:none;"><span>占地面积：<em><?php if(!(empty($info['data']['area_covered']) || (($info['data']['area_covered'] instanceof \think\Collection || $info['data']['area_covered'] instanceof \think\Paginator ) && $info['data']['area_covered']->isEmpty()))): ?><?php echo htmlentities($info['data']['area_covered']); else: ?>暂无资料<?php endif; ?></em></span><span>建筑面积：<em><?php if(!(empty($info['data']['area_build']) || (($info['data']['area_build'] instanceof \think\Collection || $info['data']['area_build'] instanceof \think\Paginator ) && $info['data']['area_build']->isEmpty()))): ?><?php echo htmlentities($info['data']['area_build']); else: ?>暂无资料<?php endif; ?></em></span></li>
            <li class="after-three" style="display:none;"><a href="javascript:;"><span>物业公司：<em><?php if(!(empty($info['data']['property_company']) || (($info['data']['property_company'] instanceof \think\Collection || $info['data']['property_company'] instanceof \think\Paginator ) && $info['data']['property_company']->isEmpty()))): ?><?php echo htmlentities($info['data']['property_company']); else: ?>暂无资料<?php endif; ?></em></span></a></li>
            <li class="after-three" style="display:none;"><a href="javascript:;"><span>开发商：<em><?php if(!(empty($info['data']['developer']) || (($info['data']['developer'] instanceof \think\Collection || $info['data']['developer'] instanceof \think\Paginator ) && $info['data']['developer']->isEmpty()))): ?><?php echo htmlentities($info['data']['developer']); else: ?>暂无资料<?php endif; ?></em></span></a></li>
            <li class="after-three" style="display:none;"><a href="javascript:;"><span>停车位：<em><?php if(!(empty($info['data']['parking_space']) || (($info['data']['parking_space'] instanceof \think\Collection || $info['data']['parking_space'] instanceof \think\Paginator ) && $info['data']['parking_space']->isEmpty()))): ?><?php echo htmlentities($info['data']['parking_space']); else: ?>暂无资料<?php endif; ?></em></span></a></li>
            <li class="after-three" style="display:none;"><a href="javascript:;"><span>特色：
                <em>
                    <?php $tag = array_filter(explode(',',$info['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <i class="item item<?php echo htmlentities($i); ?>"><?php echo htmlentities($val); ?></i>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </em>
            </span></a></li>

        </ul>
        <a href="javascript:;" id="expand">展开</a>
    </div>

    <!-- 位置周边 S-->
    <div class="per-pos">
        <h2>位置周边</h2>
        <div class="mapshow-per-pos">
    <div class="hb support">
        <em class="active" search-flag="bus">公交</em>
        <em search-flag="school">教育</em>
        <em search-flag="hospital">医疗</em>
        <em search-flag="shopping">购物</em>
        <em search-flag="life">生活</em>
        <em search-flag="entertainment">娱乐</em>
    </div>
    <div class="mapshow-box" id="map">
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo config('baidu_map_ak'); ?>"></script>
<script src="/static/js/peitao.js"></script>
<script>
    var lng = '<?php echo htmlentities($info['lng']); ?>';
    var lat = '<?php echo htmlentities($info['lat']); ?>';
    var streetView = 0;
    BMapApplication.isMobile = true;
    BMapApplication.title    = "<?php echo htmlentities($info['title']); ?>";
    BMapApplication.saleStatus = "<?php echo htmlentities((isset($info['sale_status']) && ($info['sale_status'] !== '')?$info['sale_status']:1)); ?>";
    BMapApplication.init({'lng' : lng, 'lat' : lat, 'mapContainerId' : 'map'});
    BMapApplication.getAreaMap('公交', 'bus');
    $('.support em').click(function (evt){
        $(this).addClass('active').siblings().removeClass('active');
        var iElem = $(this);
        BMapApplication.getAreaMap(iElem.text(), iElem.attr('search-flag'));
        evt.stopPropagation();
    });
</script>
    </div>
    <!-- 位置周边 E-->

    <!-- 同小区房源 S-->
    <div class="same-commu-res">
        <h2>小区二手房</h2>
        <div class="old-house house-show-box">
            <ul>
                <?php $estate_id=$info['id']; $obj = model("second_house");$obj = $obj->where("estate_id=$estate_id and status=1");$obj = $obj->field("id,title,img,city,room,living_room,tags,acreage,price");$obj = $obj->order("create_time desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>

                <li>
                    <div class="pic">
                        <a href="<?php echo url('Second/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                            <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>">
                        </a>
                    </div>
                    <div class="intro-text">
                        <h4>
                            <a href="<?php echo url('Second/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                <?php echo htmlentities($data['title']); ?>
                            </a>
                        </h4>
                        <p class="price"><span><?php echo getCityName($data['city']); ?></span><span class="price-num"><em><?php echo $data['price']; ?></em></span></p>
                        <p class="detail-text"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅&nbsp;&nbsp;<?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                        <p class="good">
                            <?php $tag = array_filter(explode(',',$data['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $n = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;if(is_numeric($val)): ?>
                            <em><?php echo getLinkMenuName(14,$val); ?></em>
                            <?php else: ?>
                            <em><?php echo htmlentities($val); ?></em>
                            <?php endif; ?>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

            </ul>
        </div>
        <a href="<?php echo url('Second/index',['estate_id'=>$info['id']]); ?>" class="more-house-btn">查看全部二手房源</a>
    </div>
    <!-- 小区二手房 E-->

    <!-- 小区出租房 S-->
    <div class="village-lease-room">
        <h2>小区出租房</h2>
        <div class="old-house house-show-box">
            <ul>
                <?php $obj = model("rental");$obj = $obj->where("estate_id=$estate_id and status=1");$obj = $obj->field("id,title,img,city,room,living_room,tags,acreage,price");$obj = $obj->order("create_time desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>

                <li>
                    <div class="pic">
                        <a href="<?php echo url('Rental/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                            <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>">
                        </a>
                    </div>
                    <div class="intro-text">
                        <h4>
                            <a href="<?php echo url('Rental/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                <?php echo htmlentities($data['title']); ?>
                            </a>
                        </h4>
                        <p class="price"><span><?php echo getCityName($data['city']); ?></span><span class="price-num"><em><?php echo $data['price']; ?></em></span></p>
                        <p class="detail-text"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅&nbsp;&nbsp;<?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                        <p class="good">
                            <?php $tag = array_filter(explode(',',$data['tags'])); if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                            <em><?php echo htmlentities($val); ?></em>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

            </ul>
        </div>
        <a href="<?php echo url('Rental/index',['estate_id'=>$info['id']]); ?>" class="more-house-btn">查看全部出租房源</a>
    </div>
    <!-- 小区出租房 E-->
    <!-- 小区成交记录 S -->
    <div class="make-deal-record mb20">
        <header class="title clearfix">
            <h2 class="fl">小区成交记录</h2>
        </header>
        <ul class="list" id="record-list">
            <?php if(is_array($record) || $record instanceof \think\Collection || $record instanceof \think\Paginator): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li <?php if($i > 4): ?>style="display:none;"<?php endif; ?>>
                <a href="javascript:;" class="clearfix">
                    <span class="fl">
                      <span class="m_c"><?php echo htmlentities($vo['title']); ?>&nbsp;<?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></span>
                      <time class="time"><?php echo htmlentities($vo['complate_time']); ?></time>
                    </span>
                    <span class="fr">
                      <span class="price"><?php echo htmlentities($vo['price']); ?>万</span>
                    </span>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
        <?php if(count($record) > 4): ?><a href="javascript:;" id="more-record" class="more-house-btn">点击查看更多</a><?php endif; ?>
    </div>
    <!-- 小区成交记录 E -->

    <!-- 附近小区 S-->
    <div class="house-show-box village-house-box">
        <ul>
            <?php if(is_array($near_by_estate) || $near_by_estate instanceof \think\Collection || $near_by_estate instanceof \think\Paginator): $i = 0; $__LIST__ = $near_by_estate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="pic">
                    <a href="<?php echo url('Estate/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <img onerror="this.src='/static/images/nopic.jpg'" src="<?php echo htmlentities($vo['img']); ?>" alt="<?php echo htmlentities($vo['title']); ?>">
                    </a>
                </div>
                <div class="intro-text">
                    <h4>
                        <a href="<?php echo url('Estate/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <?php echo htmlentities($vo['title']); ?>
                        </a>
                    </h4>
                    <p class="price"><span><?php echo getCityName($vo['city']); ?></span><span class="price-num"><em><?php echo htmlentities($vo['price']); ?></em><?php echo config('filter.second_price_unit'); ?></span></p>
                    <p>
                        <span class="time"><em><?php echo htmlentities($vo['years']); ?></em>年建成</span>&nbsp;&nbsp;
                    </p>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
    </div>
    <!-- 附近小区 E-->


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
<script src="/static/mobile/js/swiper.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop : true,
        autoplay: 4000,//可选选项，自动滑动
        initialSlide :0,
        pagination : '.swiper-pagination',
        paginationType: 'fraction'
    });
    $(function(){
        $('#more-record').on('click',function(){
            $('#record-list li:gt(3)').show();
        });
        $('#expand').on('click',function(){
            if($(this).hasClass('expand'))
            {
                $(this).text('展开').removeClass('expand');
                $('#intro').find('li:gt(3)').hide();
            }else{
                $(this).text('收起').addClass('expand');
                $('#intro').find('li:gt(3)').show();
            }
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