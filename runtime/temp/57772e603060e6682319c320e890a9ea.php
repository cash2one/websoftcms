<?php /*a:1:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/login/index.html";i:1562383985;}*/ ?>
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
            <h1>用户登录</h1>
            <div class="form_box">
                <div class="sct clearfix">
                    <div class="sct_ipt">
                        <input type="text" class="ipt"  name="user_name" id="user_name" placeholder="请输入用户名或手机号">
                        <span class="placeholder">请输入用户名或手机号</span>
                    </div>
                </div>
                <div class="sct clearfix">
                    <div class="sct_ipt fl">
                        <input type="password" class="ipt"  name="password" id="password" placeholder="请输入密码">
                        <span class="placeholder">请输入密码</span>
                    </div>
                </div>
                <div class="chkb_sct">
                    <input type="checkbox" name="remember" id="remember" value="1" class="chk">
                    <label for="remember">记住账号</label>
                </div>
                <div class=" btn_area">
                    <?php echo token(); ?>
                    <input type="hidden" id="forward" value="<?php echo htmlentities($forward); ?>">
                    <input type="button" value="登录" class="sbm login-btn" data-uri="<?php echo url('Login/loginDo'); ?>">
                </div>
                <div class="link">
                    <a href="<?php echo url('Login/register'); ?>">立即注册</a>
                    <span class="l">|</span>
                    <a href="<?php echo url('Login/forgetPassword'); ?>">忘记密码？</a>
                </div>
            </div>
            <!--div class="third_log">
                <div class="hd">
                    <div class="l l_l"></div>
                    <h3>第三方登录</h3>
                    <div class="l r_l"></div>
                </div>
                <div class="m clearfix">
                    <a href="#" class="wx_log">微信登录</a>
                    <a href="#" class="qq_log">QQ登录</a>
                    <a href="#" class="wb_log">微博登录</a>
                </div>
            </div-->
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
        $('.login-btn').on('click',function(){
            var user_name = $("#user_name").val(),password = $('#password').val(),remember = $('#remember:checked').val();
            var forward   = $("#forward").val();
            var token     = $("input[name='__token__']").val();
            var url = $(this).data('uri');
            var param = {user_name:user_name,password:password,remember:remember,forward:forward,__token__:token};
            if(!user_name)
            {
                layer.msg('请填写登录名',{icon:2});
                return false;
            }else if(!password){
                layer.msg('请填写密码',{icon:2});
                return false;
            }else{
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
    });
</script>
</body>
</html>