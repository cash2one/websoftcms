<?php /*a:2:{s:82:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/agent_company/add.html";i:1541076700;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
    #service_box em{font-style:normal;}
</style>
<form class="layui-form" id="info_form" action="<?php echo url('addDo'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label">代理商类型</label>
                    <div class="layui-input-inline">
                        <select name="cate_id" id="cate_id">
                            <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>代理商名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="company_name" lay-verify="required" class="layui-input" placeholder="俱进科技">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>联系人</label>
                    <div class="layui-input-inline">
                        <input type="text" name="contact_name" lay-verify="required" id="contact_name" placeholder="联系人" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>手机号码</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" lay-verify="required|phone" id="mobile" name="mobile" placeholder="手机号码">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>代理城市</label>
                    <div class="layui-input-inline">
                            <span id="service_box">
                            </span>
                        <button type="button" class="layui-btn layui-btn-sm" id="service_area_name" data-uri="<?php echo url('City/ajaxSelect',['onlycity'=>1]); ?>">选择城市</button>
                        <input type="hidden" class="layui-input" name="city" lay-verify="required" id="service_area" placeholder="">
                    </div>
                    <div class="layui-form-mid layui-word-aux">代理城市必需选择</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">过期时间</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" id="service_time_end" name="service_time_end" placeholder="2018-12-12">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>登录密码</label>
                    <div class="layui-input-inline">
                        <input type="password" class="layui-input" lay-verify="required" name="password" placeholder="登录密码">
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
<script src="/static/js/jquery.min.js"></script>
<script>
    layui.use(['form','laydate'], function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '#service_time_end' //指定元素
        });
    });
    $(function() {
    $("#service_box").on('click','i',function(){
            var id = $(this).attr('data-id');
            $(this).parent().remove();
            var oldval = $("#service_area").val();
            $("#service_area").val(oldval.replace(id+',',''));
        });
        $("#service_area_name").on('click',function(){
            layer.open({
                type : 2,
                title : '选择城市',
                area : ['500px','500px'],
                shade : 0.2,
                content : $(this).data('uri'),
                iframeAuto:true
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

