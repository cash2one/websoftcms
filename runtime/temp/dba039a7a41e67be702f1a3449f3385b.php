<?php /*a:2:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/estate/add.html";i:1523932370;s:77:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/public/layout.html";i:1540436276;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>管理中心</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/red.css">
    <script src="/static/layui/layui.js"></script>
    <style>
        .subnav{padding:5px 15px;}
        .layui-form-item label em{display:none;}
        .layui-tab{margin:0;}
    </style>
</head>

<body class="body">
<?php if(!empty($sub_menu) OR !empty($big_menu)): ?>
<div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!(empty($big_menu) || (($big_menu instanceof \think\Collection || $big_menu instanceof \think\Paginator ) && $big_menu->isEmpty()))): if(isset($normal)): ?>
        <a class="layui-btn" href="<?php echo htmlentities($big_menu['iframe']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php else: ?>
    	<a class="layui-btn J_showDialog" href="javascript:void(0);" data-uri="<?php echo htmlentities($big_menu['iframe']); ?>" data-title="<?php echo htmlentities($big_menu['title']); ?>" data-id="<?php echo htmlentities($big_menu['id']); ?>" data-width="<?php echo htmlentities($big_menu['width']); ?>" data-height="<?php echo htmlentities($big_menu['height']); ?>"><?php echo htmlentities($big_menu['title']); ?></a>
        <?php endif; ?>
        <?php endif; if(!(empty($sub_menu) || (($sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator ) && $sub_menu->isEmpty()))): if(is_array($sub_menu) || $sub_menu instanceof \think\Collection || $sub_menu instanceof \think\Paginator): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key;if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo htmlentities($val['url']); ?>" class="layui-btn-xs <?php echo htmlentities($val['class']); ?>"><?php echo htmlentities($val['title']); ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<div class="layui-fluid">

<form class="layui-form" id="info_form" action="<?php echo url('Estate/addDo'); ?>" method="post" enctype="multipart/form-data">
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">小区信息</li>
			<li>配套信息</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="layui-form-alert">*</span>所属区域</label>
					<input type="hidden" name="city" id="J_city_id" value="" />
					<div class="layui-input-block">
						<select class="J_city_select mr10" lay-filter="J_city_select" data-pid="0" data-uri="<?php echo url('City/ajaxGetchilds'); ?>" data-selected="">
						</select>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label"><span class="layui-form-alert">*</span>小区名称</label>
						<div class="layui-input-inline">
							<input type="text" name="title" lay-verify="title" placeholder="小区名称" value="" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label"><span class="layui-form-alert">*</span>小区地址 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" lay-verify="address" id="address" name="address" placeholder="海口市龙华区"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">建筑年代 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="years" id="years" placeholder="2017"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">地图坐标 </label>
						<div class="layui-input-inline" style="width:200px;">
							<input type="text" class="layui-input" name="map" id="map" placeholder="115.345,22.1349"  autocomplete="off" value="" >
						</div>
						<div class="layui-input-inline">
							<button type="button" id="mark" data-uri="<?php echo addon_url('map://Map/updateLocation'); ?>" class="layui-btn">标注位置</button>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">最近成交 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="complate_num" id="complate_num" placeholder="1"  autocomplete="off" value="0" >
						</div>
						<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">套</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">物业类型 </label>
						<div class="layui-input-block">
							<?php echo getLinkMenu(9,'house_type','radio'); ?>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">特色标签 </label>
						<div class="layui-input-block">
							<textarea name="tags" class="layui-textarea" placeholder="多个标签请用','号分隔"></textarea>
						</div>
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
					<label class="layui-form-label">轮播图</label>
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
				<div class="layui-form-item">
					<label class="layui-form-label">小区介绍</label>
					<div class="layui-input-block">
						<script id="info" name="info" type="text/plain"></script>
					</div>
				</div>
			</div>
			<div class="layui-tab-item">
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">建筑类型 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[building_type]" placeholder="板楼"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">产权年限 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[property_right]" placeholder="70年"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">占地面积 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[area_covered]" placeholder="789009平米"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">建筑面积 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[area_build]" placeholder="750098平米"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">容积率 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[volume_ratio]" placeholder="3.3"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">绿化率 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[greening_rate]" placeholder="40%"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">规划户数 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[plan_number]" placeholder="800户"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">地下车位 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[parking_space]" placeholder="750个"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">物业类型 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[property_type]" placeholder="住宅"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">物业公司 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[property_company]" placeholder="海航物业管理有限公司"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">物业费 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[property_fee]" placeholder="1.5元/平米/月"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">开发商 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="data[developer]" placeholder="海航地产有限公司"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
					<legend>SEO优化</legend>
				</fieldset>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">seo标题 </label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="seo_title" placeholder="seo标题"  autocomplete="off" value="" >
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">seo关键词 </label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="seo_keys" placeholder="seo关键词"  autocomplete="off" value="" >
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">seo描述 </label>
						<div class="layui-input-block">
							<textarea name="seo_desc" class="layui-textarea" id="seo_desc"></textarea>
						</div>
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
	var uploadUrl = "<?php echo url('Estate/ajaxUploadImg'); ?>",deleteImgUrl = "<?php echo url('Estate/deleteImg'); ?>";
	layui.config({
		base: '/static/manage/js/'
	});
	//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
	layui.use(['form','element','upload','linkmenu'], function(){
		var $ = layui.jquery,element = layui.element,layer = layui.layer,form = layui.form,upload = layui.upload,menu = layui.linkmenu;
		$(".J_city_select").select({field : 'J_city_id',id : 'J_city_select'});
		//自定义验证规则
		form.verify({
			area : function(value){
				if(!/\d+$/.test(value)){
					return '请选择区域';
				}
			},
			title: function(value){
				if(value.length == 0){
					return '请填写楼盘名称';
				}
			},
			price : function(value){
				if(!/\d+$/.test(value)){
					return '价格只能为数';
				}
			},
			address : function(value){
				if(value.length < 5){
					return '请写正确的地址';
				}
			}

		});
//普通图片上传
		upload.render({
			elem: '#img'
			,url: ''
			,auto:false
			,choose: function(obj){
				//预读本地文件示例，不支持ie8
				obj.preview(function(index, file, result){
					var img = "<img class='layui-upload-img' src='"+result+"' width='100'/>";
					$('#img_preview').html(img); //图片链接（base64）
				});
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
		$("#address").on('blur',function(){
			var city = $("#J_city_id").val();
			var address = $(this).val(),url = "<?php echo addon_url('map://Map/getLocationByAddress'); ?>";
			var param = {
				city : city,
				address : address
			};
			$.get(url,param,function(res){
				if(res.code == 1)
				{
					$("#map").val(res.data.map);
				}
			});
		});
		$("#mark").on('click',function(){
			var url = $(this).data('uri');
			var map = $('#map').val();
			var city = $("#J_city_id").val();console.log(city);
			if(!map)
			{
				if(!city)
				{
					layer.msg('请选择城市',{icon:2});
					return false;
				}
			}
			url += '?map='+map+'&city='+city;
			layer.open(
					{
						type : 2,
						title : '地图标注',
						area : ['100%','100%'],
						shade : 0.2,
						content : url,
						iframeAuto:true
					}
			);
		});
	});
</script>

</div>
<script src="/static/home/user/js/dialog.js"></script>
</body>
</html>

