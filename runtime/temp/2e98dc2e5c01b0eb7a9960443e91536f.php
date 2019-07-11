<?php /*a:1:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/index/index.html";i:1542330320;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>管理中心</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/manage/css/app.css" media="all">
    <link rel="stylesheet" href="/static/manage/css/themes/blue.1.css" media="all">
</head>

<body class="kit-theme">
<div class="layui-layout layui-layout-admin kit-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">后台管理中心</div>
        <div class="layui-logo kit-logo-mobile">K</div>
        <ul class="layui-nav layui-layout-left kit-nav" kit-one-level  data-uri="<?php echo url('Index/getTopMenu'); ?>"></ul>
        <ul class="layui-nav layui-layout-right kit-nav">
            <li class="layui-nav-item">
                <a href="javascript:;" kit-target data-tips="0" data-options="{icon:'',url:'<?php echo htmlentities($cache_url); ?>',title:'更新缓存',id:'9999'}"><span>更新缓存</span></a>
            </li>
            <li class="layui-nav-item">
                <a href="http://<?php echo config('url_domain_root'); ?>" target="_blank">网站首页</a>
            </li>
            <li class="layui-nav-item" style="position: static">

                <a href="javascript:;">
                    欢迎您，<?php echo htmlentities($my_admin['username']); ?>
                </a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('Login/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
            </li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black kit-side">
        <div class="layui-side-scroll">
            <div class="kit-side-fold"><i class="fa fa-navicon" aria-hidden="true"></i></div>
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar  data-uri="<?php echo url('Index/left'); ?>">
                <li>加载中……</li>
            </ul>
        </div>
    </div>
    <div class="layui-body" id="container" data-uri="<?php echo url('Index/panel'); ?>">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;"><i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#xe63e;</i> 请稍等...</div>
    </div>


</div>
<script src="/static/layui/layui.js"></script>
<script>
    var message;
    layui.config({
        base: '/static/manage/js/'
    }).use(['app', 'message'], function() {
        var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
        //主入口
        app.set({
            type: 'iframe'
        }).init();

    });
</script>
</body>

</html>