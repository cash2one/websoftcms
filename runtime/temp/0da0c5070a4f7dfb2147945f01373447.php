<?php /*a:2:{s:82:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/question/index.html";i:1535418502;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
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
                    <col width="75%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                <tr>
                    <th>
                        <div class="layui-table-cell"><span>提问内容</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>提问时间</span></div>
                    </th>
                    <th>
                        <div class="layui-table-cell"><span>操作</span></div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                <tr>
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
                            <a href="<?php echo url('Question/detail',['id'=>$val['id']]); ?>" target="_blank">查看回复</a>
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