<?php /*a:2:{s:78:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/developer/edit.html";i:1562395258;s:77:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/public/layout.html";i:1540436276;}*/ ?>
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

<form class="layui-form" id="info_form" action="<?php echo url('Developer/editDo'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>客户名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" lay-verify="title" placeholder="开发商名称" value="<?php echo htmlentities($info['title']); ?>" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">缩略图</label>
                    <div class="layui-input-block">
                        <div class="layui-upload">
                            <input type="hidden" name="img" value="<?php echo htmlentities($info['img']); ?>" id="img_txt">
                            <button type="button" class="layui-btn" id="img">上传图片</button>
                            <div id="img_preview">
                                <?php if(!(empty($info['img']) || (($info['img'] instanceof \think\Collection || $info['img'] instanceof \think\Paginator ) && $info['img']->isEmpty()))): ?>
                                <img class='layui-upload-img' src="<?php echo htmlentities($info['img']); ?>" alt="" width="100" />
                                <a href='javascript:;' data-text='img_txt' data-src='<?php echo htmlentities($info['img']); ?>' class='deleteImg layui-btn layui-btn-xs layui-btn-danger'>删除</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">介绍</label>
                    <div class="layui-input-block">
                        <script id="info" name="info" type="text/plain"><?php echo $info['info']; ?></script>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">&nbsp;</label>
        <input type="hidden" name="id" id="id" value="<?php echo htmlentities($info['id']); ?>">
        <button type="submit" lay-submit="" class="layui-btn btn-submit w200">提交</button>
    </div>
</form>
<?php echo hook('ueditor',['id'=>'info']); ?>
<script>
    var uploadUrl = "<?php echo url('Developer/ajaxUploadImg'); ?>",deleteImgUrl = "<?php echo url('Developer/deleteImg'); ?>";
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['form','upload'], function(){
        var $ = layui.jquery,form = layui.form,upload = layui.upload;
        //自定义验证规则
        form.verify({
            title : function (value) {
                if(value.length < 2){
                    return '请填写开发商名称,最少2个字符'
                }
            }
        });
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
            var that = $(this),img = $(this).data('src'),textId = $(this).data('text'),id = $("#id").val();
            layer.confirm('确定要删除图片么?', {icon: 3, title:'提示'}, function(index){
                var param = {
                    'path' : img,
                    'id'   : id,
                    'field': 'img'
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
<script src="/static/home/user/js/dialog.js"></script>
</body>
</html>

