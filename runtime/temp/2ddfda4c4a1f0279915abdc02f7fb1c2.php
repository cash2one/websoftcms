<?php /*a:2:{s:85:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/account/edit_password.html";i:1525179716;s:77:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/public/layout.html";i:1540436276;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>管理中心</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/red.css">
    <script src="/static/layui/layui.js"></script>
    <style>
        .subnav{padding:5px 15px;}
        .layui-form-item label em{display:none;}
        .layui-tab{margin:0;}
    </style>
</head>

<body class="body">
<?php if(!empty($sub_menu) OR !empty($big_menu)): ?>
<div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!(empty($big_menu) || (($big_menu instanceof \think\Collection || $big_menu instanceof \think\Paginator ) && $big_menu->isEmpty()))): if(isset($normal)): ?>
        <a class="layui-btn" href="<?php echo htmlentities($big_menu['iframe']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php else: ?>
    	<a class="layui-btn J_showDialog" href="javascript:void(0);" data-uri="<?php echo htmlentities($big_menu['iframe']); ?>" data-title="<?php echo htmlentities($big_menu['title']); ?>" data-id="<?php echo htmlentities($big_menu['id']); ?>" data-width="<?php echo htmlentities($big_menu['width']); ?>" data-height="<?php echo htmlentities($big_menu['height']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php endif; ?>
        <?php endif; if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key;if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo htmlentities($val['url']); ?>" class="layui-btn-xs <?php echo htmlentities($val['class']); ?>"><?php echo htmlentities($val['title']); ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<div class="layui-fluid">

<form class="layui-form" id="info_form" action="<?php echo url('editPassword'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">修改密码</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>原密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="password" lay-verify="password" placeholder="原密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="new_password" lay-verify="new_password" placeholder="新密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>确认新密码</label>
                    <div class="layui-input-inline">
                        <input type="password" name="confirm_password" lay-verify="cofirm_password" placeholder="确认新密码" autocomplete="off" class="layui-input">
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">&nbsp;</label>
        <button type="button" lay-submit="" class="layui-btn btn-submit w200">提交</button>
    </div>
</form>
<?php echo hook('ueditor',['id'=>'info']); ?>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['form'], function(){
        var $ = layui.jquery,form = layui.form;
        $(".btn-submit").on('click',function(){
            var password = $("input[name='password']").val(),new_password = $("input[name='new_password']").val(),
                    confirm_password = $("input[name='confirm_password']").val();
            if(password.length < 6)
            {
                layer.msg('请填写原密码',{icon:2});
            }else if(new_password.length < 6){
                layer.msg('新密码至少6位',{icon:2});
            }else if(new_password != confirm_password){
                layer.msg('两次新密码输入不一致！',{icon:2});
            }else{
                $('#info_form').submit();
            }
        });

    });
</script>

</div>
<script src="/static/home/user/js/dialog.js"></script>
</body>
</html>

