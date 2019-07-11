<?php /*a:1:{s:79:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/index/index.html";i:1544413498;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>用户中心</title>
    <link rel="stylesheet" href="/static/home/user/css/pintuer.css">
    <link rel="stylesheet" href="/static/home/user/css/user.css">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
<div class="header bg-main">
    <div class="logo margin-big-left fadein-top">
        <h1>
            <img src="<?php echo getAvatar($userInfo['id'],90,90); ?>" class="radius-circle rotate-hover" height="50" alt="" />
            <?php echo htmlentities($userInfo['nick_name']); ?>，<?php echo htmlentities($model); ?>
        </h1>
    </div>
    <div class="head-l" style="line-height: 40px;">

    </div>
    <div class="head-r">
        <a class="button button-little bg-green" href="<?php echo url('Index/index'); ?>" target="_blank">
            <span class="iconfont">&#xe77e;</span> 网站首页
        </a> &nbsp;&nbsp;

        <a class="button button-little bg-red" href="<?php echo url('Login/logout'); ?>">
            <span class="iconfont">&#xe62e;</span> 退出登录
        </a>
    </div>
</div>
<div class="leftnav">
    <div class="leftnav-title"><strong><span class="iconfont">&#xe801;</span>菜单列表</strong></div>
    <h2><span class="iconfont">&#xe602;</span>房源管理</h2>
    <ul style="display:block;" class="clearfix">
        <li><a href="<?php echo url('user.second/add'); ?>" target="right" style="float:right;margin-right:10px;">发布</a><a href="<?php echo url('user.second/index'); ?>" target="right" style="float:left;"><span class="iconfont icon-arrow-right"></span>二手房</a></li>
        <li><a href="<?php echo url('user.rental/add'); ?>" target="right" style="float:right;margin-right:10px;">发布</a><a href="<?php echo url('user.rental/index'); ?>" target="right" style="float:left;"><span class="iconfont icon-arrow-right"></span>出租房</a></li>
        <li><a href="<?php echo url('user.office/add'); ?>" target="right" style="float:right;margin-right:10px;">发布</a><a
                href="<?php echo url('user.office/index'); ?>" target="right" style="float:left;"><span class="iconfont icon-arrow-right"></span>写字楼</a></li>
        <li><a href="<?php echo url('user.shops/add'); ?>" target="right" style="float:right;margin-right:10px;">发布</a><a
                href="<?php echo url('user.shops/index'); ?>" target="right" style="float:left;"><span class="iconfont icon-arrow-right"></span>商铺</a></li>

    </ul>
    <h2><span class="iconfont">&#xe801;</span>信息列表</h2>
    <ul style="display:block">
        <?php if($userInfo['model'] == 1): ?>
        <li><a href="<?php echo url('user.follow/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>我的关注</a></li>
        <li><a href="<?php echo url('user.subscribe/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>我的预约</a></li>
        <li><a href="<?php echo url('user.comment/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>经纪人点评</a></li>
        <li><a href="<?php echo url('user.comment/house'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>楼盘点评</a></li>
        <li><a href="<?php echo url('user.question/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>我的问答</a></li>
        <?php else: ?>
        <li><a href="<?php echo url('user.subscribeManage/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>预约管理</a></li>
        <li><a href="<?php echo url('user.answer/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>我的回答</a></li>
        <?php endif; ?>
    </ul>
    <h2><span class="iconfont">&#xe605;</span>个人信息</h2>
    <ul style="display:block">
        <li><a href="<?php echo url('user.account/index'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>编辑资料</a></li>
        <li><a href="<?php echo url('user.account/password'); ?>" target="right"><span class="iconfont icon-arrow-right"></span>修改密码</a></li>
    </ul>
</div>
<ul class="bread">
    <li><a href="<?php echo url('user.index/pannel'); ?>" target="right"><span class="iconfont">&#xe77e;</span> 用户中心</a></li>
    <li><a href="##" id="a_leader_txt">首页</a></li>
</ul>
<div class="admin">
    <iframe src="<?php echo url('user.index/pannel'); ?>" name="right" width="100%" height="99%"></iframe>
</div>
<script type="text/javascript">
    $(function(){
        var heights = document.documentElement.clientHeight-110;
        $(".admin").height(heights);
        $(".leftnav h2").click(function(){
            $(this).next().slideToggle(200);
            $(this).toggleClass("on");
        })
        $(".leftnav ul li a").click(function(){
            $("#a_leader_txt").text($(this).text());
            $(".leftnav ul li a").removeClass("on");
            $(this).addClass("on");
        })
    });
</script>
</body>
</html>