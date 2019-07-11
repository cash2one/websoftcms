<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/role/index.html";i:1518078486;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<form class="layui-form" action="">
    <div class="layui-form layui-border-box layui-table-view">
        <div class="layui-table-header">
            <table class="layui-table list-table" lay-filter="editTable" data-uri="<?php echo url('ajaxEdit'); ?>">
                <colgroup>
                    <col width="5%">
                    <col width="70%">
                    <col width="20%">
                </colgroup>
                <thead>
                <tr>

                    <th>
                        <div class="layui-table-cell"><span>ID</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>角色名</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell" align="center"><span>操作</span></div>
                    </th>

                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                <tr data-index="<?php echo htmlentities($i); ?>" class="">

                    <td>
                        <div class="layui-table-cell">
                            <?php echo htmlentities($val['id']); ?>
                        </div>
                    </td>
                    <td data-field="title" data-edit="true">
                        <div class="layui-table-cell">
                             <span data-tdtype="edit" data-field="title" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit" style=""><?php echo htmlentities($val['title']); ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php if($val['id'] == $roleid or $val['id'] == $superroleid): ?>
                            <a href="javascript:;" class="layui-btn layui-btn-xs layui-btn-disabled">无权限</a><a href="javascript:;" class="layui-btn layui-btn-xs layui-btn-disabled">无权限</a>
                            <?php else: ?>
                            <a href="javascript:;" class="J_showDialog layui-btn layui-btn-xs layui-btn-normal" data-uri="<?php echo url('Role/editmenu', ['id'=>$val['id']]); ?>" data-title="设置菜单权限"  data-width="500" data-height="410">菜单权限</a>
                            <a href="javascript:;" class="J_confirm layui-btn layui-btn-xs layui-btn-danger" data-uri="<?php echo url('Role/delete', ['id'=>$val['id']]); ?>" data-msg="<?php echo sprintf('确定删除%s角色么？',$val['title']); ?>">删除</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="kaifazhe-fix-bottom layui-clear">

        <div id="pages" class="layui-layout-right">
            <?php echo $pages; ?>
        </div>
    </div>
</form>
<script>
    layui.use(['form','table'], function() {
        var form = layui.form,table = layui.table;
        //监听单元格编辑
        table.render({
            cols: [[
                {edit:'text'} //其它参数在此省略
            ]]
        });
        table.on('edit(editTable)', function(obj){alert('dd');
            var value = obj.value //得到修改后的值
                    ,data = obj.data //得到所在行所有键值
                    ,field = obj.field; //得到字段
            layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);
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

