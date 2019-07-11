<?php /*a:1:{s:83:"/home/wwwroot/gxwebsoft/public_html/application/home/view/ajax/ajax_get_estate.html";i:1535356448;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>选择小区</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <style>
        .layui-elem-quote{padding:5px 15px;}
        .page_list li{display:inline;}
        .page_list li span{}
        .page_list {
            text-align: center;
            margin: 10px 0;
        }
        .page_list a,.page_list li span,
        .page_list .more {
            display: inline-block;
            line-height: 100%;
            padding: 7px 8px;
            border-radius: 2px;
            font-size: 14px;
            text-align: center;
            margin-left: 6px;
            cursor: pointer;
        }
        .page_list a.on,.page_list li span,
        .page_list a:hover {background: #d32f2f;color: #ffffff;}
        .page_list a,.page_list li span {
            border: 1px solid #ebebeb;
        }
        .page_list .prev {
            margin-left: 0;
        }
        .page_list li.disabled span{border: 1px solid #ebebeb;background-color: #fff;color:#656565;}
    </style>
</head>
<body>
<!--小区列表-->
<div class="layui-form" >
    <form name="layui-form" class="search-form" id="info_form" action="<?php echo url('ajaxGetEstate'); ?>" method="get" >
        <div class="layui-elem-quote">
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input name="keyword" id="keyword" type="text" placeholder="小区名称" class="layui-input" size="25" value="" />
                    </div>
                    <button class="layui-btn layui-btn-normal" id="searchBtn" type="button" data-uri="">搜索</button>
                </div>

        </div>
    </form>
</div>
<form class="layui-form" action="">
    <div class="layui-form layui-border-box layui-table-view" style="margin:0 5px;">
        <table id="tree-table" style="width:100%;" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('estate/Estate/ajaxEdit'); ?>">
            <colgroup>
                <col width="70%">
                <col width="30%">
            </colgroup>
            <thead>
            <tr>
                <th>
                    <div class="layui-table-cell"><span>小区名称</span></div>
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
                        <?php echo htmlentities($val['title']); ?>
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <a href="javascript:;" data-id="<?php echo htmlentities($val['id']); ?>" data-city="<?php echo getCitySpidById($val['city']); ?>" data-map="<?php echo htmlentities($val['lng']); ?>,<?php echo htmlentities($val['lat']); ?>" data-address="<?php echo htmlentities($val['address']); ?>" data-title="<?php echo htmlentities($val['title']); ?>" class="layui-btn layui-btn-danger layui-btn-xs select">选择</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <?php if(!(empty($pages) || (($pages instanceof \think\Collection || $pages instanceof \think\Paginator ) && $pages->isEmpty()))): ?>
    <div class="kaifazhe-fix-bottom layui-clear">
        <div id="pages" class="page_list clearfix">
            <?php echo $pages; ?>
        </div>
    </div>
    <?php endif; ?>
</form>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script>
    layui.use(['layer','jquery'],function(){
        var layer = layui.layer,$ = layui.jquery;
        var index = parent.layer.getFrameIndex(window.name);
        $('.select').on('click',function(){
            var id = $(this).data('id'),city = $(this).data('city'),title = $(this).data('title'),map = $(this).data('map'),address = $(this).data('address');
            var parentFrame = $(window.parent.document),city_box = parentFrame.find('#J_city_select');
            parentFrame.find('#estate_id').val(id);
            parentFrame.find('#estate_name').val(title);
            parentFrame.find('#map').val(map);
            city_box.nextAll().remove();
            city_box.html('');
            city_box.attr('data-selected',city);
            parentFrame.find('#address').val(address);
            parent.layer.close(index);
        });
        $("#searchBtn").on('click',function(){
            var keyword = $.trim($("#keyword").val());

            if(keyword.length == 0){
                parent.layer.msg('请填写关键词',{icon:2});
                return false;
            }else{
                $('#info_form').submit();
            }
        });
    });

</script>
</body>
</html>