<?php /*a:1:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/index/index.html";i:1562394107;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title><?php echo htmlentities($info['company_name']); ?>后台管理中心</title>
    <link rel="stylesheet" href="/static/home/user/css/pintuer.css">
    <link rel="stylesheet" href="/static/home/user/css/user.css">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
<div class="header bg-main">
    <div class="logo margin-big-left">
        <h1>
            <?php echo htmlentities($info['company_name']); ?>，您好
            <?php echo htmlentities($my_admin['username']); ?>
        </h1>
    </div>
    <div class="head-l" style="line-height: 40px;">

    </div>
    <div class="head-r">
        <a class="button button-little bg-green" href="<?php echo url('Index/index@www'); ?>" target="_blank">
            <span class="iconfont">&#xe77e;</span> 网站首页
        </a> &nbsp;&nbsp;

        <a class="button button-little bg-red" href="<?php echo url('Login/logout'); ?>">
            <span class="iconfont">&#xe62e;</span> 退出登录
        </a>
    </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="iconfont">&#xe801;</span>菜单列表</strong></div>
    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
    <h2><span class="iconfont"><?php echo $data['icon']; ?></span><?php echo htmlentities($data['title']); ?></h2>
    <ul <?php if($i == 1): ?>style="display:block;"<?php endif; ?> class="clearfix">
        <?php if(is_array($data['children']) || $data['children'] instanceof \think\Collection || $data['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo htmlentities($val['url']); ?>" target="right"><span class="iconfont icon-arrow-right"></span><?php echo htmlentities($val['title']); ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<ul class="bread">
    <li><a href="<?php echo url('Index/panel'); ?>" target="right"><span class="iconfont">&#xe77e;</span> 用户中心</a></li>
    <li><a href="##" id="a_leader_txt">首页</a></li>
</ul>
<div class="admin">
    <iframe src="<?php echo url('Index/panel'); ?>" name="right" width="100%" height="99%"></iframe>
</div>
<script type="text/javascript">
    $(function(){
        var heights = document.documentElement.clientHeight-110;
        $(".admin").height(heights);
        $(".leftnav h2").click(function(){
            $(this).parent().find('ul').hide();
            $(this).next().show();
        });
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
    $(window).resize(function(){
        var heights = document.documentElement.clientHeight-110;
        $(".admin").height(heights);
    });
</script>
</body>
</html>