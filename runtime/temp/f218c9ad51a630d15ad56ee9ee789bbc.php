<?php /*a:2:{s:85:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/setting/storage_edit.html";i:1542946522;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
<!--网站设置-->
<form class="layui-form" id="info_form" action="<?php echo url('Setting/editDo'); ?>" method="post">
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">云存储设置</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label">云存储</label>
					<div class="layui-input-inline" style="width:160px;">
						<input type="radio" name="data[open]" lay-filter="open" value="1" title="开启" <?php if(isset($info['open'])): if($info['open'] == 1): ?>checked<?php endif; ?><?php endif; ?>>
						<input type="radio" name="data[open]" lay-filter="open" value="0" title="关闭" <?php if(isset($info['open'])): if($info['open'] == 0): ?>checked<?php endif; ?><?php endif; ?>>
					</div>
					<div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">开启云存储需配置相关账号</div>
				</div>
				<div id="storage">
					<?php if(isset($info['open']) && $info['open'] == 1): ?>
					<div class="layui-form-item">
						<label class="layui-form-label">
							上传类型
						</label>
						<div class="layui-input-block">
							<input type="radio" name="data[upload_type]" value="1" title="仅图片" <?php if(isset($info['upload_type'])): if($info['upload_type'] == '1'): ?>checked<?php endif; ?><?php endif; ?>/>
							<input type="radio" name="data[upload_type]" value="2" title="仅视频" <?php if(isset($info['upload_type'])): if($info['upload_type'] == '2'): ?>checked<?php endif; ?><?php endif; ?>/>
							<input type="radio" name="data[upload_type]" value="3" title="视频+图片" <?php if(isset($info['upload_type'])): if($info['upload_type'] == '3'): ?>checked<?php endif; ?><?php endif; ?>/>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">
							类型
						</label>
						<div class="layui-input-inline">
							<input type="radio" name="data[type]" lay-filter="type" value="aliyun" title="阿里云oss" <?php if(isset($info['type'])): if($info['type'] == 'aliyun'): ?>checked<?php endif; ?><?php endif; ?>/>
							<input type="radio" name="data[type]" lay-filter="type" value="qiniu" title="七牛云" <?php if(isset($info['type'])): if($info['type'] == 'qiniu'): ?>checked<?php endif; ?><?php endif; ?> />
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">accessKey</label>
						<div class="layui-input-inline">
							<input type="text" name="data[access_key]" lay-verify="required" placeholder="云存储accessKey" value="<?php echo htmlentities($info['access_key']); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">secretKey</label>
						<div class="layui-input-inline">
							<input type="text" name="data[secret_key]" lay-verify="required" placeholder="云存储secretKey" value="<?php echo htmlentities($info['secret_key']); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">存储空间名</label>
						<div class="layui-input-inline">
							<input type="text" name="data[bucket]" lay-verify="required" placeholder="存储空间名" value="<?php echo htmlentities($info['bucket']); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">资源访问域名</label>
						<div class="layui-input-inline">
							<input type="text" name="data[domain]" lay-verify="required|url" placeholder="例：http://tpfangchan.com" value="<?php echo htmlentities($info['domain']); ?>" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux layui-fl">
							请带上http://
						</div>
					</div>
					<div class="layui-form-item" id="aliyun" <?php if($info['type'] != 'aliyun'): ?>style="display:none;"<?php endif; ?>>
						<label class="layui-form-label">EndPoint(地域节点)</label>
						<div class="layui-input-inline">
							<input type="text" name="data[end_point]" placeholder="例：http://oss-cn-shenzhen.aliyuncs.com" value="<?php echo htmlentities((isset($info['end_point']) && ($info['end_point'] !== '')?$info['end_point']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-form-mid layui-word-aux layui-fl">
							阿里云存储必需填写，请带上http://
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label"></label>
						<div class="layui-input-block">
							还没有账号？<a href="https://www.aliyun.com/" target="_blank">点此申请阿里云账号</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://portal.qiniu.com/signup/choice" target="_blank">点此申请七牛云账号</a>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<input type="hidden" name="id" value="<?php echo htmlentities($base['id']); ?>">
			<input type="hidden" name="name" value="<?php echo htmlentities($action_name); ?>">
			<div class="layui-form-item">
				<label class="layui-form-label">&nbsp;</label>
				<button type="submit" lay-submit="" class="layui-btn btn-submit">提交</button>
			</div>
		</div>
	</div>
</form>
<script type="text/html" id="template">
	<div class="layui-form-item">
		<label class="layui-form-label">
			上传类型
		</label>
		<div class="layui-input-block">
			<input type="radio" name="data[upload_type]" value="1" checked="checked" title="仅图片"/>
			<input type="radio" name="data[upload_type]" value="2" title="仅视频" />
			<input type="radio" name="data[upload_type]" value="3" title="视频+图片" />
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">
			类型
		</label>
		<div class="layui-input-inline">
			<input type="radio" name="data[type]" lay-filter="type" value="aliyun" title="阿里云oss" checked="checked"/>
			<input type="radio" name="data[type]" lay-filter="type" value="qiniu" title="七牛云" />
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">accessKey</label>
		<div class="layui-input-inline">
			<input type="text" name="data[access_key]" lay-verify="required" placeholder="云存储accessKey" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">secretKey</label>
		<div class="layui-input-inline">
			<input type="text" name="data[secret_key]" lay-verify="required" placeholder="云存储secretKey" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">存储空间名</label>
		<div class="layui-input-inline">
			<input type="text" name="data[bucket]" lay-verify="required" placeholder="存储空间名" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">资源访问域名</label>
		<div class="layui-input-inline">
			<input type="text" name="data[domain]" lay-verify="required|url" placeholder="例：http://tpfangchan.com" value="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux layui-fl">
			请带上http://
		</div>
	</div>
	<div class="layui-form-item" id="aliyun">
		<label class="layui-form-label">EndPoint(地域节点)</label>
		<div class="layui-input-inline">
			<input type="text" name="data[end_point]" placeholder="例：http://oss-cn-shenzhen.aliyuncs.com" value="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux layui-fl">
			阿里云存储必需填写，请带上http://
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"></label>
		<div class="layui-input-block">
			还没有账号？<a href="https://www.aliyun.com/" target="_blank">点此申请阿里云账号</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://portal.qiniu.com/signup/choice" target="_blank">点此申请七牛云账号</a>
		</div>
	</div>
</script>
<script>
	layui.use(['form','laytpl'],function(){
		var form = layui.form,$ = layui.jquery,laytpl = layui.laytpl;
		form.on("radio(type)",function(o){
			if(o.value == 'aliyun'){
				$("#storage #aliyun").show();
			}else{
				$("#storage #aliyun").hide();
			}
		});
		form.on("radio(open)",function(o){
			var storage = $("#storage"),len = $.trim(storage.html()).length;
			if(o.value == 1){
				if(len > 0) {
					storage.show();
				}else{
					var getTpl = template.innerHTML
							,view = document.getElementById('storage');
					laytpl(getTpl).render([], function(html){
						view.innerHTML = html;
						form.render();
					});
				}
			}else{
				storage.html('');
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

