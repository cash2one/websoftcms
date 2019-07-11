<?php /*a:1:{s:84:"/home/wwwroot/gxwebsoft/public_html/application/home/view/login/forget_password.html";i:1562384074;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/input.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/login.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/color.css">
</head>
<body>
<div class="login">
    <div class="header">
        <div class="comWidth">
            <a href="<?php echo url('Index/index'); ?>"><img src="<?php echo htmlentities($site['pc_logo']); ?>" alt="logo" class="logo"></a>
        </div>
    </div>
    <div class="main">
        <div class="m_con">
            <h1>找回密码</h1>
            <div class="form_box">
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="text" class="ipt"  name="mobile" id="mobile" placeholder="请输入手机号">
                        <span class="placeholder">请输入手机号</span>
                    </div>
                </div>
                <div class="sct check_code clearfix">
                    <div class="sct_ipt fl">
                        <input type="text" class="ipt"  name="sms_code" id="sms_code" placeholder="请输入短信验证码">
                        <span class="placeholder">请输入短信验证码</span>
                    </div>
                    <span class="get_code fl" id="smsCode">获取验证码</span>
                </div>
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="password" class="ipt"  name="password" id="password" placeholder="请设置新密码，6-12位数字+字母">
                        <span class="placeholder">请设置新密码，6-12位数字+字母</span>
                    </div>
                </div>
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="password" class="ipt"  name="password2" id="password2" placeholder="确认密码">
                        <span class="placeholder">确认密码</span>
                    </div>
                </div>
                <div class="sct btn_area">
                    <?php echo token(); ?>
                    <input type="button" value="提交" id="sub_btn" data-uri="<?php echo url('Login/resetPassword'); ?>" class="sbm">
                </div>
                <div class="link">
                    <a href="<?php echo url('Login/index'); ?>">立即登录</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Copyright &copy; <?php echo date('Y'); ?> <?php echo config('url_domain_root'); ?> All Rights Reserved. <?php echo $site['icp']; ?></p>
    </div>
</div>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/layer/layer.js"></script>
<script src="/static/home/js/placeholder.js"></script>
<script>
    $(function(){
        $('#sub_btn').on('click',function(){
            var mobile = $('#mobile').val(),sms_code = $('#sms_code').val(),password = $('#password').val(),
                    password2 = $('#password2').val(),token = $("input[name='__token__']").val(),reg = /^1[3456789][0-9]{9}$/;
            if(!reg.test(mobile))
            {
                layer.msg('手机号码格式不正确！',{icon:2});
                return false;
            }else if(!sms_code){
                layer.msg('请填写短信验证码！',{icon:2});
                return false;
            }else if(password.length < 6){
                layer.msg('密码由6位以上数字或字母组成',{icon:2});
                return false;
            }else if(password!=password2){
                layer.msg('两次密码输入不一致！',{icon:2});
                return false;
            }else{
                var url = $(this).data('uri');
                var param = {
                  mobile : mobile,
                    sms_code : sms_code,
                    password : password,
                    password2 : password2,
                    token : token
                };
                $.post(url,param,function(result){
                    if(result.code == 1)
                    {
                        layer.msg(result.msg,{icon:1,time:2000},function(){
                           window.location.href = result.uri;
                        });
                    }else{
                        layer.msg(result.msg,{icon:2});
                    }
                });
            }
        });
        $("#smsCode").bind('click',function(){
            getCode();
        });
    });
    var time=60,times='';
    function getCode(){
        if(time<60) return false;
        var mobile=$("#mobile").val(),reg = /^1[3456789][0-9]{9}$/;
        if(!reg.test(mobile)){
            layer.msg('请填写正确的手机号码',{icon:2});
            return false;
        }
        $.post("<?php echo url('Sms/sendSms'); ?>",{'mobile':mobile,'exists':2},function(data){
            if(data.code==1){
                time --;
                layer.msg('验证码发送成功，请注意查收',{icon:1});
                times = setInterval(timer,1000);
            }else{
                layer.msg(data.msg,{icon:2});
            }
        });
    }
    function timer(){
        var code = $("#smsCode");
        if(time == 0){
            time = 61;
            code.text('获取验证码');
            clearInterval(times);
        }else{
            code.text(time+'秒后获取');
        }
        time --;
    }
</script>
</body>
</html>