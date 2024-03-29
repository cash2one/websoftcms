<?php /*a:2:{s:77:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/shops/add.html";i:1540979842;s:81:"/home/wwwroot/gxwebsoft/public_html/application/home/view/user/public/layout.html";i:1535441222;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/home/css/red.css">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="/static/layui/layui.js"></script>
</head>
<body>
<div class="layui-fluid">
    
<div class="content add_house">
    <form class="layui-form" id="info_form" action="<?php echo url('user.shops/save'); ?>" method="post" enctype="multipart/form-data">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li style="float:right;"><a href="<?php echo url('user.shops/index'); ?>" class="layui-btn layui-btn-sm" style="color:#fff;">商铺列表</a></li>
                <li class="layui-this">发布出售</li>
                <li><a href="<?php echo url('user.shops_rental/add'); ?>">发布出租</a></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">楼盘名称 </label>
                            <div class="layui-input-inline">
                                <input type="hidden" name="estate_id" id="estate_id" value="">
                                <input type="text" name="estate_name" lay-verify="estate_id" id="estate_name" class="layui-input" placeholder="锦绣花园">
                            </div>
                            <div class="layui-input-inline" style="width:100px;">
                                <a href="javascript:;" data-uri="<?php echo url('Ajax/ajaxGetEstate'); ?>" id="select_estate" class="layui-btn">选择楼盘</a>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label"><span class="layui-form-alert">*</span>所属区域</label>
                            <input type="hidden" name="city" id="J_city_id" value="" />
                            <div class="layui-input-block">
                                <select id="J_city_select" class="J_city_select mr10" lay-filter="J_city_select" data-pid="0" data-uri="<?php echo url('Ajax/ajaxGetCitychilds'); ?>" data-selected="">
                                    <!--[if lt IE 9]><option value=""></option><![endif]-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label"><span class="layui-form-alert">*</span>房源名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="title" lay-verify="title" placeholder="房源名称" value="" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">楼层 </label>
                            <div class="layui-input-inline" style="width:100px;">
                                <?php echo getLinkMenu(7,'floor','select',38); ?>
                            </div>
                            <div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:20px;"> 共</div>
                            <div class="layui-input-inline" style="width:100px;">
                                <input type="text" class="layui-input" name="total_floor" placeholder="20">
                            </div>
                            <div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;"> 层</div>
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label"><span class="layui-form-alert">*</span>面积 </label>
                            <div class="layui-input-inline" style="width:80px;">
                                <input type="text" class="layui-input" lay-verify="acreage" id="acreage" name="acreage" placeholder="122"  autocomplete="off" value="" >
                            </div>
                            <div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">㎡ 总价</div>
                            <div class="layui-input-inline" style="width:85px;">
                                <input type="text" class="layui-input" lay-verify="price" id="price" name="price" placeholder="122"  autocomplete="off" value="" >
                            </div>
                            <div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;">万</div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">物业费</label>
                            <div class="layui-input-inline">
                                <input type="text" name="property_fee" placeholder="1.99" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux layui-fl" style="margin-left:10px;"><?php echo config('filter.office_rental_unit'); ?></div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">房源地址 </label>
                            <div class="layui-input-inline">
                                <input type="text" class="layui-input" name="address" id="address" placeholder="海口市龙华区">
                            </div>
                        </div>

                        <div class="layui-inline">
                            <label class="layui-form-label">地图坐标 </label>
                            <div class="layui-input-inline" style="width:200px;">
                                <input type="text" class="layui-input" name="map" id="map" placeholder="115.345,22.1349"  autocomplete="off" value="" >
                            </div>
                            <div class="layui-input-inline" style="width:95px;">
                                <button type="button" id="mark" data-uri="<?php echo addon_url('map://Map/updateLocation'); ?>" class="layui-btn layui-btn-primary">标注位置</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">联系人 </label>
                            <div class="layui-input-inline">
                                <input type="text" name="contact_name" id="contact_name" value="<?php echo htmlentities($userInfo['nick_name']); ?>" placeholder="联系人" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">联系电话 </label>
                            <div class="layui-input-inline">
                                <input type="text" name="contact_phone" lay-verify="phone" value="<?php echo htmlentities($userInfo['mobile']); ?>" id="contact_phone" placeholder="联系电话" class="layui-input">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">装修情况 </label>
                            <div class="layui-input-block">
                                <?php echo getLinkMenu(8,'renovation','radio'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">经营行业</label>
                            <div class="layui-input-block">
                                <?php echo getLinkMenu(19,'industry','checkbox'); ?>
                            </div>
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">分割 </label>
                            <div class="layui-input-block">
                                <input type="radio" name="division" value="不可分割" title="不可分割">
                                <input type="radio" name="division" value="可分割" title="可分割">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">类型 </label>
                            <div class="layui-input-block">
                                <?php echo getLinkMenu(18,'type','radio'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">特色标签 </label>
                            <div class="layui-input-block">
                                <?php echo getLinkMenu(20,'tags','checkbox'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">商铺配套 </label>
                            <div class="layui-input-block">
                                <?php echo getLinkMenu(21,'mating','checkbox'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-block">
                            <label class="layui-form-label">有效期 </label>
                            <div class="layui-input-block">
                                <select name="timeout" id="timeout">
                                    <?php $_result=getHouseTimeOut();if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo htmlentities($key); ?>" <?php if($key == 7): ?>selected="selected"<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <span>过期房源不会展示</span>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">缩略图</label>
                        <div class="layui-input-block">
                            <div class="layui-upload">
                                <input type="hidden" name="img" id="img_txt">
                                <button type="button" class="layui-btn layui-btn-primary" id="img">上传图片</button>
                                <div id="img_preview">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">房源图片</label>
                        <div class="layui-input-block">
                            <div class="layui-upload">
                                <script id="uploadpic" name="uploadpic" type="text/plain"></script>
                                <button type="button" class="layui-btn layui-btn-primary" onclick="upImage();">选择图片</button>
                                <div id="imageList">
                                    <ul class="list clearfix">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">全景看房<a href="javascript:;" data-title="在720yun.com或其它全景平台创建全景相册，复制链接地址到输入框。" class="layui-icon layui-icon-tips alert"></a></label>
                        <div class="layui-input-inline" style="width:600px;">
                            <input name="pano_url" id="pano_url" placeholder="在720yun.com创建全景相册,复制链接地址到输入框" class="layui-input" />
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">房源介绍</label>
                        <div class="layui-input-block">
                            <script id="info" name="info" type="text/plain"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">&nbsp;</label>
            <button type="button" lay-submit="" class="layui-btn btn-submit layui-btn-danger w240">提交</button>
        </div>
    </form>

</div>
<?php echo hook('ueditor',['id'=>'info','width'=>'100%','height'=>220,'mini'=>true,'upload'=>true]); ?>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['form','element','upload','linkmenu'], function(){
        var $ = layui.jquery,element = layui.element,layer = layui.layer,form = layui.form,upload = layui.upload,menu = layui.linkmenu;
        $(".J_city_select").select({field : 'J_city_id',id : 'J_city_select'});

//普通图片上传
        upload.render({
            elem: '#img'
            ,auto:false
            ,choose: function(obj){
                if(!IEVersion())
                {
                    $('#img_preview').html($('.layui-upload-file').val());
                }else {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        var img = "<img class='layui-upload-img' src='" + result + "' width='100'/>";
                        $('#img_preview').html(img); //图片链接（base64）
                    });
                }
            }
            ,done: function(res){console.log(res);
                //如果上传失败
                if(res.code == 0){
                    return layer.msg('上传失败');
                }else{
                    var img = "<img class='layui-upload-img' src='"+res.data+"' width='100'/><a href='javascript:;' data-text='img_txt' data-src='"+res.data+"' class='deleteImg layui-btn layui-btn-xs layui-btn-danger'>删除</a>";
                    $("#img_txt").val(res.data);
                    $("#img_preview").html(img);
                }
                //上传成功
            }

        });
        $('.btn-submit').on('click',function(){
            var title = $("input[lay-verify='title']"),
                    estate_name = $("input[lay-verify='estate_id']"),
                    acreage     = $("input[lay-verify='acreage']"),
                    price       = $("input[lay-verify='price']");
            if(title.val().length == 0)
            {
                layer.msg('请填写房源标题',{icon:5});
                title.focus();
                return false;
            }else if(estate_name.val().length == 0){
                layer.msg('请填写小区名称',{icon:5});

                return false;
            }else if(!/^\d+\.?\d{0,2}$/.test(acreage.val())){
                layer.msg('面积只能为数字,最多保留两位小数',{icon:5});
                acreage.focus();
                return false;
            }else if(price.val().length > 0 && !/^\d+\.?\d{0,2}$/.test(price.val())){
                layer.msg('价格只能为数字,最多保留两位小数',{icon:5});
                price.focus();
                return false;
            }else{
                layer.load(1);
                $("#info_form").submit();
            }
        });
        $("#address").on('blur',function(){
            var city = $("#J_city_id").val();
            var address = $(this).val(),url = "<?php echo addon_url('map://Map/getLocationByAddress'); ?>";
            var param = {
                city : city,
                address : address
            };
            $.get(url,param,function(res){
                if(res.code == 1)
                {
                    $("#map").val(res.data.map);
                }
            });
        });
        $("#mark").on('click',function(){
            var url = $(this).data('uri');
            var map = $('#map').val();
            var city = $("#J_city_id").val();console.log(city);
            if(!map)
            {
                if(!city)
                {
                    layer.msg('请选择城市',{icon:2});
                    return false;
                }
            }
            url += '?map='+map+'&city='+city;
            layer.open(
                    {
                        type : 2,
                        title : '地图标注',
                        area : ['100%','100%'],
                        shade : 0.2,
                        content : url,
                        iframeAuto:true
                    }
            );
        });
        $("#select_estate").on('focus',function(){
            layer.open({
                type : 2,
                title : '选择楼盘',
                area : ['500px','500px'],
                shade : 0.2,
                content : $(this).data('uri'),
                iframeAuto:true,
                end : function(){
                    var select = $("#J_city_select");
                    select.html('');
                    select.nextAll().remove();
                    select.select({field : 'J_city_id',id : 'J_city_select'});
                }
            });
        });
    });
</script>

</div>
<script>
    layui.config({
        base: '/static/manage/js/'
    });
    function IEVersion() {
        var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
        var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
        var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器
        var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
        if(isIE) {
            var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
            reIE.test(userAgent);
            var fIEVersion = parseFloat(RegExp["$1"]);
            if(fIEVersion < 10) {
                return false;
            }
        } else if(isEdge) {
            return 'edge';//edge
        } else if(isIE11) {
            return true; //IE11
        }else{
            return true;//不是ie浏览器
        }
    }
</script>
</body>
</html>