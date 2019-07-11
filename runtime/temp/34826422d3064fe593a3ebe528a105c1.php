<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/module/index/18.html";i:1562404297;}*/ ?>
<?php if(!(empty($house) || (($house instanceof \think\Collection || $house instanceof \think\Paginator ) && $house->isEmpty()))): ?>
    <!-- 推荐新房 S-->
    <div class="house-show-box mt20">
        <div class="title">
            <h3>推荐新房</h3>
            <a href="<?php echo url('House/index'); ?>" title="新房">更多</a>
        </div>
        <ul>
            <?php if(is_array($house) || $house instanceof \think\Collection || $house instanceof \think\Paginator): $i = 0; $__LIST__ = $house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('House/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                    <div class="clearfix">
                        <div class="pic">
                            <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>">
                        </div>
                        <div class="intro-text">
                            <h4 class="saleing">
                                <?php echo htmlentities($vo['title']); ?>
                            </h4>
                            <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><?php if($vo['price'] > 0): ?><em><?php echo htmlentities($vo['price']); ?></em><?php echo getUnitData($vo['unit']); else: ?>待定<?php endif; ?></span></p>
                            <p><span><?php echo htmlentities($vo['min_acreage']); ?>-<?php echo htmlentities($vo['max_acreage']); ?><?php echo config('filter.acreage_unit'); ?></span><i>|</i><span><?php echo htmlentities($vo['min_type']); ?>-<?php echo htmlentities($vo['max_type']); ?>室</span></p>
                            <p class="good">
                                <?php $tags = array_filter(explode(',',$vo['tags_id'])); if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $n = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($n % 2 );++$n;if($n < 4): ?>
                                <em><?php echo getLinkMenuName(3,$val); ?></em>
                                <?php endif; ?>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <?php if($vo['is_discount'] == 1): ?>
                    <div class="list-discount">
                        <span>惠</span><?php echo htmlentities($vo['discount']); ?>
                    </div>
                    <?php endif; ?>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
    </div>
    <!-- 推荐新房 E-->
    <?php endif; ?>