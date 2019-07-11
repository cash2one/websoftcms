<?php /*a:3:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/tools/index.html";i:1527591334;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/layout.html";i:1541120186;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script>
        var browser = {
            versions: function() {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {     //移动终端浏览器版本信息
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器
                    iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            } (),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        };
        if (browser.versions.mobile) {
            window.location.href = "<?php echo config('mobile_domain'); ?>"+window.location.pathname;
        }
    </script>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/common.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/input.css">
    <link rel="stylesheet" type="text/css" href="/static/home/css/css.css">
    <script src="/static/js/jquery.min.js"></script>
</head>
<body>
<!-- topBar S -->
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
<!-- topBar E -->


<link rel="stylesheet" href="/static/home/css/calculator.css">
    <div class="comWidth">
        <!-- 页面标识 S-->
        <div class="page_tit">
            <a href="javascript:;" rel="nofollow">您的位置：</a><a href="<?php echo url('Index/index'); ?>" title="<?php echo htmlentities($site['title']); ?>">首页</a> &gt; <a href="javascript:void(0);">房贷计算器</a>
        </div>
    </div>
<div class="calculator">
    <div class="content clearfix">
        <div class="infor">
            <dl class="title">
                <dt>房贷计算器</dt>
                <dd>选择基本情况，帮您快速计算房贷</dd>
            </dl>
            <table class="tab">
                <tbody>
                <tr>
                    <td>房款总额：</td>
                    <td>
                        <div class="box">
                            <input value="300" name="total" id="total" type="text">
                            <span class="unit">万</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>首付成数：</td>
                    <td>
                        <div class="box select">
                            <a data-value="0.3" id="firstPayPercent" name="ltv">3成</a>
                            <div class="unflod">
                                <a data-value="0.1" name="ltv">1成</a>
                                <a data-value="0.2" name="ltv">2成</a>
                                <a data-value="0.3" name="ltv">3成</a>
                                <a data-value="0.4" name="ltv">4成</a>
                                <a data-value="0.5" name="ltv">5成</a>
                                <a data-value="0.6" name="ltv">6成</a>
                                <a data-value="0.7" name="ltv">7成</a>
                                <a data-value="0.8" name="ltv">8成</a>
                                <a data-value="0.9" name="ltv">9成</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>贷款类别：</td>
                    <td>
                        <div class="box select">
                            <a data-value="pfa" id="loanType" name="type">公积金贷款</a>
                            <div class="unflod">
                                <a data-value="business" name="type">商业贷款</a>
                                <a data-value="pfa" name="type">公积金贷款</a>
                                <a data-value="mix" name="type">组合型贷款</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr style="display:none" id="tr-pfa">
                    <td>公贷金额：</td>
                    <td>
                        <div class="box">
                            <input value="" name="total-pfa" id="totalPfa" type="text">
                            <span class="unit">万</span>
                        </div>
                    </td>
                </tr>
                <tr style="display:none" id="tr-business">
                    <td>商贷金额：</td>
                    <td>
                        <div class="box">
                            <input value="" name="total-business" id="totalBusiness" type="text">
                            <span class="unit">万</span>
                        </div>
                    </td>
                </tr>
                <tr style="display:none" id="tr-business-rate">
                    <td>商贷利率：</td>
                    <td>
                        <div class="equal">
                            <div class="box select">
                                <a data-value="1.0" id="businessDiscount" name="business-discount">无折扣</a>
                                <div class="unflod">
                                    <a data-value="1.0" name="business-discount">无折扣</a>
                                    <a data-value="1.2" name="business-discount">1.2倍</a>
                                    <a data-value="1.15" name="business-discount">1.15倍</a>
                                    <a data-value="1.1" name="business-discount">1.1倍</a>
                                    <a data-value="1.05" name="business-discount">1.05倍</a>
                                    <a data-value="0.95" name="business-discount">95折</a>
                                    <a data-value="0.9" name="business-discount">9折</a>
                                    <a data-value="0.85" name="business-discount">85折</a>
                                    <a data-value="0.8" name="business-discount">8折</a>
                                    <a data-value="0.75" name="business-discount">75折</a>
                                    <a data-value="0.7" name="business-discount">7折</a>
                                </div>
                            </div>
                            <div class="to">=</div>
                            <div class="box">
                                <input value="4.90" name="business-rate" id="businessRate" type="text">
                                <span class="unit">%</span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>贷款期限：</td>
                    <td>
                        <div class="box select">
                            <a data-value="360" id="loanPeriod" name="loan-period">30年（360期）</a>
                            <div class="unflod"><a data-value="12" name="loan-period">1年（12期）</a><a data-value="24" name="loan-period">2年（24期）</a><a data-value="36" name="loan-period">3年（36期）</a><a data-value="48" name="loan-period">4年（48期）</a><a data-value="60" name="loan-period">5年（60期）</a><a data-value="72" name="loan-period">6年（72期）</a><a data-value="84" name="loan-period">7年（84期）</a><a data-value="96" name="loan-period">8年（96期）</a><a data-value="108" name="loan-period">9年（108期）</a><a data-value="120" name="loan-period">10年（120期）</a><a data-value="132" name="loan-period">11年（132期）</a><a data-value="144" name="loan-period">12年（144期）</a><a data-value="156" name="loan-period">13年（156期）</a><a data-value="168" name="loan-period">14年（168期）</a><a data-value="180" name="loan-period">15年（180期）</a><a data-value="192" name="loan-period">16年（192期）</a><a data-value="204" name="loan-period">17年（204期）</a><a data-value="216" name="loan-period">18年（216期）</a><a data-value="228" name="loan-period">19年（228期）</a><a data-value="240" name="loan-period">20年（240期）</a><a data-value="252" name="loan-period">21年（252期）</a><a data-value="264" name="loan-period">22年（264期）</a><a data-value="276" name="loan-period">23年（276期）</a><a data-value="288" name="loan-period">24年（288期）</a><a data-value="300" name="loan-period">25年（300期）</a><a data-value="312" name="loan-period">26年（312期）</a><a data-value="324" name="loan-period">27年（324期）</a><a data-value="336" name="loan-period">28年（336期）</a><a data-value="348" name="loan-period">29年（348期）</a><a data-value="360" name="loan-period">30年（360期）</a></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>还款方式：</td>
                    <td>
                        <label class="" data-value="0" name="repay-method"><span></span>等额本息</label>
                        <label data-value="1" name="repay-method" class="on"><span></span>等额本金</label>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="tip">温馨提示：最新公积金贷款基准利率3.25%；商业贷款利率为4.90%</p>
        </div>
        <button data-rate-business-range1and5="4.75" data-rate-business-lessthan1="4.35" data-rate-business="4.90" data-rate-pfa-lessthan5="2.75" data-rate-pfa="3.25" id="buttonCal" class="work">开始 计算</button>
        <div id="result-panel" style="" class="result">
            <dl class="title">
                <dt>您的账单</dt>
                <dd>房款总额：约<span id="houseTotal">300</span>万元</dd>
            </dl>
            <ul class="msg">
                <li class="gr">首付金额：<span id="firstPay">90.00</span>万元</li>
                <li class="or">贷款金额：<span id="loanTotal">210.00万（公贷）</span></li>
                <li class="bl">偿还利息：<span id="payInterest">102.66万（公贷）</span></li>
                <!-- 等额本息 -->
                <li style="display: none;" class="bill">
                    参考月供：<span id="monthPay" class="mcolor">元（公贷）</span>
                </li>
                <!-- /等额本息 -->

                <!-- 等额本金 -->
                <li style="" class="bill">
                    首月还款：<span id="monthPayFirst" class="mcolor">11520.83元（公贷）</span><span class="line"></span>
                    每月递减：<span id="monthPayDecrease" class="mcolor">15.80元（公贷）</span>
                </li>
                <!-- /等额本金 -->

            </ul>
        </div>

    </div>

</div>
<script src="/static/home/js/loan.min.js"></script>

<div class="footer">
    <div class="comWidth">
    <div class="link_box clearfix">
        <div class="leftArea">
            <div class="house_link clearfix">
                <a href="<?php echo url('House/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>新楼盘</a>
                <a href="<?php echo url('Estate/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手小区</a>
                <a href="<?php echo url('Second/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>二手房</a>
                <a href="<?php echo url('Rental/index'); ?>"><?php echo htmlentities($cityInfo['name']); ?>出租房</a>
            </div>
            <?php if($controller == 'index'): ?>
            <div class="tab_link clearfix">
                <a href="javascript:;" style="text-decoration: none;">友情链接：</a>
                <?php $obj = model("link");$obj = $obj->where("cate_id=1 and status=1 and city = $cityId");$obj = $obj->field("name,url");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(40)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo htmlentities($data['url']); ?>" target="_blank" title="<?php echo htmlentities($data['name']); ?>"><?php echo htmlentities($data['name']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php else: ?>
            <div class="tab_link clearfix" style="margin-top:10px;">
                <?php $where_str = "status=1";$city_all_child && $where_str.= " and city in (".$city_all_child.")"; $obj = model("house");$obj = $obj->where("$where_str");$obj = $obj->field("id,title");$obj = $obj->order("ordid asc,id desc");$name = $obj->limit(50)->select();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('House/detail',['id'=>$data['id']]); ?>" target="_blank" title="<?php echo htmlentities($data['title']); ?>"><?php echo htmlentities($data['title']); ?></a>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </div>
            <?php endif; ?>
            <div class="other_link">
                <?php $n = 0; if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pos'] == 2): $n++; ?>
                <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a>
                <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <a href="<?php echo url('agent/Login/index@agent'); ?>">代理登录</a>
                <a href="javascript:;">服务热线：<?php echo htmlentities($site['telphone']); ?></a>
            </div>
        </div>
        <div class="rightArea">
            <div class="ewm">
                <img src="<?php echo htmlentities($site['weixin_qrcode']); ?>" width="140" height="140" alt="" class="img">
                <p>官方微信公众号</p>
            </div>
        </div>
    </div>
    <div class="bottom">
        <p>地址：<?php echo htmlentities($site['address']); ?> </p>
        <p>版权所有 &copy;2009-<?php echo date('Y'); ?> <?php echo htmlentities($site['company_name']); ?> All Rights Reserved. <?php echo $site['icp']; ?></p>
    </div>
</div>
<div class="scroll-top" id="scroll-top">
    <span class="text">返回顶部</span>
    <span class="ico"></span>
</div>
<?php echo $site['pc_js']; ?>
<script>
    $(function(){
        var h = $(window).height();
        $(document).on('scroll',function(){
            var top=$(document).scrollTop();
            if(top > h)
            {
                $("#scroll-top").show();
            }else{
                $("#scroll-top").hide();
            }
        });
        $("#scroll-top").on('click',function(){
            $('body,html').animate({scrollTop:0},300);
        })
    });
</script>
</div>
<script src="/static/js/plugins/jquery.lazyload.js"></script>
<script type="text/javascript" src="/static/home/js/common.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script>
    $("img.lazy").lazyload({
        threshold : 100,
        effect : "fadeIn"
        //event: "scrollstop"
    });
    $(function(){
       $('.follow').on('click',function(){
           var house_id = $(this).data('id'),model = $(this).data('model'),url = $(this).data('uri'),me = $(this);
           $.post(url,{house_id:house_id,model:model},function(result){
               if(result.code == 1)
               {
                   layer.msg(result.msg,{icon:1});
                   if(me.hasClass('on'))
                   {
                       me.removeClass('on').text(result.text);
                   }else{
                       me.addClass('on').text(result.text);
                   }
               }else{
                   layer.msg(result.msg,{icon:2});
               }
           });
       });
    });
</script>
</body>
</html>