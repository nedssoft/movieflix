(function($) {
    $.fn.socialCircle = function(options) {
        $(this).siblings().addBack().each(function() {
            var iconRadius = $(this).outerWidth() / 2;
            $(this).css({
                "top": "-" + iconRadius + "px",
                "left": "-" + iconRadius + "px"
            });
        });
        var centerCircle = $(this)
        var settings = $.extend({
            rotate: 0,
            radius: 200,
            circleSize: 2,
            speed: 500
        }, options);
        if (settings.rotate == 0) {
            var rotate = 0;
        } else {
            var rotate = (Math.PI) * 2 * settings.rotate / 360;
        }
        if (settings.circleSize == 0) {
            var rotate = 0;
        } else {
            var circleSize = settings.circleSize;
        }
        expand();

        function expand() {
            var radius = settings.radius,
                icons = centerCircle.siblings(),
                container = centerCircle.parent(),
                width = container.outerWidth(),
                height = container.outerHeight(),
                step = (2 * Math.PI) / icons.length / settings.circleSize,
                angle = rotate + (step / 2);
            icons.each(function() {
                var x = Math.round(width / 2 + radius * Math.cos(angle) - $(this).width() / 2);
                var y = Math.round(height / 2 + radius * Math.sin(angle) - $(this).height() / 2);
                $(this).animate({
                    left: x + 'px',
                    top: y + 'px',
                    margin: '0px'
                }, {
                    duration: settings.speed,
                    queue: false
                });
                angle += step;
            });
        }
    };
}(jQuery));





// (function($){$.fn.socialCircle=function(options){$(this).siblings().addBack().each(function(){var iconRadius=$(this).outerWidth()/2;$(this).css({"top":"-"+iconRadius+"px","left":"-"+iconRadius+"px"});});var centerCircle=$(this)
// var settings=$.extend({rotate:0,radius:200,circleSize:2,speed:500},options);if(settings.rotate==0){var rotate=0;}else{var rotate=(Math.PI)*2*settings.rotate/360;}
// if(settings.circleSize==0){var rotate=0;}else{var circleSize=settings.circleSize;}
// expand();function expand(){var radius=settings.radius,icons=centerCircle.siblings(),container=centerCircle.parent(),width=container.outerWidth(),height=container.outerHeight(),step=(2*Math.PI)/icons.length/settings.circleSize,angle=rotate+(step/2);icons.each(function(){var x=Math.round(width/2+radius*Math.cos(angle)-$(this).width()/2);var y=Math.round(height/2+radius*Math.sin(angle)-$(this).height()/2);$(this).animate({left:x+'px',top:y+'px',margin:'0px'},{duration:settings.speed,queue:false});angle+=step;});}};}(jQuery));
