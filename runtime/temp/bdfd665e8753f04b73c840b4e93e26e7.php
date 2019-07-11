<?php /*a:2:{s:76:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/index/panel.html";i:1562730628;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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
    .layui-table-view .layui-table td{text-align:left;}
    .layui-colla-content{line-height: 30px;font-size:14px;}
    .layui-colla-content li{border-bottom:1px dashed #ccc;}
    .layui-table, .layui-table-view{margin:10px 0 20px 0;}
</style>
<div class="layui-progress layui-progress-big layui-hide" lay-showpercent="true" lay-filter="download">
    <div class="layui-progress-bar layui-bg-red" lay-percent="0%"></div>
</div>
<div class="layui-form layui-border-box layui-table-view">
    <div class="layui-table-header">
        <table id="tree-table" style="width:100%" class="layui-table list-table" lay-filter="tree-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
            <colgroup>
                <col width="50%">
                <col width="50%">
            </colgroup>
            <tbody>
            <tr>
                <td colspan="2">
                    <div data-field="title" class="layui-table-cell">
                        商业授权：<font style="color: #ff0000">未授权</font>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div data-field="title" class="layui-table-cell">
                        系统版本：V3.0.3
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        服务器域名或ip：<?php echo htmlentities($system_info['server_domain']); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-table-cell">
                        服务器操作系统：<?php echo htmlentities($system_info['server_os']); ?>
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        WEB服务器：<?php echo htmlentities($system_info['web_server']); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-table-cell">
                        PHP版本：<?php echo htmlentities($system_info['php_version']); ?>
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        MYSQL版本：<?php echo htmlentities($system_info['mysql_version']); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-table-cell">
                        文件上传限制：<?php echo htmlentities($system_info['upload_max_filesize']); ?>
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        执行时间限制：<?php echo htmlentities($system_info['max_execution_time']); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-table-cell">
                        安全模式：<?php echo htmlentities($system_info['safe_mode']); ?>
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        Zlib支持：<?php echo htmlentities($system_info['zlib']); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="layui-table-cell">
                        售后客服：<a target="_blank" title="点击使用QQ聊天" href="http://wpa.qq.com/msgrd?v=3&amp;uin=903532898&amp;site=qq&amp;menu=yes"><img src="http://wpa.qq.com/pa?p=1:903532898:10"></a>
                    </div>
                </td>
                <td data-field="title" date-edit="true">
                    <div class="layui-table-cell">
                        联系电话：0771-5386339，13077767405
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="layui-table-cell">
                        微信客服：<img src="http://www.wangsucn.com/static/images/jpg_ewm1.jpg" width="150" alt="">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    layui.use(['layer','element'],function(){
        var layer  = layui.layer, $ = layui.jquery,element = layui.element,timer;
        $(function(){
            $('body').on('click','.download',function(){
                var uri = $(this).attr('data-rel'),flag = true;
                if(!uri)
                {
                    layer.msg('未获得商业权授或权授已过期');
                    return false;
                }
                if($(this).hasClass('layui-btn-disabled'))
                {
                    return false;
                }
                $(this).addClass('layui-btn-disabled');
                layer.msg('正在下载升级包……',{time:5000});
                $.get('/upgrade/index',{uri:uri},function(result){
                    if(result.code == 0)
                    {
                        flag = false;
                        layer.msg(result.msg);
                        clearTimeout(timer);
                    }else if(result.code == 100){
                        layer.closeAll();
                        var d = $('.download');
                        flag  = false;
                        clearTimeout(timer);
                        d.removeClass('layui-btn-disabled');
                        layer.confirm('升级包已下载，请先做好数据备份，点击确定将覆盖原文件！', function(index){
                            layer.msg('升级中……');
                            $('.layui-progress').addClass('layui-hide');
                            $.get('/upgrade/decompression',function(result){
                                layer.closeAll();
                                if(result.code == 1)
                                {
                                    layer.msg(result.msg,{icon:1},function(){
                                        parent.window.location.reload();
                                    });
                                }else{
                                    alert(result.msg);
                                }
                            });
                        },function(index){
                            $('.layui-progress').addClass('layui-hide');
                        });
                    }
                });
                if(flag){
                    $('.layui-progress').removeClass('layui-hide');
                    progress();
                }
            });
        });
        function progress()
        {
            timer = setTimeout(function(){
                $.get('/upgrade/getDownloadProgress',function(result){
                    element.progress('download', result.data+'%');
                    if(result.code == 1 && result.data < 100)
                    {
                        progress();
                    }else{
                        var d = $('.download');
                        d.removeClass('layui-btn-disabled');
                        layer.confirm('升级包下载完成，请先做好数据备份，点击确定将覆盖原文件！', function(index){
                            layer.msg('升级中……');
                            $('.layui-progress').addClass('layui-hide');
                            $.get('/upgrade/decompression',function(result){
                                layer.closeAll();
                                if(result.code == 1)
                                {
                                    layer.msg(result.msg,{icon:1},function(){
                                        window.location.reload();
                                    });
                                }else{
                                    alert(result.msg);
                                }
                            });
                        },function(index){
                            $('.layui-progress').addClass('layui-hide');
                        });
                    }
                });
            },3000);

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

