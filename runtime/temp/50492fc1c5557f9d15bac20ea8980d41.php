<?php /*a:2:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/role/editmenu.html";i:1517212582;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<style>
    .layui-table-cell{padding-left:0;}
    .layui-table-view .layui-table td, .layui-table-view .layui-table th{text-align:left;}
</style>
<!--栏目列表-->
<form class="layui-form" action="<?php echo url('Role/setrule'); ?>" method="post" id="info_form">
    <div class="layui-form layui-border-box layui-table-view">
        <div class="layui-table-header">
            <table class="layui-table list-table" id="J_cate_tree" cellspacing="0" cellpadding="0" border="0" style="width:100%;" data-uri="<?php echo url('ajaxEdit'); ?>">
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                <tr id="node-<?php echo htmlentities($val['id']); ?>" <?php if($val['pid'] != 0): ?>class="child-of-node-<?php echo htmlentities($val['pid']); ?>"<?php endif; ?>>
                <td width="30" align="center">
                        <input type='checkbox' name='menuid[]' lay-ignore value='<?php echo htmlentities($val['id']); ?>' class='J_checkitem' <?php if(in_array($val['id'],$menuarr)): ?>checked<?php endif; ?>>
                </td>
                <td class="left">
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['name']); ?>
                    </div>
                </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="role_id" value="<?php echo htmlentities($roleid); ?>" />
</form>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/jquery.treetable.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script>
    $(function(){
        $("#J_cate_tree").treeTable({indent:20,treeColumn:1,expandable:true});
        //选择
        $('.J_checkitem').on('click',this,function(){
            var parent = $(this).parents('tr');
            var pid    = parent.attr('id');
            var find   = "tr.child-of-"+pid;
            var child  = $(find);
            var checked = $(this).get(0).checked;
            child.each(function(){
                getChildMenu(child,checked);
            });
        });
    });
    function submitForm(){
        $("#info_form").ajaxForm({success:complate,dataType:'json'}).submit();
    }
    function complate(result){
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        if(result.code == 1){
            parent.layer.close(index);
            parent.layer.msg(result.msg,{icon:1});
            window.parent.location.reload();
        } else {
            layer.msg(result.msg,{icon:2});
        }
    }
    function getChildMenu(o,c){
        o.each(function(){
            var pid = $(this).attr('id');
            var find   = "tr.child-of-"+pid;
            var child  = $(find);
            $(this).children().find('.J_checkitem').get(0).checked=c;
            if(child.length>0){
                getChildMenu(child,c);
            }
        });
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

