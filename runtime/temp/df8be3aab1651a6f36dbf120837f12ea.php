<?php /*a:3:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/home/view/school/index.html";i:1544236106;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 搜索栏 S -->
<div class="searBar ">
    <div class="comWidth clearfix">
        <div class="sear_box fl">
            <form action="<?php echo url('School/index'); ?>">
                <div class="ipt_area fl">
                    <input type="text" name="keyword" id="keyword" autocomplete="off" placeholder="输入学校名称" data-uri="<?php echo url('Ajax/searchSchool'); ?>" class="ipt">
                    <span class="placeholder">输入学校名称</span>
                    <ul id="search-box">
                    </ul>
                </div>
                <div class="btn_area fl">
                    <input type="submit" class="sbm_btn" value="搜索">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- 搜索栏 E -->
<!-- 列表 S-->
<div class="cm_house">
    <div class="comWidth">
        <!-- 页面标识 S-->
        <div class="page_tit">
            <a href="javascript:;" rel="nofollow">您的位置：</a>
            <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt;
            <a href="javascript:void(0);">学校</a>
        </div>
        <!-- 页面标识 E-->
        <!-- 筛选栏 S -->
        <div class="seleBar">
            <div class="box">
                <div class="item clearfix">
                    <h3>区域:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('School/index','area',$param,0); ?>" <?php if($search['area'] == $cityId): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('School/index','area',$param,$vo['id']); ?>" <?php if($search['area'] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <div class="item clearfix">
                    <h3>类型:</h3>
                    <ul class="list">
                        <li><a href="<?php echo getUrl('School/index','type',$param,0); ?>" <?php if($search['type'] == 0): ?>class="active"<?php endif; ?>">全部</a></li>
                        <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getUrl('School/index','type',$param,$key); ?>" <?php if($search['type'] == $key): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 筛选栏 E -->
        <div class="main clearfix">
            <!-- 列表 S -->
            <div class="houseList_wrap leftArea cm_leftArea">
                <div class="head clearfix">
                    <div class="tit fl">
                        <h2><a href="javascript:;" class="active">全部学校</a></h2>
                    </div>
                </div>
                <div class="school_lists">
                    <ul class="clearfix">
                        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                        <a href="<?php echo url('School/detail',['id'=>$vo['id']]); ?>" target="_blank" title="<?php echo htmlentities($vo['title']); ?>">
                            <img src="/static/images/nopic.jpg" data-original="<?php echo thumb($vo['img'],180,130); ?>" class="fl lazy" alt="<?php echo htmlentities($vo['title']); ?>">
                            <div class="fl school_desc">
                                <h2><?php echo htmlentities($vo['title']); ?></h2>
                                <div class="school_text">
                                    <span><?php echo getLinkMenuName(22,$vo['type']); ?></span>
                                </div>
                                <div class="school_text">
                                    [<?php echo getCityName($vo['city'],'',1); ?>] &nbsp;<?php echo htmlentities($vo['address']); ?>
                                </div>
                            </div>
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
            <!-- 列表 E -->
            <!-- 右边内容 S -->
            <div class="cm_rightArea rightArea">
                <!-- 热门学校 S -->
                <div class="rcmd_house new_house  mt_73">
                    <div class="title">
                        <h3>热门学校</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="school_hot clearfix">
                        <ul>
                            <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("school");$obj = $obj->where("$where_str");$obj = $obj->field("id,title,type");$obj = $obj->order("hits desc");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <li>
                                <a href="<?php echo url('School/detail',['id'=>$data['id']]); ?>" target="_blank" title="<?php echo htmlentities($data['title']); ?>"><span class="fr"><?php echo getLinkMenuName(22,$data['type']); ?></span><?php echo htmlentities($data['title']); ?></a>
                            </li>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <!-- 热门学校 E -->
                <!-- 推荐楼盘 S -->
                <div class="rcmd_build mt_25">
                    <div class="title">
                        <h3>学区房</h3>
                        <p class="b_l"></p>
                    </div>
                    <div class="con_box">
                        <?php if(is_array($school_house) || $school_house instanceof \think\Collection || $school_house instanceof \think\Paginator): $i = 0; $__LIST__ = $school_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="clearfix">
                            <a href="<?php echo url('Second/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>" target="_blank">
                                <div class="fl l_img">
                                    <img src="<?php echo htmlentities($vo['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" width="120" height="80" alt="<?php echo htmlentities($vo['title']); ?>">
                                </div>
                                <div class="fr r_con">
                                    <p class="name"><?php echo htmlentities($vo['title']); ?></p>
                                    <p class="address"><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅-<?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></p>
                                    <p class="price"><?php if(empty($vo['price']) || (($vo['price'] instanceof \think\Collection || $vo['price'] instanceof \think\Paginator ) && $vo['price']->isEmpty())): ?><b>面议</b><?php else: ?><b><?php echo htmlentities($vo['price']); ?></b><?php echo config('filter.second_price_unit'); ?><?php endif; ?></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <!-- 推荐楼盘 E -->
            </div>
            <!-- 右边内容 E -->
        </div>
    </div>
</div>

<!-- 楼盘列表 S-->
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li>
        <a href="{{d[i].url}}" target="_blank">
            <span>
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
<script type="text/javascript">
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