<?php /*a:2:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/house/add.html";i:1552638634;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<form class="layui-form" id="info_form" data-uri="<?php echo url('Linkmenu/ajaxGetAttr'); ?>" data-cacheuri="<?php echo url('Linkmenu/ajaxGetMenuCache'); ?>" action="<?php echo url('House/addDo'); ?>" method="post" enctype="multipart/form-data">
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">楼盘信息</li>
			<li>配套信息</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label"><span class="layui-form-alert">*</span>所属区域</label>
					<input type="hidden" name="city" id="J_city_id" value="" />
					<div class="layui-input-block">
						<select name="" lay-filter="province" id="province" data-uri="<?php echo url('City/ajaxGetchilds'); ?>">
							<option value="0">--请选择--</option>
							<?php $_result=getProvinceLists();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<select class="J_city_select mr10" lay-filter="J_city_select" data-pid="0" data-uri="" data-selected="">
						</select>
					</div>

				</div>

				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label"><span class="layui-form-alert">*</span>楼盘名称</label>
						<div class="layui-input-inline">
							<input type="text" name="title" lay-verify="title" placeholder="楼盘名称" value="" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label"><span class="layui-form-alert">*</span>均价<a href="javascript:;" data-title="不填写价格或填写0前台显示为待定" class="layui-icon layui-icon-tips alert"></a></label>
						<div class="layui-input-inline" style="width:90px;">
							<input type="text" name="price"  lay-verify="price" size="10" placeholder="30000" value="" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-input-inline" style="width:80px;">
							<select name="unit" id="unit">
								<?php if(is_array($unit) || $unit instanceof \think\Collection || $unit instanceof \think\Paginator): $i = 0; $__LIST__ = $unit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo); ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label"><span class="layui-form-alert">*</span>楼盘地址 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" lay-verify="address" id="address" name="address" placeholder="例：海秀路104号"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">售楼处地址 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="sale_address" placeholder="例：海秀路104号"  autocomplete="off" value="" >
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">开盘时间<a href="javascript:;" data-title="不选择时间前台不会显示，若要填写其它字符请在时间选择框后面那个输入框中填写！" class="layui-icon layui-icon-tips alert"></a> </label>
						<div class="layui-input-inline" style="width:110px;;">
							<input type="text" class="layui-input" id="opening_time" name="opening_time" placeholder="2016-10-22"  autocomplete="off" value="" >
						</div>
						<div class="layui-input-inline" style="width:190px;">
							<input type="text" class="layui-input" name="opening_time_memo" placeholder="1#,2#已开盘"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">交房时间 </label>
						<div class="layui-input-inline" style="width:110px;">
							<input type="text" class="layui-input" id="complate_time" name="complate_time" placeholder="2018-10-20"  autocomplete="off" value="" >
						</div>
						<div class="layui-input-inline" style="width:190px;">
							<input type="text" class="layui-input" name="complate_time_memo" placeholder="1#,2#已交房"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">售楼电话 </label>
						<div class="layui-input-inline" style="width:200px;">
							<input type="text" class="layui-input" name="sale_phone[phone]" placeholder="0898-32266803"  autocomplete="off" value="" >
						</div>
						<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">转</div>
						<div class="layui-input-inline" style="width:67px;">
							<input type="text" class="layui-input" name="sale_phone[extension]" placeholder="8888"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">预售证号 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="license_key" placeholder=" [2014]海房预字（0076）号"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">开发商 </label>
						<div class="layui-input-inline">
							<input type="hidden" name="developer_id" id="developer_id" value="">
							<input type="text" class="layui-input" name="developer_name" id="developer_name" placeholder="富力地产"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">地图坐标 </label>
						<div class="layui-input-inline" style="width:200px;">
							<input type="text" class="layui-input" name="map" id="map" placeholder="115.345,22.1349"  autocomplete="off" value="" >
						</div>
						<div class="layui-input-inline">
							<button type="button" id="mark" data-autouri="<?php echo addon_url('map://Map/getLocationByAddress'); ?>" data-uri="<?php echo addon_url('map://Map/updateLocation'); ?>" class="layui-btn">标注位置</button>
						</div>
					</div>
				</div>
				<?php if(getSettingCache('site','red_packet') == 1): ?>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">购房红包<a href="javascript:;" data-title="不填写红包金额或填写0，前台不会显示领取红包提示！" class="layui-icon layui-icon-tips alert"></a> </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="red_packet" lay-verify="red_packet" placeholder="10000"  autocomplete="off" value="" >
						</div>
						<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">元</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">优惠楼盘 </label>
						<div class="layui-input-block">
							<input type="checkbox" lay-skin="primary" lay-filter="discount" name="is_discount" value="1" title="">
						</div>
					</div>
				</div>
				<div class="layui-form-item layui-hide" id="discount">
					<div class="layui-block">
						<label class="layui-form-label">优惠内容 </label>
						<div class="layui-input-block">
							<textarea name="discount" id="" class="layui-textarea"></textarea>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">装修情况<a href="javascript:;" data-field="renovation" data-type="radio" data-alert="装修情况" data-id="8" data-title="点击我可以管理装修情况" class="layui-icon layui-icon-set attr-manage"></a></label>
						<div class="layui-input-block">
							<?php echo getLinkMenu(8,'renovation','radio'); ?>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">销售状态<a href="javascript:;" data-field="sale_status" data-type="radio" data-default="1" data-alert="销售状态" data-id="1" data-title="点击我可以管理销售状态" class="layui-icon layui-icon-set attr-manage"></a></label>
						<div class="layui-input-block">
							<?php echo getLinkMenu(1,'sale_status','radio',1); ?>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">楼盘类型<a href="javascript:;" data-field="type_id" data-type="checkbox" data-alert="楼盘类型" data-id="2" data-title="点击我可以管理楼盘类型" class="layui-icon layui-icon-set attr-manage"></a> </label>
						<div class="layui-input-block">
							<?php echo getLinkMenu(2,'type_id','checkbox'); ?>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">特色标签<a href="javascript:;" data-field="tags_id" data-type="checkbox" data-alert="特色标签" data-id="3" data-title="点击我可以管理特色标签" class="layui-icon layui-icon-set attr-manage"></a> </label>
						<div class="layui-input-block">
							<?php echo getLinkMenu(3,'tags_id','checkbox'); ?>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">推荐位 </label>
						<div class="layui-input-block">
							<?php if(is_array($position_lists) || $position_lists instanceof \think\Collection || $position_lists instanceof \think\Paginator): $i = 0; $__LIST__ = $position_lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<input type="checkbox" name="position[]" lay-skin="primary" value="<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['title']); ?>">
							<?php endforeach; endif; else: echo "" ;endif; ?>
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
					<label class="layui-form-label">视频看房</label>
					<div class="layui-input-block">
						<div class="layui-upload">
							<input type="hidden" name="video" id="video">
							<div id="container">
								<button type="button" class="layui-btn" id="select-video-btn">选择视频</button>
								<button type="button" class="layui-btn" id="upload-video-btn">开始上传</button>
								<span>视频上传到云存储，请先配置相关账号。支持视频格式：mp4,flv,m3u8 最大可上传500M</span>
							</div>
							<div id="ossfile"></div>
							<div id="console"></div>
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">全景看房<a href="javascript:;" data-title="在720yun.com或其它全景平台创建全景相册，复制链接地址到输入框。" class="layui-icon layui-icon-tips alert"></a></label>
					<div class="layui-input-inline" style="width:600px;">
						<input name="pano_url" id="pano_url" placeholder="在720yun.com创建全景相册,复制链接地址到输入框" class="layui-input" />
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">楼盘介绍</label>
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
							<input type="text" class="layui-input" name="attr[building_type]" placeholder="板楼"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">产权年限 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[property_right]" placeholder="70年"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">占地面积 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[area_covered]" placeholder="789009平米"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">建筑面积 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[area_build]" placeholder="750098平米"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">容积率 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[volume_ratio]" placeholder="3.3"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">绿化率 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[greening_rate]" placeholder="40%"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">规划户数 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[plan_number]" placeholder="800户"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">车位情况 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[parking_space]" placeholder="750个"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">物业类型 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[property_type]" placeholder="住宅"  autocomplete="off" value="" >
						</div>
					</div>
					<div class="layui-inline">
						<label class="layui-form-label">物业公司 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[property_company]" placeholder="海航物业管理有限公司"  autocomplete="off" value="" >
						</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-inline">
						<label class="layui-form-label">物业费 </label>
						<div class="layui-input-inline">
							<input type="text" class="layui-input" name="attr[property_fee]" placeholder="1.5元/平米/月"  autocomplete="off" value="" >
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
							<input type="text" class="layui-input" name="seo[seo_title]" placeholder="seo标题"  autocomplete="off" value="" >
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">seo关键词 </label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" name="seo[seo_keys]" placeholder="seo关键词"  autocomplete="off" value="" >
						</div>
					</div>

				</div>
				<div class="layui-form-item">
					<div class="layui-block">
						<label class="layui-form-label">seo描述 </label>
						<div class="layui-input-block">
							<textarea name="seo[seo_desc]" class="layui-textarea" id="seo_desc"></textarea>
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
<input type="hidden" id="uploadUrl" value="<?php echo url('House/ajaxUploadImg'); ?>" />
<input type="hidden" id="deleteUrl" value="<?php echo url('House/deleteImg'); ?>" />
<input type="hidden" id="deleteVideo" value="<?php echo url('House/deleteVideo'); ?>" />
<?php echo hook('ueditor',['id'=>'info']); if(isset($storage['open']) && $storage['open'] == 1 && $storage['upload_type'] != 1): if($storage['type'] == "aliyun"): ?>
<script type="text/javascript" src="/static/storage/alioss/js/plupload.full.min.js"></script>
<script src="/static/storage/alioss/upload.js"></script>
<?php else: ?>
<script src="/static/storage/qiniuoss/plupload.full.min.js"></script>
<script src="/static/storage/qiniuoss/qiniu.min.js"></script>
<script src="/static/storage/qiniuoss/upload.js"></script>
<?php endif; else: ?>
<script>
	document.getElementById('select-video-btn').onclick = function(){
		alert('请先配置云存储账号再上传');
	}
</script>
<?php endif; ?>
<script src="/static/manage/js/option.js"></script>
<script>
	//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
	layui.use(['form','element','laydate'], function(){
		var $ = layui.jquery,element = layui.element,layer = layui.layer,form = layui.form,laydate = layui.laydate;
		laydate.render({
			elem: '#opening_time' //指定元素
		});
		laydate.render({
			elem: '#complate_time' //指定元素
		});
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
				if(value && !/\d+$/.test(value)){
					return '价格只能为数字';
				}
			},
			address : function(value){
				if(value.length < 5){
					return '请写正确的地址';
				}
			},
			red_packet : function(value){
				if(value && !/\d+$/.test(value)){
					return '红包金额只能为数字';
				}
			}
		});
		$("#developer_name").on('focus',function(){
			layer.open({
				type : 2,
				title : '选择开发商',
				area : ['500px','500px'],
				shade : 0.2,
				content : "<?php echo url('Developer/ajaxGetDeveloper'); ?>",
				iframeAuto:true
			});
		});
		form.on("checkbox(discount)",function(data){
			var checked = data.elem.checked;
			if(checked)
			{
				$("#discount").removeClass('layui-hide');
			}else{
				$("#discount").addClass('layui-hide').find('textarea').val('');
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

