<?php /*a:2:{s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/comment/index.html";i:1535418224;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
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
    <form class="layui-form" action="">
        <div class="layui-form layui-border-box layui-table-view">
            <table id="tree-table" class="layui-table list-table" cellspacing="0" cellpadding="0" border="0">
                <colgroup>
                    <col width="10%">
                    <col width="65%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <div class="layui-table-cell"><span>评论经纪人</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>评论内容</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>评论时间</span></div>
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
                            <a href="<?php echo url('Broker/second',['id'=>$val['broker_id']]); ?>" target="_blank"><?php echo htmlentities($val['nick_name']); ?></a>
                        </div>
                    </td>
                    <td style="padding:0 10px;">
                        <?php echo htmlentities($val['content']); ?>
                    </td>
                    <td>
                        <div class="layui-table-cell">
                            <?php echo htmlentities(date('Y-m-d H:i',!is_numeric($val['create_time'])? strtotime($val['create_time']) : $val['create_time'])); ?>
                        </div>
                    </td>
                    <td class="kaifazhe-switch">
                        <div class="layui-table-cell">
                            <a href="javascript:;" data-uri="<?php echo url('delete',['id'=>$val['id']]); ?>" class="layui-btn layui-btn-xs layui-btn-danger J_delete">删除</a>
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
<script>
    layui.use(['jquery','layer'],function(){
        var $ = layui.jquery,layer = layui.layer;
        $('.J_delete').on('click',function(){
            var url = $(this).data('uri');
            var param = {

            };
            layer.confirm('您确定要删除该条评论么？', function(){
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
    })
</script>

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