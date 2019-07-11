<?php /*a:1:{s:80:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/index/pannel.html";i:1540637846;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .clearfix:after{content:"";display:block;clear:both;}
        .clearfix{zoom:1;}
        a{text-decoration: none;}
        ul,li{list-style-type: none;margin:0;padding:0;}
        .main{padding:30px 0 0 10px;font-size:14px;}
        .header .avatar{width:90px;height:90px;float:left;margin-right:10px;}
        .header .avatar img{width:100%;height:100%;border-radius:50%;}
        .header .user-info{float:left;}
        .header .user-info .row{line-height: 30px;}
        .header .user-info .row span.grade{color:#999;}
        .header .user-info .row span.price{color:#ff0000;font-size:16px;}
        .header .user-info .row .pay-btn{padding:5px 10px;background-color: #1E9FFF;color:#fff;margin-left:10px;border-radius: 3px;text-decoration: none;}
        .header .user-info .login-info{color:#666;}
        .header .user-info .login-info a{color:#666;margin-right:30px;}
        .header .user-info .login-info a:hover{color:#111;}
        .header .send-count{float:left;margin-left:30px;border-left:1px solid #e7e7e7;height:85px;color:#666;}
        .header .send-count li{float:left;width:75px;text-align:center;line-height: 24px;}
        .user-grade,.user-rights{padding:10px 0 0 20px;}
        h1{font-size:16px;color:#333;}
        table{background-color: #e7e7e7;color:#666;}
        table tr th{background-color: #f2f2f2;font-weight: 400;padding:5px 0;}
        table tr th li,table tr td li{float:left;width:16.5%;text-align:center;}
        table tr td{background-color: #fff;padding:5px;text-align:center;}
        .grade-btn{display:inline-block;width:50px;height:25px;line-height: 25px;text-align:center;background-color: #1E9FFF;color:#fff;border-radius: 3px;}
        .content{line-height: 2em;}
    </style>
</head>
<body>
    <div class="main">
        <div class="header clearfix">
            <div class="avatar">
                <img src="<?php echo getAvatar($userInfo['id'],90,90); ?>" alt="">
            </div>
            <div class="user-info">
                <div class="row">您好，<?php echo htmlentities($userInfo['nick_name']); ?>！ <span class="grade">您的等级是：<?php echo htmlentities($userInfo['model_name']); ?></span></div>
                <div class="row">
                    账户余额：<span class="price">&yen;<?php echo htmlentities($userInfo['money']); ?></span>
                    <a href="javascript:;" class="pay-btn" id="pay" data-uri="<?php echo url('user.pay/index'); ?>">充值</a>
                    <a href="javascript:;" class="pay-btn" id="order" data-uri="<?php echo url('user.record/order'); ?>">订单</a>
                    <a href="javascript:;" class="pay-btn" id="pay-record" data-uri="<?php echo url('user.record/index'); ?>">账单</a>
                </div>
                <div class="row login-info"><a href="<?php echo url('user.index/log'); ?>">最近登录：<?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($userInfo['login_time'])? strtotime($userInfo['login_time']) : $userInfo['login_time'])); ?></a> <span>ip:<?php echo htmlentities($userInfo['login_ip']); ?> <?php echo htmlentities($userInfo['city']); ?></span></div>
            </div>
            <div class="send-count">
                <ul class="clearfix">
                    <li>&nbsp;</li>
                    <li>全部</li>
                    <li>二手房</li>
                    <li>出租房</li>
                    <li>写字楼出售</li>
                    <li>写字楼出租</li>
                    <li>商铺出售</li>
                    <li>商铺出租</li>
                </ul>
                <ul class="clearfix">
                    <li>总发布</li>
                    <li><?php echo htmlentities($count['total']); ?></li>
                    <li><?php echo htmlentities($count['second_total']); ?></li>
                    <li><?php echo htmlentities($count['rental_total']); ?></li>
                    <li><?php echo htmlentities($count['office_total']); ?></li>
                    <li><?php echo htmlentities($count['office_rental_total']); ?></li>
                    <li><?php echo htmlentities($count['shops_total']); ?></li>
                    <li><?php echo htmlentities($count['shops_rental_total']); ?></li>
                </ul>
                <ul class="clearfix">
                    <li>今日发布</li>
                    <li><?php echo htmlentities($count['total_day']); ?></li>
                    <li><?php echo htmlentities($count['second_total_day']); ?></li>
                    <li><?php echo htmlentities($count['rental_total_day']); ?></li>
                    <li><?php echo htmlentities($count['office_total_day']); ?></li>
                    <li><?php echo htmlentities($count['office_rental_total_day']); ?></li>
                    <li><?php echo htmlentities($count['shops_total_day']); ?></li>
                    <li><?php echo htmlentities($count['shops_rental_total_day']); ?></li>
                </ul>
            </div>
        </div>
        <div class="user-grade">
            <h1>会员等级</h1>
            <div>
                <table width="100%" cellspacing="1" cellpadding="1" border="0">
                    <colgroup>
                        <col width="10%">
                        <col width="8%">
                        <col width="8%">
                        <col/>
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>等级</th>
                            <th>每天发布(条)</th>
                            <th>共发布(条)</th>
                            <th>
                                <div>审核</div>
                                <ul>
                                    <li>二手房</li>
                                    <li>出租房</li>
                                    <li>写字楼出售</li>
                                    <li>写字楼出租</li>
                                    <li>商铺出售</li>
                                    <li>商铺出租</li>
                                </ul>
                            </th>
                            <th>年费(元/年)</th>
                            <th>置顶(元/条/天)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($user_cate) || $user_cate instanceof \think\Collection || $user_cate instanceof \think\Paginator): $i = 0; $__LIST__ = $user_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo htmlentities($val['name']); ?></td>
                            <td>
                                <?php if($val['data']['free_day_send'] == 0): ?>
                                 不限
                                <?php else: ?>
                                <?php echo htmlentities($val['data']['free_day_send']); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($val['data']['free_all_send'] == 0): ?>
                                不限
                                <?php else: ?>
                                <?php echo htmlentities($val['data']['free_all_send']); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <ul>
                                    <li><?php echo htmlentities($check[$val['data']['check_second']]); ?></li>
                                    <li><?php echo htmlentities($check[$val['data']['check_rental']]); ?></li>
                                    <li><?php echo htmlentities($check[$val['data']['check_office']]); ?></li>
                                    <li><?php echo htmlentities($check[$val['data']['check_office_rental']]); ?></li>
                                    <li><?php echo htmlentities($check[$val['data']['check_shops']]); ?></li>
                                    <li><?php echo htmlentities($check[$val['data']['check_shops_rental']]); ?></li>
                                </ul>
                            </td>
                            <td style="color:#ff0000;">
                                <?php if($val['fee'] == 0): ?>免费<?php else: ?>&yen;<?php echo htmlentities($val['fee']); ?><?php endif; ?>
                            </td>
                            <td style="color:#ff0000;">&yen;<?php echo htmlentities($val['fee_top']); ?></td>
                            <td>
                                <?php if($val['fee'] > 0 and $level < $val['ordid']): ?><a href="javascript:;" data-id="<?php echo htmlentities($val['id']); ?>" data-msg="确实要升级为<?php echo htmlentities($val['name']); ?>么？" class="grade-btn">升级</a><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="user-rights">
            <h1>会员权益</h1>
            <div class="content">
                <?php echo $info['info']; ?>
            </div>
        </div>
    </div>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/layer/layer.js"></script>
    <script>
        $("#pay").on('click',function(){
            var url = $(this).data('uri');
            layer.open({
                type: 2,
                title: "账户充值",
                area: ['450px', '400px'],
                shade: 0,
                shadeClose: true,
                content: url
            });
        });
        $("#pay-record").on('click',function(){
            var url = $(this).data('uri');
            layer.open({
                type: 2,
                title: "我的账单",
                area: ['100%', '100%'],
                shade: 0,
                shadeClose: true,
                content: url
            });
        });
        $("#order").on('click',function(){
            var url = $(this).data('uri');
            layer.open({
                type: 2,
                title: "支付订单",
                area: ['100%', '100%'],
                shade: 0,
                shadeClose: true,
                content: url
            });
        });
        $(".grade-btn").on('click',function(){
            var url = "<?php echo url('user.index/upgrade'); ?>",id = $(this).data('id'),msg = $(this).data('msg');
            layer.confirm(msg,{icon:3,title:'提示信息'},function(index){
                var loading = layer.load(1);
                $.ajax({
                    url : url,
                    data : {
                        id : id
                    },
                    type:'get',
                    dataType:'json',
                    success : function(res){
                        layer.close(loading);
                        if(res.code == 1){
                            layer.msg(res.msg,{icon:1},function(){
                                parent.window.location.reload();
                            });
                        }else{
                            layer.msg(res.msg,{icon:2});
                        }
                    }
                });
            });

        });
    </script>
</body>
</html>