<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/filter/edit.html";i:1529468860;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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
	.width-100{width:75px;display:inline-block;}
	.orange{color:#f47023;cursor:pointer;}
</style>
<div class="dialog_content">
	<form class="layui-form" id="info_form" action="<?php echo url('editDo'); ?>" method="post">
		<div class="layui-form-item">
			<label class="layui-form-label">名称</label>
			<div class="layui-input-inline">
				<input type="text" name="name" id="name"  placeholder="新房价格范围" value="<?php echo htmlentities($info['name']); ?>" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">调用key</label>
			<div class="layui-input-inline">
				<input type="text" name="keys" id="keys"  placeholder="house_price" value="<?php echo htmlentities($info['keys']); ?>" autocomplete="off" class="layui-input layui-disabled">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">值</label>
			<div class="layui-input-block" id="type-box" data-total="<?php echo count($info['values']); ?>" <?php if($info['type'] == 3): ?>style="margin-left:0;"<?php endif; ?>>
				<?php if($info['type'] == 1): ?>
				<input type="text" name="values" value="<?php echo htmlentities($info['values']); ?>" class="layui-input" />
				<?php elseif($info['type'] == 2): ?>
				<table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
					<colgroup>
						<col width="85%">
					</colgroup>
					<thead>
					<tr>
						<th>
							<div class="layui-table-cell"><span>显示名称</span></div>
						</th>
						<th>
							操作
						</th>
					</tr>
					</thead>
					<tbody>
					<?php if(is_array($info['values']) || $info['values'] instanceof \think\Collection || $info['values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td class="filter-name"><input type="text" name="values[<?php echo htmlentities($key); ?>]" value="<?php echo htmlentities($vo); ?>" class="layui-input" /></td>
						<td>
							<a href="javascript:;" class="addItem"><i class="layui-icon orange">&#xe61f;</i></a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<?php else: ?>
				<table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
					<colgroup>
						<col width="35%">
						<col width="50%">
						<col width="15%">
					</colgroup>
					<thead>
					<tr>
						<th>
							<div class="layui-table-cell"><span>显示名称</span></div>
						</th>
						<th>
							<div class="layui-table-cell"><span>查询值</span></div>
						</th>
						<th>
							操作
						</th>
					</tr>
					</thead>
					<tbody>
					<?php if(is_array($info['values']) || $info['values'] instanceof \think\Collection || $info['values'] instanceof \think\Paginator): $i = 0; $__LIST__ = $info['values'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr>
						<td class="filter-name"><input type="text" name="values[<?php echo htmlentities($key); ?>][name]" value="<?php echo htmlentities($vo['name']); ?>" class="layui-input" /></td>
						<td class="filter-value">
							<input type="text" name="values[<?php echo htmlentities($key); ?>][value][]" value="<?php echo htmlentities($vo['value'][0]); ?>" class="layui-input width-100" /> 到 <input type="text" name="values[<?php echo htmlentities($key); ?>][value][]" value="<?php echo htmlentities($vo['value'][1]); ?>"  class="layui-input width-100"/>
						</td>
						<td>
							<?php if($i == 1): ?>
							<a href="javascript:;" class="addItem"><i class="layui-icon orange">&#xe61f;</i></a>
							<?php else: ?>
							<a href="javascript:;" class="reduceItem"><i class="layui-icon orange">&#x1007;</i></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>">
	</form>
</div>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/formvalidator.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script type="text/html" id="type-1">
	<input type="text" name="values" class="layui-input" />
</script>
<script type="text/html" id="type-2">
	<table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
		<colgroup>
			<col width="85%">
		</colgroup>
		<thead>
		<tr>
			<th>
				<div class="layui-table-cell"><span>显示名称</span></div>
			</th>
			<th>
				操作
			</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td class="filter-name"><input type="text" name="values[1]" class="layui-input" /></td>
			<td>
				<a href="javascript:;" class="addItem"><i class="layui-icon orange">&#xe61f;</i></a>
			</td>
		</tr>
		</tbody>
	</table>
</script>
<script type="text/html" id="type-3">
	<table class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
		<colgroup>
			<col width="15%">
			<col width="65%">
			<col width="20%">
		</colgroup>
		<thead>
		<tr>
			<th>
				<div class="layui-table-cell"><span>显示名称</span></div>
			</th>
			<th>
				<div class="layui-table-cell"><span>查询值</span></div>
			</th>
			<th>
				操作
			</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td class="filter-name"><input type="text" name="values[1][name]" class="layui-input" /></td>
			<td class="filter-value">
				<input type="text" name="values[1][value][]" class="layui-input width-100" /> 到 <input type="text" name="values[1][value][]"  class="layui-input width-100"/>
			</td>
			<td>
				<a href="javascript:;" class="addItem"><i class="layui-icon orange">&#xe61f;</i></a>
			</td>
		</tr>
		</tbody>
	</table>
</script>
<script>
	var number = $("#type-box").data('total');
	$(function(){
		$.formValidator.initConfig({formid:"info_form",autotip:true});
		$("#name").formValidator({onshow:'请填写名称',onfocus:'请填写名称'}).inputValidator({min:1,onerror:'请填写名称'});
		$("#type-box").on('click','.addItem',function(){
			var parent = $(this).parents('tr'),clone = parent.clone(),input_name = clone.find(".filter-name"),input_value = clone.find(".filter-value");
			number++;
			input_name.html(input_name.html().replace('values[1]','values['+number+']'));
			if(input_value.length > 0){
				input_value.html(input_value.html().replace(/values\[1\]/g,'values['+number+']'));
			}
			clone.find(".layui-icon").html('&#x1007;');
			clone.find("input[type='text']").val('');
			clone.find(".addItem").addClass('reduceItem').removeClass('addItem');
			parent.parent().append(clone);
		});
		$(".layui-form").on('click','.reduceItem',function(){
			var parent = $(this).parents('tr'),next = parent.nextAll();
			number = parent.index();
			parent.remove();
			next.remove();
		});
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
	layui.use(['form'],function(){
		var form = layui.form;
		form.on('select(type)', function(data){
			number = 1;
			var v = data.value;
			$("#type-box").html($("#type-"+v).html());
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

