<?php /*a:3:{s:73:"/home/wwwroot/gxwebsoft/public_html/application/home/view/map/second.html";i:1540867520;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<div class="map_house">
    <!-- 筛选 和 搜索 S-->
    <div class="sele_sear clearfix">
        <div class="comWidth">
            <div class="sear fl">
                <div class="ipt_area fl">
                    <input type="text" class="ipt" id="keyword" placeholder="输入小区名称">
                    <span class="placeholder">输入小区名称</span>
                </div>
                <div class="btn_area fl">
                    <button class="btn search-keyword"></button>
                </div>
            </div>
            <div class="sele_list fl">
                <form action="">
                    <div class="item fl" id="select_city" data-uri="<?php echo url('Ajax/getCityPoint'); ?>">
                        <input type="hidden" name="city" id="city" value="" />
                        <select class="J_city_select" data-pid="0" data-uri="<?php echo url('Ajax/ajaxGetchilds'); ?>" data-selected="">
                        </select>
                    </div>
                    <div class="item fl">
                        <select name="price" id="price">
                            <option value="0">价格</option>
                            <?php $_result=getSecondPrice();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="item fl">
                        <select name="acreage" id="acreage">
                            <option value="0">面积</option>
                            <?php $_result=getAcreage();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="item fl">
                        <select name="room" id="room">
                            <option value="0">户型</option>
                            <?php $_result=getRoom();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="item fl">
                        <select name="renovation" id="renovation">
                            <option value="0">装修</option>
                            <?php if(is_array($renovation) || $renovation instanceof \think\Collection || $renovation instanceof \think\Paginator): $i = 0; $__LIST__ = $renovation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="item  fl">
                        <button type="button" class="btn search-btn" data-uri="<?php echo url('Map/getSecondLists'); ?>">搜索</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- 筛选 和 搜索 E-->

    <div class="main">
        <!-- 左边地图 S -->
        <div class="l_box ">
            <div class="map">
                <div id="map"></div>
            </div>
        </div>
        <!-- 左边地图 E -->
        <!-- 右边区域内容 S -->
        <div class="r_box">
            <!-- 楼盘列表 S -->
            <div class="house_list">
                <div class="hd clearfix">
                    <ul class="fl tab sort">
                        <li>
                            <a href="javascript:;" data-sort="0" class="active df">默认</a>
                        </li>
                        <li >
                            <a href="javascript:;" data-sort="1" class="price down">总价</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-sort="3" class="time down">面积</a>
                        </li>
                    </ul>
                    <span class="b_l"></span>
                </div>
                <ul class="bd" id="lists">
                </ul>
            </div>
            <!-- 楼盘列表 E -->

        </div>
        <!-- 右边区域内容 E -->
    </div>
</div>
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li class="clearfix">
        <a href="{{d[i].url}}" target="_blank" title="{{d[i].title}}">
            <div class="img fl f_con">
                <img src="{{d[i].img}}" onerror="this.src='/static/images/nopic.jpg'" width="130" height="90" alt="">
            </div>
            <div class="c_con fl">
                <div class="t clearfix">
                    <h3>{{d[i].title}}</h3>
                </div>
                <div class="c">
                    <span>{{d[i].estate_name}} {{d[i].room}}室{{d[i].living_room}}厅 {{d[i].acreage}}<?php echo config('filter.acreage_unit'); ?> {{d[i].renovation}}</span>
                </div>
                <div class="b clearfix">
                    {{# for(var j in  d[i]['tags']){ }}
                    <span class="item item{{j*1+1}}">{{d[i]['tags'][j]}}</span>
                    {{# } }}
                </div>
            </div>
            <div class="r_con fl">
                <p class="price"><strong>{{d[i].price}}</strong></p>
            </div>
        </a>
    </li>
    {{# } }}
</script>
<script src="/static/js/layer/laytpl.js"></script>
<script src="/static/js/plugins/jquery.linkmenu.js"></script>
<script type="text/javascript" src="//api.map.baidu.com/api?v=2.0&ak=<?php echo config('baidu_map_ak'); ?>"></script>
<script type="text/javascript" src="/static/home/js/map.js"></script>
<script type="text/javascript">
    $(function(){
        $('.J_city_select').cate_select({field:'city',parent_id:'select_city',top_option:'选择区域',id:'J_city_select'});
        var lng = '<?php echo htmlentities($lng); ?>';
        var lat = '<?php echo htmlentities($lat); ?>';
        BMapApplication.init({'lng' : lng, 'lat' : lat, 'mapContainerId' : 'map'});
        BMapApplication.requestUrl = $('.search-btn').data('uri');
        BMapApplication.requestParam = getParam();
        BMapApplication.getMap();
        //按条件筛选
        $('.search-btn').on('click',function(){
            BMapApplication.viewArea = true;
            BMapApplication.requestParam = getParam();
            BMapApplication.getData();
        });
        $('.search-keyword').on('click',function(){
            var keyword = $('#keyword').val();
            BMapApplication.viewArea = false;//全局搜索
            BMapApplication.requestNum = 0;
            BMapApplication.requestParam = {keyword:keyword};
            BMapApplication.getData();
        });
        //排序
        $('.sort a').on('click',function(){
            var sort = parseInt($(this).attr('data-sort'));
            $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
            if($(this).hasClass('up'))
            {
                $(this).removeClass('up').addClass('down');
            }else if($(this).hasClass('down')){
                $(this).removeClass('down').addClass('up');
            }
            switch(sort)
            {
                case 0:
                    break;
                case 1:
                    sort = 2;
                    break;
                case 2:
                    sort = 1;
                    break;
                case 3:
                    sort = 4;
                    break;
                case 4:
                    sort = 3;
                    break;
                default :
                    sort = 90;
                    break;
            }
            BMapApplication.requestParam = getParam();
            BMapApplication.getData();
            $(this).attr('data-sort',sort);
        });
    });
    function getParam()
    {
        var city = $('#city').val(),price = $('#price').val(),room = $('#room').val(),acreage = $('#acreage').val(),
                renovation = $('#renovation').val();
        var sort  = $('.sort').find('.active').attr('data-sort');
        var param = {
            area : city,
            price : price,
            acreage  : acreage,
            room  : room,
            renovation : renovation,
            sort   : sort
        };
        return param;
    }
    $('#select_city').on('change','.J_city_select',function(){
        var city = $(this).val();
        var  url = $('#select_city').data('uri');
        var param = {
          city : city
        };
        $.get(url,param,function(result){
            if(result.code == 1)
            {
                BMapApplication.requestParam.city = city;
                BMapApplication.setCenter(result.data.lng,result.data.lat,result.data.name);
                BMapApplication.getData();
            }
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