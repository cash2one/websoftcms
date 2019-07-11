<?php /*a:4:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/news/detail.html";i:1534128256;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:73:"/home/wwwroot/gxwebsoft/public_html/application/home/view/news/right.html";i:1544584202;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 资讯详情 S-->
<div class="flash">
    <div class="con_wrap comWidth clearfix">
        <div class="sub_nav">
            <ul>
                <li><a href="<?php echo url('News/index'); ?>">全部</a></li>
                <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('News/index',['cate'=>$vo['id']]); ?>" <?php if($info["cate_id"] == $vo['id']): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <div class="leftArea cm_leftArea">
            <!-- 页面标识 S-->
            <div class="page_tit">
                <a href="javascript:;" rel="nofollow">您的位置：</a>
                <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
                <a href="<?php echo url('News/index'); ?>">资讯</a> &gt;
                <a href="<?php echo url('News/index',['cate'=>$info['cate_id']]); ?>" title="<?php echo getCateName('articleCate',$info['cate_id']); ?>"><?php echo getCateName('articleCate',$info['cate_id']); ?></a> &gt;
                <a href="javascript:void(0);">正文</a>
            </div>
            <!-- 页面标识 E-->
            <!-- 文章详情 S-->
            <div class="artc_detail">
                <div class="head">
                    <h1><?php echo htmlentities($info['title']); ?></h1>
                    <div class="sub clearfix">
                        <div class="fl">
                            <span class="news_type"><?php if(empty($info['come_from']) || (($info['come_from'] instanceof \think\Collection || $info['come_from'] instanceof \think\Paginator ) && $info['come_from']->isEmpty())): ?><?php echo htmlentities($site['title']); else: ?><?php echo htmlentities($info['come_from']); ?><?php endif; ?></span>
                            <span class="time"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($info['create_time'])? strtotime($info['create_time']) : $info['create_time'])); ?></span>
                        </div>
                        <div class="fr">
                            <span class="view"><?php echo htmlentities($info['hits']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="con_box">
                    <?php echo $info['info']; ?>
                </div>
                <?php if(!(empty($house_info) || (($house_info instanceof \think\Collection || $house_info instanceof \think\Paginator ) && $house_info->isEmpty()))): ?>
                <div class="house-info">
                    <a href="<?php echo htmlentities($house_info['url']); ?>" target="_blank">
                        <dl class="clearfix">
                            <dt><img src="<?php echo htmlentities($house_info['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($house_info['title']); ?>"></dt>
                            <dd class="title"><?php echo htmlentities($house_info['title']); ?></dd>
                            <dd class="price">均价：<span><?php echo htmlentities($house_info['price']); ?><?php echo htmlentities($house_info['unit']); ?></span></dd>
                            <dd class="address">地址：[<?php echo getCityName($house_info['city']); ?>]<?php echo htmlentities($house_info['address']); ?></dd>
                            <dd class="telphone">电话：<span><?php echo htmlentities($house_info['sale_phone']['phone']); if(!(empty($house_info['sale_phone']['extension']) || (($house_info['sale_phone']['extension'] instanceof \think\Collection || $house_info['sale_phone']['extension'] instanceof \think\Paginator ) && $house_info['sale_phone']['extension']->isEmpty()))): ?>转<?php echo htmlentities($house_info['sale_phone']['extension']); ?><?php endif; ?></span></dd>
                        </dl>
                    </a>

                </div>
                <?php endif; ?>
                <div class="f_share clearfix">
                    <div class="fl">
                        <p>编辑者：<?php echo htmlentities($info['editor']); ?></p>
                    </div>
                    <div class="fr">
                        <p>分享到：</p>
                        <div style="float:left;">
                               <div class="bdsharebuttonbox" style="display:inline-block;vertical-align: middle;"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                               <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                        </div>
                    </div>
                </div>
                <div class="relative_artc">
                    <div class="title">
                        <h3>相关文章</h3>
                        <a href="<?php echo url('News/index'); ?>" class="more">更多+</a>
                        <p class="b_l"></p>
                    </div>
                    <ul class="list clearfix">
                        <?php if(is_array($relation) || $relation instanceof \think\Collection || $relation instanceof \think\Paginator): $i = 0; $__LIST__ = $relation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li>
                            <span class="time"><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($vo['create_time'])? strtotime($vo['create_time']) : $vo['create_time'])); ?></span>
                            <a href="<?php echo url('News/detail',['id'=>$vo['id']]); ?>" target="_blank" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a>

                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 文章详情 E-->
        </div>
        <div class="rightArea cm_rightArea ">
            <!-- 热文排行 S -->
<div class="hot_artc mt_30">
    <div class="title">
        <h3>最新动态</h3>
        <p class="b_l"></p>
    </div>
    <div class="con_box">
        <ul class="clearfix">
            <?php $obj = model("article");$obj = $obj->where("status=1 and city = $cityId");$obj = $obj->field("id,title");$obj = $obj->order("hits desc");$name = $obj->limit(10)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('News/detail',['id'=>$data['id']]); ?>" target="_blank" title="<?php echo htmlentities($data['title']); ?>">
                    <span class="order <?php if($i < 4): ?>on<?php endif; ?>"><?php echo htmlentities($i); ?></span>
                    <?php echo htmlentities($data['title']); ?>
                </a>
            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>
</div>
<!-- 热文排行 E -->
<!-- 热门楼盘 S -->
<div class="hot_build  mt_30">
    <div class="title">
        <h3>最新楼盘</h3>
        <p class="b_l"></p>
    </div>
    <div class="con_box">
        <ul class="list clearfix">
            <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("house");$obj = $obj->where("$where_str");$obj = $obj->field("id,title,img,price,unit,city");$obj = $obj->order("id desc");$name = $obj->limit(2)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('House/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>" target="_blank">
                    <div class="img">
                        <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>">
                    </div>
                    <div class="con">
                        <p class="name"><?php echo htmlentities($data['title']); ?></p>
                        <div class="clearfix">
                            <p class="price fl"><b><?php echo htmlentities($data['price']); ?></b><?php echo htmlentities($data['unit']); ?></p>
                            <p class="address fr" title="<?php echo getCityName($data['city'],'-',2); ?>"><?php echo getCityName($data['city'],'-'); ?></p>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>
</div>
<!-- 热门楼盘 E -->
<div class="hot_build  mt_30">
    <div class="title">
        <h3>推荐楼盘</h3>
        <p class="b_l"></p>
    </div>
    <div class="con_box">
        <ul class="list clearfix">
            <?php $where_str = "";$city_all_child && $where_str.= "t.city in (".$city_all_child.")"; $join   = [["house t","t.id = p.house_id"]];$obj = model("Position")->alias("p")->join($join);$obj = $obj->where("p.status = 1 and p.cate_id = 1 and t.status = 1 and p.model = 'house' and $where_str");$obj = $obj->field("t.id,t.title,t.img,(case t.price when 0 then '待定' else t.price end) as price,t.unit,t.city");$obj = $obj->order("id desc");$name = $obj->limit(4)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('House/detail',['id'=>$data['id']]); ?>" title="<?php echo htmlentities($data['title']); ?>" target="_blank">
                    <div class="img">
                        <img src="<?php echo htmlentities($data['img']); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($data['title']); ?>">
                    </div>
                    <div class="con">
                        <p class="name"><?php echo htmlentities($data['title']); ?></p>
                        <div class="clearfix">
                            <p class="price fl"><b><?php echo htmlentities($data['price']); ?></b><?php if($data['price'] > 0): ?><?php echo getUnitData($data['unit']); ?><?php endif; ?></p>
                            <p class="address fr" title="<?php echo getCityName($data['city'],'-',2); ?>"><?php echo getCityName($data['city'],'-'); ?></p>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>
</div>
        </div>
    </div>
</div>
<!-- 资讯详情 E-->

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