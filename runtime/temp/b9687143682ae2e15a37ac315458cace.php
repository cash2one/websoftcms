<?php /*a:3:{s:83:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/subscribe/index.html";i:1541060282;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/subscribe/nav.html";i:1541059874;}*/ ?>
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
    
<div class="layui-tab layui-tab-brief">
    <ul class="layui-tab-title">
    <li <?php if($action == 'index'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/index'); ?>">新房</a></li>
    <li <?php if($action == 'second'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/second'); ?>">二手房</a></li>
    <li <?php if($action == 'rental'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/rental'); ?>">出租房</a></li>
    <li <?php if($action == 'office'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/office'); ?>">写字楼出售</a></li>
    <li <?php if($action == 'officerental'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/officeRental'); ?>">写字楼出租</a></li>
    <li <?php if($action == 'shops'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/shops'); ?>">商铺出售</a></li>
    <li <?php if($action == 'shopsrental'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('user.subscribe/shopsRental'); ?>">商铺出租</a></li>
</ul>
<script>
    layui.use(['jquery','layer'],function(){
        var $ = layui.jquery,layer = layui.layer;
        $('.delete').on('click',function(){
            var house_id = $(this).data('id'),model = $(this).data('model'),url = "<?php echo url('delete'); ?>";
            var param = {
                house_id : house_id,
                model    : model
            };
            layer.confirm('您确定要删除预约么？', function(){
                $.get(url,param,function(result){
                    if(result.code == 1)
                    {
                        layer.msg(result.msg,{icon:1},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(result.msg,{icon:2});
                    }
                });
            });
        });
    });
</script>
    <form class="layui-form" action="">
        <div class="layui-form layui-border-box layui-table-view">
            <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
                <colgroup>
                    <col width="10%">
                    <col width="30%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <div class="layui-table-cell"><span>类型</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>楼盘名称</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>区域</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>均价</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>预约时间</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>操作</span></div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <div class="layui-table-cell">
                            <?php echo subscribeType($val['type']); ?>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <a href="<?php echo url('House/detail',['id'=>$val['id']]); ?>" target="_blank"><?php echo htmlentities($val['title']); ?></a>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php echo getCityName($val['city']); ?>
                        </div>
                    </td>

                    <td>
                        <div class="layui-table-cell">
                            <?php if($val['price'] > 0): ?><?php echo htmlentities($val['price']); ?><?php echo getUnitData($val['unit']); else: ?>待定<?php endif; ?>
                        </div>
                    </td>

                    <td>
                        <div class="layui-table-cell">
                            <?php echo htmlentities(date('Y-m-d H:i',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                        </div>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <a href="javascript:;" data-id="<?php echo htmlentities($val['id']); ?>" data-model="house" class="layui-btn layui-btn-xs layui-btn-danger delete">删除</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <div class="kaifazhe-fix-bottom layui-clear">
            <div id="pages" class="layui-layout-right">
                <?php echo $pages; ?>
            </div>
        </div>
    </form>
</div>
<!-- 列表 E-->

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