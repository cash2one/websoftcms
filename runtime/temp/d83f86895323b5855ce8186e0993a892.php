<?php /*a:1:{s:62:"/home/wwwroot/gxwebsoft/public_html/addons/editor/ueditor.html";i:1527897502;}*/ ?>
<script src="/static/js/ueditor/ueditor.config.js"></script>
<script src="/static/js/ueditor/ueditor.all.min.js"></script>
<script src="/static/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    window.UEDITOR_HOME_URL='/static/js/ueditor/';
    var id = '<?php echo htmlentities($param["id"]); ?>',width = "<?php echo htmlentities($param['width']); ?>" || 850,height  = "<?php echo htmlentities($param['height']); ?>" || 500,
            upload = "<?php echo htmlentities($param['upload']); ?>" || false,mini = "<?php echo htmlentities($param['mini']); ?>" || false;
    var min_toolbars = [
        'fullscreen', 'source', '|',
        'bold', 'italic', 'underline', '|', 'fontfamily','fontsize', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', 'insertimage','|', 'kityformula', 'preview'
    ];
    id = eval('('+id+')');
    window.onload=function(){
        window.UEDITOR_CONFIG.initialFrameWidth = width;
        window.UEDITOR_CONFIG.initialFrameHeight = height;
        if(isArray(id))
        {
            for(var i = 0,len = id.length;i < len;i++)
            {
                UE.getEditor(id[i]);
            }
        }else{
            mini ? UE.getEditor(id,{toolbars: [min_toolbars]}) : UE.getEditor(id);
        }
        if(upload)
        {
            upmoreimg();
        }
    };
    function setContent(value)
    {
        UE.getEditor(id).setContent(value);
    }
    function isArray(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    }
</script>
<?php if(isset($param['upload'])): ?>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/plugins/jquery-ui.min.js"></script>
<script src="/static/js/ueditor/uploadImg.js"></script>
<?php endif; ?>