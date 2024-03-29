<?php /*a:1:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/login/index.html";i:1535441222;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理登录</title>
    <script>
        if (window != window.top) top.location.href = self.location.href;
    </script>
    <link href="/static/layui/css/layui.css" rel="stylesheet" />
    <link href="/static/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/static/manage/css/login.css" rel="stylesheet" />
    <link href="/static/sideshow/css/normalize.css" rel="stylesheet" />
    <link href="/static/sideshow/css/demo.css" rel="stylesheet" />
    <link href="/static/sideshow/css/component.css" rel="stylesheet" />
    <!--[if IE]>
    <script src="/static/sideshow/js/html5.js"></script>
    <![endif]-->
    <style>
        canvas {
            position: absolute;
            z-index: -1;
        }

        .kit-login-box header h1 {
            line-height: normal;
        }

        .kit-login-box header {
            height: auto;
        }

        .content {
            position: relative;
        }

        .codrops-demos {
            position: absolute;
            bottom: 0;
            left: 40%;
            z-index: 10;
        }

        .codrops-demos a {
            border: 2px solid rgba(242, 242, 242, 0.41);
            color: rgba(255, 255, 255, 0.51);
        }

        .kit-pull-right button,
        .kit-login-main .layui-form-item input {
            background-color: transparent;
            color: white;
        }

        .kit-login-main .layui-form-item input::-webkit-input-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input:-moz-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input::-moz-placeholder {
            color: white;
        }

        .kit-login-main .layui-form-item input:-ms-input-placeholder {
            color: white;
        }

        .kit-pull-right button:hover {
            border-color: #009688;
            color: #009688
        }
    </style>
</head>


<body class="kit-login-bg">
<div class="container demo-<?php echo htmlentities($w); ?>">
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="kit-login-box">
                <header>
                    <h1>管理中心登录</h1>
                </header>
                <div class="kit-login-main">
                    <form action="<?php echo url('Login/loginDo'); ?>" class="layui-form" method="post">
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe612;</i>
                            </label>
                            <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="这里输入用户名." class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe673;</i>
                            </label>
                            <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="这里输入密码." class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe60d;</i>
                            </label>
                            <input type="text" name="verify_code" lay-verify="required" autocomplete="off" placeholder="输入右侧验证码." class="layui-input">
                                <span class="form-code" id="changeCode" style="position:absolute;right:2px; top:2px;">
                                    <img class="verify_img" src="<?php echo url('verfiy'); ?>" id="refImg" style="cursor:pointer;" title="点击刷新"/>
                                </span>
                        </div>

                        <div class="layui-form-item">
                            <button type="submit" class="layui-btn btn-submit" lay-submit="" lay-filter="login" style="width:100%;">立即登录</button>
                        </div>
                    </form>
                </div>
                <footer>
                </footer>
            </div>
        </div>
    </div>
</div>
<!-- /container -->

<script src="/static/layui/layui.js"></script>
<script src="/static/sideshow/js/TweenLite.min.js"></script>
<script src="/static/sideshow/js/EasePack.min.js"></script>
<script src="/static/sideshow/js/rAF.js"></script>
<script src="/static/sideshow/js/demo-2.js"></script>
<script>
    layui.use(['layer', 'form'], function() {
        var layer = layui.layer,
                $ = layui.jquery,
                form = layui.form;
        var ie = IEVersion();
        if(!ie){
            layer.alert('为达到最佳使用体验，请使用ie9及以上浏览器或火狐/谷哥/safari浏览');
        }
        $(".verify_img").click(function(){
            var timenow = new Date().getTime();
            $(this).attr("src","<?php echo url('verfiy'); ?>?t="+timenow)
        });

        function IEVersion() {
            var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
            var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
            var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器
            var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
            if(isIE) {
                var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
                reIE.test(userAgent);
                var fIEVersion = parseFloat(RegExp["$1"]);
                if(fIEVersion < 9) {
                    return false;
                }
            } else if(isEdge) {
                return 'edge';//edge
            } else if(isIE11) {
                return true; //IE11
            }else{
                return true;//不是ie浏览器
            }
        }
    });
</script>
</body>

</html>