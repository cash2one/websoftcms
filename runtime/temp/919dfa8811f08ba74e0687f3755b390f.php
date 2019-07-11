<?php /*a:2:{s:86:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/house/question_detail.html";i:1530784114;s:78:"/home/wwwroot/gxwebsoft/public_html/application/mobile/view/public/layout.html";i:1536722262;}*/ ?>
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


<div class="main" style="background:none;">
    <div class="question-detail">
        <!-- 问 S -->
        <div class="ask">
            <p class="tit"><?php echo htmlentities($question_info['content']); ?></p>
            <div class="foot clearfix">
                <p class="ask-name fl"><?php if(!(empty($question_info['user_name']) || (($question_info['user_name'] instanceof \think\Collection || $question_info['user_name'] instanceof \think\Paginator ) && $question_info['user_name']->isEmpty()))): ?><?php echo hideStr($question_info['user_name']); else: ?>游客<?php endif; ?></p>
                <p class="time fr"><?php echo htmlentities(date('Y-m-d',!is_numeric($question_info['create_time'])? strtotime($question_info['create_time']) : $question_info['create_time'])); ?></p>
            </div>
        </div>
        <!-- 问 E -->
        <div style="height:.43rem;width: 100%;background: #f1f1f1;"></div>
        <!-- 答 S-->
        <div class="answer">
            <div class="title">
                <h3>共有<?php echo htmlentities($question_info['reply_num']); ?>个回答</h3>
            </div>
            <ul class="list">
                <?php $q_id = $question_info['id']; $obj = model("answer");$obj = $obj->where("question_id=$q_id and status=1");$obj = $obj->field("content,broker_id,broker_name,content,create_time");$name = $obj->paginate(10);$pages=$name->render();if(is_array( $name ) || $name  instanceof \think\Collection || $name instanceof \think\Paginator ): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "暂无数据" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                <li class="clearfix">
                    <div class="pic fl">
							<img src="<?php echo getAvatar($data['broker_id'],90); ?>" alt="<?php echo htmlentities($data['broker_name']); ?>">
					</div>
                    <div class="comment-content fl">
                        <div class="username-level clearfix">
                            <p class="username"><?php echo htmlentities($data['broker_name']); ?></p>
                        </div>
                        <time class="time"><?php echo htmlentities(date('Y-m-d',!is_numeric($data['create_time'])? strtotime($data['create_time']) : $data['create_time'])); ?></time>
                        <p class="comment-desc">
                            <?php echo htmlentities($data['content']); ?>
                        </p>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "暂无数据" ;endif; ?>
            </ul>
            <div class="page_list">
                <?php echo $pages; ?>
            </div>
        </div>
        <!-- 答 S-->
    </div>
    <div class="answer-textarea">
        <form action="#">
            <div class="form-box">
                <div class="ipt-area">
                    <input type="text" class="text-ipt" id="content" placeholder="我来回答这个问题" minlength="5" maxlength="40" name="textIpt">
                </div>
                <div class="btn-area">
                    <?php echo token(); ?>
                    <input type="hidden" name="question_id" id="question_id" value="<?php echo htmlentities($question_info['id']); ?>">
                    <input type="button" class="submit answer-btn"  data-uri="<?php echo url('Api/answer'); ?>" value="回答">
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/static/js/layer/layer.js"></script>
<script>
    $(function(){
        $(".answer-btn").on('click',function(){
            var content = $("#content").val(),question_id = $("#question_id").val(),url = $(this).data('uri'),
                    token = $("input[name='__token__']").val();
            if(!content){
                layer.msg('请填写您的回答内容',{icon:2});
            }else{
                $.post(url,{content:content,question_id:question_id,token:token},function(result){
                    if(result.code == 1)
                    {
                        $("#content").val('');
                        layer.msg('回答提交成功',{icon:1},function(){
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