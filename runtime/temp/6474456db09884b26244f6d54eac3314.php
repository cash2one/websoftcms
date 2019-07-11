<?php /*a:2:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/group/add.html";i:1528187362;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<form class="layui-form" id="info_form" action="<?php echo url('addDo'); ?>" method="post" enctype="multipart/form-data">
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">基本信息</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="layui-form-alert">*</span>选择楼盘</label>
					<div class="layui-input-inline">
						<input type="hidden" id="city" name="city" />
						<input type="hidden" id="house_id" name="house_id" />
						<input type="text" id="house_title" class="layui-input select-house" lay-verify="required" name="house_title">
					</div>
					<div class="layui-input-inline">
						<button type="button" data-uri="<?php echo url('House/ajaxGetLists'); ?>" class="layui-btn select-house">选择楼盘</button>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="layui-form-alert">*</span>标题</label>
					<div class="layui-input-inline">
						<input type="text" name="title" id="title" lay-verify="required" placeholder="团购标题" value="" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="layui-form-alert">*</span>团购价格</label>
					<div class="layui-input-inline" style="width:100px;">
						<input type="text" name="price" id="price" lay-verify="required|number" placeholder="团购价格" value="" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;"><?php echo config('filter.house_price_unit'); ?> &nbsp;&nbsp;原价格：</div>
					<div class="layui-input-inline" style="width:100px;">
						<input type="text" name="old_price" id="old_price" lay-verify="required|number" placeholder="原价格" value="" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;"><?php echo config('filter.house_price_unit'); ?></div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">有效时间</label>
					<div class="layui-input-inline" style="width:150px;">
						<input type="text" name="begin_time" id="begin_time" placeholder="2018-06-02" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">至</div>
					<div class="layui-input-inline" style="width:150px;">
						<input type="text" name="end_time" id="end_time" placeholder="2018-06-02" value="<?php echo date('Y-m-d',strtotime('+30 days')); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">报名人数</label>
					<div class="layui-input-inline">
						<input type="text" name="sign_num" placeholder="1" value="" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">缩略图</label>
					<div class="layui-input-block">
						<div class="layui-upload">
							<input type="hidden" name="img" id="img_txt">
							<button type="button" class="layui-btn" id="img">上传图片</button>
							<div id="img_preview">

							</div>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">轮播图片</label>
					<div class="layui-input-block">
						<div class="layui-upload">
							<script id="uploadpic" name="uploadpic" type="text/plain"></script>
							<button type="button" class="layui-btn" onclick="upImage();">选择图片</button>
							<div id="imageList">
								<ul class="list clearfix">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">团购优惠</label>
					<div class="layui-input-block">
						<textarea placeholder="团购优惠" name="discount" class="layui-textarea"></textarea>
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">楼盘特色</label>
					<div class="layui-input-block">
						<textarea placeholder="楼盘特色" name="special" class="layui-textarea"></textarea>
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">项目介绍</label>
					<div class="layui-input-block">
						<script id="info" name="info" type="text/plain"></script>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">seo标题</label>
					<div class="layui-input-inline">
						<input type="text" name="seo_title" placeholder="seo标题" value="" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">seo关键词</label>
					<div class="layui-input-inline">
						<input type="text" name="seo_keys" placeholder="seo关键词" value="" autocomplete="off" class="layui-input">
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">seo描述</label>
					<div class="layui-input-block">
						<textarea placeholder="seo描述" name="seo_desc" class="layui-textarea"></textarea>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">&nbsp;</label>
		<button type="submit" lay-submit="" class="layui-btn btn-submit w200">提交</button>
	</div>
</form>
<?php echo hook('ueditor',['id'=>'info','upload'=>true]); ?>
<script>
	var uploadUrl = "<?php echo url('ajaxUploadImg'); ?>",deleteImgUrl = "<?php echo url('deleteImg'); ?>";
	layui.config({
		base: '/static/manage/js/'
	});
	//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
	layui.use(['form','upload','linkmenu','laydate'], function(){
		var $ = layui.jquery,form = layui.form,upload = layui.upload,layer = layui.layer,laydate = layui.laydate;
		laydate.render({
			elem: '#begin_time' //指定元素
		});
		laydate.render({
			elem: '#end_time' //指定元素
		});
		$(".select-house").on('click',function(){
			layer.open({
				type : 2,
				title : '选择楼盘',
				area : ['500px','500px'],
				shade : 0.2,
				content : "<?php echo url('House/ajaxGetLists'); ?>",
				iframeAuto:true
			});
		});
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
			var that = $(this),img = $(this).data('src'),textId = $(this).data('text');
			layer.confirm('确定要删除图片么?', {icon: 3, title:'提示'}, function(index){
				var param = {
					'path' : img
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

