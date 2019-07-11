<?php /*a:5:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/broker/second.html";i:1545638780;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:78:"/home/wwwroot/gxwebsoft/public_html/application/home/view/broker/userinfo.html";i:1541129938;s:73:"/home/wwwroot/gxwebsoft/public_html/application/home/view/broker/nav.html";i:1541063890;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 内容 S-->
<div class="cm_house agent_detail">
    <div class="comWidth ">
        <div class="main clearfix">
            <div class="agent_info cm_rightArea fl">
                <div class="m_wrap">
    <div class="toux">
        <img src="<?php echo getAvatar($brokerInfo['id'],180); ?>" alt=<?php echo htmlentities($brokerInfo['nick_name']); ?>">
    </div>
    <div class="phone"><?php echo htmlentities($brokerInfo['mobile']); ?></div>
    <ul class="info_list clearfix">
        <li>
            <div class="tit fl">
                <p>公司：</p>
            </div>
            <div class="con fr" style="width:160px;">
               <p style="line-height: 22px;padding:7px 0;"><?php echo htmlentities($brokerInfo["userInfo"]["company"]); ?></p>
            </div>
        </li>
        <li>
            <div class="tit fl">
                <p>等级：</p>
            </div>
            <div class="con fr">
                <ul class="star_list clearfix">
                    <?php $__FOR_START_2069678131__=1;$__FOR_END_2069678131__=6;for($i=$__FOR_START_2069678131__;$i < $__FOR_END_2069678131__;$i+=1){ ?>
                    <li <?php if($i <= $brokerInfo["userInfo"]["point"]): ?>class="on"<?php else: ?>class='off'<?php endif; ?>></li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <li>
            <div class="tit fl">
                <p>区域：</p>
            </div>
            <div class="con fr">
                <p>
                    <?php $area=array_filter(explode(',',$brokerInfo["userInfo"]['service_area'])); if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <?php echo getCityName($val,'-'); ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </p>
            </div>
        </li>
        <li>
            <div class="tit fl">
                <p>评价：</p>
            </div>
            <div class="con fr">
                <p>好评率<?php echo number_format(($brokerInfo["userInfo"]['point']/5)*100,0); ?>%</p>
            </div>
        </li>
        <li>
            <div class="tit fl">
                <p>带看：</p>
            </div>
            <div class="con fr">
                <p>近30天带看<?php echo htmlentities($brokerInfo['userInfo']['looked']); ?>次</p>
            </div>
        </li>
        <li>
            <div class="tit fl">
                <p>成交：</p>
            </div>
            <div class="con fr">
                <p>历史成交<?php echo htmlentities($brokerInfo['userInfo']['history_complate']); ?>套</p>
            </div>
        </li>
    </ul>
    <span class="label_list clearfix">
         <?php $tags=array_filter(explode(',',$brokerInfo['userInfo']['tags'])); if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
         <i class="item"><?php echo getLinkMenuName(13,$tag); ?></i>
         <?php endforeach; endif; else: echo "" ;endif; ?>
	 </span>
</div>
            </div>
            <!-- 二手房列表 S -->
            <div class="houseList_wrap fr cm_leftArea">
                <div class="head clearfix">
                    <div class="tit fl">
    <h2><a href="<?php echo url('Broker/second',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'second'): ?>class="active"<?php endif; ?>>二手房</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/rental',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'rental'): ?>class="active"<?php endif; ?>>出租房</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/office',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'office'): ?>class="active"<?php endif; ?>>写字楼出售</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/officeRental',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'officerental'): ?>class="active"<?php endif; ?>>写字楼出租</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/shops',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'shops'): ?>class="active"<?php endif; ?>>商铺出售</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/shopsRental',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'shopsrental'): ?>class="active"<?php endif; ?>>商铺出租</a></h2>
</div>
<div class="tit fl">
    <h2><a href="<?php echo url('Broker/comment',['id'=>$brokerInfo['id']]); ?>" <?php if($action == 'comment'): ?>class="active"<?php endif; ?>>客户评价</a></h2>
</div>
                </div>
                <div class="list_con sh_house_list">
                    <ul class="clearfix">
                        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('Second/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
								<span class="l_img fl">
									<img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
								</span>
								<span class="r_con fr">
									<h3><?php echo htmlentities($vo['title']); ?></h3>
									<p>
                                        <span class="info"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅<?php echo htmlentities($vo['toilet']); ?>卫</span>
                                        <span class="l">|</span>
                                        <span class="info"><?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></span>
                                        <span class="l">|</span>
                                        <span class="info"><?php echo getLinkMenuName(8,$vo['renovation']); ?></span>
                                        <span class="l">|</span>
                                        <span class="info"><?php echo getLinkMenuName(4,$vo['orientations']); ?></span>
                                    </p>
                                <p>
                                    <span class="tit"><?php echo htmlentities($vo['estate_name']); ?></span>
                                    <span class="address"><?php echo htmlentities($vo['address']); ?></span>
                                </p>
									<span class="label_list clearfix">
                                        <?php $tag = array_filter(explode(',',$vo['tags'])); if(!(empty($tag) || (($tag instanceof \think\Collection || $tag instanceof \think\Paginator ) && $tag->isEmpty()))): if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $n = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;?>
                                        <i class="item item<?php echo htmlentities($n); ?>"><?php echo getLinkMenuName(14,$val); ?></i>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <?php endif; ?>
									</span>
									<span class="price">
										<h5><strong><?php echo $vo['price']; ?></strong></h5>
										<p><?php echo $vo['average_price']; ?></p>
									</span>
                                </span>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                    </ul>
                </div>
                <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
                <div class="page_list clearfix">
                    <?php echo $pages; ?>
                </div>
                <?php endif; ?>
            </div>
            <!-- 二手房列表 E -->
        </div>
    </div>
</div>

<!-- 内容 S-->

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