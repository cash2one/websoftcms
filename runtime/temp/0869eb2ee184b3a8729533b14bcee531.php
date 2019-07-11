<?php /*a:2:{s:79:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/question.html";i:1525092534;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title><?php echo htmlentities($seo['title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($seo['keys']); ?>" />
    <meta name="description" content="<?php echo htmlentities($seo['desc']); ?>" />
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/mobile/js/font-size.js"></script>
    <link rel="stylesheet" href="/static/mobile/css/base.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="/static/mobile/css/style.css?t=<?php echo time(); ?>">

</head>
<body>

<!-- 头部 S-->
<div class="mc-header">
    <a href="javascript:;" class="go-back"></a>
    <h3><?php echo htmlentities((isset($title) && ($title !== '')?$title:$site["title"])); ?></h3>
</div>
<!-- 头部 E-->


<div class="main" style="background: none;padding-bottom:3rem;">
    <!-- 提问列表 S-->
    <div class="question-lists">
        <ul>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="ask">
                    <a href="<?php echo url('House/questionDetail',['id'=>$data['id']]); ?>"><?php echo htmlentities($data['content']); ?></a>
                </div>
                <?php if(!(empty($data['answer']) || (($data['answer'] instanceof \think\Collection || $data['answer'] instanceof \think\Paginator ) && $data['answer']->isEmpty()))): ?>
                <div class="answer">
                    <?php echo htmlentities($data['answer']); ?>
                </div>
                <?php endif; ?>
                <div class="num-time">
                    <a class="num"><?php if(empty($data['total']) || (($data['total'] instanceof \think\Collection || $data['total'] instanceof \think\Paginator ) && $data['total']->isEmpty())): ?>待回答<?php else: ?><em><?php echo htmlentities($data['total']); ?></em>个回答<?php endif; ?></a>
                    <span class="time"><?php if(!(empty($data['create_time']) || (($data['create_time'] instanceof \think\Collection || $data['create_time'] instanceof \think\Paginator ) && $data['create_time']->isEmpty()))): ?><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?><?php endif; ?></span>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="page_list">
            <?php echo $lists->render(); ?>
        </div>
    </div>
    <!-- 提问列表 E-->
    <div class="answer-textarea">
        <form action="#">
            <div class="form-box">
                <div class="ipt-area">
                    <input type="text" class="text-ipt" id="question" placeholder="请填写您的问题" minlength="5" maxlength="40" name="textIpt">
                </div>
                <div class="btn-area">
                    <?php echo token(); ?>
                    <input type="hidden" id="house_id" value="<?php echo htmlentities($info['id']); ?>">
                    <input type="button" class="submit sub-question"  data-uri="<?php echo url('Api/subQuestion'); ?>" value="提交">
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/static/js/layer/layer.js"></script>
<script>
    $(function(){
        $(".sub-question").on('click',function(){
            var question = $("#question").val(),house_id = $("#house_id").val(),url = $(this).data('uri'),
                    token = $("input[name='__token__']").val();
            if(!question){
                layer.msg('请填写您的问题',{icon:2});
            }else{
                $.post(url,{content:question,house_id:house_id,token:token},function(result){
                    if(result.code == 1)
                    {
                        $("#question").val('');
                        layer.msg('问题提交成功',{icon:1},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(result.msg,{icon:2});
                    }
                });
            }
        });
    });

</script>

<div style="max-width: 750px;margin:0 auto;position: relative;">
    <div class="footer-bar">
        <ul>
            <li <?php if($controller == "index"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Index/index'); ?>"><i class="icon iconfont icon-daohangshouye"></i><div>首页</div></a></li>
            <li <?php if($controller == "house"): ?>class="active"<?php endif; ?>><a href="<?php echo url('House/index'); ?>"><i class="icon iconfont icon-ziyuan"></i><div>新房</div></a></li>
            <li <?php if($controller == "second"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Second/index'); ?>"><i class="icon iconfont icon-second"></i><div>二手</div></a></li>
            <li <?php if($controller == "rental"): ?>class="active"<?php endif; ?>><a href="<?php echo url('Rental/index'); ?>"><i class="icon iconfont icon-rental"></i><div>出租</div></a></li>
            <li <?php if($controller == "user"): ?>class="active"<?php endif; ?>><a href="<?php echo url('user.index/index'); ?>"><i class="icon iconfont icon-yonghu"></i><div>我的</div></a></li>
        </ul>
    </div>
</div>
<div style="display:none;" id="weixin-share" data-desc="<?php if(isset($info)): ?><?php echo msubstr(strip_tags($info['info']),0,50); else: ?><?php echo htmlentities($site['seo_desc']); ?><?php endif; ?>"></div>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    $(function(){
       $('.detail-go-back,.go-back').on('touchend',function(){
           window.history.back();
       }) ;
        var img_url = "<?php echo config('mobile_domain'); ?><?php echo htmlentities((isset($info['img']) && ($info['img'] !== '')?$info['img']:$site['pc_logo'])); ?>";
        var shareData = {
            title: "<?php echo !empty($share_title) ? htmlentities($share_title) : htmlentities($seo['title']); ?>",
            link: window.location.href,
            desc: $("#weixin-share").data('desc'),
            imgUrl: img_url,
            success:function(){

            }
        };
        var jssdkconfig = <?php echo $sdk_config; ?> || { jsApiList:[] };
        wx.config(jssdkconfig);
        wx.ready(function () {
            wx.onMenuShareAppMessage(shareData);
            wx.onMenuShareTimeline(shareData);
            wx.onMenuShareQQ(shareData);
            wx.onMenuShareWeibo(shareData);
        });
    });
</script>
</body>
</html>