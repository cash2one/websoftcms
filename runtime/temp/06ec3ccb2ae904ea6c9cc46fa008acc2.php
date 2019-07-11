<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/module/index/20.html";i:1562404297;}*/ ?>
<div class="old-house house-show-box mt20">
        <div class="title">
            <h3>最新出租房</h3>
            <a href="<?php echo url('Rental/index'); ?>" title="出租房">更多</a>
        </div>
        <ul>
            <?php $obj = model("rental");$obj = $obj->where("status = 1 and city in ($cityIds) and timeout > $time");$obj = $obj->order("ordid asc,update_time desc");$name = $obj->limit(5)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="pic">
                    <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" />
                    </a>
                </div>
                <div class="intro-text">
                    <h4>
                        <a href="<?php echo url('Rental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <?php echo htmlentities($vo['title']); ?>
                        </a>
                    </h4>
                    <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo $vo['price']; ?></em></span></p>
                    <p><span><?php echo htmlentities($vo['room']); ?>室<?php echo htmlentities($vo['living_room']); ?>厅</span>&nbsp;<span><?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></span><span>&nbsp;&nbsp;<?php echo getTime($vo['update_time'],'mohu'); ?>更新</span></p>
                    <p class="good">
                        <?php echo htmlentities($vo['address']); ?>
                    </p>
                </div>
            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>