<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/admin/index.html";i:1528681442;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<!--管理员管理-->
<form class="layui-form" action="">
<div class="layui-form layui-border-box layui-table-view">
    <div class="layui-table-header">
        <table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
            <colgroup>
                <col width="15%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>

                <th>
                    <div class="layui-table-cell"><span>用户名</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>角色</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>最后登录时间</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>最后登录IP</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>状态</span></div>
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
                        <?php echo htmlentities($val['username']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['role']['title']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['last_time'])? strtotime($val['last_time']) : $val['last_time'])); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['last_ip']); ?>
                    </div>
                </td>
                <td class="kaifazhe-switch">
                    <div class="layui-table-cell">
                        <input type="checkbox" name="switch" lay-filter="switchStatus" lay-skin="switch" data-field="status" data-id="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($val['status']); ?>" lay-text="正常|禁用" <?php if($val['status'] == 1): ?>checked<?php endif; ?>>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php if($val['role_id'] != $adminInfo['role'] and $adminInfo['role'] != $superroleid): ?>无权限<?php else: ?>
                        <a href="javascript:;" class="J_showDialog layui-btn layui-btn-xs layui-btn-normal"  lay-event="edit" data-uri="<?php echo url('Admin/edit',['id'=>$val['id']]); ?>" data-title="编辑 - <?php echo htmlentities($val['username']); ?>"  data-id="edit" data-width="500" data-height="400">编辑</a>

                        <?php endif; if($val['role_id'] < $adminInfo['role'] or $val['id'] == $adminInfo['id']): ?>
                        无权限
                        <?php else: ?>
                        <a href="javascript:;" class="J_confirm layui-btn layui-btn-xs layui-btn-danger" lay-event="del" data-uri="<?php echo url('Admin/delete', ['id'=>$val['id']]); ?>" data-msg="<?php echo sprintf('确定删除用户%s么?',$val['username']); ?>">删除</a>
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
    layui.use(['form'], function() {
        var form = layui.form;
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

