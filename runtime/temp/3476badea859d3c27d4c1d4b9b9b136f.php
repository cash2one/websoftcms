<?php /*a:2:{s:79:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/collection/add.html";i:1544609368;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1536141234;}*/ ?>
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

<form class="layui-form" id="info_form" action="<?php echo url('addDo'); ?>" method="post" enctype="multipart/form-data">
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">添加采集项目</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>文章分类</label>
                    <input type="hidden" name="cate_id" lay-verify="articleCate" id="J_cate_id" value="" />
                    <div class="layui-input-inline" style="width:120px;">
                        <select class="J_cate_select mr10" lay-filter="J_cate_select" data-pid="0" data-uri="<?php echo url('ArticleCate/ajaxGetchilds'); ?>" data-selected="">
                        </select>
                    </div>
                    <input type="hidden" name="city" id="J_city_id" value="" />
                    <div class="layui-input-inline">
                        <select name="" lay-filter="province" id="province" data-level="1" data-uri="<?php echo url('City/ajaxGetchilds'); ?>">
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
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>项目名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" lay-verify="title" placeholder="项目名称" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="layui-form-alert">*</span>网址配置</label>
                    <div class="layui-input-inline">
                        <input type="text" name="pageurl"  placeholder="采集网址" value="" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline">
                        <a href="javascript:;" class="layui-btn" id="test" data-uri="<?php echo url('ajaxGetTestLists'); ?>">测试</a>
                    </div>
                    <div class="layui-input-block">
                        (如：http://www.tpfangchan.com/news/(*).html,页码使用(*)做为通配符。
                    </div>
                    <div class="layui-input-block">
                        页码从第 <input type="text" class="layui-input" name="pagesize_start" value="1" style="width:80px;display:inline-block;" />
                        到 <input type="text" class="layui-input" name="pagesize_end" value="5" style="width:80px;display:inline-block;">
                         页 列表第一页 <input type="text" name="pageurl_first"  placeholder="列表第一页地址" value="" style="width:500px;display:inline-block;" autocomplete="off" class="layui-input">

                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">页面编码</label>
                    <div class="layui-input-block">
                        <input type="radio" name="coding" value="gbk"  title="gbk" />
                        <input type="radio" name="coding" value="utf-8" title="UTF-8" />
                        <input type="radio" name="coding" value="bg5" title="BG5" />
                    </div>
                </div>
               <div class="layui-form-item">
                   <label class="layui-form-label">列表区域</label>
                   <div class="layui-input-inline">
                       <input type="text" name="list_area" placeholder="列表区域" value="" autocomplete="off" class="layui-input">
                   </div>
               </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="url_area" placeholder="链接地址规则" value="" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:50px;">
                        补全url
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="supplement_url" placeholder="补全内容链接地址" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="img_area" placeholder="图片地址规则" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>内容规则</legend>
                </fieldset>
                <div class="layui-form-item">
                    <label class="layui-form-label">标题规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title_area" placeholder="标题规则" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">时间规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="create_time_area" placeholder="时间规则" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">内容规则</label>
                    <div class="layui-input-inline">
                        <input type="text" name="content_area" placeholder="内容规则" value="" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:100px;">需过滤的标签</div>
                    <div class="layui-input-inline">
                        <input type="text" name="filter_content" placeholder="-a -strong -p -span" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图片补全</label>
                    <div class="layui-input-inline">
                        <input type="text" name="supplement_img_url" placeholder="补全内容中的图片地址" value="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">下载内容图片</label>
                    <div class="layui-input-inline">
                        <input type="checkbox" name="download_pic" value="1" title="下载" />
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
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['form','linkmenu','layer'], function(){
        var $ = layui.jquery,form = layui.form,layer = layui.layer;
        $(".J_cate_select").select({field : 'J_cate_id',id : 'J_cate_select'});
        //自定义验证规则
        form.verify({
            articleCate: function (value) {
                if (value == 0) {
                    return '请选择选择文章分类';
                }
            },
            title : function (value) {
                if(!value){
                    return '请填写项目名称'
                }
            }
        });
        $("#test").on('click',function(){
            var url = $("input[name='pageurl']").val(),uri = $(this).data('uri'),start = $("input[name='pagesize_start']").val(),end = $("input[name='pagesize_end']").val();
            if(!url)
            {
                layer.msg('请填写网址配置');
            }else if(!start){
                layer.msg('请填写起始页码');
            }else if(!end){
                layer.msg('请填写结束页码');
            }else{
                layer.open({
                    type : 2,
                    title : '测试列表地址',
                    area : ['500px','500px'],
                    shade : 0.2,
                    content : uri+"?url="+encodeURIComponent(url)+"&start="+start+"&end="+end,
                    iframeAuto:true
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

