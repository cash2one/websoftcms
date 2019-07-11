<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/group/index.html";i:1536846298;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<!--楼盘列表-->
<style>
    .layui-form-select{width:100px;}
    td a{margin-bottom:5px;}
</style>
<div class="layui-form">
    <form name="layui-form" class="search-form" action="<?php echo url('index'); ?>" method="get" >
        <div class="layui-elem-quote">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">区域</label>
                    <input type="hidden" name="city" id="J_city_id" value="" />
                    <div class="layui-input-inline">
                        <select class="J_city_select mr10" lay-filter="J_city_select" data-pid="0" data-uri="<?php echo url('City/ajaxGetchilds'); ?>" data-selected="<?php echo getCitySpidById($search['city']); ?>">
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:100px;">
                        <select name="status">
                            <option value="">-所有-</option>
                            <option value="1" <?php if($search['status'] == '1'): ?>selected="selected"<?php endif; ?>>启用</option>
                            <option value="0" <?php if($search['status'] == '0'): ?>selected="selected"<?php endif; ?>>禁用</option>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input name="keyword" type="text" placeholder="输入关键词搜索" class="layui-input" size="25" value="<?php echo htmlentities($search['keyword']); ?>" />
                    </div>
                    <input type="hidden" name="menuid" value="<?php echo htmlentities($menuid); ?>">
                    <button class="layui-btn layui-btn-normal">搜索</button>
                    <span style="color:green;">排序数字越小越靠前</span>
                </div>

            </div>
        </div>
    </form>
</div>
<form class="layui-form" action="">
    <div class="layui-form layui-border-box layui-table-view">
        <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
            <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="10%">
                <col width="15%">
                <col width="15%">
                <col width="15%">
                <col width="8%">
                <col width="8%">
                <col width="19%">
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
                    <div class="layui-table-cell"><span>团购标题</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>楼盘名称</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>价格</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>有效期</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>排序</span></div>
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
                <td data-field="title">
                    <div class="layui-table-cell">
                        <a href="<?php echo url('Group/detail@www',['id'=>$val['id']]); ?>" target="_blank"><?php echo htmlentities($val['title']); ?></a>
                        <?php if(!(empty($val['img']) || (($val['img'] instanceof \think\Collection || $val['img'] instanceof \think\Paginator ) && $val['img']->isEmpty()))): ?>
                        <a href="javascript:;" class="thumb" data-thumb="<?php echo htmlentities($val['img']); ?>"><i class="layui-icon">&#xe64a;</i></a>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['house_title']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['price']); ?><?php echo config('filter.house_price_unit'); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities(date('Y-m-d',!is_numeric($val['begin_time'])? strtotime($val['begin_time']) : $val['begin_time'])); ?>至<?php echo htmlentities(date('Y-m-d',!is_numeric($val['end_time'])? strtotime($val['end_time']) : $val['end_time'])); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <span data-tdtype="edit" data-field="ordid" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit" style=""><?php echo htmlentities($val['ordid']); ?></span>
                    </div>
                </td>
                <td class="kaifazhe-switch">
                    <div class="layui-table-cell">
                        <input type="checkbox" name="switch" lay-filter="switchStatus" lay-skin="switch" data-field="status" data-id="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($val['status']); ?>" lay-text="正常|禁用" <?php if($val['status'] == 1): ?>checked<?php endif; ?>>
                    </div>
                </td>
                <td>
                    <?php echo rights($options,$val['id'],$val['title'],$menuid); ?>
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
<script>
    layui.config({
        base: '/static/manage/js/'
    });
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['linkmenu','jquery'], function(){
        var menu = layui.linkmenu,$ = layui.jquery;
        $(".J_city_select").select({field : 'J_city_id',id : 'J_city_select'});
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

