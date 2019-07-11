<?php /*a:2:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/linkmenu/add.html";i:1520241866;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<!--添加分类-->
<div class="dialog-form">
    <form class="layui-form" id="info_form" action="<?php echo url('addDo'); ?>" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">上级栏目</label>
            <input type="hidden" name="pid" id="J_cate_id" />
            <div class="layui-input-inline">
                <select class="J_cate_select mr10" lay-filter="J_cate_select" data-menuid="<?php echo htmlentities($menu_id); ?>" data-pid="0" data-uri="<?php echo url('Linkmenu/ajaxGetchilds'); ?>" data-selected="">
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">栏目名称</label>
            <div class="layui-input-block">
                <textarea name="name" id="name" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">栏目别名</label>
            <div class="layui-input-block">
                <input type="text" name="alias" id="alias" class="layui-input" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SEO 标题</label>
            <div class="layui-input-block">
                <input type="text" name="seo_title" class="layui-input"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SEO 关键词</label>
            <div class="layui-input-block">
                <input type="text" name="seo_keys" class="layui-input"/>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SEO 描述</label>
            <div class="layui-input-block">
                <textarea name="seo_desc" id="seo_desc" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <input type="radio" name="status" value="1" checked="checked" title="正常">&nbsp;&nbsp;
                <input type="radio" name="status" value="0" title="禁用">
            </div>
        </div>
        <input type="hidden" name="menuid" value="<?php echo htmlentities($menu_id); ?>" />
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/formvalidator.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script>
    layui.config({
        base: '/static/manage/js/'
    });
    layui.use(['linkmenu'], function() {
        var $ = layui.jquery,  menu = layui.linkmenu;
        $(".J_cate_select").select({field: 'J_cate_id', id: 'J_cate_select'});
    });
    $(function(){
        $.formValidator.initConfig({formid:"info_form",autotip:true});
        $("#name").formValidator({onshow:'请填写名称',onfocus:'请填写名称'}).inputValidator({min:1,onerror:'请填写名称'});
    });
    function submitForm(){
        $("#info_form").ajaxForm({success:complate,dataType:'json'}).submit();
    }
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

