<?php /*a:2:{s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/account/index.html";i:1540639426;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
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
    <form class="layui-form" id="info_form" action="<?php echo url('edit'); ?>" method="post" enctype="multipart/form-data">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">编辑资料</li>
                <li><a href="<?php echo url('avatar'); ?>">上传头像</a></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">手机号 </label>
                            <div class="layui-input-inline" style="line-height: 40px;">
                                <?php echo htmlentities($info['mobile']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">昵称 </label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" name="nick_name" id="nick_name" placeholder="王先生"  autocomplete="off" value="<?php echo htmlentities($info['nick_name']); ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">邮箱 </label>
                            <div class="layui-input-inline">
                                <input type="text" name="email" id="email" lay-verify="email" value="<?php echo htmlentities($info['email']); ?>" placeholder="service@tpfangchan.com" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <?php if($info['model'] != 1): ?>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">所属公司 </label>
                            <div class="layui-input-inline">
                                <input type="text" name="data[company]" id="company" value="<?php echo htmlentities($info['userInfo']['company']); ?>" placeholder="例：XX房产经纪有限公司" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">个人介绍 </label>
                            <div class="layui-input-block">
                                <textarea name="data[description]" id="description" class="layui-textarea"><?php echo htmlentities($info['userInfo']['description']); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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
            var nick_name = $('#nick_name').val(),email = $('#email').val(),url = $('#info_form').attr('action'),
                    company = $('#company').val(),description=$("#description").val();
            if(!nick_name)
            {
                layer.msg('请填写昵称',{icon:2});
                return false;
            }else{
                layer.load(1);
                var param = {
                    nick_name : nick_name,
                    email     : email,
                    data : {
                        company : company,
                        description : description
                    }
                };
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