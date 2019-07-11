<?php /*a:2:{s:83:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/poster_space/index.html";i:1532751814;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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
	<form class="layui-form" action="">
		<div class="layui-form layui-border-box layui-table-view">
			<div class="layui-table-header">
				<table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('PosterSpace/ajaxEdit'); ?>">
					<colgroup>
						<col width="5%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
						<col width="5%">
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
							<div class="layui-table-cell"><span>广告位名称</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>广告位类型</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>广告位尺寸</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>广告数</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>显示广告数</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>状态</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>调用代码</span></div>
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
								<span data-tdtype="edit" data-field="name" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit"><?php echo htmlentities($val['name']); ?></span>
							</div>
						</td>
						<td>
							<div class="layui-table-cell">
								<?php echo htmlentities($val['type']); ?>
							</div>
						</td>
						<td>
							<div class="layui-table-cell">
								<span data-tdtype="edit" data-field="width" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit"><?php echo htmlentities($val['width']); ?></span>
								*
								<span data-tdtype="edit" data-field="height" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit"><?php echo htmlentities($val['height']); ?></span>
							</div>
						</td>
						<td>
							<div class="layui-table-cell">
								<?php echo htmlentities($val['items']); ?>
							</div>
						</td>
						<td class="kaifazhe-switch">
							<div class="layui-table-cell">
								<span data-tdtype="edit" data-field="display_num" data-id="<?php echo htmlentities($val['id']); ?>" class="tdedit"><?php echo htmlentities($val['display_num']); ?></span>
							</div>
						</td>
						<td>
							<div class="layui-table-cell">
								<input type="checkbox" name="switch" lay-filter="switchStatus" lay-skin="switch" data-field="status" data-id="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($val['status']); ?>" lay-text="正常|禁用" <?php if($val['status'] == 1): ?>checked<?php endif; ?>>
							</div>
						</td>
						<td>
							<a href="javascript:;" class="showCode" data-id="<?php echo htmlentities($val['id']); ?>">调用代码</a>
						</td>
						<td class="kaifazhe-switch">
							<div class="layui-table-cell">
								<?php echo rights($options,$val['id'],$val['name']); ?>
							</div>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="kaifazhe-fix-bottom layui-clear">
			<div class="kaifazhe-list-option layui-fl">
				<input name="checkAll" lay-filter="checkAll" lay-skin="primary" title="全选/取消" type="checkbox">
				<button type="button" lay-submit lay-filter="optionAll" data-msg="确定要删除所选项目么？" data-uri="<?php echo url('PosterSpace/delete'); ?>" class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
			</div>
			<div id="pages" class="layui-layout-right">
				<?php echo $pages; ?>
			</div>
		</div>
	</form>
<script>
	layui.use('layer',function(){
		var layer = layui.layer,$ = layui.jquery;
		$('.showCode').on('click',function(){
			var url = "<?php echo url('showCode'); ?>",id = $(this).data('id');
			layer.open({
				type: 2,
				title: '广告位调用代码',
				area: ['500px','500px'],
				shadeClose: true,
				content: url+'?id='+id
			});
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

