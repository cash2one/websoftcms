<?php /*a:2:{s:81:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/setting/sms_edit.html";i:1543312342;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<!--网站设置-->
<form class="layui-form" id="info_form" action="<?php echo url('Setting/editDo'); ?>" method="post">
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">短信设置</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label">短信平台</label>
					<div class="layui-input-inline">
						<input type="radio" name="data[sms_type]" lay-filter="sms_type" value="1" title="阿里云" <?php if(!isset($info['sms_type']) or $info['sms_type'] == 1): ?>checked="checked"<?php endif; ?>>
						<input type="radio" name="data[sms_type]" lay-filter="sms_type" value="2" title="云信" <?php if(isset($info['sms_type']) && $info['sms_type'] == 2): ?>checked="checked"<?php endif; ?>>
					</div>
					<div class="layui-input-block" style="color:#ff0000;">
						tips:阿里云短信只能发送验证码，云信可以发送验证码 也可以发送预约提醒短信到指定手机号。
					</div>
				</div>
				<div id="lists">
					<?php if(!isset($info['sms_type']) or $info['sms_type'] == 1): ?>
					<div class="layui-form-item">
						<label class="layui-form-label">Access Key ID</label>
						<div class="layui-input-inline">
							<input type="text" name="data[access_key_id]" placeholder="阿里短信access_key_id" value="<?php echo htmlentities((isset($info['access_key_id']) && ($info['access_key_id'] !== '')?$info['access_key_id']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">Access Key Secret</label>
						<div class="layui-input-inline">
							<input type="text" name="data[access_key_secret]" placeholder="阿里短信access_key_secret" value="<?php echo htmlentities((isset($info['access_key_secret']) && ($info['access_key_secret'] !== '')?$info['access_key_secret']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">短信签名</label>
						<div class="layui-input-inline">
							<input type="text" name="data[sign]" placeholder="短信签名" value="<?php echo htmlentities((isset($info['sign']) && ($info['sign'] !== '')?$info['sign']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">验证码短信模板ID</label>
						<div class="layui-input-inline">
							<input type="text" name="data[verify]" placeholder="模板ID" value="<?php echo htmlentities((isset($info['verify']) && ($info['verify'] !== '')?$info['verify']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<?php else: ?>
					<div class="layui-form-item">
						<label class="layui-form-label">用户名</label>
						<div class="layui-input-inline">
							<input type="text" name="data[user_name]" placeholder="云信账号登录名" value="<?php echo htmlentities((isset($info['user_name']) && ($info['user_name'] !== '')?$info['user_name']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">接口密码</label>
						<div class="layui-input-inline">
							<input type="text" name="data[password]" placeholder="云信接口密码" value="<?php echo htmlentities((isset($info['password']) && ($info['password'] !== '')?$info['password']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">验证码模板ID</label>
						<div class="layui-input-inline">
							<input type="text" name="data[verify]" placeholder="验证码模板ID" value="<?php echo htmlentities((isset($info['verify']) && ($info['verify'] !== '')?$info['verify']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-input-inline">
							验证码模板变量为 {&#x24;code}
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">预约通知模板ID</label>
						<div class="layui-input-inline">
							<input type="text" name="data[notice]" placeholder="预约通知模板ID" value="<?php echo htmlentities((isset($info['notice']) && ($info['notice'] !== '')?$info['notice']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">模板内容</label>
						<div class="layui-input-inline">
							<textarea class="layui-textarea" style="height:50px;" readonly="readonly">用户[{&#x24;user}] 提交 {&#x24;type} 楼盘: {&#x24;name},请尽快联系他(她)</textarea>
						</div>
						<div class="layui-input-inline">
							在云信短信平台添加短信模板复制左边内容提交审核。
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">接收通知手机号</label>
						<div class="layui-input-inline">
							<input type="text" name="data[notice_mobile]" placeholder="接收通知手机号" value="<?php echo htmlentities((isset($info['notice_mobile']) && ($info['notice_mobile'] !== '')?$info['notice_mobile']:'')); ?>" autocomplete="off" class="layui-input">
						</div>
						<div class="layui-input-inline">
							默认发送到房源联系人手机号，若未设置房源联系人则发送到 此处设置的手机号。
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">&nbsp;</label>
					<div class="layui-input-block">
						还没有账号？<a href="http://www.aliyun.com" target="_blank">点击此处申请阿里云短信</a> |
						<a href="http://sms.cn/" target="_blank">点击此处申请云信短信</a>
					</div>
				</div>
			</div>
			<input type="hidden" name="id" value="<?php echo htmlentities($base['id']); ?>">
			<input type="hidden" name="name" value="<?php echo htmlentities($action_name); ?>">
			<div class="layui-form-item">
				<label class="layui-form-label">&nbsp;</label>
				<button type="submit" class="layui-btn btn-submit">提交</button>
			</div>
		</div>
	</div>
</form>
<script type="text/html" id="template_ali">
	<div class="layui-form-item">
		<label class="layui-form-label">Access Key ID</label>
		<div class="layui-input-inline">
			<input type="text" name="data[access_key_id]" placeholder="阿里短信access_key_id" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">Access Key Secret</label>
		<div class="layui-input-inline">
			<input type="text" name="data[access_key_secret]" placeholder="阿里短信access_key_secret" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">短信签名</label>
		<div class="layui-input-inline">
			<input type="text" name="data[sign]" placeholder="短信签名" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">验证码短信模板ID</label>
		<div class="layui-input-inline">
			<input type="text" name="data[verify]" placeholder="模板ID" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
</script>
<script type="text/html" id="template_sms">
	<div class="layui-form-item">
		<label class="layui-form-label">用户名</label>
		<div class="layui-input-inline">
			<input type="text" name="data[user_name]" placeholder="云信账号登录名" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">接口密码</label>
		<div class="layui-input-inline">
			<input type="text" name="data[password]" placeholder="云信接口密码" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">验证码模板ID</label>
		<div class="layui-input-inline">
			<input type="text" name="data[verify]" placeholder="验证码模板ID" value="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-input-inline">
			验证码模板变量为 {&#x24;code}
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">预约通知模板ID</label>
		<div class="layui-input-inline">
			<input type="text" name="data[notice]" placeholder="预约通知模板ID" value="" autocomplete="off" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">模板内容</label>
		<div class="layui-input-inline">
			<textarea class="layui-textarea" style="height:50px;" readonly="readonly">用户[{&#x24;user}] 提交 {&#x24;type} 楼盘: {&#x24;name},请尽快联系他(她)</textarea>
		</div>
		<div class="layui-input-inline">
			在云信短信平台添加短信模板复制左边内容提交审核。
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">接收通知手机号</label>
		<div class="layui-input-inline">
			<input type="text" name="data[notice_mobile]" placeholder="接收通知手机号" value="" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-input-inline">
			默认发送到房源联系人手机号，若未设置房源联系人则发送到 此处设置的手机号。
		</div>
	</div>
</script>
<script>
	layui.use(['form','laytpl'],function() {
		var form = layui.form, $ = layui.jquery, laytpl = layui.laytpl;
		form.on("radio(sms_type)",function(o){
			var lists = $("#lists"),len = $.trim(lists.html()).length;
			if(o.value == 1){
				var getTpl = template_ali.innerHTML
						,view = document.getElementById('lists');
				laytpl(getTpl).render([], function(html){
					view.innerHTML = html;
					form.render();
				});
			}else{
				var getTpl = template_sms.innerHTML
						,view = document.getElementById('lists');
				laytpl(getTpl).render([], function(html){
					view.innerHTML = html;
					form.render();
				});
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

