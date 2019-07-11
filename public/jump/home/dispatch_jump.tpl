<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>系统信息</title>
    <style type="text/css">
        *{ margin:0px; padding:0px;}
        .error-container{ background:#fff; border:1px solid #d32f2f;  text-align:center; width:450px; margin:50px auto; font-family:Microsoft Yahei; padding-bottom:30px; border-top-left-radius:5px; border-top-right-radius:5px;  }
        .error-container h1{ font-size:16px; padding:12px 0; background:#d32f2f; color:#fff;}
        .errorcon{ padding:35px 0; text-align:center; color:#666; font-size:18px;}
        .errorcon *{vertical-align:middle;}
        .errorcon i{ display:inline-block; margin:12px 10px; font-size:30px; width:30px;height:30px;background: url(/static/images/icon.png) -180px 0 no-repeat;}
        h4{ font-size:14px; color:#666;}
        a{color:#d32f2f;}
        .errorcon i.error{background-position:-150px 0;}
    </style>
</head>
<body class="no-skin">
<div class="error-container">
    <h1> 信息提示 </h1>
    <div class="errorcon">
        <?php switch ($code) {?>
        <?php case 1:?>
        <i class="success"></i><?php echo(strip_tags($msg));?>
        <?php break;?>
        <?php case 0:?>
        <i class="error"></i><?php echo(strip_tags($msg));?>
        <?php break;?>
        <?php } ?>
    </div>
    <h4 class="smaller">页面自动 <a id="href" href="<?php echo($url);?>">跳转</a> 等待时间： <b id="wait"><?php echo $wait;?></b></h4>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            }
        }, 1000);
    })();
</script>
</body>
</html>
