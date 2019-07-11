<?php /*a:4:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/home/view/group/detail.html";i:1541234322;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:75:"/home/wwwroot/gxwebsoft/public_html/application/home/view/group/search.html";i:1527954110;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script>
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {     //移动终端浏览器版本信息
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                    iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            } (),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        };
        if (browser.versions.mobile) {
            window.location.href = "<?php echo config('mobile_domain'); ?>"+window.location.pathname;
        }
    </script>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/common.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/input.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/css.css">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
<!-- topBar S -->
<div class="topBar">
    <div class="comWidth clearfix">
        <div class="logo fl">
            <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">
                <img src="<?php echo htmlentities($site['pc_logo_white']); ?>" alt="<?php echo htmlentities($site['title']); ?>" />
            </a>
        </div>
        <div class="fl sele_city">
            <a href="javascript:;"  class="sele_city_btn"><?php echo htmlentities($cityInfo['name']); ?><img src="/static/home/images/icon/icon15.png" alt="" class="icon"></a>
            <div class="city_list clearfix">
                <i class="city-close">关闭</i>
                <?php if(is_array($top_nav_city['city']) || $top_nav_city['city'] instanceof \think\Collection || $top_nav_city['city'] instanceof \think\Paginator): $i = 0; $__LIST__ = $top_nav_city['city'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <dl class="clearfix">
                    <dt class="bold"><?php echo htmlentities($key); ?></dt>
                    <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <dd <?php if($val['is_hot'] == 1): ?>class="hot"<?php endif; ?>><a href="<?php echo url($controller.'/index@'.$val['domain']); ?>" title="<?php echo htmlentities($val['name']); ?>"><?php echo htmlentities($val['name']); ?></a></dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="navBar fl">
            <ul class="nav_list fl">
                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 1): ?>
                <li <?php if($vo['model'] == $cur_url): ?>class="active"<?php endif; ?>>
                    <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"  target="<?php echo htmlentities($vo['open_type']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                    <?php if(isset($vo['_child'])): ?>
                    <ul>
                        <?php if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo htmlentities($val['url']); ?>" title="<?php echo htmlentities($val['title']); ?>" target="<?php echo htmlentities($val['open_type']); ?>"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="log_link fr">
            <?php if(!(empty($userInfo) || (($userInfo instanceof \think\Collection || $userInfo instanceof \think\Paginator ) && $userInfo->isEmpty()))): ?>
            <!-- 已登录状态 -->
            <div class="loged">
                <div class="user_info">
                    <img src="<?php echo getAvatar($userInfo['id'],30); ?>" width="30" height="30" alt="">
                    <span class="name"><?php echo hideStr($userInfo['nick_name']); ?></span>
                </div>
                <div class="slide_tog" style="display:none;">
                    <a href="<?php echo url('user.index/index'); ?>">用户中心</a>
                    <a href="<?php echo url('Login/logout'); ?>">退出登录</a>
                </div>
            </div>
            <?php else: ?>
            <!-- 未登录状态 -->
            <div class="not_log">
                <a href="<?php echo url('Login/index'); ?>">登录</a>
                /
                <a href="<?php echo url('Login/register'); ?>">注册</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- topBar E -->


<link rel="stylesheet" href="/static/home/css/group.css">
<div class="searBar ">
    <div class="comWidth clearfix">
    <div class="sear_box fl">
        <form action="<?php echo url('House/index'); ?>">
            <div class="ipt_area fl">
                <input type="text" name="keyword" id="keyword" autocomplete="off" placeholder="输入楼盘名称" data-uri="<?php echo url('Ajax/searchHouse'); ?>" class="ipt">
                <span class="placeholder">输入楼盘名称</span>
                <ul id="search-box">
                </ul>
            </div>
            <div class="btn_area fl">
                <input type="submit" class="sbm_btn" value="搜索">
            </div>
        </form>
    </div>
    <a href="<?php echo url('Map/index'); ?>" class="map_btn fr">地图找房</a>
</div>
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li>
        <a href="{{d[i].url}}" target="_blank">
            <span>
                <em>{{d[i].price}}{{d[i].unit}}</em>
                 {{d[i].title}}
            </span>
            <span class="address">
                {{d[i].address}}
            </span>
        </a>
    </li>
    {{# } }}
</script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script>
    $(function(){
        $("#keyword").on('keyup click',function(e){
            e.preventDefault();
            e.stopPropagation();
            var keyword = $(this).val(),url = $(this).data('uri'),box = $('#search-box');
            $.get(url,{keyword: $.trim(keyword)},function(result){
                if(result.code == 1)
                {
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        $('#search-box').html(html);
                    });
                    box.show();
                }else{
                    box.hide();
                }
            });
        });
        $('body').on('click',function(){
            $('#search-box').hide();
        });
    });
</script>
</div>
<div class="comWidth">
    <!-- 页面标识 S-->
    <div class="page_tit position-bottom">
        <a href="javascript:;">您的位置：</a>
        <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt;
        <a href="javascript:void(0);">团购</a>
    </div>
    <!-- 页面标识 E-->
</div>
<div class="comWidth clearfix">
    <div class="group_show02">
        <div class="group_show02_l detail_slide">
            <div class="g_s1">
                <span class="arr01"></span>
                <div class="small_list">
                    <ul>
                        <li class="on">
                            <img src="<?php echo htmlentities($info['img']); ?>" width="96" height="70">
                        </li>
                        <?php if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><img src="<?php echo htmlentities($vo['url']); ?>" width="96" height="70" /></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <span class="arr02"></span>
            </div>
            <div class="n_h_simg01 large_box">
                <ul>
                    <li>
                        <img src="<?php echo htmlentities($info['img']); ?>" width="600" height="455">
                    </li>
                    <?php if(!(empty($info['file']) || (($info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator ) && $info['file']->isEmpty()))): if(is_array($info['file']) || $info['file'] instanceof \think\Collection || $info['file'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['file'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li style="display: none;">
                        <img src="<?php echo htmlentities($vo['url']); ?>" width="600" height="455">
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="group_show02_r">
            <div class="g_s2">
                <b><a href="javascript:;"><?php echo htmlentities($info['title']); ?></a></b>
                <p><?php echo htmlentities($info['address']); ?></p>
                <p><?php echo htmlentities($info['special']); ?></p>
            </div>
            <div class="g_s3">
                <div class="g_tuang"><img src="/static/home/images/ico28.png" data-bd-imgshare-binded="1" width="128" height="132"></div>
                <div class="g_s3_n1">
                    <b> 团购价 <?php echo htmlentities($info['price']); ?><?php echo config('filter.house_price_unit'); ?> </b>
                    <p><span><?php echo htmlentities($info['discount']); ?></span><span>全程专车接送</span></p>
                </div>
                <div class="g_s3_n2">已有<i><?php echo htmlentities($info['sign_num']); ?></i>人报名团购</div>
                <div class="g_s3_n3">
                    <b>距离报名结束时间倒计时</b>
                    <p><span class="text22 time-remain" data-down="<?php echo htmlentities($info['end_time']-time()); ?>"><i class="text22" time_id="d">0</i> 天 <i class="text22" time_id="h">0</i> 时 <i class="text22" time_id="m">0</i>分  <i class="text22" time_id="s">0</i>秒</span></p>
                    <a href="javascript:;" class="J_dialog but20" data-id="<?php echo htmlentities($info['house_id']); ?>" data-model="house" data-type="4" data-uri="<?php echo url('Dialog/subscribe'); ?>">我要报名</a>
                </div>
                <div class="g_s3_n4">
                    <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1527848286649"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a><a title="分享到百度新首页" href="#" class="bds_bdhome" data-cmd="bdhome"></a><a title="分享到QQ好友" href="#" class="bds_sqq" data-cmd="sqq"></a><a title="分享到豆瓣网" href="#" class="bds_douban" data-cmd="douban"></a><a title="分享到腾讯朋友" href="#" class="bds_tqf" data-cmd="tqf"></a><a title="分享到美丽说" href="#" class="bds_meilishuo" data-cmd="meilishuo"></a><a title="分享到蘑菇街" href="#" class="bds_mogujie" data-cmd="mogujie"></a><a title="分享到天涯社区" href="#" class="bds_ty" data-cmd="ty"></a></div>
                    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin","bdhome","sqq","douban","tqf","meilishuo","mogujie","ty"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin","bdhome","sqq","douban","tqf","meilishuo","mogujie","ty"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                </div>

            </div>
        </div>
    </div>
    <div class="house_detail clearfix" style="margin-top:20px;">
        <div class="con_wrap clearfix">
            <div class="leftArea cm_leftArea">
                <!-- 房源概况 S-->
                <div class="house_general floor">
                    <div class="title clearfix">
                        <h2>项目介绍</h2>
                    </div>
                    <div class="desc">
                        <?php echo $info['info']; ?>
                    </div>
                </div>

            </div>
            <div class="rightArea cm_rightArea ">

                <div class="group_body_r01">
                    <h1>服务热线</h1>
                    <h2><?php echo htmlentities($site['telphone']); ?></h2>
                    <p>工作时间：周一到周日8:30-18:00</p>
                </div>
                <div class="group_body_r02"><h2>团购服务中心</h2><p><span class="group_ico group_ico_01">免费接机</span><span class="group_ico group_ico_02">旅游看房</span><span class="group_ico group_ico_03">置业顾问</span></p></div>
                <div class="group_body_r03">
                    <?php if(is_array($qq) || $qq instanceof \think\Collection || $qq instanceof \think\Paginator): $i = 0; $__LIST__ = $qq;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <p>客服<?php echo htmlentities($i); ?>：<span class="org05"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo htmlentities($vo); ?>&amp;site=qq&amp;menu=yes" target="_blank"><?php echo htmlentities($vo); ?></a></span></p>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="m_t_15">
                    <div class="title01"><span class="more"><a href="<?php echo url('House/index'); ?>">更多 &gt;</a></span>热门楼盘</div>
                    <div class="hot_h">
                        <?php if(is_array($hot_house) || $hot_house instanceof \think\Collection || $hot_house instanceof \think\Paginator): $i = 0; $__LIST__ = $hot_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <dl class="clearfix">
                            <dt><a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>"><img src="<?php echo htmlentities($vo['img']); ?>" alt="<?php echo htmlentities($vo['title']); ?>" onerror="this.src='/static/images/nopic.jpg'" width="120" height="90"></a></dt>
                            <dd class="hot_h_t1 nowarp"><a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a></dd>
                            <dd class="hot_h_t2"><?php echo htmlentities($vo['price']); ?><?php echo htmlentities($vo['unit']); ?></dd>
                            <dd class="hot_h_t3"><?php echo getCityName($vo['city']); ?></dd>
                            <dd class="hot_h_t3 nowarp" title="<?php echo htmlentities(date('Y年m月d日',!is_numeric($vo['opening_time'])? strtotime($vo['opening_time']) : $vo['opening_time'])); ?><?php echo htmlentities($vo['opening_time_memo']); ?>">开盘时间：<?php echo htmlentities(date('Y年m月d日',!is_numeric($vo['opening_time'])? strtotime($vo['opening_time']) : $vo['opening_time'])); ?><?php echo htmlentities($vo['opening_time_memo']); ?></dd>
                        </dl>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="/static/home/js/carousel.min.js"></script>
<script>
    $(function(){
        $(".detail_slide").thumbnailImg({
            large_elem: ".large_box",
            small_elem: ".small_list",
            left_btn: ".arr01",
            right_btn: ".arr02"
        });
        $('.J_dialog').on('click',function(){
            var me=$(this),w = 750,h = 400,house_id=me.data('id'),model = me.data('model'),type = me.data('type'),url = me.data('uri');
            url = url + '?house_id='+house_id+'&type='+type+'&model='+model;
            layer.open({
                type: 2,
                title: false,
                fix:true,
                move:false,
                area: [w+'px', h+'px'],
                shade: 0.8,
                closeBtn: 1,
                shadeClose: true,
                content: url
            });
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

<div class="footer">
    <div class="comWidth">
    <div class="link_box clearfix">
        <div class="leftArea">
            <div class="house_link clearfix">
                <a href="<?php echo url('House/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>新楼盘</a>
                <a href="<?php echo url('Estate/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手小区</a>
                <a href="<?php echo url('Second/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手房</a>
                <a href="<?php echo url('Rental/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>出租房</a>
            </div>
            <?php if($controller == 'index'): ?>
            <div class="tab_link clearfix">
                <a href="javascript:;" style="text-decoration: none;">友情链接：</a>
                <?php $obj = model("link");$obj = $obj->where("cate_id=1 and status=1 and city = $cityId");$obj = $obj->field("name,url");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(40)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo htmlentities($data['url']); ?>" target="_blank" title="<?php echo htmlentities($data['name']); ?>"><?php echo htmlentities($data['name']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php else: ?>
            <div class="tab_link clearfix" style="margin-top:10px;">
                <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("house");$obj = $obj->where("$where_str");$obj = $obj->field("id,title");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(50)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('House/detail',['id'=>$data['id']]); ?>" target="_blank" title="<?php echo htmlentities($data['title']); ?>"><?php echo htmlentities($data['title']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php endif; ?>
            <div class="other_link">
                <?php $n = 0; if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 2): $n++; ?>
                <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <a href="<?php echo url('agent/Login/index@agent'); ?>">代理登录</a>
                <a href="javascript:;">服务热线：<?php echo htmlentities($site['telphone']); ?></a>
            </div>
        </div>
        <div class="rightArea">
            <div class="ewm">
                <img src="<?php echo htmlentities($site['weixin_qrcode']); ?>" width="140" height="140" alt="" class="img">
                <p>官方微信公众号</p>
            </div>
        </div>
    </div>
    <div class="bottom">
        <p>地址：<?php echo htmlentities($site['address']); ?> </p>
        <p>版权所有 &copy;2009-<?php echo date('Y'); ?> <?php echo htmlentities($site['company_name']); ?> All Rights Reserved. <?php echo $site['icp']; ?></p>
    </div>
</div>
<div class="scroll-top" id="scroll-top">
    <span class="text">返回顶部</span>
    <span class="ico"></span>
</div>
<?php echo $site['pc_js']; ?>
<script>
    $(function(){
        var h = $(window).height();
        $(document).on('scroll',function(){
            var top=$(document).scrollTop();
            if(top > h)
            {
                $("#scroll-top").show();
            }else{
                $("#scroll-top").hide();
            }
        });
        $("#scroll-top").on('click',function(){
            $('body,html').animate({scrollTop:0},300);
        })
    });
</script>
</div>
<script src="/static/js/plugins/jquery.lazyload.js"></script>
<script type="text/javascript" src="/static/home/js/common.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script>
    $("img.lazy").lazyload({
        threshold : 100,
        effect : "fadeIn"
        //event: "scrollstop"
    });
    $(function(){
       $('.follow').on('click',function(){
           var house_id = $(this).data('id'),model = $(this).data('model'),url = $(this).data('uri'),me = $(this);
           $.post(url,{house_id:house_id,model:model},function(result){
               if(result.code == 1)
               {
                   layer.msg(result.msg,{icon:1});
                   if(me.hasClass('on'))
                   {
                       me.removeClass('on').text(result.text);
                   }else{
                       me.addClass('on').text(result.text);
                   }
               }else{
                   layer.msg(result.msg,{icon:2});
               }
           });
       });
    });
</script>
</body>
</html>