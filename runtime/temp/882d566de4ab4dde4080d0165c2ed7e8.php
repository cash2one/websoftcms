<?php /*a:2:{s:79:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/agent_menu/add.html";i:1517565684;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<!--菜单添加-->
<div class="dialog_content">
    <form class="layui-form" id="info_form" action="<?php echo url('addDo'); ?>" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">上级菜单</label>
            <div class="layui-input-inline">
                <select name="pid">
                    <option value="0">作为一级菜单</option>
                    <?php echo $select_menus; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">菜单名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="title" id="title" placeholder="菜单名称" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">控制器名称</label>
            <div class="layui-input-inline">
                <input type="text" name="module_name" id="module_name" placeholder="控制器名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">方法名</label>
            <div class="layui-input-inline">
                <input type="text" name="action_name" id="action_name" class="layui-input" placeholder="方法名">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">附加参数</label>
            <div class="layui-input-inline">
                <input type="text" name="data" id="data" class="layui-input" placeholder="附加参数">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">字体图标</label>
            <div class="layui-input-inline">
                <input type="text" name="icon" id="icon" class="layui-input" placeholder="字体图标">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-inline">
                <textarea name="remark" id="remark" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-inline">
                <input type="radio" name="display" class="radio_style" value="1" checked="checked" title="是">
                <input type="radio" name="display" class="radio_style" value="0" title="否">
            </div>
        </div>
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/formvalidator.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script>
    $(function(){
        $.formValidator.initConfig({formid:"info_form",autotip:true});
        $("#title").formValidator({ onshow:'填写菜单名称', onfocus:'填写菜单名称', oncorrect:'正确'}).inputValidator({ min:1, onerror:'填写菜单名称'});
        $("#module_name").formValidator({ onshow:'填写控制器名', onfocus:'填写控制器名', oncorrect:'正确'}).inputValidator({ min:1, onerror:'填写控制器名'});
        $("#action_name").formValidator({ onshow:'填写方法名', onfocus:'填写方法名', oncorrect:'正确'}).inputValidator({ min:1, onerror:'填写方法名'});
        $('.J_cate_select').cate_select();
    });
    function submitForm(){
        $("#info_form").ajaxForm({success:complate,dataType:'json'}).submit();
    }
    function complate(result){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        if(result.code == 1){
            parent.layer.msg(result.msg,{icon:1,time:1500},function(){
                window.parent.location.reload();
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

