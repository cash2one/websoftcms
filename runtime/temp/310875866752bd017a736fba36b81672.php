<?php /*a:2:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/rental/index.html";i:1541043404;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/red.css">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="/static/layui/layui.js"></script>
</head>
<body>
<div class="layui-fluid">
    
<div class="layui-form">
    <form name="layui-form" class="search-form" action="<?php echo url('user.rental/index'); ?>" method="get" >
        <div class="layui-elem-quote">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline" style="width:100px;">
                        <select name="status">
                            <option value="">-所有-</option>
                            <option value="1" <?php if($search['status'] == '1'): ?>selected="selected"<?php endif; ?>>发布</option>
                            <option value="0" <?php if($search['status'] == '0'): ?>selected="selected"<?php endif; ?>>待审</option>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input name="keyword" type="text" placeholder="输入关键词搜索" class="layui-input" size="25" value="<?php echo htmlentities($search['keyword']); ?>" />
                    </div>
                    <button class="layui-btn layui-btn-normal">搜索</button>
                </div>
            </div>
        </div>
    </form>
</div>
<form class="layui-form" action="">
    <div class="layui-form layui-border-box layui-table-view">
        <table id="list-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0" data-model="rental" data-uri="<?php echo url('Api/setTop'); ?>">
            <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="40%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
            </colgroup>
            <thead>
            <tr>
                <th>
                    <div class="layui-table-cell">
                        <input name="checkAll" lay-skin="primary" lay-filter="checkAll" type="checkbox">
                    </div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>小区名称</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>标题</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>面积</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>租金</span></div>
                </th>
                <th>
                    <div class="layui-table-cell"><span>状态</span></div>
                </th>
                <th>
                    <div class="layui-table-cell" align="center"><span>操作</span></div>
                </th>

            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <div class="layui-table-cell laytable-cell-checkbox">
                        <input lay-skin="primary" lay-filter="checkOne" value="<?php echo htmlentities($val['id']); ?>" type="checkbox" />
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['estate_name']); ?>
                    </div>
                </td>
                <td data-field="title">
                    <?php echo htmlentities($val['title']); ?>(<?php echo htmlentities($val['room']); ?>室<?php echo htmlentities($val['living_room']); ?>厅)
                    <?php if($val['top_time'] > time()): ?>
                    <span style="color:#ff0000;">[置顶]</span>
                    <?php endif; if(!(empty($val['img']) || (($val['img'] instanceof \think\Collection || $val['img'] instanceof \think\Paginator ) && $val['img']->isEmpty()))): ?>
                    <a href="javascript:;" class="thumb" data-thumb="<?php echo htmlentities($val['img']); ?>"><i class="layui-icon">&#xe64a;</i></a>
                    <?php endif; ?>
                </td>

                <td>
                    <div class="layui-table-cell">
                        <?php echo htmlentities($val['acreage']); ?>㎡
                    </div>
                </td>
                <td>
                    <div class="layui-table-cell">
                        <?php echo $val['price']; ?>
                    </div>
                </td>
                <td class="kaifazhe-switch">
                    <div class="layui-table-cell">
                        <?php if($val['status'] == 1): ?>
                        发布
                        <?php else: ?>
                        <span style="color:#ff0000;">待审</span>
                        <?php endif; if($val['timeout'] < time()): ?>
                        ,<span style="color:#ff0000;">已过期</span>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="layui-center">
                    <?php if($val['status'] == 1 and $val['top_time'] < time()): ?>
                    <a class="relative set-top">
                        <span class="layui-btn layui-btn-xs">置顶</span>
                        <ul class="absolute" data-id="<?php echo htmlentities($val['id']); ?>" style="display:none;">
                            <?php $_result=getTopTime();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li data-val="<?php echo htmlentities($key); ?>"><?php echo htmlentities($vo); ?></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </a>
                    <?php endif; ?>
                    <a href="<?php echo url('edit',['id'=>$val['id']]); ?>" class="layui-btn layui-btn-xs">编辑</a><a href="javascript:;" data-msg="您确认要删除该条房源么？" data-uri="<?php echo url('user.send/delete',['id'=>$val['id'],'model'=>'rental']); ?>" class="J_confirm layui-btn layui-btn-xs layui-btn-danger">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <div class="kaifazhe-fix-bottom layui-clear">
        <div class="kaifazhe-list-option layui-fl">
            <input name="checkAll" lay-filter="checkAll" lay-skin="primary" title="全选/取消" type="checkbox">
            <button type="button" lay-submit lay-filter="optionAll" data-msg="确定要删除所选项目么？" data-uri="<?php echo url('user.send/delete',['model'=>'rental']); ?>" class="layui-btn layui-btn-danger layui-btn-sm">删除</button>
        </div>
        <div id="pages" class="layui-layout-right">
            <?php echo $pages; ?>
        </div>
    </div>
</form>
<script src="/static/home/user/js/dialog.js"></script>

</div>
<script>
    layui.config({
        base: '/static/manage/js/'
    });
    function IEVersion() {
        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
        var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器
        var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
        if(isIE) {
            var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
            reIE.test(userAgent);
            var fIEVersion = parseFloat(RegExp["$1"]);
            if(fIEVersion < 10) {
                return false;
            }
        } else if(isEdge) {
            return 'edge';//edge
        } else if(isIE11) {
            return true; //IE11
        }else{
            return true;//不是ie浏览器
        }
    }
</script>
</body>
</html>