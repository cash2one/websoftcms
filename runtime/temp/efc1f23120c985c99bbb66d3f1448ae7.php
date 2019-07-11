<?php /*a:2:{s:83:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/setting/water_edit.html";i:1530763478;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
	.layui-form-item .layui-input-inline{width:300px;}
</style>
<!--图片水印设置-->
<form class="layui-form" id="info_form" action="<?php echo url('Setting/editDo'); ?>" method="post">
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">水印设置</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label">开启水印</label>
					<div class="layui-input-block">
						<input type="radio" name="data[is_warter]" value="1" title="开启" <?php if($info['is_warter'] == 1): ?>checked<?php endif; ?>>
						<input type="radio" name="data[is_warter]" value="0" title="关闭" <?php if($info['is_warter'] == 0): ?>checked<?php endif; ?>>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印类型</label>
					<div class="layui-input-block">
						<input type="radio" name="data[water_type]" value="1" title="图片" <?php if($info['water_type'] == 1): ?>checked<?php endif; ?>>
						<input type="radio" name="data[water_type]" value="2" title="文字" <?php if($info['water_type'] == 2): ?>checked<?php endif; ?>>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">水印图片</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_img]" placeholder="" id="img-src" value="<?php echo htmlentities($info['water_img']); ?>" autocomplete="off" class="layui-input ajax-img-text">
						<div class="layui-box layui-upload-button" id="upload">
							<span class="layui-upload-icon"><i class="layui-icon">&#xe61f;</i>图片</span>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印文字</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_text]" placeholder="水印文字" value="<?php echo htmlentities($info['water_text']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印透明度</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_alpha]" placeholder="水印透明度" value="<?php echo htmlentities($info['water_alpha']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">文字旋转角度</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_angle]" placeholder="水印文字旋转角度" value="<?php echo htmlentities($info['water_angle']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印文字大小</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_size]" placeholder="水印文字大小" value="<?php echo htmlentities($info['water_size']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印文字颜色</label>
					<div class="layui-input-inline">
						<input type="text" name="data[water_color]" placeholder="水印文字颜色" value="<?php echo htmlentities($info['water_color']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">水印位置</label>
					<div class="layui-input-block">
						<p>
							<input type="radio" name="data[water_pos]" value="1" title="顶部居左" <?php if($info['water_pos'] == 1): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="2" title="顶部居中" <?php if($info['water_pos'] == 2): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="3" title="顶部居右" <?php if($info['water_pos'] == 3): ?>checked<?php endif; ?>>
						</p>
						<p>
							<input type="radio" name="data[water_pos]" value="4" title="左边居中" <?php if($info['water_pos'] == 4): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="5" title="图片中心" <?php if($info['water_pos'] == 5): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="6" title="右边居中" <?php if($info['water_pos'] == 6): ?>checked<?php endif; ?>>
						</p>
						<p>
							<input type="radio" name="data[water_pos]" value="7" title="底部居左" <?php if($info['water_pos'] == 7): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="8" title="底部居中" <?php if($info['water_pos'] == 8): ?>checked<?php endif; ?>>
							<input type="radio" name="data[water_pos]" value="9" title="底部居右" <?php if($info['water_pos'] == 9): ?>checked<?php endif; ?>>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="name" value="<?php echo htmlentities($action_name); ?>">
	<input type="hidden" name="id" value="<?php echo htmlentities($base['id']); ?>">
	<div class="layui-form-item">
		<label class="layui-form-label">&nbsp;</label>
		<button type="submit" class="layui-btn btn-submit">立即提交</button>
	</div>
</form>
<script>
	//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
	layui.use(['element','upload'], function(){
		var $ = layui.jquery,element = layui.element,upload = layui.upload;
		//普通图片上传
		var uploadInst = upload.render({
			elem: '#upload'
			,url: '<?php echo url("ajaxUploadImg"); ?>'
			,before: function(obj){

			}
			,done: function(res){
				//如果上传失败
				if(res.code == 0){
					return layer.msg('上传失败');
				}else{
					//上传成功
					$("#img-src").val(res.data);
				}

			}
			,error: function(){
				layer.msg('上传失败');
			}
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

