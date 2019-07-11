<?php /*a:2:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/index/index.html";i:1544067370;s:78:"/home/wwwroot/gxwebsoft/public_html/application/home/view/module/index/31.html";i:1562673388;}*/ ?>
<div class="topBar">
        <div class="comWidth clearfix">
            <div class="logo fl">
                <a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">
                    <img src="<?php echo htmlentities($site['pc_logo_white']); ?>" alt="<?php echo htmlentities($site['title']); ?>" />
                </a>
            </div>
            <div class="fl sele_city">
                <a href="javascript:;"  class="sele_city_btn"><?php echo htmlentities($cityInfo['name']); ?><img src="/static/home/images/icon/icon15.png" alt="" class="icon"></a>
                <div class="city_list clearfix">
                    <i class="city-close">关闭</i>
                  
                    <?php if(is_array($top_nav_city['city']) || $top_nav_city['city'] instanceof \think\Collection || $top_nav_city['city'] instanceof \think\Paginator): $i = 0; $__LIST__ = $top_nav_city['city'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <dl class="clearfix">
                        <dt class="bold"><?php echo htmlentities($key); ?></dt>
                        <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <dd <?php if($val['is_hot'] == 1): ?>class="hot"<?php endif; ?>><a href="<?php echo url($controller.'/index@'.$val['domain']); ?>" title="<?php echo htmlentities($val['name']); ?>"><?php echo htmlentities($val['name']); ?></a></dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dl>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                 
                </div>
            </div>
            <div class="navBar fl">
                <ul class="nav_list fl">
                    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 1): ?>
                    <li <?php if($vo['model'] == $cur_url): ?>class="active"<?php endif; ?>>
                    <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"  target="<?php echo htmlentities($vo['open_type']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                    <?php if(isset($vo['_child'])): ?>
                    <ul>
                        <?php if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo htmlentities($val['url']); ?>" title="<?php echo htmlentities($val['title']); ?>" target="<?php echo htmlentities($val['open_type']); ?>"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="log_link fr">
                <?php if(!(empty($userInfo) || (($userInfo instanceof \think\Collection || $userInfo instanceof \think\Paginator ) && $userInfo->isEmpty()))): ?>
                <!-- 已登录状态 -->
                <div class="loged">
                    <div class="user_info">
                        <img src="<?php echo getAvatar($userInfo['id'],30); ?>" width="30" height="30" alt="">
                        <span class="name"><?php echo hideStr($userInfo['nick_name']); ?></span>
                    </div>
                    <div class="slide_tog" style="display:none;">
                        <a href="<?php echo url('user.index/index'); ?>">用户中心</a>
                        <a href="<?php echo url('Login/logout'); ?>">退出登录</a>
                    </div>
                </div>
                <?php else: ?>
                <!-- 未登录状态 -->
                <div class="not_log">
                    <a href="<?php echo url('Login/index'); ?>">登录</a>
                    /
                    <a href="<?php echo url('Login/register'); ?>">注册</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>