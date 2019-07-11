<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/member/edit.html";i:1540638846;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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
<form class="layui-form" id="info_form" action="<?php echo url('editDo'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label">所属模型</label>
                    <div class="layui-input-block">
                        <?php $_result=getUserCate();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <input type="radio" lay-filter="model" name="model" value="<?php echo htmlentities($vo['id']); ?>" class="layui-input" title="<?php echo htmlentities($vo['name']); ?>" <?php if($vo['id'] == $info->getData('model')): ?>checked="checked"<?php endif; ?>>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>用户名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="user_name" placeholder="用户名" value="<?php echo htmlentities($info['user_name']); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="nick_name" lay-verify="nick_name" value="<?php echo htmlentities($info['nick_name']); ?>" placeholder="昵称" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号码</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="mobile" value="<?php echo htmlentities($info['mobile']); ?>" placeholder="手机号码">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">登录密码</label>
                    <div class="layui-input-inline">
                        <input type="password" class="layui-input" name="password" placeholder="登录密码">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="email" value="<?php echo htmlentities($info['email']); ?>" placeholder="邮箱">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">余额</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" value="<?php echo htmlentities($info['money']); ?>" name="money" placeholder="余额">
                    </div>
                    <div class="layui-input-inline">
                        元
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">用户头像</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <button type="button" class="layui-btn" id="img">选择图片</button>
                            <div id="img_preview">
                                <img class='layui-upload-img' src="<?php echo getAvatar($info['id'],90); ?>?t=<?php echo time(); ?>" alt="" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
                <div id="broker" <?php if($info->getData("model") == 1): ?>style="display:none;"<?php endif; ?>>
                    <div class="layui-form-item">
                        <label class="layui-form-label">服务区域</label>
                        <div class="layui-input-inline">
                            <?php $area_arr = array_filter(explode(',',$info['userInfo']['service_area'])); ?>
                            <span id="service_box">
                                <?php if(is_array($area_arr) || $area_arr instanceof \think\Collection || $area_arr instanceof \think\Paginator): $i = 0; $__LIST__ = $area_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <em><?php echo getCityName($vo,'-'); ?> <i class="layui-icon" data-id="<?php echo htmlentities($vo); ?>">&#x1006;</i></em>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </span>
                            <button type="button" class="layui-btn layui-btn-sm" id="service_area_name" data-uri="<?php echo url('City/ajaxSelect'); ?>">选择区域</button>
                            <input type="hidden" class="layui-input" name="service_area" value="<?php echo htmlentities($info['userInfo']['service_area']); ?>," id="service_area" placeholder="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">到期时间</label>
                        <div class="layui-input-inline">
                            <input type="text" class="layui-input" id="timeout" name="timeout" value="<?php if($info['timeout'] > 0): ?><?php echo htmlentities(date('Y-m-d',!is_numeric($info['timeout'])? strtotime($info['timeout']) : $info['timeout'])); ?><?php endif; ?>" placeholder="会员到期时间">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">历史成交</label>
                        <div class="layui-input-inline">
                            <input type="text" class="layui-input" name="history_complate" value="<?php echo htmlentities($info['userInfo']['history_complate']); ?>" placeholder="历史成交">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">最近30天带看</label>
                        <div class="layui-input-inline">
                            <input type="text" class="layui-input" name="looked" value="<?php echo htmlentities($info['userInfo']['looked']); ?>" placeholder="最近30天带看">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">标签<a href="javascript:;" data-field="tags" data-type="checkbox" data-alert="经纪人标签" data-id="13" data-title="点击我可以管理经纪人标签" class="layui-icon layui-icon-set attr-manage"></a></label>
                        <div class="layui-input-block">
                            <?php echo getLinkMenu(13,'tags','checkbox',$info['userInfo']['tags']); ?>
                        </div>
                    </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">所属公司</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input" name="company" value="<?php echo htmlentities($info['userInfo']['company']); ?>" placeholder="例：XX房产经纪有限公司">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">介绍</label>
                    <div class="layui-input-inline">
                        <textarea name="description" id="description" class="layui-textarea" placeholder="介绍"><?php echo htmlentities($info['userInfo']['description']); ?></textarea>
                    </div>
                </div>
                </div>

            </div>
    </div>
    <div class="layui-form-item">
        <input type="hidden" name="refer" value="<?php echo htmlentities($refer); ?>">
        <input type="hidden" name="id" value="<?php echo htmlentities($info['id']); ?>">
        <label class="layui-form-label">&nbsp;</label>
        <button type="submit" lay-submit="" class="layui-btn btn-submit w200">提交</button>
    </div>
</form>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/formvalidator.js"></script>
<script>
    layui.use(['form','jquery','upload','laydate'],function(){
        var form = layui.form,$ = layui.jquery,upload = layui.upload,laydate = layui.laydate;
        laydate.render({
            elem: '#timeout'
            ,type: 'date'
        });
        form.on("radio(model)",function(){
            var value = $(this).val();
            if(value == 1)
            {
                $('#broker').hide();
            }else{
                $("#broker").show();
            }
        });
        upload.render({
            elem: '#img'
            ,url: ''
            ,field : 'avatar'
            ,auto: false
            ,choose: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    var img = "<img class='layui-upload-img' src='"+result+"' width='100'/>";
                    $('#img_preview').html(img); //图片链接（base64）
                });
            }
        });
        $("#service_box").on('click','i',function(){
            var id = $(this).attr('data-id');
            $(this).parent().remove();
            var oldval = $("#service_area").val();
            $("#service_area").val(oldval.replace(id+',',''));
        });
        $("#service_area_name").on('click',function(){
            layer.open({
                type : 2,
                title : '选择区域',
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

