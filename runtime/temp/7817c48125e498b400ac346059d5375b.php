<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/module/index/23.html";i:1562404297;}*/ ?>
<div class="old-house house-show-box mt20">
        <div class="title">
            <h3>最新写字楼</h3>
            <a href="<?php echo url('OfficeRental/index'); ?>" title="写字楼">更多</a>
        </div>
        <ul>
            <?php $obj = model("office_rental");$obj = $obj->where("status = 1 and city in ($cityIds) and timeout > $time");$obj = $obj->field("id,title,city,img,acreage,type,renovation,price,tags,update_time");$obj = $obj->order("ordid asc,update_time desc");$name = $obj->limit(5)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="pic">
                    <a href="<?php echo url('OfficeRental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                        <img src="<?php echo thumb($vo['img'],200,150); ?>" onerror="this.src='/static/images/nopic.jpg'" alt="<?php echo htmlentities($vo['title']); ?>" />
                    </a>
                </div>
                <div class="intro-text">
                    <h4>
                        <a href="<?php echo url('OfficeRental/detail',['id'=>$vo['id']]); ?>" title="<?php echo htmlentities($vo['title']); ?>">
                            <?php echo htmlentities($vo['title']); ?>
                        </a>
                    </h4>
                    <p class="price"><span><?php echo getCityName($vo['city'],'-'); ?></span><span class="price-num"><em><?php echo $vo['price']; ?></em></span></p>
                    <p><span><?php echo getLinkMenuName(15,$vo['type']); ?></span>&nbsp;<span><?php echo getLinkMenuName(8,$vo['renovation']); ?></span>&nbsp;<span><?php echo htmlentities($vo['acreage']); ?><?php echo config('filter.acreage_unit'); ?></span><span>&nbsp;&nbsp;<?php echo getTime($vo['update_time'],'mohu'); ?>更新</span></p>
                    <p class="good">
                        <?php $tag = array_filter(explode(',',$vo['tags'])); if(!(empty($tag) || (($tag instanceof \think\Collection || $tag instanceof \think\Paginator ) && $tag->isEmpty()))): if(is_array($tag) || $tag instanceof \think\Collection || $tag instanceof \think\Paginator): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <em><?php echo getLinkMenuName(16,$val); ?></em>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </li>
            <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
        </ul>
    </div>