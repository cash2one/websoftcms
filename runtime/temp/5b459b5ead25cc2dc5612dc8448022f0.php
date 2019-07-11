<?php /*a:2:{s:81:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/setting/pay_edit.html";i:1540626258;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
			<li class="layui-this">微信支付设置</li>
			<li>支付宝设置</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<div class="layui-form-item">
					<label class="layui-form-label">公众号appid</label>
					<div class="layui-input-inline">
						<input type="text" name="data[weixin][appid]" lay-verify="required" value="<?php echo htmlentities($info['weixin']['appid']); ?>" placeholder="微信公众平台appid" autocomplete="off" class="layui-input" />
					</div>
					<div class="layui-input-inline">
						微信公众号appid
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商户mch_id</label>
					<div class="layui-input-inline">
						<input type="text" name="data[weixin][mch_id]" lay-verify="required" value="<?php echo htmlentities($info['weixin']['mch_id']); ?>" placeholder="微信商户平台mch_id"  autocomplete="off" class="layui-input">
					</div>
					<div class="layui-input-inline">
						微信商户平台mch_id
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商户密钥</label>
					<div class="layui-input-inline">
						<input type="text" name="data[weixin][mch_key]" lay-verify="required" placeholder="微信商户平台mch_key" value="<?php echo htmlentities((isset($info['weixin']['mch_key']) && ($info['weixin']['mch_key'] !== '')?$info['weixin']['mch_key']:'')); ?>" autocomplete="off" class="layui-input">
					</div>
					<div class="layui-input-inline">
						微信商户平台mch_key
					</div>
				</div>
			</div>
			<div class="layui-tab-item">
				<div class="layui-form-item">
					<label class="layui-form-label">app_id</label>
					<div class="layui-input-inline">
						<input type="text" name="data[alipay][app_id]" value="<?php echo htmlentities((isset($info['alipay']['app_id']) && ($info['alipay']['app_id'] !== '')?$info['alipay']['app_id']:'')); ?>" placeholder="支付宝app_id" autocomplete="off" class="layui-input" />
					</div>
					<div class="layui-input-inline">
						支付宝应用id
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商户私钥</label>
					<div class="layui-input-block">
						<textarea name="data[alipay][merchant_private_key]" class="layui-textarea"><?php echo htmlentities((isset($info['alipay']['merchant_private_key']) && ($info['alipay']['merchant_private_key'] !== '')?$info['alipay']['merchant_private_key']:'')); ?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">支付宝公钥</label>
					<div class="layui-input-block">
						<textarea name="data[alipay][alipay_public_key]" class="layui-textarea"><?php echo htmlentities((isset($info['alipay']['alipay_public_key']) && ($info['alipay']['alipay_public_key'] !== '')?$info['alipay']['alipay_public_key']:'')); ?></textarea>
					</div>
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
<script>
	layui.use(['form','element'], function() {
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

