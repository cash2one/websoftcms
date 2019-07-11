$("head").append('<link rel="stylesheet" type="text/css" href="/static/css/jquery.slide-packer.css">');$("body").append('<script type="text/javascript" src="/static/js/plugins/jquery.slide-packer.js"></script>');document.write('<div class="slider slider-1"><div class="switchable-box poster"><ul class="switchable-content"><li><a style="background-image:url(/uploads/poster/20181101/41d731fe17f55e7fb41ed3b7bca7e907.jpg);" href="" title="" target="_blank"><img src="/uploads/poster/20181101/41d731fe17f55e7fb41ed3b7bca7e907.jpg" title="" width="100%"  /></a></li></li></ul><div class="ui-arrow"><a class="ui-prev"></a><a class="ui-next"></a></div></div></div>');$(function(){
        $('body').find('.slider-1').slide({
			effect: 'fade', // random/normal/scroll/fade/fold/slice/slide/shutter/grow
			speed: 'slow',
			navCls: 'switchable-nav',
			contentCls: 'switchable-content',
			caption: false,
			prevBtnCls:'ui-prev',
            nextBtnCls:'ui-next',
			evtype: 'click'
		});
        });