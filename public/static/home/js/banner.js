(function($){
    /*鼠标移过，左右按钮显示*/
    $(".focusBox").hover(
        function(){ 
            $(this).find(".prev,.next").stop(true,true).fadeTo("show",0.2) 
        },
        function(){ 
            $(this).find(".prev,.next").fadeOut() 
        }
    );
    /*SuperSlide图片切换*/
    $(".focusBox").slide({ 
        mainCell:".pic",
        effect:"leftLoop", 
        autoPlay:false, 
        delayTime:600, 
        trigger:"mouseover"
    });
})(jQuery)