<?php /*a:3:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/home/view/broker/index.html";i:1541129486;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 列表 S-->
<div class="cm_house">
    <div class="comWidth">
        <!-- 页面标识 S-->
        <div class="page_tit">
            <a href="javascript:;" rel="nofollow">您的位置：</a>
            <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
            <a href="javascript:void(0);">经纪人列表</a>
        </div>
        <!-- 页面标识 E-->
        <!-- 筛选栏 S -->
        <div class="seleBar">
            <div class="box">
                <div class="item clearfix">
                    <h3>区域:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('Broker/index','area',$param,0); ?>" <?php if($search['area'] == $cityId): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('Broker/index','area',$param,$vo['id']); ?>" <?php if($search['area'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php if(!(empty($rading) || (($rading instanceof \think\Collection || $rading instanceof \think\Paginator ) && $rading->isEmpty()))): ?>
                <div class="item clearfix">
                    <h3>商圈:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('Broker/index','area',$param,$search['area']); ?>" <?php if($search['rading'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($rading) || $rading instanceof \think\Collection || $rading instanceof \think\Paginator): $i = 0; $__LIST__ = $rading;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('Broker/index','area',$param,$vo['id']); ?>" <?php if($search['rading'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="item clearfix">
                    <h3>标签:</h3>
                    <form action="<?php echo url('Broker/index',['area'=>$search['area'],'sort'=>$search['sort']]); ?>" id="form" method="get">
                        <ul class="list">
                            <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li>
                                <label>
                                    <input type="checkbox" name="deposit[]" class="chcb" value="<?php echo htmlentities($vo['id']); ?>" <?php if($search['tags'] and in_array($vo['id'],$search['tags'])): ?>checked="checked"<?php endif; ?>>
                                <?php echo htmlentities($vo['name']); ?>
                                </label>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                            <li>
                                <input type="button" id="search-btn" value="查找" class="btn">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <!-- 筛选栏 E -->
        <div class="main clearfix">
            <!-- 房子列表 S -->
            <div class="houseList_wrap leftArea cm_leftArea">
                <div class="head clearfix">
                    <div class="tit fl">
                        <h2><a href="<?php echo url('Broker/index'); ?>" class="active">全部经纪人</a></h2>
                    </div>
                    <div class="tab fr">
                        <ul>
                            <li><a href="<?php echo getUrl('Broker/index','sort',$param,0); ?>" style='background:none;' <?php if($search['sort'] == 0): ?>class="active"<?php endif; ?>>默认排序</a></li>
                            <?php if($search['sort'] == 1): ?>
                            <li><a href="<?php echo getUrl('Broker/index','sort',$param,2); ?>" class="active down">好评</a></li>
                            <?php elseif($search['sort'] == 2): ?>
                            <li><a href="<?php echo getUrl('Broker/index','sort',$param,1); ?>" class="active up">好评</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo getUrl('Broker/index','sort',$param,1); ?>">好评</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="agent_list">
                    <ul class="clearfix">
                        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <a href="<?php echo url('Broker/second',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['nick_name']); ?>">
								<span class="l_img fl">
									<img src="<?php echo getAvatar($vo['id'],180); ?>" alt="<?php echo htmlentities($vo['nick_name']); ?>">
								</span>
								<span class="r_con fr">
									<span class="row clearfix">
										<p class="name fl"><?php echo htmlentities($vo['nick_name']); ?></p>
										<ul class="star_list fl">
                                            <?php $__FOR_START_1796971192__=1;$__FOR_END_1796971192__=6;for($i=$__FOR_START_1796971192__;$i < $__FOR_END_1796971192__;$i+=1){ ?>
                                            <li <?php if($i <= $vo["point"]): ?>class="on"<?php else: ?>class='off'<?php endif; ?>></li>
                                            <?php } ?>
                                        </ul>
										<p class="good_rate fl">好评率：<b><?php echo htmlentities($vo['goods']); ?>%</b></p>
									</span>
									<span class="row clearfix">
										<p>
                                            所属公司：<?php echo htmlentities($vo['company']); ?>&nbsp;&nbsp;
                                            主营区域：
                                        <?php $area=array_filter(explode(',',$vo['service_area'])); if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                            <?php echo getCityName($val,'-'); ?>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </p>
									</span>
									<span class="row clearfix">
										<p>在售房源<?php echo htmlentities($vo['second_total']); ?>套  在租房源<?php echo htmlentities($vo['rental_total']); ?>套</p>
									</span>
									<span class="label_list clearfix">
                                        <?php $tags=array_filter(explode(',',$vo['tags'])); if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
										<i class="item"><?php echo getLinkMenuName(13,$tag); ?></i>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</span>
									<span class="phone">
										<?php echo htmlentities($vo['mobile']); ?>
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
            <!-- 房子列表 E -->
            <!-- 右边内容 S -->
            <div class="cm_rightArea rightArea">
                <!-- 最新房源 S -->
                <div class="rcmd_house new_house  mt_73">
                    <div class="title">
                        <h3>最新房源</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <ul class="clearfix">
                            <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("second_house");$obj = $obj->where("$where_str");$obj = $obj->field("id,title,img,price,room,living_room,acreage,estate_name");$obj = $obj->order("create_time desc");$name = $obj->limit(8)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('Second/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>">
                                    <div class="img">
                                        <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>">
                                    </div>
                                    <div class="con">
                                        <div class="row clearfix">
                                            <p class="name fl"><?php echo htmlentities($data['title']); ?></p>
                                            <p class="price fr"><?php echo $data['price']; ?></p>
                                        </div>
                                        <div class="row clearfix">
                                            <p class="type fl"><?php echo htmlentities($data['room']); ?>室<?php echo htmlentities($data['living_room']); ?>厅</p>
                                            <p class="area fr"><?php echo htmlentities($data['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 最新房源 E -->

            </div>
            <!-- 右边内容 E -->
        </div>
    </div>
</div>

<!-- 列表 S-->
<script type="text/javascript">
    $(function(){
       $("#search-btn").on('click',function(){
           var val = '',url = $("#form").attr('action');
           $("input[name='deposit[]']:checked").each(function(){
               val += $(this).val()+',';
           });
           url += '?tags='+val.substring(0,val.length -1);
           window.location.href = url;
       });
    });
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