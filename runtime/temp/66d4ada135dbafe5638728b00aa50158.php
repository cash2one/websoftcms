<?php /*a:2:{s:82:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/account/avatar.html";i:1535420038;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/red.css">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="/static/layui/layui.js"></script>
</head>
<body>
<div class="layui-fluid">
    
<style>
    .flash-box{width:500px;height:450px;float:left;margin-right:10px;}
    .avatar-list{width:200px;float:left;}
</style>
<div class="content add_house">
    <form class="layui-form" id="info_form" action="" method="post" enctype="multipart/form-data">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li><a href="<?php echo url('index'); ?>">编辑资料</a></li>
                <li class="layui-this"><a href="<?php echo url('avatar'); ?>">上传头像</a></li>
            </ul>
            <div class="layui-tab-content">
                <div class="flash-box">
                    <div class="flash">
                        <div id="content">

                        </div>
                    </div>
                </div>
                <div class="avatar-list">
                    <?php if(is_array($avatar) || $avatar instanceof \think\Collection || $avatar instanceof \think\Paginator): $i = 0; $__LIST__ = $avatar;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($i < 5): ?>
                    <p><a class="max_tx" title="<?php echo htmlentities($key); ?>×<?php echo htmlentities($key); ?>" href="javascript:;"><img src="<?php echo htmlentities($vo); ?>" alt="<?php echo htmlentities($key); ?>×<?php echo htmlentities($key); ?>"><br /><?php echo htmlentities($key); ?>×<?php echo htmlentities($key); ?></a></p>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>

    </form>

</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script language="javascript" type="text/javascript" src="/static/js/avatar/swfobject.js"></script>
<script type="text/javascript">
    var flashvars = {
        'upurl':"<?php echo htmlentities($upload_url); ?>&callback=avatar&"
    };
    var params = {
        'align':'middle',
        'play':'true',
        'loop':'false',
        'scale':'showall',
        'wmode':'window',
        'devicefont':'true',
        'id':'Main',
        'bgcolor':'#ffffff',
        'name':'Main',
        'allowscriptaccess':'always'
    };
    var attributes = {

    };
    swfobject.embedSWF("/static/js/avatar/main.swf", "content", "490", "434", "9.0.0","/static/js/avatar/expressInstall.swf", flashvars, params, attributes);

    function avatar(result) {
        var data  = eval('('+result+')');
        if(data.status == 1) {

            var str = '';
            for(var i in data['data']){
                str += '<p><a class="max_tx"><img src="'+data['data'][i].replace('.\/','/')+'?t='+Math.random()+'" width="'+i+'" height="'+i+'" /><br />'+i+' x '+i+'</a></p>';
            }
            $(".avatar-list").html(str);
            layer.msg('上传成功',{icon:1});
        } else {
            layer.msg('上传失败',{icon:2});
        }
    }
</script>

</div>
<script>
    layui.config({
        base: '/static/manage/js/'
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
            if(fIEVersion < 10) {
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
</script>
</body>
</html>