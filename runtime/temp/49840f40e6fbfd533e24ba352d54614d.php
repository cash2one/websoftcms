<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/module/index/17.html";i:1562404297;}*/ ?>
<?php if(!(empty($group) || (($group instanceof \think\Collection || $group instanceof \think\Paginator ) && $group->isEmpty()))): ?>
    <!-- 团购优惠 S-->
    <div class="house-show-box mb20 mt20">
        <div class="title">
            <h3>团购优惠</h3>
            <a href="<?php echo url('Group/index'); ?>" title="团购优惠">更多</a>
        </div>
        <ul>
            <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('Group/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                    <div class="clearfix">
                        <div class="pic">
                            <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                        </div>
                        <div class="intro-text">
                            <h4 class="saleing">
                                <?php echo htmlentities($vo['title']); ?>
                            </h4>
                            <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo htmlentities($vo['price']); ?></em><?php echo config('filter.house_price_unit'); ?></span></p>
                            <p style="padding-top:10px;">
                                <span class="time-remain" data-down="<?php echo htmlentities($vo['end_time']-time()); ?>"><i class="icon iconfont icon-clock text20"></i> <i class="text20" time_id="d">0</i> 天 <i class="text20" time_id="h">0</i> 小时 <i class="text20" time_id="m">0</i> 分钟  <i class="text20" time_id="s">0</i> 秒</span>
                            </p>
                        </div>
                    </div>
                    <div class="list-discount">
                        <span>惠</span><?php echo htmlentities($vo['discount']); ?>
                    </div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!-- 团购优惠 E-->
    <?php endif; ?>