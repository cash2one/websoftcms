<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/admin/edit.html";i:1522328868;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>管理中心</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/manage/css/themes/blue.1.css">
    <script src="/static/layui/layui.js"></script>
    <style>
        .subnav{padding:5px 15px;}
        .layui-form-item label em{display:none;}
    </style>
</head>

<body class="body">
<div class="subnav">
    <?php if(!empty($sub_menu) OR !empty($big_menu)): ?>
    <div class="content_menu ib_a blue line_x">
    	<?php if(!(empty($big_menu) || (($big_menu instanceof \think\Collection || $big_menu instanceof \think\Paginator ) && $big_menu->isEmpty()))): if(isset($normal)): ?>
        <a class="layui-btn" href="<?php echo htmlentities($big_menu['iframe']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php else: ?>
    	<a class="layui-btn J_showDialog" href="javascript:void(0);" data-uri="<?php echo htmlentities($big_menu['iframe']); ?>" data-title="<?php echo htmlentities($big_menu['title']); ?>" data-id="<?php echo htmlentities($big_menu['id']); ?>" data-width="<?php echo htmlentities($big_menu['width']); ?>" data-show_btn="<?php echo htmlentities((isset($big_menu['btn']) && ($big_menu['btn'] !== '')?$big_menu['btn']:true)); ?>" data-height="<?php echo htmlentities($big_menu['height']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php endif; ?>
        <?php endif; if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key;if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo htmlentities($val['url']); ?>" class="layui-btn-xs <?php echo htmlentities($val['class']); ?>"><?php echo htmlentities($val['title']); ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<div class="layui-fluid">

<div class="dialog-form">
    <form class="layui-form" id="info_form" action="<?php echo url('Admin/editDo'); ?>" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">管理员名称</label>
            <div class="layui-input-inline">
                <input type="text" name="username" id="username" placeholder="管理员名称" value="<?php echo htmlentities($info['username']); ?>" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">所属角色</label>
                <div class="layui-input-inline">
                    <select name="role_id">
                        <?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($vo['id'] == $info['role_id']): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo['title']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" id="password" placeholder="密码" value="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-inline">
                <input type="password" name="repassword" id="repassword" placeholder="确认密码" value="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>" />
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/formvalidator.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script>
    var status = 0,check_name_url = "<?php echo url('Admin/ajaxCheckName', ['id'=>$info['id']]); ?>";
    $(function(){
        $.formValidator.initConfig({formid:"info_form",autotip:true});
        $("#username").formValidator({onshow:'请填写名称',onfocus:'请填写名称'}).inputValidator({min:1,onerror:'请填写名称'}).ajaxValidator({
            type : "get",
            url : check_name_url,
            datatype : "json",
            async:'false',
            success : function(result){
                if(result == 0){
                    return false;
                }else{
                    return true;
                }
            },
            onerror : '名称已存在',
            onwait : '查询中,请稍候...'
        }).defaultPassed();
        $("#repassword").formValidator({onfocus:"两次密码不同。",oncorrect:"密码输入一致"}).compareValidator({desid:"password",operateor:"=",onerror:"两次密码不同。"}).defaultPassed();

    });
    function submitForm(){
        $("#info_form").ajaxForm({success:complate,dataType:'json'}).submit();
    }
    layui.use(['form'], function(){
        var form = layui.form

    });
    function complate(result){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        if(result.code == 1){
            parent.layer.msg(result.msg,{icon:1,time:1500},function(){
                parent.window.location.reload();
            });
        } else {
            layer.msg(result.msg,{icon:2});
        }
    }
</script>

</div>
<input type="hidden" id="attr" value="<?php echo url('Linkmenu/ajaxGetAttr'); ?>"/>
<input type="hidden" id="attr-cache" value="<?php echo url('Linkmenu/ajaxGetMenuCache'); ?>">
<script src="/static/manage/js/dialog.js"></script>
<script>
    layui.config({
        base: '/static/manage/js/'
    });
</script>
</body>
</html>

