<?php /*a:2:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/article/index.html";i:1552359480;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<!--文章列表-->
<div class="layui-form" >
    <form name="layui-form" class="search-form" action="<?php echo url('Article/index'); ?>" method="get" >
        <div class="layui-elem-quote">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <input type="hidden" name="cate_id" lay-verify="articleCate" id="J_cate_id" value="" />
                        <select class="J_cate_select mr10" lay-filter="J_cate_select" data-pid="0" data-uri="<?php echo url('ArticleCate/ajaxGetchilds'); ?>" data-selected="<?php echo htmlentities($search['selected_ids']); ?>">
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
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
                    <input type="hidden" name="house_id" value="<?php echo htmlentities($search['house_id']); ?>">
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
        <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('Article/ajaxEdit'); ?>">
                <colgroup>
                    <col width="5%">
                    <col width="5%">
                    <col width="25%">
                    <col width="10%">
                    <col width="15%">
                    <col width="15%">
                    <col width="5%">
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
                        <div class="layui-table-cell"><span>标题</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>所属分类</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>发布时间</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>更新时间</span></div>
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
                    <td data-field="title" date-edit="true">
                        <a href="<?php echo url('News/detail@www',['id'=>$val['id']]); ?>" target="_blank"><?php echo htmlentities($val['title']); ?></a>
                            <?php if(!(empty($val['img']) || (($val['img'] instanceof \think\Collection || $val['img'] instanceof \think\Paginator ) && $val['img']->isEmpty()))): ?>
                            <a href="javascript:;" class="thumb" data-thumb="<?php echo htmlentities($val['img']); ?>"><i class="layui-icon">&#xe64a;</i></a>
                            <?php endif; ?>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php echo htmlentities($val['articleCate']['name']); ?>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php echo htmlentities(date('Y-m-d H:i',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php if(empty($val['update_time']) || (($val['update_time'] instanceof \think\Collection || $val['update_time'] instanceof \think\Paginator ) && $val['update_time']->isEmpty())): ?><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); else: ?><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($val['update_time'])? strtotime($val['update_time']) : $val['update_time'])); ?><?php endif; ?>
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
                        <div class="layui-table-cell">
                            <?php echo rights($options,$val['id'],$val['title'],$menuid); ?>
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
            <button type="button" lay-submit lay-filter="optionAll" data-msg="确定要删除所选项目么？" data-uri="<?php echo url('Article/delete'); ?>" class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
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
    layui.use(['linkmenu'], function(){
        var $ = layui.jquery,menu = layui.linkmenu;
        $(".J_cate_select").select({field : 'J_cate_id',id : 'J_cate_select'});
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

