<?php /*a:2:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/user_cate/index.html";i:1540638380;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
    .td-table{width:100%;}
    .td-table li{display:inline-block;width:16%;float:left;text-align:center;}
</style>
<!--列表-->
<form class="layui-form" action="">
    <div class="layui-form layui-border-box layui-table-view">
        <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
            <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="10%">
                <col/>
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
            <tr>
                <th>
                    <div class="layui-table-cell">
                        <input name="checkAll" lay-skin="primary" lay-filter="checkAll" type="checkbox">
                    </div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>ID</span></div>
                </th>
                <th>
                    <div class="layui-table-cell">
                        <span>分类名称</span>
                    </div>
                </th>
                <th>
                    <div style="text-align:center;">审核</div>
                    <ul class="td-table">
                        <li>二手房</li>
                        <li>出租房</li>
                        <li>写字楼出售</li>
                        <li>写字楼出租</li>
                        <li>商铺出售</li>
                        <li>商铺出租</li>
                    </ul>
                </th>
                <th>
                    <div class="layui-table-cell"><span>年费(元/年)</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>等级</span></div>
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
            <tr>
                <td>
                    <div class="layui-table-cell laytable-cell-checkbox">
                        <input lay-skin="primary" lay-filter="checkOne" value="<?php echo htmlentities($val['id']); ?>" type="checkbox" />
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['id']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['name']); ?>
                    </div>
                </td>
                <td style="padding:0;">
                      <ul class="td-table">
                          <li><?php echo htmlentities($check[$val['data']['check_second']]); ?></li>
                          <li><?php echo htmlentities($check[$val['data']['check_rental']]); ?></li>
                          <li><?php echo htmlentities($check[$val['data']['check_office']]); ?></li>
                          <li><?php echo htmlentities($check[$val['data']['check_office_rental']]); ?></li>
                          <li><?php echo htmlentities($check[$val['data']['check_shops']]); ?></li>
                          <li><?php echo htmlentities($check[$val['data']['check_shops_rental']]); ?></li>
                      </ul>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['fee']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <span data-tdtype="edit" data-field="ordid" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit" style=""><?php echo htmlentities($val['ordid']); ?></span>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <input type="checkbox" name="switch" lay-filter="switchStatus" lay-skin="switch" data-field="status" data-id="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($val['status']); ?>" lay-text="正常|禁用" <?php if($val['status'] == 1): ?>checked<?php endif; ?>>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo rights($options,$val['id'],$val['name'],$menuid); ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <div class="kaifazhe-fix-bottom layui-clear">
        <div class="kaifazhe-list-option layui-fl">
            <input name="checkAll" lay-filter="checkAll" lay-skin="primary" title="全选/取消" type="checkbox">
            <button type="button" lay-submit lay-filter="optionAll" data-msg="确定要删除所选项目么？" data-uri="<?php echo url('delete'); ?>" class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
        </div>
        <div id="pages" class="layui-layout-right">
            <?php echo $pages; ?>
        </div>
    </div>
</form>


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

