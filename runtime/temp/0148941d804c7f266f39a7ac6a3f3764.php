<?php /*a:2:{s:82:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/setting/site_edit.html";i:1548311904;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<link rel="stylesheet" href="/static/css/jquery.bigcolorpicker.css">
<style>
    .table_form td span{color:#fff;}
    .layui-form-item .layui-input-inline{width:300px;}
</style>
<!--网站设置-->
<form class="layui-form" id="info_form" action="<?php echo url('Setting/editDo'); ?>" method="post">
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
    <ul class="layui-tab-title">
        <li class="layui-this">基本设置</li>
        <li>高级设置</li>
    </ul>
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <div class="layui-form-item">
                <label class="layui-form-label">网站状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="data[status]" lay-filter="reson" value="1" title="开启" <?php if($info['status'] == 1): ?>checked<?php endif; ?>>
                    <input type="radio" name="data[status]" lay-filter="reson" value="0" title="关闭" <?php if($info['status'] == 0): ?>checked<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item layui-hide" id="tr-reson">
                <label class="layui-form-label">关闭原因</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[reson]" placeholder="请输入关闭原因" autocomplete="off" value="<?php echo htmlentities($info['reson']); ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">站点名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[title]" placeholder="请输入站点名称" value="<?php echo htmlentities($info['title']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">电脑版Logo(200*50)</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[pc_logo]" id="pclogo" placeholder="" value="<?php echo htmlentities($info['pc_logo']); ?>" autocomplete="off" class="layui-input ajax-img-text">
                    <div class="layui-box layui-upload-button" id="upload">
                        <span class="layui-upload-icon"><i class="layui-icon">&#xe61f;</i>图片</span>
                    </div>
                    <div id="pclogo-preview">
                        <?php if(!(empty($info['pc_logo']) || (($info['pc_logo'] instanceof \think\Collection || $info['pc_logo'] instanceof \think\Paginator ) && $info['pc_logo']->isEmpty()))): ?>
                        <img src="<?php echo htmlentities($info['pc_logo']); ?>" alt="" width="100" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">电脑版白色Logo(200*50)</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[pc_logo_white]" id="pclogowhite" placeholder="" value="<?php echo htmlentities($info['pc_logo_white']); ?>" autocomplete="off" class="layui-input ajax-img-text">
                    <div class="layui-box layui-upload-button" id="uploadwhite">
                        <span class="layui-upload-icon"><i class="layui-icon">&#xe61f;</i>图片</span>
                    </div>
                    <div id="pclogowhite-preview">
                        <?php if(!(empty($info['pc_logo']) || (($info['pc_logo'] instanceof \think\Collection || $info['pc_logo'] instanceof \think\Paginator ) && $info['pc_logo']->isEmpty()))): ?>
                        <img src="<?php echo htmlentities($info['pc_logo_white']); ?>" alt="" width="100" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机版Logo(160*40)</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[mobile_logo]" id="mobileLogo" placeholder="" value="<?php echo htmlentities($info['mobile_logo']); ?>" autocomplete="off" class="layui-input ajax-img-text">
                    <div class="layui-box layui-upload-button" id="uploadMobile">
                        <span class="layui-upload-icon"><i class="layui-icon">&#xe61f;</i>图片</span>
                    </div>
                    <div id="mobileLogo-preview">
                        <?php if(!(empty($info['mobile_logo']) || (($info['mobile_logo'] instanceof \think\Collection || $info['mobile_logo'] instanceof \think\Paginator ) && $info['mobile_logo']->isEmpty()))): ?>
                        <img src="<?php echo htmlentities($info['mobile_logo']); ?>" alt="" width="100" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">微信二维码(200*200)</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[weixin_qrcode]" id="weixinPic" placeholder="" value="<?php echo htmlentities($info['weixin_qrcode']); ?>" autocomplete="off" class="layui-input ajax-img-text">
                    <div class="layui-box layui-upload-button" id="uploadWeixin">
                        <span class="layui-upload-icon"><i class="layui-icon">&#xe61f;</i>图片</span>
                    </div>
                    <div id="weixinPic-preview">
                        <?php if(!(empty($info['weixin_qrcode']) || (($info['weixin_qrcode'] instanceof \think\Collection || $info['weixin_qrcode'] instanceof \think\Paginator ) && $info['weixin_qrcode']->isEmpty()))): ?>
                        <img src="<?php echo htmlentities($info['weixin_qrcode']); ?>" alt="" width="100" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">备案号</label>
                <div class="layui-input-block">
                    <input type="text" name="data[icp]" placeholder="备案号" value="<?php echo htmlentities($info['icp']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客服电话</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[telphone]" placeholder="客服电话" value="<?php echo htmlentities($info['telphone']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">客服QQ</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[qq]" placeholder="客服QQ" value="<?php echo htmlentities($info['qq']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">在线咨询</label>
                <div class="layui-input-block">
                    <textarea name="data[online_consulting]" id="online_consulting" class="layui-input"><?php echo htmlentities($info['online_consulting']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">房源距地铁站</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="data[metro_distance]" value="<?php echo htmlentities((isset($info['metro_distance']) && ($info['metro_distance'] !== '')?$info['metro_distance']:'')); ?>" placeholder="例：500" />
                </div>
                <div class="layui-input-inline" style="width:400px;">
                    米，根据经纬度自动计算并关联指定范围内的站点。
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">房源距学校</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="data[school_distance]" value="<?php echo htmlentities((isset($info['school_distance']) && ($info['school_distance'] !== '')?$info['school_distance']:'')); ?>" placeholder="例：500" />
                </div>
                <div class="layui-input-inline" style="width:400px;">
                    米，根据经纬度自动计算并关联指定范围内的学校。
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站主色调</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" id="main-color-input" name="data[main_color]" placeholder="#d32f2f" value="<?php echo htmlentities((isset($info['main_color']) && ($info['main_color'] !== '')?$info['main_color']:'#d32f2f')); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:120px;">
                    <button type="button" id="main-color-btn" class="layui-btn">选色</button>
                </div>
                <div class="layui-input-inline">
                    <div id="main-color" style="width:50px;height:40px;background-color: <?php echo htmlentities((isset($info['main_color']) && ($info['main_color'] !== '')?$info['main_color']:'#d32f2f')); ?>;"></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">主色背景文字颜色</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" id="text-color-input" name="data[text_color]" placeholder="#fff" value="<?php echo htmlentities((isset($info['text_color']) && ($info['text_color'] !== '')?$info['text_color']:'#ffffff')); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:120px;">
                    <button type="button" id="text-color-btn" class="layui-btn">选色</button>
                </div>
                <div class="layui-input-inline">
                    <div id="text-color" style="width:50px;height:40px;line-height:40px;text-align:center;background-color: <?php echo htmlentities((isset($info['main_color']) && ($info['main_color'] !== '')?$info['main_color']:'#d32f2f')); ?>;color:<?php echo htmlentities((isset($info['color']) && ($info['color'] !== '')?$info['color']:'#ffffff')); ?>">文字</div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">导航菜单选中背景颜色</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" id="selected-color-input" name="data[selected_color]" placeholder="#B71B1C" value="<?php echo htmlentities((isset($info['selected_color']) && ($info['selected_color'] !== '')?$info['selected_color']:'#B71B1C')); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width:120px;">
                    <button type="button" id="selected-color-btn" class="layui-btn">选色</button>
                </div>
                <div class="layui-input-inline">
                    <div id="selected-color" style="width:50px;height:40px;background-color: <?php echo htmlentities((isset($info['selected_color']) && ($info['selected_color'] !== '')?$info['selected_color']:'#B71B1C')); ?>;"></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">购房红包</label>
                <div class="layui-input-block">
                    <input type="radio" name="data[red_packet]" value="1" title="开启" <?php if(isset($info['red_packet'])): if($info['red_packet'] == 1): ?>checked<?php endif; ?><?php endif; ?>>
                    <input type="radio" name="data[red_packet]" value="0" title="关闭" <?php if(isset($info['red_packet'])): if($info['red_packet'] == 0): ?>checked<?php endif; ?><?php endif; ?>>
                </div>
            </div>
        </div>
        <div class="layui-tab-item">
            <div class="layui-form-item">
                <label class="layui-form-label">企业名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[company_name]" placeholder="企业名称" value="<?php echo htmlentities($info['company_name']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO 标题</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[seo_title]" placeholder="SEO 标题" value="<?php echo htmlentities($info['seo_title']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO 关键词</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[seo_keys]" placeholder="SEO 关键词" value="<?php echo htmlentities($info['seo_keys']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO 描述</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[seo_desc]" placeholder="SEO 描述" value="<?php echo htmlentities($info['seo_desc']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" name="data[email]" placeholder="邮箱" value="<?php echo htmlentities($info['email']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">公司地址</label>
                <div class="layui-input-block">
                    <input type="text" name="data[address]" placeholder="公司地址" value="<?php echo htmlentities($info['address']); ?>" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">电脑版js代码</label>
                <div class="layui-input-block">
                    <textarea placeholder="js代码可在此填写" name="data[pc_js]" class="layui-textarea"><?php echo htmlentities($info['pc_js']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">手机版js代码</label>
                <div class="layui-input-block">
                    <textarea placeholder="js代码可在此填写" name="data[mobile_js]" class="layui-textarea"><?php echo htmlentities($info['mobile_js']); ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
    <input type="hidden" name="name" value="<?php echo htmlentities($action_name); ?>">
    <input type="hidden" name="id" value="<?php echo htmlentities($base['id']); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">&nbsp;</label>
        <button type="submit" class="layui-btn btn-submit">提交</button>
    </div>
</form>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['form','element','upload','colorpicker'], function(){
        var $ = layui.jquery,element = layui.element,form = layui.form,upload = layui.upload;
        $("#main-color-btn").bigColorpicker(function(el,color){
            $("#main-color-input").val(color);
            $("#main-color").css({backgroundColor:color});
            $("#text-color").css({backgroundColor:color});
        });
        $("#text-color-btn").bigColorpicker(function(el,color){
            $("#text-color-input").val(color);
            $("#text-color").css({color:color});
        });
        $("#selected-color-btn").bigColorpicker(function(el,color){
            $("#selected-color-input").val(color);
            $("#selected-color").css({backgroundColor:color});
        });
        form.on('radio(reson)',function(){
            var value = $(this).val();
            if(value == 1){
                $("#tr-reson").addClass('layui-hide');
                $("#reson").val('');
            }else{
                $("#tr-reson").removeClass('layui-hide');
            }
        });
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#upload'
            ,url: '<?php echo url("ajaxUploadImg"); ?>'
            ,done: function(res){
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    //上传成功
                    $("#pclogo").val(res.data);
                    $img = "<img src='"+res.data+"' width='100' />";
                    $("#pclogo-preview").html($img);
                }
            }
            ,error: function(){
                layer.msg('上传失败');
            }
        });
        upload.render({
            elem: '#uploadwhite'
            ,url: '<?php echo url("ajaxUploadImg"); ?>'
            ,done: function(res){
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    //上传成功
                    $("#pclogowhite").val(res.data);
                    $img = "<img src='"+res.data+"' width='100' />";
                    $("#pclogowhite-preview").html($img);
                }
            }
            ,error: function(){
                layer.msg('上传失败');
            }
        });
        upload.render({
            elem: '#uploadMobile'
            ,url: '<?php echo url("ajaxUploadImg"); ?>'
            ,done: function(res){
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    //上传成功
                    $("#mobileLogo").val(res.data);
                    $img = "<img src='"+res.data+"' width='100' />";
                    $("#mobileLogo-preview").html($img);
                }
            }
            ,error: function(){
                layer.msg('上传失败');
            }
        });
        upload.render({
            elem: '#uploadWeixin'
            ,url: '<?php echo url("ajaxUploadImg"); ?>'
            ,done: function(res){
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    //上传成功
                    $("#weixinPic").val(res.data);
                    $img = "<img src='"+res.data+"' width='100' />";
                    $("#weixinPic-preview").html($img);
                }
            }
            ,error: function(){
                layer.msg('上传失败');
            }
        });

        $("#mark").on('click',function(){
            var url = $(this).data('uri');
            var map = $('#map').val();
            url += '?map='+map;
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

