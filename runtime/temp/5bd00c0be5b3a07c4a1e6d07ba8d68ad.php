<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/module/index/15.html";i:1562404297;}*/ ?>
<!-- 头条 S-->
    <div class="headlines clearfix">
        <div class="tit">最新动态</div>
        <div class="text">
            <ul id="text-scroll" style="margin-top: 0;">
                <?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('News/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!-- 头条 E-->