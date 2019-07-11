<?php /*a:4:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/comment.html";i:1543888346;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:72:"/home/wwwroot/gxwebsoft/public_html/application/home/view/house/nav.html";i:1544411302;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
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
<div class="newhouse_detail">
    <!-- 页面标识 S-->
    <div class="page_tit">
        <div class="comWidth">
            <a href="javascript:;" rel="nofollow">您的位置：</a>
            <a href="<?php echo url('Index/index'); ?>">首页</a> &gt;
            <a href="<?php echo url('House/index'); ?>">新房</a> &gt;
            <a href="<?php echo url('House/detail',['id'=>$info['id']]); ?>"><?php echo htmlentities($info['title']); ?></a> &gt;
            <a href="javascript:void(0);">用户点评</a>
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
    <div class="con_wrap comWidth clearfix">
        <div class="leftArea cm_leftArea question">
            <div class="title clearfix" style="padding:10px 30px;">
                <h3><?php echo htmlentities($info['title']); ?>点评</h3>
                <div class="ipt_box" style="display:block;float:none;">
                    <form action="#">
                        <div class="select-score clearfix">
                            <ul class="select-score-left fl">
                                <li>
                                    <span class="score-name">价格：</span>
                                    <span class="score-grade" data-title="price">
                                        <i class="on" data-value="1"></i>
                                        <i class="on" data-value="2"></i>
                                        <i class="on" data-value="3"></i>
                                        <i data-value="4"></i>
                                        <i data-value="5"></i>
                                    </span>
                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                    <span class="score-desc">项目性价比情况</span>
                                </li>
                                <li>
                                    <span class="score-name">地段：</span>
                                    <span class="score-grade" data-title="place">
                                        <i class="on" data-value="1"></i>
                                        <i class="on" data-value="2"></i>
                                        <i class="on" data-value="3"></i>
                                        <i data-value="4"></i>
                                        <i data-value="5"></i>
                                    </span>
                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                    <span class="score-desc">项目所在地理位置情况</span>
                                </li>
                                <li>
                                    <span class="score-name">配套：</span>
                                    <span class="score-grade" data-title="mating">
                                        <i class="on" data-value="1"></i>
                                        <i class="on" data-value="2"></i>
                                        <i class="on" data-value="3"></i>
                                        <i data-value="4"></i>
                                        <i data-value="5"></i>
                                    </span>
                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                    <span class="score-desc">配套与项目的距离及规模大小</span>
                                </li>
                                <li>
                                    <span class="score-name">交通：</span>
                                    <span class="score-grade" data-title="traffic">
                                        <i class="on" data-value="1"></i>
                                        <i class="on" data-value="2"></i>
                                        <i class="on" data-value="3"></i>
                                        <i data-value="4"></i>
                                        <i data-value="5"></i>
                                    </span>
                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                    <span class="score-desc">项目到交通实际距离远近</span>
                                </li>
                                <li>
                                    <span class="score-name">环境：</span>
                                    <span class="score-grade" data-title="science">
                                        <i class="on" data-value="1"></i>
                                        <i class="on" data-value="2"></i>
                                        <i class="on" data-value="3"></i>
                                        <i data-value="4"></i>
                                        <i data-value="5"></i>
                                    </span>
                                    <span class="score-desc color-red"><span class="one-score">3</span>分</span>
                                    <span class="score-desc">项目内绿化及周边污染情况</span>
                                </li>
                            </ul>
                            <div class="select-score-right fl">
                                <div class="score-average">综合评分</div>
                                <div class="score-average-point color-red"><span id="average-score">3</span>分</div>
                                <div class="score-average-desc">根据评分项目自动计算</div>
                            </div>
                        </div>
                        <div class="form">
                            <?php echo token(); ?>
                            <input type="hidden" id="house_id" value="<?php echo htmlentities($info['id']); ?>">
                            <p>
                                <textarea name="content" id="content" cols="30" rows="10" placeholder="请输入评论内容"></textarea>
                            </p>
                            <div class="submit clearfix">
                                <div class="verify fl">
                                    <input type="text" placeholder="填写验证码" name="verify" id="verify">
                                    <img src="<?php echo url('Verfiy/index'); ?>"  class="changeVerify" id="verify-img" alt="验证码">
                                    <span class="changeVerify">换一张</span>
                                </div>
                                <div class="sub-btn fr">
                                    <input type="button" class="btn sub-comment" data-uri="<?php echo url('Api/subHouseComment'); ?>" value="提交">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- 用户问答列表 S -->
            <div class="comment-list">
                <?php $obj = model("comment");$obj = $obj->where("house_id = $id and pid = 0 and status = 1");$obj = $obj->order("create_time desc");$name = $obj->paginate(5);$pages=$name->render();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <div class="comment-row clearfix">
                    <div class="comment-row-avatar fl">
                        <img src="<?php echo getAvatar($data['user_id'],45); ?>" alt="">
                    </div>
                    <div class="comment-row-content fl" style="width:845px;">
                        <div class="comment-row-time">
                            <span class="username"><?php echo htmlentities($data['user_name']); ?></span> <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?>
                        </div>
                        <div class="comment-row-integral">
                            <span class="star">
                                <span class="star integral" style="width:<?php echo htmlentities($data['average_score']/5*100); ?>%;"></span>
                            </span>
                            <span class="comment-row-per">
                                价格：<?php echo htmlentities($data['score']['price']); ?> &nbsp;&nbsp;地段：<?php echo htmlentities($data['score']['place']); ?> &nbsp;&nbsp;配套：<?php echo htmlentities($data['score']['mating']); ?> &nbsp;&nbsp;交通：<?php echo htmlentities($data['score']['traffic']); ?> &nbsp;&nbsp;环境：<?php echo htmlentities($data['score']['science']); ?>
                            </span>
                        </div>
                        <div class="comment-row-content">
                            <?php echo htmlentities($data['content']); ?>
                        </div>
                        <div class="comment-reply">
                            <a href="javascript:;" class="support" onclick="support(this,'<?php echo htmlentities($data['id']); ?>')">支持(<span><?php echo htmlentities($data['support']); ?></span>)</a> <a href="javascript:;" class="reply-content">回复</a> <a href="javascript:;" class="reply">查看回复</a>
                        </div>
                        <div class="comment-reply-content" id="comment-reply-content-<?php echo htmlentities($data['id']); ?>" style="display:none;">
                            <?php $pid = $data['id']; $obj = model("comment");$obj = $obj->where("pid = $pid and status = 1");$obj = $obj->order("create_time desc");$name = $obj->limit(15)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                            <div class="comment-row clearfix">
                                <div class="comment-row-avatar fl">
                                    <img src="<?php echo getAvatar($val['user_id'],45); ?>" alt="<?php echo htmlentities($val['user_name']); ?>">
                                </div>
                                <div class="comment-row-content fl" style="width:795px;">
                                    <div class="comment-row-time">
                                        <span class="username"><?php echo htmlentities($val['user_name']); ?></span> <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                                    </div>
                                    <div class="comment-row-content">
                                        <?php echo htmlentities($val['content']); ?>
                                    </div>
                                    <div class="comment-reply">
                                        <a href="javascript:;" class="support" onclick="support(this,'<?php echo htmlentities($val['id']); ?>')">支持(<span><?php echo htmlentities($val['support']); ?></span>)</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
                        </div>
                        <div class="comment-reply-box">
                            <div class="submit clearfix">
                                <p>
                                    <textarea name="reply_content" id="reply_content_<?php echo htmlentities($data['id']); ?>" placeholder="请输入回复内容"></textarea>
                                </p>
                                <div class="verify fl">
                                    <input type="text" placeholder="填写验证码" name="verify">
                                    <img src="<?php echo url('Verfiy/index'); ?>"  class="changeVerify" alt="验证码">
                                    <span class="changeVerify">换一张</span>
                                </div>
                                <div class="sub-btn fr">
                                    <input type="button" data-pid="<?php echo htmlentities($data['id']); ?>" class="btn sub-comment-reply" data-uri="<?php echo url('Api/subHouseCommentReply'); ?>" value="提交">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
        </div>
        <div class="rightArea cm_rightArea ">
            <!-- 待解决问题 S -->
            <div class="for_anser mt_30">
                <div class="title">
                    <h3>周边楼盘</h3>
                    <p class="b_l"></p>
                </div>
                <div class="con_box">
                    <ul class="clearfix">
                        <?php if(is_array($nearby_house) || $nearby_house instanceof \think\Collection || $nearby_house instanceof \think\Paginator): $i = 0; $__LIST__ = $nearby_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>" target="_blank"><span style="float:right;color:#D32F2F;"><?php echo htmlentities($vo['price']); ?><?php echo htmlentities($vo['unit']); ?></span><?php echo htmlentities($vo['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
            <!-- 待解决问题 E -->
        </div>
    </div>
</div>
<!-- 楼盘详情 E-->
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <div class="comment-row clearfix">
        <div class="comment-row-avatar fl">
            <img src="{{d[i].avatar}}" alt="">
        </div>
        <div class="comment-row-content fl" style="width:795px;">
            <div class="comment-row-time">
                <span class="username">{{d[i].user_name}}</span> {{d[i].create_time}}
            </div>
            <div class="comment-row-content">
                {{d[i].content}}
            </div>
            <div class="comment-reply">
                <a href="javascrip:;" class="support" onclick="support(this,'{{d[i].id}}')">支持(<span>{{d[i].support}}</span>)</a>
            </div>
        </div>
    </div>
    {{# } }}
</script>
<script src="/static/js/layer/laytpl.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script>
    $(function(){
        var init = {'price':3,'place' : 3,'mating' : 3,'traffic' : 3,'science' : 3};
        $('.score-grade i').on('mouseenter',function () {
            var index = $(this).index()+ 1,score = $(this).data('value');
            $(this).prevAll().addClass('on');
            $(this).addClass('on');
            $(this).nextAll().removeClass('on');
            $(this).parent().parent().find('.one-score').text(score);
        });
        $('.score-grade').on('mouseleave',function () {
            var title = $(this).data('title');
            $(this).find('.on').removeClass('on');
            var count = init[title];
            if(count == 5) {
                $(this).find('i').addClass('on');
            } else {
                $(this).find('i').eq(count).prevAll().addClass('on');
            }
            $(this).parent().find('.one-score').text(init[title]);
        });
        $('.score-grade i').on('click',function () {
            var total = 0,len  = 5,average = 0,score = $(this).data('value'),parent = $(this).parent(),title = parent.data('title');
            $(this).prevAll().addClass('on');
            $(this).addClass('on');
            init[title] = score;
            parent.parent().find('.one-score').text(score);
            for(var i in init)
            {
                total += init[i];
            }
            average = 1*(total / len).toFixed(1);
            $("#average-score").text(average);
        });
        //弹出回复框
        $(".reply-content").on('click',function(){
            var parent = $(this).parents('.comment-row-content'),re_list = parent.find('.comment-reply-content'),
                    re_box = parent.find('.comment-reply-box');
            re_list.slideUp();
            if(re_box.css('display') == 'block')
            {
                re_box.slideUp();
            }else{
                re_box.slideDown();
            }
        });
        $(".reply").on('click',function(){
            var parent = $(this).parents('.comment-row-content'),re_list = parent.find('.comment-reply-content'),
                    re_box = parent.find('.comment-reply-box');
            re_box.slideUp();
            if(re_list.css('display') == 'block')
            {
                re_list.slideUp();
            }else{
                re_list.slideDown();
            }
        });
        //提交点评
        $(".sub-comment").on('click',function(){
            var content = $("#content").val(),house_id = $("#house_id").val(),url = $(this).data('uri'),
                    token = $("input[name='__token__']").val(),verify = $("#verify").val();
            if(!content){
                layer.msg('请填写您的评论内容',{icon:2});
            }else if(!verify){
                layer.msg('请填写验证码',{icon:2});
            }else{
                $.post(
                        url,
                        {
                            content:content,
                            house_id:house_id,
                            token:token,
                            verify : verify,
                            score  : JSON.stringify(init)
                        },
                        function(result){
                            if(result.code == 1)
                            {
                                $("#content").val('');
                                layer.msg('评论提交成功',{icon:1});
                            }else{
                                layer.msg(result.msg,{icon:2});
                            }
                });
            }
        });
        //点评回复
        $(".sub-comment-reply").on('click',function(){
            var parent = $(this).parents('.submit'),content = parent.find("textarea[name='reply_content']"),house_id = $("#house_id").val(),url = $(this).data('uri'),
                    verify = parent.find("input[name='verify']"),pid = $(this).data('pid');
            if(!content.val()){
                layer.msg('请填写您的回复内容',{icon:2});
            }else if(!verify.val()){
                layer.msg('请填写验证码',{icon:2});
            }else{
                $.post(
                        url,
                        {
                            content:content.val(),
                            house_id:house_id,
                            verify : verify.val(),
                            pid : pid
                        },
                        function(result){
                            if(result.code == 1)
                            {
                                content.val('');
                                if(result.data){
                                    var gettpl = document.getElementById('template').innerHTML;
                                    laytpl(gettpl).render(result.data, function(html){
                                        $('#comment-reply-content-'+pid).html(html);
                                    });
                                }
                                layer.msg('提交成功',{icon:1});
                            }else{
                                layer.msg(result.msg,{icon:2});
                            }
                        });
            }
        });
        $(".changeVerify").on('click',function(){
            var img = $(this).parent().find('img'),url = img.attr('src');
            img.attr('src',url+"?t="+Math.random());
        });
    });
    function support(obj,id)
    {
        var url = "<?php echo url('Api/support'); ?>",o = $(obj).find('span'),num = parseInt(o.text());
        $.get(url,{id:id},function(res){
            if(res.code == 1){
                o.text(num+1);
                layer.msg(res.msg,{icon:1});
            }else{
                layer.msg(res.msg,{icon:2});
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