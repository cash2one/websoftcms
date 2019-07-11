<?php /*a:2:{s:81:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/city/ajax_select.html";i:1541076762;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<!--列表-->
<div class="layui-form" >
    <form name="layui-form" class="search-form" id="info_form" action="<?php echo url('ajaxSelect'); ?>" method="get" >
        <div class="layui-elem-quote">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <select name="province" lay-filter="province" id="province">
                            <option value="0">--请选择--</option>
                            <?php $_result=getProvinceLists();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($vo['id'] == $province): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <button class="layui-btn layui-btn-normal" id="searchBtn" type="submit" data-uri="">搜索</button>
                </div>

            </div>
        </div>
    </form>
</div>
<div class="pad_lr_10" >
    <form class="layui-form" action="">
        <div class="layui-form layui-border-box layui-table-view">
            <div class="layui-table-header">
                <table class="layui-table list-table" id="J_cate_tree" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
                    <colgroup>
                        <col width="80%">
                        <col width="20%">

                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <div class="layui-table-cell"><span>区域名称</span></div>
                        </th>
                        <th>
                            <div class="layui-table-cell"><span>操作</span></div>
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <tr id="node-<?php echo htmlentities($val['id']); ?>" pid="<?php echo htmlentities($val['pid']); ?>" <?php if($val['pid'] != 0): ?>class="child-of-node-<?php echo htmlentities($val['pid']); ?>"<?php endif; ?>>

                    <td style="text-align: left;">
                        <div class="layui-table-cell">
                            <?php echo htmlentities($val['name']); ?>
                        </div>
                    </td>
                    <td align="">
                        <div class="layui-table-cell">
                            <a href="javascript:;" class="select layui-btn layui-btn-xs layui-btn-danger" data-id="<?php echo htmlentities($val['id']); ?>" data-name="<?php echo getCityName($val['id'],'-'); ?>">选择</a>
                        </div>
                    </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/jquery.treetable.js"></script>
<script>
    $(function(){
        $("#J_cate_tree").treeTable({indent:20,treeColumn:0,expandable:true});
    });
    layui.use(['jquery'], function() {
        var $ = layui.jquery;
        $(".select").on('click',function(){
            var id = $(this).data('id'),name = $(this).data('name');
            var parentFrame = $(window.parent.document);
            var selected_area = parentFrame.find('#service_area');
            var selected_area_val = selected_area.val();
            name = '<em>'+name+' <i class="layui-icon" data-id="'+id+'">&#x1006;</i></em>';
            id = selected_area_val + id+',';
            selected_area.val(id);
            parentFrame.find('#service_box').append(name);
        });

    });
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

