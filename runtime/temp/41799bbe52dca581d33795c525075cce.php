<?php /*a:5:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/detail.html";i:1557453412;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/peitao.html";i:1523094390;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/footer.html";i:1535332940;s:81:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/footer_bar.html";i:1523007706;}*/ ?>
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
    .pic-show img{width:auto;}
</style>
<script src="/static/mobile/js/swiper.min.js"></script>
<link rel="stylesheet" href="/static/mobile/css/swiper.min.css">
<div class="main">
    <!-- 返回键 S-->
    <a href="<?php echo url('House/index'); ?>" title="<?php echo htmlentities($info['title']); ?>" class="detail-go-back"></a>
    <!-- 返回键 E-->
    <!-- 房子图片滚动展示 S-->
    <div class="scroll-roomPic-box">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(!(empty($info['photo']) || (($info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator ) && $info['photo']->isEmpty()))): if(is_array($info['photo']) || $info['photo'] instanceof \think\Collection || $info['photo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['photo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide">
                    <a href="<?php echo url('House/photo',['house_id'=>$id]); ?>"><img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['cate_name']); ?>"  onerror="this.src='/static/images/nopic.jpg'"></a>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; else: ?>
                <div class="swiper-slide">
                    <img src="<?php echo htmlentities($info['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($info['title']); ?>">
                </div>
                <?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="photo-count">
            <a href="<?php echo url('House/photo',['house_id'=>$id]); ?>">(共<?php echo htmlentities($info['photo_total']); ?>张)</a>
        </div>
    </div>
    <!-- 房子图片滚动展示 E-->

    <!-- 房子细节介绍 S-->
    <div class="house-detail-intro mb20">
        <h3 class="house-saling-title"><?php echo htmlentities($info['title']); ?></h3>
        <ul class="intro-small-detail" id="intro">
            <li class="after-three"><span>均&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：<em class="price"><?php echo htmlentities($info['price']); ?></em><?php echo htmlentities($info['unit']); ?></span></li>
            <li class="after-three"><span>开盘时间：<em><?php if(!(empty($info['opening_time']) || (($info['opening_time'] instanceof \think\Collection || $info['opening_time'] instanceof \think\Paginator ) && $info['opening_time']->isEmpty()))): ?><?php echo htmlentities(date('Y-m-d',!is_numeric($info['opening_time'])? strtotime($info['opening_time']) : $info['opening_time'])); ?><?php endif; ?><?php echo htmlentities($info['opening_time_memo']); ?></em></span></li>
            <li class="after-three"><a href=""><span>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：<em><?php echo htmlentities($info['address']); ?></em></span></a></li>
            <li class="after-three"><span>交房时间：<em><?php echo htmlentities(date('Y-m-d',!is_numeric($info['complate_time'])? strtotime($info['complate_time']) : $info['complate_time'])); ?><?php echo htmlentities($info['complate_time_memo']); ?></em></span></a></li>
            <li class="after-three"><span>开&nbsp;发&nbsp;&nbsp;商：<em><?php if(empty($info['developer_name']) || (($info['developer_name'] instanceof \think\Collection || $info['developer_name'] instanceof \think\Paginator ) && $info['developer_name']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['developer_name']); ?><?php endif; ?></em></span></a></li>
            <li class="after-three"><span>物业公司：<em><?php if(empty($info['attr']['property_company']) || (($info['attr']['property_company'] instanceof \think\Collection || $info['attr']['property_company'] instanceof \think\Paginator ) && $info['attr']['property_company']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_company']); ?><?php endif; ?></em></span></a></li>
            <li class="top-three"><span>物&nbsp;业&nbsp;&nbsp;费：<em><?php if(empty($info['attr']['property_fee']) || (($info['attr']['property_fee'] instanceof \think\Collection || $info['attr']['property_fee'] instanceof \think\Paginator ) && $info['attr']['property_fee']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_fee']); ?><?php endif; ?></em></span><span>物业类型：<em><?php if(empty($info['attr']['property_type']) || (($info['attr']['property_type'] instanceof \think\Collection || $info['attr']['property_type'] instanceof \think\Paginator ) && $info['attr']['property_type']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_type']); ?><?php endif; ?></em></span></li>
            <li class="top-three"><span>产权年限：<em><?php if(empty($info['attr']['property_right']) || (($info['attr']['property_right'] instanceof \think\Collection || $info['attr']['property_right'] instanceof \think\Paginator ) && $info['attr']['property_right']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['property_right']); ?><?php endif; ?></em></span><span>建筑类型：<em><?php if(empty($info['attr']['building_type']) || (($info['attr']['building_type'] instanceof \think\Collection || $info['attr']['building_type'] instanceof \think\Paginator ) && $info['attr']['building_type']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['building_type']); ?><?php endif; ?></em></span></li>
            <li class="top-three"><span>占地面积：<em><?php if(empty($info['attr']['area_covered']) || (($info['attr']['area_covered'] instanceof \think\Collection || $info['attr']['area_covered'] instanceof \think\Paginator ) && $info['attr']['area_covered']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['area_covered']); ?><?php endif; ?></em></span><span>建筑面积：<em><?php if(empty($info['attr']['area_build']) || (($info['attr']['area_build'] instanceof \think\Collection || $info['attr']['area_build'] instanceof \think\Paginator ) && $info['attr']['area_build']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['area_build']); ?><?php endif; ?></em></span></li>
            <li class="after-three"><span>车位情况：<em><?php if(empty($info['attr']['parking_space']) || (($info['attr']['parking_space'] instanceof \think\Collection || $info['attr']['parking_space'] instanceof \think\Paginator ) && $info['attr']['parking_space']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['parking_space']); ?><?php endif; ?></em></span></li>
            <li class="after-three"><span>计划户数：<em><?php if(empty($info['attr']['plan_number']) || (($info['attr']['plan_number'] instanceof \think\Collection || $info['attr']['plan_number'] instanceof \think\Paginator ) && $info['attr']['plan_number']->isEmpty())): ?>暂无资料<?php else: ?><?php echo htmlentities($info['attr']['plan_number']); ?><?php endif; ?></em></span></li>
            <li class="after-three"><span>预售证号：<em><?php echo htmlentities($info['license_key']); ?></em></span></li>
        </ul>
    </div>
    <!-- 房子细节介绍 E-->
    <?php if($info['red_packet'] > 0 and getSettingCache('site','red_packet') == 1): ?>
    <!--购房红包-->
    <div class="discount-box">
        <div class="discount-cont">
            <h4 class="discount-title"><?php echo htmlentities($info['title']); ?>专享</h4>
            <h5 class="discount-sub">购房领红包</h5>
            <p class="discount-text">最高可领<span class="price">¥<strong><?php echo htmlentities($info['red_packet']); ?></strong></span></p>
        </div>
        <div class="discount-info">
            <span class="btn dialog" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="3" data-uri="<?php echo url('Dialog/subscribe'); ?>">立即领取</span>
        </div>
    </div>
    <?php endif; if($info['is_discount'] == 1): ?>
    <div class="build-dynamic-box mb20">
        <div class="new-house-title title">
            <h3>楼盘优惠</h3>
        </div>
        <div class="house-content">
            <?php echo $info['discount']; ?>
        </div>
    </div>
    <?php endif; ?>
    <!-- 楼盘动态 S-->
    <div class="build-dynamic-box mb20">
        <div class="new-house-title title">
            <h3>楼盘动态(<span><?php echo htmlentities($info['topNews']['total']); ?></span>)</h3>
            <a href="<?php echo url('House/news',['house_id'=>$id]); ?>">查看全部</a>
        </div>
        <h4>
            <a href="<?php echo url('News/detail',['id'=>$info['topNews']['id']]); ?>" title="<?php echo htmlentities($info['topNews']['title']); ?>"><?php echo htmlentities($info['topNews']['title']); ?></a>
        </h4>
        <p>
            <a href="<?php echo url('News/detail',['id'=>$info['topNews']['id']]); ?>" title="<?php echo htmlentities($info['topNews']['title']); ?>"><?php echo htmlentities($info['topNews']['description']); ?></a>
        </p>
    </div>
    <!-- 楼盘动态 E-->

    <!-- 房源描述 S-->
    <div class="apartment-layout mb20">
        <div class="new-house-title title">
            <h3>主力户型</h3>
            <a href="<?php echo url('House/room',['house_id'=>$id]); ?>" title="全部户型">查看全部</a>
        </div>
        <div class="apartment-layout-box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php $obj = model("house_type");$obj = $obj->where("house_id=$id and status=1");$obj = $obj->field("id,title,room,img,living_room,toilet,acreage,price");$obj = $obj->order("id desc");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <div class="swiper-slide">
                        <a href="<?php echo url('House/roomDetail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                            <span class="pic"><img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>"></span>
                            <span class="intro-text"><em><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅<?php echo htmlentities($data['toilet']); ?>卫</em>&nbsp;|&nbsp;<em><?php echo htmlentities($data['acreage']); ?></em><?php echo config('filter.acreage_unit'); ?></span>
                            <p class="price"><em><?php echo htmlentities($data['price']); ?></em>万</p>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>

                </div>
            </div>
        </div>
    </div>
    <!-- 房源描述 E-->
    <?php if($info['video'] && $storage_open == 1): ?>
    <div class="floorInfo-box mb20">
        <div class="new-house-title title">
            <h3>视频看房</h3>
        </div>
        <div class="">
            <video src="<?php echo getVideoUrl($info['video']); ?>" style="width:100%;height:10rem;" controls="controls" loop="true" poster="<?php echo htmlentities($info['img']); ?>"></video>
        </div>
    </div>
    <?php endif; if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?>
    <div class="floorInfo-box mb20">
        <div class="new-house-title title">
            <h3>全景看房</h3>
            <a href="<?php echo url('Ajax/pano'); ?>?pano_url=<?php echo base64_encode($info['pano_url']); ?>" title="<?php echo htmlentities($info['title']); ?>全景">全屏查看</a>
        </div>
        <div class="pano-content">
            <iframe src="<?php echo htmlentities($info['pano_url']); ?>" width="100%" height="350px" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
    <?php endif; ?>
    <!-- 大家都在问 S-->
    <div class="allask-box question-lists mb20">
        <div class="new-house-title title">
            <h3>大家都在问（<span><?php echo htmlentities($info['question']['total']); ?></span>）</h3>
            <a href="<?php echo url('House/question',['house_id'=>$id]); ?>">查看全部</a>
        </div>
        <ul>
            <?php if(is_array($info['question']['lists']) || $info['question']['lists'] instanceof \think\Collection || $info['question']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['question']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="ask">
                    <a href="<?php echo url('House/questionDetail',['house_id'=>$id,'id'=>$vo['id']]); ?>">
                        <?php echo htmlentities($vo['content']); ?>
                    </a>
                </div>
                <?php if(!(empty($vo['answer']) || (($vo['answer'] instanceof \think\Collection || $vo['answer'] instanceof \think\Paginator ) && $vo['answer']->isEmpty()))): ?>
                <div class="answer"><?php echo htmlentities($vo['answer']); ?></div>
                <div class="num-time">
                    <a class="num"><em><?php echo htmlentities($vo['reply_num']); ?></em>个回答</a>
                    <span class="time"><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                </div>
                <?php else: ?>
                <div class="num-time">
                    <span class="time"><?php echo htmlentities(date('Y-m-d',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                </div>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 大家都在问 E-->


    <!-- 位置周边 S-->
    <div class="per-pos mb20" style="padding-bottom:0;">
        <div class="new-house-title title" style="padding:0 0.62rem;">
            <h3>位置周边</h3>
        </div>
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
    <?php if(!(empty($points) || (($points instanceof \think\Collection || $points instanceof \think\Paginator ) && $points->isEmpty()))): ?>
    <!-- 楼栋信息 S-->
    <div class="floorInfo-box mb20">
        <div class="new-house-title title">
            <h3>楼栋信息</h3>
        </div>
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
        <a href="<?php echo url('House/build',['house_id'=>$id]); ?>" class="more-house-btn">共有<em><?php echo count($ban_lists); ?></em>个楼栋信息，点击查看详情</a>
    </div>
    <!-- 楼栋信息 E-->
    <?php endif; if(!(empty($info['info']) || (($info['info'] instanceof \think\Collection || $info['info'] instanceof \think\Paginator ) && $info['info']->isEmpty()))): ?>
    <div class="build-dynamic-box mb20">
        <div class="new-house-title title">
            <h3>楼盘介绍</h3>
        </div>
        <div class="house-content">
            <?php echo $info['info']; ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="allask-box question-lists mb20" style="padding-right:.66rem;">
        <div class="new-house-title title">
            <h3>楼盘点评</h3>
            <a href="<?php echo url('House/comment',['house_id'=>$id]); ?>">查看全部</a>
        </div>
        <div class="comment-lists">
            <?php $obj = model("comment");$obj = $obj->where("house_id = $id and status = 1 and pid=0");$obj = $obj->field("id,user_id,score,average_score,user_name,content,create_time,support");$obj = $obj->order("create_time desc");$name = $obj->limit(2)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <div class="comment-row">
                <div class="comment-img">
                    <img src="<?php echo getAvatar($data['user_id'],45); ?>" alt="<?php echo htmlentities($data['user_name']); ?>">
                </div>
                <div class="comment-content">
                    <div class="comment-top">
                        <span class="nickname"><?php echo htmlentities($data['user_name']); ?></span>
                        <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?>
                    </div>
                    <div class="comment-score">
                        价格：<?php echo htmlentities($data['score']['price']); ?> &nbsp;&nbsp;地段：<?php echo htmlentities($data['score']['place']); ?> &nbsp;&nbsp;配套：<?php echo htmlentities($data['score']['mating']); ?> &nbsp;&nbsp;交通：<?php echo htmlentities($data['score']['traffic']); ?> &nbsp;&nbsp;环境：<?php echo htmlentities($data['score']['science']); ?>
                    </div>
                    <div class="comment-con">
                        <?php echo htmlentities($data['content']); ?>
                    </div>
                    <div class="comment-view">
                        <div class="view-reply" data-id="20"><img src="/static/mobile/images/icon/list-view.png">查看回复</div>
                    </div>
                    <div class="comment-reply" style="display:none;">
                        <?php $pid = $data['id']; $obj = model("comment");$obj = $obj->where("pid = $pid and status = 1");$obj = $obj->order("create_time desc");$name = $obj->limit(15)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <div class="comment-row">
                            <div class="comment-img">
                                <img src="<?php echo getAvatar($val['user_id'],45); ?>" alt="<?php echo htmlentities($val['user_name']); ?>">
                            </div>
                            <div class="comment-content">
                                <div class="comment-top">
                                    <span class="nickname"><?php echo htmlentities($val['user_name']); ?></span>
                                    <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                                </div>
                                <div class="comment-con">
                                    <?php echo htmlentities($val['content']); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            <a id="comment-btn" href="<?php echo url('House/sendComment',['house_id'=>$info['id']]); ?>" class="but03">我要点评</a>
        </div>
    </div>
    <!-- 热门楼盘 S-->
    <div class="house-show-box mb20 pt30">
        <div class="title">
            <h3>您可能感兴趣的楼盘</h3>
            <a href="<?php echo url('House/index'); ?>" title="更多新房">更多</a>
        </div>
        <ul>
            <?php if(is_array($interest) || $interest instanceof \think\Collection || $interest instanceof \think\Paginator): $i = 0; $__LIST__ = $interest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="pic">
                    <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                    </a>
                </div>
                <div class="intro-text">
                    <h4 class="saleing">
                        <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <?php echo htmlentities($vo['title']); ?>
                        </a>
                    </h4>
                    <p class="price"><span><?php echo getCityName($vo['city']); ?></span><span class="price-num"><em><?php echo htmlentities($vo['price']); ?></em><?php echo htmlentities($vo['unit']); ?></span></p>
                    <p><span><?php echo htmlentities($vo['min_acreage']); ?>-<?php echo htmlentities($vo['max_acreage']); ?><?php echo config('filter.acreage_unit'); ?></span><i>|</i><span><?php echo htmlentities($vo['min_type']); ?>-<?php echo htmlentities($vo['max_type']); ?>室</span></p>
                    <p class="good">
                        <?php $tags = array_filter(explode(',',$vo['tags_id'])); if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $n = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;if($n < 4): ?>
                        <em><?php echo getLinkMenuName(3,$val); ?></em>
                        <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 热门楼盘 E-->

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
<script>
    var mySwiper = new Swiper('.swiper-container', {
        slidesPerView:'auto'
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