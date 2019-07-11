<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/pages/edit.html";i:1518078486;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<form class="layui-form"  enctype="multipart/form-data" id="info_form" action="<?php echo url('Pages/editDo'); ?>" method="post">
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">基本设置</li>
			<li>SEO设置</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">

				<div class="layui-form-item">
					<label class="layui-form-label">所属分类</label>
					<div class="layui-input-inline" style="line-height: 37px;">
						<?php echo htmlentities($cate['name']); ?>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">标题</label>
					<div class="layui-input-inline">
						<input type="text" name="title" placeholder="标题" value="<?php echo htmlentities($info['title']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">缩略图</label>
					<div class="layui-input-block">
						<div class="layui-upload">
							<input type="hidden" name="img" value="<?php echo htmlentities($info['img']); ?>" id="img_txt">
							<button type="button" class="layui-btn" id="img">上传图片</button>
							<div id="img_preview">
								<?php if(!(empty($info['img']) || (($info['img'] instanceof \think\Collection || $info['img'] instanceof \think\Paginator ) && $info['img']->isEmpty()))): ?>
								<img class='layui-upload-img' src="<?php echo htmlentities($info['img']); ?>" alt="" width="100" />
								<a href='javascript:;' data-text='img_txt' data-src='<?php echo htmlentities($info['img']); ?>' class='deleteImg layui-btn layui-btn-xs layui-btn-danger'>删除</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">简介</label>
					<div class="layui-input-block">
						<textarea class="layui-textarea" name="description"><?php echo htmlentities($info['description']); ?></textarea>
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-inline">
						<script id="info" name="info" type="text/plain"><?php echo $info['info']; ?></script>
					</div>
				</div>

			</div>
			<div class="layui-tab-item">
				<div class="layui-form-item">
					<label class="layui-form-label">seo标题</label>
					<div class="layui-input-inline">
						<input type="text" name="seo_title" placeholder="seo标题" value="<?php echo htmlentities($info['seo_title']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">seo关键词</label>
					<div class="layui-input-inline">
						<input type="text" name="seo_keys" placeholder="seo关键词" value="<?php echo htmlentities($info['seo_keys']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">seo描述</label>
					<div class="layui-input-block">
						<textarea placeholder="seo描述" name="seo_desc" class="layui-textarea"><?php echo htmlentities($info['seo_desc']); ?></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="id" id="id" value="<?php echo htmlentities($cate['id']); ?>" />
	<div class="layui-form-item">
		<label class="layui-form-label">&nbsp;</label>
		<button type="submit" class="layui-btn btn-submit">提交</button>
	</div>
</form>
<?php echo hook('ueditor',['id'=>'info']); ?>
<script>
	var uploadUrl = "<?php echo url('ajaxUploadImg'); ?>",deleteImgUrl = "<?php echo url('deleteImg'); ?>";
	layui.use(['form','upload','element'], function(){
		var $ = layui.jquery,upload = layui.upload;
		upload.render({
			elem: '#img'
			,url: uploadUrl
			,before: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					var img = "<img class='layui-upload-img' src='"+result+"' width='100'/>";
					$('#img_preview').html(img); //图片链接（base64）
				});
			}
			,done: function(res){console.log(res);
				//如果上传失败
				if(res.code == 0){
					return layer.msg('上传失败');
				}else{
					var img = "<img class='layui-upload-img' src='"+res.data+"' width='100'/><a href='javascript:;' data-text='img_txt' data-src='"+res.data+"' class='deleteImg layui-btn layui-btn-xs layui-btn-danger'>删除</a>";
					$("#img_txt").val(res.data);
					$("#img_preview").html(img);
				}
				//上传成功
			}

		});
		$(document).on('click','.deleteImg',function(){
			var that = $(this),img = $(this).data('src'),textId = $(this).data('text'),id = $("#id").val();
			layer.confirm('确定要删除图片么?', {icon: 3, title:'提示'}, function(index){
				var param = {
					'path' : img,
					id : id,
					field : 'img'
				};
				$.post(deleteImgUrl,param,function(res){
					layer.close(index);
					if(res.code == 1){
						$("#"+textId).val('');
						that.parent().html('');
					}else{
						layer.msg(res.msg,{icon:2});
					}
				});
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

