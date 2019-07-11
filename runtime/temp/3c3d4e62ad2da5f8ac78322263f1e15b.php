<?php /*a:1:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/home/view/login/register.html";i:1562384065;}*/ ?>
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
    <style>
        .layui-layer-content{padding:15px;line-height: 25px;}
    </style>
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
            <h1><span><a href="<?php echo url('Login/index'); ?>">已有账号，立即登录</a></span>用户注册</h1>
            <div class="form_box">
                <div class="chkb_sct" style="height:20px;">
                    <div class="sct_ipt">
                        <?php if(is_array($user_cate) || $user_cate instanceof \think\Collection || $user_cate instanceof \think\Paginator): $i = 0; $__LIST__ = $user_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['fee'] == 0): ?>
                        <label><input type="radio" name="model" value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></label>&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="text" class="ipt"  name="user_name" id="mobile" placeholder="请输入手机号">
                        <span class="placeholder">请输入手机号</span>
                    </div>
                </div>
                <?php if($user_setting["reg_sms"] == 1): ?>
                <div class="sct check_code clearfix">
                    <div class="sct_ipt fl">
                        <input type="text" class="ipt"  name="sms_code" id="sms_code" placeholder="请输入短信验证码">
                        <span class="placeholder">请输入短信验证码</span>
                    </div>
                    <span class="get_code fl" id="smsCode">获取验证码</span>
                </div>
                <?php endif; ?>
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="password" class="ipt"  name="password" id="password" placeholder="请设置6-12位密码，数字+字母">
                        <span class="placeholder">请设置6位以上密码，数字+字母</span>
                    </div>
                </div>
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="password" class="ipt"  name="password2" id="password2" placeholder="确认密码">
                        <span class="placeholder">确认密码</span>
                    </div>
                </div>
                <div class="sct str_check_code clearfix">
                    <div class="sct_ipt fl">
                        <input type="text" class="ipt"  name="verfiy_code" id="verfiy_code" placeholder="请输入右侧验证码">
                        <span class="placeholder">请输入右侧验证码</span>
                    </div>
                    <img src="<?php echo url('Verfiy/index'); ?>" alt="" class="get_code fr verify_img">
                </div>

                <div class="chkb_sct">
                    <?php echo token(); ?>
                    <input type="checkbox" name="agree" id="agree" value="1" class="chk">
                    <label for="agree">我已阅读并同意《<a href="javascript:;" id="agreement"><?php echo htmlentities($site['title']); ?>用户协议</a>》</label>
                </div>
                <div class="sct btn_area">
                    <input type="hidden" id="reg_sms" value="<?php echo htmlentities($user_setting['reg_sms']); ?>">
                    <input type="button" id="reg_btn" data-uri="<?php echo url('Login/registerDo'); ?>" value="立即注册" class="sbm">
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
        $('#agreement').on('click',function(){
            var html = '<?php echo $agreement['info']; ?>';
            if(html)
            {
                layer.open({
                    type : 1,
                    title : false,
                    area  : ['500px','500px'],
                    content : html
                });
            }

        });
        $("#reg_btn").on('click',function(){
            var mobile = $('#mobile').val(),sms_code = $('#sms_code').val(),password = $('#password').val(),
                    password2 = $('#password2').val(),verfiy_code = $('#verfiy_code').val(),model = $("input[name='model']:checked").val(),
                    agree = $('input[name="agree"]:checked').val(),reg = /^1[3456789][0-9]{9}$/,
                    token = $("input[name='__token__']").val(),send_sms = $('#reg_sms').val();
            if(!reg.test(mobile))
            {
                layer.msg('手机号格式不正确！',{icon:2});
                return false;
            }else if(!sms_code && send_sms == 1){
                layer.msg('请填写短信验证码！',{icon:2});
                return false;
            }else if(password.length < 6){
                layer.msg('密码至少由6位数字或字母组合',{icon:2});
                return false;
            }else if(password != password2){
                layer.msg('两次密码输入不一致！',{icon:2});
                return false;
            }else if(!verfiy_code){
                layer.msg('请填写验证码！',{icon:2});
                return false;
            }else if(agree != 1){
                layer.msg('请先同意用户协议！',{icon:2});
                return false;
            }else{
                var param = {
                    mobile :mobile,
                    sms_code : sms_code,
                    password : password,
                    password2 : password2,
                    verfiy_code : verfiy_code,
                    model : model,
                    token       : token
                };
                var url = $(this).data('uri');
                $.post(url,param,function(result){
                    if(result.code == 1)
                    {
                        window.location.href = result.uri;
                    }else{
                        layer.msg(result.msg,{icon:2});
                    }
                });
            }
        });
        $("#smsCode").bind('click',function(){
            getCode();
        });
        $(".verify_img").click(function(){
            var timenow = new Date().getTime();
            $(this).attr("src","<?php echo url('Verfiy/index'); ?>?t="+timenow)
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
        $.post("<?php echo url('Sms/sendSms'); ?>",{'mobile':mobile,'exists':1},function(data){
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