<?php /*a:2:{s:74:"/home/wwwroot/gxwebsoft/public_html/application/home/view/index/index.html";i:1544067370;s:76:"/home/wwwroot/gxwebsoft/public_html/application/home/view/public/footer.html";i:1562384461;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
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
    <link rel="stylesheet" type="text/css" href="/static/home/css/index.css">
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
</head>
<body>
<div class="index">
    <?php if(is_array($full_module) || $full_module instanceof \think\Collection || $full_module instanceof \think\Paginator): $i = 0; $__LIST__ = $full_module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$module): $mod = ($i % 2 );++$i;?>
        <?php echo action('Module/index',['tpl'=>'module/index/'.$module['id']]); ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <!-- 内容 S-->
    <div class="wrap">
        <div class="comWidth">
            <?php if(is_array($fix_module) || $fix_module instanceof \think\Collection || $fix_module instanceof \think\Paginator): $i = 0; $__LIST__ = $fix_module;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$module): $mod = ($i % 2 );++$i;?>
            <?php echo action('Module/index',['tpl'=>'module/index/'.$module['id']]); ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-- 内容 E-->
</div>
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
<script type="text/html" id="template">
    {{# for(var i = 0, len = d.length; i < len; i++){ }}
    <li>
        <a href="{{d[i].url}}" target="_blank">
            <span>
                <em>{{d[i].price}}{{d[i].unit}}</em>
                 {{d[i].title}}
            </span>
            <span class="address">
                {{d[i].address}}
            </span>
        </a>
    </li>
    {{# } }}
</script>
<script type="text/javascript" src="/static/js/layer/laytpl.js"></script>
<script src="/static/js/layer/layer.js"></script>
<script type="text/javascript" src="/static/home/js/placeholder.js"></script>
<script type="text/javascript" src="/static/home/js/echarts.common.min.js"></script>
<script type="text/javascript" src="/static/home/js/common.js"></script>
<script src="/static/js/plugins/jquery.lazyload.js"></script>

<script>
    $(function(){
        $('#tab-1 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#house-content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#tab-2 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#tab-3 li').on('mouseover',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#second-content-box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $('#rec_house li').on('click',function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index(),box = $('#rec_house_box').children().hide().eq(index);
            box.show();
            var i = box.find('img'),s = i.attr('src'),o = i.data('original');
            if(s != o)
            {
                box.find("img.lazy").lazyload({
                    threshold : 100,
                    effect : "fadeIn",
                    event: "showstop"
                });
            }
        });
        $("#second_tab .tit").on('click',function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $("#second_content").children().hide().eq(index).show();
        });
        $("#house_tab .tit").on('click',function(){
            var index = $(this).index();
            $(this).addClass('active').siblings().removeClass('active');
            $("#house_content").children().hide().eq(index).show();
        });
        $("img.lazy").lazyload({
            threshold : 100,
            effect : "fadeIn"
            //event: "scrollstop"
        });
    });
</script>
<script>
    $(function(){
        drawBroken('house','新盘价格走势');
        drawBroken('second_house','二手房价格走势');
        $("#keyword").on('keyup click',function(e){
            e.preventDefault();
            e.stopPropagation();
            var keyword = $(this).val(),url = $(this).data('uri'),box = $('#search-box');
            $.get(url,{keyword: $.trim(keyword)},function(result){
                if(result.code == 1)
                {
                    var gettpl = document.getElementById('template').innerHTML;
                    laytpl(gettpl).render(result.data, function(html){
                        $('#search-box').html(html);
                    });
                    box.show();
                }else{
                    box.hide();
                }
            });
        });
        $(".filter-row").hover(function(){
            var more = $(this).find(".filter-more"),c = more.html().replace(/[\r\n]/g,""),len = $.trim(c).length;
            if(len > 0){
                more.show();
            }
        },function(){
            $(".filter-more").hide();
        });
        $('body').on('click',function(e){

            $('#search-box').hide();
        });
        $(".search-type a").on('click',function(){
            var url = $(this).data('uri');
            $(this).addClass('active').siblings().removeClass('active');
            $("#form").attr('action',url);
        });
        $(".search-btn").on('click',function(){
            $("#form").submit();
        });
        $('.subscribe-btn').on('click',function(){
            var user_name = $('#user_name'),mobile = $('#mobile'),house_name = $('#house_name').val(),
                    reg   = /^1[3456789][0-9]{9}$/,url = $(this).data('uri'),token = $("input[name='__token__']").val();
                if(!user_name.val())
                {
                    layer.msg('请填写您的姓名',{icon:2});
                    user_name.focus();
                    return false;
                }else if(!reg.test(mobile.val())){
                    layer.msg('请填写正确的手机号码',{icon:2});
                    mobile.focus();
                    return false;
                }else{
                    var param = {
                      user_name : user_name.val(),
                        mobile  : mobile.val(),
                        house_name : house_name,
                        model   : 'house',
                        check_sms : 'no',
                        __token__ : token
                    };
                    $.post(url,param,function(result){
                        if(result.code == 1)
                        {
                            document.form.reset();
                            layer.msg(result.msg,{icon:1});
                        }else{
                            layer.msg(result.msg,{icon:2});
                        }
                    });
                }
        });
        $("#subscribe").Scroll({line:4,speed:1000,timer:3000});
    });
    function drawBroken(id,name)
    {
        var dom = document.getElementById(id);
        var myChart = echarts.init(dom);
        var url = dom.getAttribute('data-uri');
        myChart.showLoading({
            text: '正在努力的读取数据中...'
        });
        var datas = '';
        var title = '';
        $.ajaxSettings.async = false;
        $.get(url,function(data){
            if(data.code==1){
                title = data.month;
                datas = data.data;
            }
        });
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: ''
            },
            tooltip: {},
            legend: {
                data:[]
            },
            grid: {
                left: '3%',
                right: '4%',
                top: '5%',
                containLabel: true
            },
            xAxis: {
                data: title
            },
            yAxis: {},
            series: [{
                name: '均价(<?php echo config("filter.second_price_unit"); ?>)',
                type: 'line',
                data: datas
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        myChart.hideLoading();
    }
    setTimeout(takeCount,1000);
    function takeCount() {
        setTimeout("takeCount()", 1000);
        $(".time-remain").each(function(){
            var obj = $(this);
            var tms = obj.data("down");
            if (tms>0) {
                tms = parseInt(tms)-1;
                var days = Math.floor(tms / (1 * 60 * 60 * 24));
                var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
                var minutes = Math.floor(tms / (1 * 60)) % 60;
                var seconds = Math.floor(tms / 1) % 60;

                if (days < 0) days = 0;
                if (hours < 0) hours = 0;
                if (minutes < 0) minutes = 0;
                if (seconds < 0) seconds = 0;
                obj.find("[time_id='d']").html(days);
                obj.find("[time_id='h']").html(hours);
                obj.find("[time_id='m']").html(minutes);
                obj.find("[time_id='s']").html(seconds);
                obj.data("down",tms);
            }
        });
    }
</script>
</body>
</html>