<?php /*a:2:{s:87:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/member/ajax_get_broker.html";i:1541130810;s:78:"/home/wwwroot/gxwebsoft/public_html/application/manage/view/public/layout.html";i:1562673466;}*/ ?>
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

<!--经纪人列表-->
<div class="layui-form" >
    <form name="layui-form" class="search-form" id="info_form" action="<?php echo url('Member/ajaxGetBroker'); ?>" method="get" >
        <div class="layui-elem-quote">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input type="hidden" id="sid" name="sid" value="<?php echo htmlentities($sid); ?>">
                        <input name="keyword" id="keyword" type="text" placeholder="经纪人昵称" class="layui-input" size="25" value="" />
                    </div>
                    <button class="layui-btn layui-btn-normal" id="searchBtn" type="submit" data-uri="">搜索</button>
                </div>

            </div>
        </div>
    </form>
</div>
<form class="layui-form" id="select_form" action="" data-uri="<?php echo url('Subscribe/ajaxDistributionBroker'); ?>">
    <div class="layui-form layui-border-box layui-table-view">
        <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('Developer/ajaxEdit'); ?>">
            <colgroup>
                <col width="70%">
                <col width="30%">
            </colgroup>
            <thead>
            <tr>
                <th>
                    <div class="layui-table-cell"><span>经纪人昵称</span></div>
                </th>
                <th>
                    <div class="layui-table-cell" align="center"><span>操作</span></div>
                </th>

            </tr>
            </thead>
            <tbody>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <tr>
                <td data-field="title">
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['nick_name']); ?>(<?php echo htmlentities($val['mobile']); ?>)
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <a href="javascript:;" data-id="<?php echo htmlentities($val['id']); ?>" class="layui-btn layui-btn-danger layui-btn-xs select">选择</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
    <div class="kaifazhe-fix-bottom layui-clear">
        <div id="pages" class="layui-layout-right">
            <?php echo $pages; ?>
        </div>
    </div>
    <?php endif; ?>
</form>
<script>
    layui.use(['layer','jquery'],function(){
        var layer = layui.layer,$ = layui.jquery,flag = true;
        $('.select').on('click',function(){
            flag = false;
            var id = $(this).data('id'),sid = $("#sid").val(),url = $("#select_form").data('uri');
            $.get(url,{broker_id : id,sid : sid},function(result){
                if(result.code == 1)
                {
                    layer.msg(result.msg,{icon:1},function(){
                        flag = true;
                        parent.window.location.reload();
                    });
                }else{
                    flag = true;
                    layer.msg(result.msg);
                }
            });
        });
        $("#searchBan").on('click',function(){
            var keyword = $.trim($("#keyword").val()),url = $(this).data('uri');

            if(keyword.length == 0){
                parent.layer.msg('请填写关键词',{icon:2});
                return false;
            }else{
                $('#info_form').submit();
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

