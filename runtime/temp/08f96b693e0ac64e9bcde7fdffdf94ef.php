<?php /*a:2:{s:84:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/account/password.html";i:1535420702;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
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
    
<div class="content add_house">
    <form class="layui-form" id="info_form" action="<?php echo url('editPassword'); ?>" method="post" enctype="multipart/form-data">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">修改密码</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">原密码 </label>
                            <div class="layui-input-inline">
                                <input type="password" class="layui-input" name="old_password" id="old_password" placeholder="原密码"  autocomplete="off" value="" />
                            </div>
                            <div class="layui-input-inline" style="line-height: 40px;">
                                填写原密码
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">新密码 </label>
                            <div class="layui-input-inline">
                                <input type="password" class="layui-input" name="password" id="password" placeholder="密码至少6位"  autocomplete="off" />
                            </div>
                            <div class="layui-input-inline" style="line-height: 40px;">
                                填写新密码，至少6位
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">确认密码 </label>
                            <div class="layui-input-inline">
                                <input type="password" name="password2" id="password2" value="" placeholder="确认新密码" class="layui-input">
                            </div>
                            <div class="layui-input-inline" style="line-height: 40px;">
                                填写确认密码
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">&nbsp;</label>
            <button type="button" lay-submit="" class="layui-btn btn-submit layui-btn-danger w240">提交</button>
        </div>
    </form>

</div>
<script>
    layui.use(['jquery','layer'],function(){
        var $ = layui.jquery,layer = layui.layer;
        $('.btn-submit').on('click',function(){
            var old_password = $('#old_password').val(),password = $('#password').val(),
                    password2 = $('#password2').val(),url = $('#info_form').attr('action');
            if(!old_password)
            {
                layer.msg('请填写原密码',{icon:2});
                return false;
            }else if(!password){
                layer.msg('请填写新密码',{icon:2});
                return false;
            }else if(password != password2){
                layer.msg('两次密码填写不一致',{icon:2});
                return false;
            }else{
                var param = {
                    old_password : old_password,
                    password     : password,
                    password2    : password2
                };
                layer.load(1);
                $.post(url,param,function(result){
                    layer.closeAll();
                    if(result.code == 1)
                    {
                        layer.msg(result.msg,{icon:1},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(result.msg,{icon:2});
                    }
                });
            }

        });
    });
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