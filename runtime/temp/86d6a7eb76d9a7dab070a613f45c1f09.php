<?php /*a:2:{s:79:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/user_cate/edit.html";i:1539570350;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
    .layui-form-label{width:85px;font-size:12px;}
    .layui-input-block{margin-left:120px;}
</style>
<form class="layui-form" id="info_form" action="<?php echo url('editDo'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:#ff0000;">*</span>分类名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="name" id="name" lay-verify="name" value="<?php echo htmlentities($info['name']); ?>" placeholder="普通会员" />
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">每天免费发布</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['data']['free_day_send']); ?>" name="data[free_day_send]" placeholder="0" />
            </div>
            <div class="layui-input-inline">
                条/天 0为不限制。
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">共免费发布</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['data']['free_all_send']); ?>" name="data[free_all_send]" placeholder="0" />
            </div>
            <div class="layui-input-inline">
                条 0为不限制。
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">年费</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['fee']); ?>" name="fee" placeholder="0" />
            </div>
            <div class="layui-input-inline">
                元/年 0为不收取年费。
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">超出收费</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['data']['price']); ?>" name="data[price]" placeholder="0" />
            </div>
            <div class="layui-input-inline">
                元/条 0为不收费，年费用户可设置为0，设置为-1表示超出限制后不可发布。
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">置顶</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['fee_top']); ?>" id="price" lay-verify="price" name="fee_top" placeholder="1" />
            </div>
            <div class="layui-input-inline">
                元/条/天，置顶按天收费。
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">二手房审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_second]" value="0" title="是" <?php if($info['data']['check_second'] == 0): ?>checked="checked"<?php endif; ?>>
                <input type="radio" name="data[check_second]" value="1" title="否" <?php if($info['data']['check_second'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">出租房审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_rental]" value="0" title="是" <?php if($info['data']['check_rental'] == 0): ?>checked="checked"<?php endif; ?>/>
                <input type="radio" name="data[check_rental]" value="1" title="否" <?php if($info['data']['check_rental'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">写字楼出售审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_office]" value="0" title="是" <?php if($info['data']['check_office'] == 0): ?>checked="checked"<?php endif; ?>/>
                <input type="radio" name="data[check_office]" value="1" title="否" <?php if($info['data']['check_office'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">写字楼出租审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_office_rental]" value="0" title="是" <?php if($info['data']['check_office_rental'] == 0): ?>checked="checked"<?php endif; ?>/>
                <input type="radio" name="data[check_office_rental]" value="1" title="否" <?php if($info['data']['check_office_rental'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">商铺出售审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_shops]" value="0" title="是" <?php if($info['data']['check_shops'] == 0): ?>checked="checked"<?php endif; ?>/>
                <input type="radio" name="data[check_shops]" value="1" title="否" <?php if($info['data']['check_shops'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">商铺出租审核</label>
            <div class="layui-input-block">
                <input type="radio" name="data[check_shops_rental]" value="0" title="是" <?php if($info['data']['check_shops_rental'] == 0): ?>checked="checked"<?php endif; ?>/>
                <input type="radio" name="data[check_shops_rental]" value="1" title="否" <?php if($info['data']['check_shops_rental'] == 1): ?>checked="checked"<?php endif; ?> />
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>" />
        <label class="layui-form-label">&nbsp;</label>
        <button type="button" lay-submit class="layui-btn btn-submit w200">提 交</button>
    </div>
</form>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/jquery.ajax.form.js"></script>
<script>
    layui.use(['form','layer'],function(){
        var form = layui.form,$ = layui.jquery,layer = layui.layer,flag = true;
        $(".btn-submit").on('click',function(){console.log(flag);
            var name = $("#name"),price = $("#price");
            if($.trim(name.val()).length == 0){
                name.focus();
                layer.msg('请填写分类名称',{icon:2});
            }else if(isNaN(price.val()) || price.val() <= 0){
                price.focus();
                layer.msg('置顶费用必须大于0，支持1位小数',{icon:2});
            }else{
                $("#info_form").ajaxForm({success:complate,dataType:'json'}).submit();
            }
        });
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

