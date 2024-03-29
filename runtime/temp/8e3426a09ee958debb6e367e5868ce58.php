<?php /*a:1:{s:73:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/404.html";i:1557452268;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>404</title>
    <style>
        .main{max-width:640px;margin:0 auto;text-align:center;font-size:14px;}
        .error{margin-top:40px;text-align:center;width:100%;}
        .error img{width:150px;}
        .error-text{padding:10px;}
        .jump{padding:0;}
        .jump span{color:#D32F2F;font-size:30px;}
        .link-url{margin: 20px 0;}
        .link-url a{background-color: #D32F2F;padding:5px 30px;color:#fff;border-radius: 5px;text-decoration: none;}
        .error-img{width:280px;margin:0 auto;}
        .error-img img{width:280px;margin:0 auto;display:inline-block;}
    </style>
</head>
<body>
<div class="main">
    <div class="error">
        <img src="/static/images/404.png" alt="">
    </div>
    <div class="error-text">可怜的页面姑娘不小心迷路了……</div>
    <div class="jump"><span id="wait">5s</span>后自动跳转到首页</div>
    <div class="link-url">
        <a href="<?php if(isset($url)): if(empty($url) || (($url instanceof \think\Collection || $url instanceof \think\Paginator ) && $url->isEmpty())): ?><?php echo url('Index/index'); else: ?><?php echo htmlentities($url); ?><?php endif; else: ?><?php echo url('Index/index'); ?><?php endif; ?>" id="href">带她回首页</a>
    </div>
    <div class="error-img">
        <img src="/static/images/404-girl.png" alt="">
    </div>
</div>
</body>
<script>
    (function(){
        var wait = 5,href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait;
            document.getElementById('wait').innerHTML = time+'s';
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            }
        }, 1000);
    })();
</script>
</html>