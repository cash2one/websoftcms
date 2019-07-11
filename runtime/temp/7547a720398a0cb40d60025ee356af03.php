<?php /*a:4:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/build.html";i:1527591078;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:72:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/nav.html";i:1544411302;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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


<!-- 楼盘详情 S-->
<div class="newhouse_detail house_detail">
    <!-- 页面标识 S-->
    <div class="page_tit">
        <div class="comWidth">
            <a href="javascript:;" rel="nofollow">您的位置：</a>
            <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
            <a href="<?php echo url('House/index'); ?>">新房</a> &gt;
            <a href="<?php echo url('House/detail',['id'=>$info['id']]); ?>"><?php echo htmlentities($info['title']); ?></a> &gt;
            <a href="javascript:void(0);">楼栋信息</a>
        </div>
    </div>
    <!-- 页面标识 E-->
    <?php $sale_status = getLinkMenuCache(1); ?>
<div class="head">
    <div class="comWidth clearfix">
        <h2><?php echo htmlentities($info['title']); ?></h2>
        <p class="sale_state house-status-<?php echo htmlentities($info['sale_status']); ?>"><?php echo htmlentities($sale_status[$info['sale_status']]['name']); ?></p>
        <ul class="label_list">
            <?php $tags = array_filter(explode(',',$info['tags_id'])); if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $n = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;?>
            <li class="item "><?php echo getLinkMenuName(3,$val); ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <?php endif; ?>
        </ul>
        <span class="collect_btn follow" data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-uri="<?php echo url('Api/follow'); ?>">关注楼盘</span>
    </div>
</div>
<div class="sub_nav">
    <div class="comWidth clearfix">
        <ul>
            <li><a href="<?php echo url('House/detail',['id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>">首页</a></li>
            <li><a href="<?php echo url('House/news',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘动态" <?php if($action == "news"): ?>class="active"<?php endif; ?>>楼盘动态</a></li>
            <li><a href="<?php echo url('House/room',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>在售户型" <?php if($action == "room" or $action == "roomdetail"): ?>class="active"<?php endif; ?>>在售户型</a></li>
            <li><a href="<?php echo url('House/question',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>用户问答" <?php if($action == "question" or $action == "questiondetail"): ?>class="active"<?php endif; ?>>用户问答</a></li>
            <?php if(!(empty($info['pano_url']) || (($info['pano_url'] instanceof \think\Collection || $info['pano_url'] instanceof \think\Paginator ) && $info['pano_url']->isEmpty()))): ?><li><a href="<?php echo url('House/pano',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>全景相册" <?php if($action == "pano"): ?>class="active"<?php endif; ?>>全景看房</a></li><?php endif; ?>
            <li><a href="<?php echo url('House/photo',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘相册" <?php if($action == "photo"): ?>class="active"<?php endif; ?>>楼盘相册</a></li>
            <li><a href="<?php echo url('House/build',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼栋信息" <?php if($action == "build"): ?>class="active"<?php endif; ?>>楼栋信息</a></li>
            <li><a href="<?php echo url('House/info',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘详情" <?php if($action == "info"): ?>class="active"<?php endif; ?>>楼盘详情</a></li>
            <li><a href="<?php echo url('House/comment',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>楼盘点评" <?php if($action == "comment"): ?>class="active"<?php endif; ?>>楼盘点评</a></li>
            <li><a href="<?php echo url('House/support',['house_id'=>$info['id']]); ?>" title="<?php echo htmlentities($info['title']); ?>周边配套" <?php if($action == "support"): ?>class="active"<?php endif; ?>>周边配套</a></li>
        </ul>
    </div>
</div>
<?php if(getSettingCache('site','red_packet') == 1 and $info['red_packet'] > 0): ?>
<div class="hb-right J_dialog"  data-id="<?php echo htmlentities($info['id']); ?>" data-model="house" data-type="3" data-uri="<?php echo url('Dialog/subscribe'); ?>">
    <p class="hb-p1">最高<strong><?php echo htmlentities($info['red_packet']); ?></strong>元</p>
    <p class="hb-p2">买新房 领红包 人人有份</p>
    <div class="detailPopClose"></div>
</div>
<script>
    $(function(){
        $(".detailPopClose").on('click',function(e){
            e.stopPropagation();
            e.preventDefault();
            $(this).parent().hide();
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
    });
</script>
<?php endif; ?>
    <div class="con_wrap comWidth clearfix ">
        <!-- 楼栋信息 S -->
        <?php $sale_status = getLinkMenuCache(5); ?>
        <div class="buildNum_info floor">
            <div class="title clearfix">
                <h2>楼栋信息</h2>
            </div>
            <div class="con_box clearfix">
                <?php if(!(empty($points) || (($points instanceof \think\Collection || $points instanceof \think\Paginator ) && $points->isEmpty()))): ?>
                <div class="l_con fl" id="ldxx-img">
                    <div class="img"  draggable="false" id="img" style="position: absolute;cursor:move;">
                        <img src="<?php echo htmlentities($points['img']); ?>" alt="">
                        <?php if(is_array($points['data']) || $points['data'] instanceof \think\Collection || $points['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $points['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;$point=explode(',',$vo['point']); ?>
                        <div class="tit ban <?php echo htmlentities($sale_status[$vo['sale']]['alias']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" style="left:<?php echo htmlentities($point[0]); ?>px;top:<?php echo htmlentities($point[1]); ?>px;cursor:pointer;">
                            <?php echo htmlentities($vo['title']); ?>
                            <div class="riangle"></div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div class="label">
                        <div class="item clearfix">
                            <span class="bg on"></span>
                            <span class="txt">在售</span>
                        </div>
                        <div class="item clearfix">
                            <span class="bg for"></span>
                            <span class="txt">待售</span>
                        </div>
                        <div class="item clearfix">
                            <span class="bg off"></span>
                            <span class="txt">售罄</span>
                        </div>
                        <div class="opacity"></div>
                    </div>

                </div>
                <div class="r_con fr">
                    <div class="tab_nav">
                        <ul class="clearfix" id="ban_lists" data-uri="<?php echo url('Api/getBanInfoById'); ?>">
                            <?php if(is_array($ban_lists) || $ban_lists instanceof \think\Collection || $ban_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $ban_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li><a href="javascript:;" data-id="<?php echo htmlentities($vo['id']); ?>" <?php if($i == 1): ?>class="active"<?php endif; ?>><?php echo htmlentities($vo['title']); ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                        <div class="b_l"></div>
                    </div>
                    <div id="ban_info"></div>
                </div>
                <?php else: ?>
                 暂无数据
                <?php endif; ?>
            </div>
        </div>
        <!-- 楼栋信息 E -->
    </div>
</div>
<!-- 楼盘详情 E-->
<script type="text/html" id="template">
    <div class="m_info">
        <ul class="clearfix">
            <li>
                <span class="tit">单元:</span>
                <span class="txt">{{# if(d['ban_info']['unit']){ }}{{d.ban_info.unit}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">电梯数:</span>
                <span class="txt">{{# if(d['ban_info']['elevator']){ }}{{d.ban_info.elevator}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">楼层:</span>
                <span class="txt">{{# if(d['ban_info']['floor_num']){ }}{{d.ban_info.floor_num}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">户数:</span>
                <span class="txt">{{# if(d['ban_info']['room_num']){ }}{{d.ban_info.room_num}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">开盘时间:</span>
                <span class="txt">{{# if(d['ban_info']['open_time']){ }}{{d.ban_info.open_time}}{{# } }}</span>
            </li>
            <li>
                <span class="tit">交房时间:</span>
                <span class="txt">{{# if(d['ban_info']['complate_time']){ }}{{d.ban_info.complate_time}}{{# } }}</span>
            </li>
        </ul>
    </div>
    <div class="s_info">
        <h4>{{d.ban_info.title}}</h4>
        <ul class="table clearfix">
            {{# if(d.type_lists.length>0){ }}
            <li class="thd">
                <ol>
                    <li class="th">名称</li>
                    <li class="th">户型</li>
                    <li class="th">价格</li>
                    <li class="th">状态</li>
                </ol>
            </li>
            <li class="tbd">
                {{# for(var i = 0, len = d.type_lists.length; i < len; i++){ }}
                <a href="{{d.type_lists[i].url}}">
                    <ol class="clearfix">
                        <li class="td">{{d.type_lists[i].title}}</li>
                        <li class="td">{{d.type_lists[i].room}}室{{d.type_lists[i].living_room}}厅{{d.type_lists[i].acreage}}㎡</li>
                        <li class="td">{{d.type_lists[i].price}}万</li>
                        <li class="td">{{d.type_lists[i].sale_status}}</li>
                    </ol>
                </a>
                {{# } }}
            </li>
            {{# } }}
        </ul>
    </div>
</script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script type="text/javascript">
    $(function(){
        //图片拖动
        window.onload = function(){
            var draging = false, lastPoint;
            var body = document.body;
            var img = document.getElementById('img') || false;
            img.onmousedown = function(e){
                e = e || window.event;
                var x = e.clientX;
                var y = e.clientY;
                if(!lastPoint){
                    lastPoint = {};
                }
                lastPoint.x = x;
                lastPoint.y = y;
                draging = true;
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    return false;
                }
            }
            img.ondragstart = function(e){
                e = e || window.event;
                if(e.preventDefault){
                    e.preventDefault();
                }else{
                    return false;
                }
            }
            img.onmouseup = function(){
                draging = false;
                lastPoint = undefined;
            }
            if(document.addEventListener){
                body.addEventListener('mousemove',function(e){
                    onMouseMove(e);
                },false);
                body.addEventListener('mouseup',onMouseUp,false);
            }else{
                body.attachEvent('onmousemove',function(){
                    var event = window.event;
                    onMouseMove(event);
                })
                body.attachEvent('onmouseup',onMouseUp);
            }

            function onMouseMove(e){
                if(!draging){
                    return;
                }
                var img = document.getElementById('img');
                var ldxx_img = document.getElementById('ldxx-img');
                if(lastPoint){
                    var x = e.clientX , y = e.clientY;
                    var imgTop = parseFloat(img.style.top || '0');
                    var imgLeft = parseFloat(img.style.left || '0');
                    var changeX = x - lastPoint.x , changeY = y - lastPoint.y;
                    var dis_X = imgLeft + changeX;
                    var dis_Y = imgTop + changeY;
                    var sub_img = img.getElementsByTagName('img')[0];
                    var sub_img_width = sub_img.offsetWidth;
                    var sub_img_height = sub_img.offsetHeight;
                    var img_width = ldxx_img.offsetWidth;
                    var img_height = ldxx_img.offsetHeight;
                    var dis_w = img_width -  sub_img_width;
                    var dis_h = img_height - sub_img_height;
                    if(dis_X>0){
                        dis_X = 0;
                    }
                    if(dis_X < dis_w){
                        dis_X = dis_w;
                    }

                    if(dis_Y>0){
                        dis_Y = 0;
                    }
                    if(dis_Y < dis_h){
                        dis_Y = dis_h;
                    }

                    img.style.top = dis_Y + 'px';
                    img.style.left = dis_X + 'px';
                    lastPoint.x = x, lastPoint.y = y;
                }
            }
            function onMouseUp(){
                draging = false;
                lastPoint = undefined;
            }
        }
        getBanInfo($("#ban_lists a.active").data('id'));
        $("#ban_lists a").on('click',function(){
            var id = $(this).data('id');
            $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
            getBanInfo(id);
        });
        $(".ban").on('click',function(){
            var id = $(this).data('id');
            $("#ban_lists").find('.active').removeClass('active');
            $("#ban_lists").find("a[data-id='"+id+"']").addClass('active');
            getBanInfo(id);
        });
    });
    function getBanInfo(id)
    {
        var url   = $("#ban_lists").data('uri');
        var param = {id:id};
        $.get(url,param,function(result){
            if(result.code == 1)
            {
                if(result.data){
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        document.getElementById('ban_info').innerHTML = html;
                    });
                }
            }else{
                console.log('get data error');
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