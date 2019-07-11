<?php /*a:2:{s:75:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/index/panel.html";i:1525177370;s:77:"/home/wwwroot/gxwebsoft/public_html/application/agent/view/public/layout.html";i:1540436276;}*/ ?>
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

<style>
    .layui-table-cell{display:block;text-align:left;}
    .layui-table-view .layui-table td{text-align:left;padding-left:20px;}
</style>
<div class="layui-form layui-border-box layui-table-view">
    <div class="layui-table-header">
        <table id="tree-table" style="width:100%" class="layui-table list-table" lay-filter="tree-table" cellspacing="0" cellpadding="0" border="0" data-uri="<?php echo url('ajaxEdit'); ?>">
            <colgroup>
                <col width="50%">
                <col width="50%">
            </colgroup>
            <tbody>
            <tr>
                <td colspan="2">代理商：<?php echo htmlentities($info['company_name']); ?></td>
            </tr>
            <tr>
                <td>代理城市：<?php echo getCityNameByIds($info['city']); ?></td>
                <td>代理类型 ：<?php echo htmlentities($info['title']); ?></td>
            </tr>
            <tr>
                <td>过期时间：
                    <?php if($info['service_time_end'] < time()): ?>
                    <span style="color:#ff0000;"><?php echo htmlentities(date('Y-m-d',!is_numeric($info['service_time_end'])? strtotime($info['service_time_end']) : $info['service_time_end'])); ?>已过期</span>
                    <?php else: ?>
                    <?php echo htmlentities(date('Y-m-d',!is_numeric($info['service_time_end'])? strtotime($info['service_time_end']) : $info['service_time_end'])); ?>
                    <?php endif; ?>
                </td>
                <td>状态 ：<?php if($info['status'] == 1): ?>正常<?php else: ?>禁用<?php endif; ?></td>
            </tr>
            <tr>
                <td>联系人：<?php echo htmlentities($info['contact_name']); ?></td>
                <td>联系电话 ：<?php echo htmlentities($info['mobile']); ?></td>
            </tr>

            </tbody>
        </table>
    </div>
</div>

</div>
<script src="/static/home/user/js/dialog.js"></script>
</body>
</html>

