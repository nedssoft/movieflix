(function() {
    $.fn.waypointsSetup = {
        'animationClass': '.has-animation'
    }
    $.fn.waypointsInit = function() {
        $(this).waypoint({
            handler: function(direction) {
                $(this.element).find($.fn.waypointsSetup.animationClass).each(function() {
                    var el = $(this)
                    var animation = el.attr('data-animation')
                    var delay = 0
                    if (el.attr('data-delay')) {
                        delay = el.attr('data-delay')
                    }
                    setTimeout(function() {
                        el.addClass('animated ' + animation)
                    }, delay)
                })
            }
        })
    }
}(jQuery));
(function($) {
    $.fn.accordionSetup = {
        card: '.card',
        openIcon: '<i class="fas fa-plus-circle"></i>',
        closeIcon: '<i class="fas fa-minus-circle"></i>',
        eventListener: {
            button: 'button'
        }
    }
    $.fn.triggerAccordion = function(id) {
        var isOpen = $('[data-card="' + id + '"]').hasClass('active')
        $($.fn.accordionSetup.card).find('button').html($.fn.accordionSetup.openIcon);
        $($.fn.accordionSetup.card).removeClass('active')
        $('#accordion .collapse').removeClass('show')
        if (!isOpen) {
            $('[data-card="' + id + '"]').addClass('active')
            $(id).addClass('active')
            $('[data-target="' + id + '"]').html($.fn.accordionSetup.closeIcon)
        }
    }
    $.fn.accordionInit = function() {
        $(this).find($.fn.accordionSetup.eventListener.button).click(function(e) {
            e.preventDefault()
            var id = $(this).attr('data-target');
            setTimeout(function() {
                $.fn.triggerAccordion(id)
            }, 100)
        })
    }
}(jQuery));
(function($) {
    $.fn.scrollToDiv = function() {
        $(this).click(function(e) {
            e.preventDefault();
            var el = $(this).attr('data-scroll')
            $('html, body').animate({
                scrollTop: $(el).offset().top
            }, 700);
        })
    }
}(jQuery));
(function($) {
    $.fn.circleTabs = function(options) {
        var defaults = {
            socialCircle: {
                rotate: 180,
                radius: 370,
                circleSize: 2,
                speed: 500
            },
            rotatingCircle: '.rotating-dot',
            degrees: {
                deg0: -80,
                deg1: -40,
                deg2: -5,
                deg3: 5,
                deg4: 40,
                deg5: 80
            },
            menuItems: '.circle-list',
            content: '.circle-content',
            eventListeners: {
                menu: '.circle-list > li > a'
            },
            animationIn: 'flipInY',
            animationOut: 'flipOutY'
        }
        var settings = $.extend({}, defaults, options);

        function changeTab(item) {
            var newIndex = item.parent().index()
            var oldIndex = $(settings.menuItems + ' > li.active').index()
            $(settings.menuItems + ' > li').removeClass('active')
            $(settings.menuItems + ' > li').eq(newIndex).addClass('active')
            $(settings.content + ' > li').eq(oldIndex).addClass('animated ' + settings.animationOut).delay(800).queue(function() {
                $(this).removeClass('animated ' + settings.animationOut)
                $(this).dequeue();
                $(settings.content + ' > li').eq(newIndex).addClass('animated ' + settings.animationIn).delay(1000).queue(function() {
                    $(this).removeClass(settings.animationIn + ' ' + settings.animationOut);
                    $(this).dequeue();
                });
            });
            rotateCircle(newIndex)
        }

        function rotateCircle(index) {
            $(settings.rotatingCircle).css('transform', 'rotate(' + settings.degrees['deg' + index] + 'deg)')
        }

        function init() {
            $(settings.menuItems + " li.center").socialCircle({
                rotate: settings.socialCircle.rotate,
                radius: settings.socialCircle.radius,
                circleSize: settings.socialCircle.circleSize,
                speed: settings.socialCircle.speed
            });
        }
        $(settings.eventListeners.menu).click(function(e) {
            e.preventDefault();
            changeTab($(this));
        })
        init()
    }
}(jQuery));
(function($) {
    $.fn.formSwitcher = function(options) {
        var selectedForm = 1;
        var defaults = {
            forms: [],
            startForm: 1,
            onFormChange: function() {}
        }
        var settings = $.extend({}, defaults, options);

        function displayForm() {
            if (selectedForm == 1) {
                $('.arrow').addClass('left').queue(function() {
                    $('.form-container .footer button').addClass('has-animation')
                    $('.form-container .heading').addClass('has-animation').html('<h4>' + $('#translationCalculatorFormTitleP1').val() + '<br/>' + $('#translationCalculatorFormTitleP2').val() + '</h4><div class="offer animated fadeIn"><span><h4>$5</h4><p>free</p></span></div>').delay(800).queue(function() {
                        $(this).removeClass('has-animation').addClass('animated fadeIn')
                        $(this).dequeue()
                    })
                    $('.form-container .footer h3').removeClass('animated').addClass('has-animation').delay(800).queue(function() {
                        $(this).html($('#translationCalculatorBackToProfitCal').val()).removeClass('has-animation').addClass('animated fadeIn left')
                        $(this).dequeue()
                    })
                    $(this).dequeue()
                })
            } else {
                $('.arrow').removeClass('left').queue(function() {
                    $('.form-container .heading').addClass('has-animation').delay(800).queue(function() {
                        $(this).html('<div class="col-md-5"><p>' + $('#translationCalculatorTitle').val() + '</p></div><div class="col-md-7 text-right"><h2>1,49%</h2></div>').removeClass('has-animation').addClass('animated fadeIn')
                        $(this).dequeue()
                    })
                    $('.form-container .footer h3').removeClass('animated').addClass('has-animation').delay(800).queue(function() {
                        $(this).html($('#translationCalculatorSignUpAndStartTrading').val()).removeClass('has-animation left').addClass('animated fadeIn')
                        $(this).dequeue()
                    })
                    $(this).dequeue()
                })
            }
            $('.form-container .box').removeClass('bounceIn').addClass('zoomOut').delay(500).queue(function() {
                $(this).removeClass('zoomOut').html(settings.forms[selectedForm]).addClass('animated zoomIn')
                settings.onFormChange.call({
                    selected: selectedForm
                })
                $(this).dequeue()
            })
        }

        // function init() {
        //     selectedForm = settings.startForm;
        //     displayForm()
        // }
        $('#toggleBox').click(function(e) {
            e.preventDefault();
            selectedForm == 0 ? selectedForm++ : selectedForm = 0
            displayForm()
        })
        init()
        return {
            changeForm: function(formInt) {
                selectedForm = formInt
                displayForm()
            }
        }
    }
}(jQuery));
(function($) {
    $.fn.signup = function() {
        var el = $(this)

        function validateForm() {
            if ($.fn.registerCheckFields()) {
                if ($('#g-recaptcha-response') && $('#g-recaptcha-response').val().length > 0) {
                    window.captchaCallback();
                } else {
                    $('#recaptchaModal').modal('show');
                }
            }
        }
        $(this).find('button').click(function(e) {
            e.preventDefault();
            validateForm()
        })
    }
}(jQuery));
$(function() {
    $('.circle-container').circleTabs()
    var formSwitcher = $('.form-container').formSwitcher({
        forms: ['<div class="calculator"><div class="row justify-content-between align-items-center"><div class="col-md-6 col-sm-12"><p class="mb-0 text-uppercase">' + $('#translationCalculatorCurrency').val() + '</p></div><div class="col-md-6 col-sm-12"><div class="dropdown currencies"> <button class="btn btn-secondary dropdown-toggle text-capitalize"><img src="' + $('#calculatorImagePath').val() + 'btc.svg"> Bitcoin </button> <div class="dropdown-menu"></div> </div></div></div><div class="slider"><input id="cal-range" type="range"></div><div class="amount d-flex justify-content-between align-items-center"><span><p class="small mb-0 text-uppercase">' + $('#translationCalculatorAmount').val() + '</p></span><span><input type="text" id="calculatorAmount" value="0.001"></span><span><p class="mb-0" data-currency-symbol>BTC</p></span></div><div class="row"><div class="col-sm-6"><div class="profit"><p class="mb-0 text-uppercase">' + $('#translationCalculatorDailyProfit').val() + '</p><input type="hidden" id="dailyProfit" value="1.49"><hr><h2 data-daily-profit>0.00004500</h2></div></div><div class="col-sm-6"><div class="profit"><p class="mb-0 text-uppercase">' + $('#translationCalculatorTotalProfit').val() + '</p><hr><h2 data-total-profit>0.00200000</h2></div></div></div></div>', '<div class="signup"><p id="formOutputMessage" class="text-center" style="display:none;color: #f00;"></p><div class="form-group"><input type="text" class="form-control" required value="" id="formUsername"><label>' + $('#translationCalculatorFormUsername').val() + '</label></div><div class="form-group"><input type="text" class="form-control" required value="" id="formEmail"><label>' + $('#translationCalculatorFormEmail').val() + '</label></div><div class="form-group"><input type="password" class="form-control" required value="" id="formPassword"><label>' + $('#translationCalculatorFormPassword').val() + '</label></div><div class="text-center pt-2"><button type="button" class="btn btn-lg mb-2 btn-block justify-content-center btn-primary text-uppercase">' + $('#translationCalculatorFormRegister').val() + ' <i class="fas fa-arrow-circle-right"></i></button><p class="small mb-0">' + $('#translationCalculatorFormAlreadyHaveAccount').val() + ' <a href="' + $('#redirectCabinetLoginUrl').val() + '">' + $('#translationCalculatorFormLogin').val() + '</a></p></div></div>'],
        onFormChange: function() {
            if (this.selected == 1) {
                $('.form-container form').signup();
            } else {
                var calculator = $('.calculator').calculator({
                    image_path: $('#calculatorImagePath').val(),
                    currencyButton: '.calculator .currencies button',
                    currencyDropDown: '.calculator .currencies .dropdown-menu',
                    daily_profit: parseFloat($('#dailyProfit').val()),
                    total_return: 150,
                    eventListener: {
                        currency: '.calculator .currencies button',
                        currency_items: '.calculator .currencies .dropdown-menu a'
                    },
                    onCurrencyChanged: function() {
                        console.log(this)
                    },
                    onAmountChanged: function() {
                        $("[data-daily-profit]").text(this.daily_income)
                        $("[data-total-profit]").text(this.total_profit)
                        $('#calculatorAmount').val(this.amount)
                    }
                });
                $("#cal-range").ionRangeSlider({
                    min: 0,
                    max: 25000,
                    from: 0,
                    hide_min_max: true,
                    hide_from_to: true,
                    onChange: function(data) {
                        if (data.from == 0) {
                            calculator.updateAmount(0.001)
                        } else {
                            calculator.updateAmount(data.from / 1000)
                        }
                    }
                });
                $('#calculatorAmount').keyup(function() {
                    calculator.updateAmount(parseFloat($('#calculatorAmount').val()))
                    var slider = $("#cal-range").data("ionRangeSlider");
                    slider.update({
                        from: parseFloat($('#calculatorAmount').val()) * 1000
                    });
                });
            }
        }
    })
    $('.hero .link').click(function(e) {
        e.preventDefault()
        formSwitcher.changeForm(0)
    })
    $('#goToProfitSimulator').click(function(e) {
        e.preventDefault()
        $("html, body").animate({
            scrollTop: $('#wrapper').offset().top
        }, 1500);
        formSwitcher.changeForm(0)
    })
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('#header').addClass('stuck')
            $('.navbar').addClass('navbar-light bg-light')
        } else {
            $('#header').removeClass('stuck')
            $('.navbar').removeClass('navbar-light bg-light')
        }
    })
    $('.trigger-animation').waypointsInit()
    $('[data-scroll]').scrollToDiv();
    $('#accordion').accordionInit();
});
if (typeof THREE !== 'undefined') {
    var renderer, scene, camera, ww, wh, particles;
    ww = window.innerWidth, wh = window.innerHeight;
    var centerVector = new THREE.Vector3(0, 0, 0);
    var previousTime = 0;
    var getImageData = function(image) {
        var canvas = document.createElement("canvas");
        canvas.width = image.width;
        canvas.height = image.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(image, 0, 0);
        return ctx.getImageData(0, 0, image.width, image.height);
    }
}
var drawTheMap = function() {
    if (typeof THREE === 'undefined') {
        return;
    }
    var geometry = new THREE.Geometry();
    var material = new THREE.PointsMaterial({
        size: 5,
        color: 0xffffff,
        sizeAttenuation: false
    });
    for (var y = 0, y2 = imagedata.height; y < y2; y += 2) {
        for (var x = 0, x2 = imagedata.width; x < x2; x += 2) {
            if (imagedata.data[(x * 4 + y * 4 * imagedata.width) + 3] > 128) {
                var vertex = new THREE.Vector3();
                vertex.x = Math.random() * 1000 - 500;
                vertex.y = Math.random() * 1000 - 500;
                vertex.z = -Math.random() * 500;
                vertex.destination = {
                    x: x - imagedata.width / 2,
                    y: -y + imagedata.height / 2,
                    z: 0
                };
                vertex.speed = 0.08;
                geometry.vertices.push(vertex);
            }
        }
    }
    particles = new THREE.Points(geometry, material);
    scene.add(particles);
    requestAnimationFrame(render);
};
var init = function() {
    if (typeof THREE === 'undefined' || !document.getElementById("map")) {
        return;
    }
    THREE.ImageUtils.crossOrigin = '';
    renderer = new THREE.WebGLRenderer({
        canvas: document.getElementById("map"),
        antialias: true,
        alpha: true
    });
    renderer.setSize(ww, wh);
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(50, ww / wh, 0.1, 10000);
    camera.position.set(-100, 0, 220);
    camera.lookAt(centerVector);
    scene.add(camera);
    texture = THREE.ImageUtils.loadTexture($('#imgTransparentMapSource').val(), undefined, function() {
        imagedata = getImageData(texture.image);
        drawTheMap();
    });
    window.addEventListener('resize', onResize, false);
};
var onResize = function() {
    ww = window.innerWidth;
    wh = window.innerHeight;
    renderer.setSize(ww, wh);
    camera.aspect = ww / wh;
    camera.updateProjectionMatrix();
};
var render = function(a) {
    requestAnimationFrame(render);
    for (var i = 0, j = particles.geometry.vertices.length; i < j; i++) {
        var particle = particles.geometry.vertices[i];
        particle.x += (particle.destination.x - particle.x) * particle.speed;
        particle.y += (particle.destination.y - particle.y) * particle.speed;
        particle.z += (particle.destination.z - particle.z) * particle.speed;
    }
    if (a - previousTime > 100) {
        var index = Math.floor(Math.random() * particles.geometry.vertices.length);
        var particle1 = particles.geometry.vertices[index];
        var particle2 = particles.geometry.vertices[particles.geometry.vertices.length - index];
        TweenMax.to(particle, Math.random() * 2 + 1, {
            x: particle2.x,
            y: particle2.y,
            ease: Power2.easeInOut
        });
        TweenMax.to(particle2, Math.random() * 2 + 1, {
            x: particle1.x,
            y: particle1.y,
            ease: Power2.easeInOut
        });
        previousTime = a;
    }
    particles.geometry.verticesNeedUpdate = true;
    camera.position.x = Math.sin(a / 5000) * 100;
    camera.lookAt(centerVector);
    renderer.render(scene, camera);
};
init();



// (function(){$.fn.waypointsSetup={'animationClass':'.has-animation'}
// $.fn.waypointsInit=function(){$(this).waypoint({handler:function(direction){$(this.element).find($.fn.waypointsSetup.animationClass).each(function(){var el=$(this)
// var animation=el.attr('data-animation')
// var delay=0
// if(el.attr('data-delay')){delay=el.attr('data-delay')}
// setTimeout(function(){el.addClass('animated '+animation)},delay)})}})}}(jQuery));(function($){$.fn.accordionSetup={card:'.card',openIcon:'<i class="fas fa-plus-circle"></i>',closeIcon:'<i class="fas fa-minus-circle"></i>',eventListener:{button:'button'}}
// $.fn.triggerAccordion=function(id){var isOpen=$('[data-card="'+id+'"]').hasClass('active')
// $($.fn.accordionSetup.card).find('button').html($.fn.accordionSetup.openIcon);$($.fn.accordionSetup.card).removeClass('active')
// $('#accordion .collapse').removeClass('show')
// if(!isOpen){$('[data-card="'+id+'"]').addClass('active')
// $(id).addClass('active')
// $('[data-target="'+id+'"]').html($.fn.accordionSetup.closeIcon)}}
// $.fn.accordionInit=function(){$(this).find($.fn.accordionSetup.eventListener.button).click(function(e){e.preventDefault()
// var id=$(this).attr('data-target');setTimeout(function(){$.fn.triggerAccordion(id)},100)})}}(jQuery));(function($){$.fn.scrollToDiv=function(){$(this).click(function(e){e.preventDefault();var el=$(this).attr('data-scroll')
// $('html, body').animate({scrollTop:$(el).offset().top},700);})}}(jQuery));(function($){$.fn.circleTabs=function(options){var defaults={socialCircle:{rotate:180,radius:370,circleSize:2,speed:500},rotatingCircle:'.rotating-dot',degrees:{deg0:-80,deg1:-40,deg2:-5,deg3:5,deg4:40,deg5:80},menuItems:'.circle-list',content:'.circle-content',eventListeners:{menu:'.circle-list > li > a'},animationIn:'flipInY',animationOut:'flipOutY'}
// var settings=$.extend({},defaults,options);function changeTab(item){var newIndex=item.parent().index()
// var oldIndex=$(settings.menuItems+' > li.active').index()
// $(settings.menuItems+' > li').removeClass('active')
// $(settings.menuItems+' > li').eq(newIndex).addClass('active')
// $(settings.content+' > li').eq(oldIndex).addClass('animated '+settings.animationOut).delay(800).queue(function(){$(this).removeClass('animated '+settings.animationOut)
// $(this).dequeue();$(settings.content+' > li').eq(newIndex).addClass('animated '+settings.animationIn).delay(1000).queue(function(){$(this).removeClass(settings.animationIn+' '+settings.animationOut);$(this).dequeue();});});rotateCircle(newIndex)}
// function rotateCircle(index){$(settings.rotatingCircle).css('transform','rotate('+settings.degrees['deg'+index]+'deg)')}
// function init(){$(settings.menuItems+" li.center").socialCircle({rotate:settings.socialCircle.rotate,radius:settings.socialCircle.radius,circleSize:settings.socialCircle.circleSize,speed:settings.socialCircle.speed});}
// $(settings.eventListeners.menu).click(function(e){e.preventDefault();changeTab($(this));})
// init()}}(jQuery));(function($){$.fn.formSwitcher=function(options){var selectedForm=1;var defaults={forms:[],startForm:1,onFormChange:function(){}}
// var settings=$.extend({},defaults,options);function displayForm(){if(selectedForm==1){$('.arrow').addClass('left').queue(function(){$('.form-container .footer button').addClass('has-animation')
// $('.form-container .heading').addClass('has-animation').html('<h4>'+$('#translationCalculatorFormTitleP1').val()+'<br/>'+$('#translationCalculatorFormTitleP2').val()+'</h4><div class="offer animated fadeIn"><span><h4>$5</h4><p>free</p></span></div>').delay(800).queue(function(){$(this).removeClass('has-animation').addClass('animated fadeIn')
// $(this).dequeue()})
// $('.form-container .footer h3').removeClass('animated').addClass('has-animation').delay(800).queue(function(){$(this).html($('#translationCalculatorBackToProfitCal').val()).removeClass('has-animation').addClass('animated fadeIn left')
// $(this).dequeue()})
// $(this).dequeue()})}else{$('.arrow').removeClass('left').queue(function(){$('.form-container .heading').addClass('has-animation').delay(800).queue(function(){$(this).html('<div class="col-md-5"><p>'+$('#translationCalculatorTitle').val()+'</p></div><div class="col-md-7 text-right"><h2>1,49%</h2></div>').removeClass('has-animation').addClass('animated fadeIn')
// $(this).dequeue()})
// $('.form-container .footer h3').removeClass('animated').addClass('has-animation').delay(800).queue(function(){$(this).html($('#translationCalculatorSignUpAndStartTrading').val()).removeClass('has-animation left').addClass('animated fadeIn')
// $(this).dequeue()})
// $(this).dequeue()})}
// $('.form-container .box').removeClass('bounceIn').addClass('zoomOut').delay(500).queue(function(){$(this).removeClass('zoomOut').html(settings.forms[selectedForm]).addClass('animated zoomIn')
// settings.onFormChange.call({selected:selectedForm})
// $(this).dequeue()})}
// function init(){selectedForm=settings.startForm;displayForm()}
// $('#toggleBox').click(function(e){e.preventDefault();selectedForm==0?selectedForm++:selectedForm=0
// displayForm()})
// init()
// return{changeForm:function(formInt){selectedForm=formInt
// displayForm()}}}}(jQuery));(function($){$.fn.signup=function(){var el=$(this)
// function validateForm(){if($.fn.registerCheckFields()){if($('#g-recaptcha-response')&&$('#g-recaptcha-response').val().length>0){window.captchaCallback();}else{$('#recaptchaModal').modal('show');}}}
// $(this).find('button').click(function(e){e.preventDefault();validateForm()})}}(jQuery));$(function(){$('.circle-container').circleTabs()
// var formSwitcher=$('.form-container').formSwitcher({forms:['<div class="calculator"><div class="row justify-content-between align-items-center"><div class="col-md-6 col-sm-12"><p class="mb-0 text-uppercase">'+$('#translationCalculatorCurrency').val()+'</p></div><div class="col-md-6 col-sm-12"><div class="dropdown currencies"> <button class="btn btn-secondary dropdown-toggle text-capitalize"><img src="'+$('#calculatorImagePath').val()+'btc.svg"> Bitcoin </button> <div class="dropdown-menu"></div> </div></div></div><div class="slider"><input id="cal-range" type="range"></div><div class="amount d-flex justify-content-between align-items-center"><span><p class="small mb-0 text-uppercase">'+$('#translationCalculatorAmount').val()+'</p></span><span><input type="text" id="calculatorAmount" value="0.001"></span><span><p class="mb-0" data-currency-symbol>BTC</p></span></div><div class="row"><div class="col-sm-6"><div class="profit"><p class="mb-0 text-uppercase">'+$('#translationCalculatorDailyProfit').val()+'</p><input type="hidden" id="dailyProfit" value="1.49"><hr><h2 data-daily-profit>0.00004500</h2></div></div><div class="col-sm-6"><div class="profit"><p class="mb-0 text-uppercase">'+$('#translationCalculatorTotalProfit').val()+'</p><hr><h2 data-total-profit>0.00200000</h2></div></div></div></div>','<div class="signup"><p id="formOutputMessage" class="text-center" style="display:none;color: #f00;"></p><div class="form-group"><input type="text" class="form-control" required value="" id="formUsername"><label>'+$('#translationCalculatorFormUsername').val()+'</label></div><div class="form-group"><input type="text" class="form-control" required value="" id="formEmail"><label>'+$('#translationCalculatorFormEmail').val()+'</label></div><div class="form-group"><input type="password" class="form-control" required value="" id="formPassword"><label>'+$('#translationCalculatorFormPassword').val()+'</label></div><div class="text-center pt-2"><button type="button" class="btn btn-lg mb-2 btn-block justify-content-center btn-primary text-uppercase">'+$('#translationCalculatorFormRegister').val()+' <i class="fas fa-arrow-circle-right"></i></button><p class="small mb-0">'+$('#translationCalculatorFormAlreadyHaveAccount').val()+' <a href="'+$('#redirectCabinetLoginUrl').val()+'">'+$('#translationCalculatorFormLogin').val()+'</a></p></div></div>'],onFormChange:function(){if(this.selected==1){$('.form-container form').signup();}else{var calculator=$('.calculator').calculator({image_path:$('#calculatorImagePath').val(),currencyButton:'.calculator .currencies button',currencyDropDown:'.calculator .currencies .dropdown-menu',daily_profit:parseFloat($('#dailyProfit').val()),total_return:150,eventListener:{currency:'.calculator .currencies button',currency_items:'.calculator .currencies .dropdown-menu a'},onCurrencyChanged:function(){console.log(this)},onAmountChanged:function(){$("[data-daily-profit]").text(this.daily_income)
// $("[data-total-profit]").text(this.total_profit)
// $('#calculatorAmount').val(this.amount)}});$("#cal-range").ionRangeSlider({min:0,max:25000,from:0,hide_min_max:true,hide_from_to:true,onChange:function(data){if(data.from==0){calculator.updateAmount(0.001)}else{calculator.updateAmount(data.from/1000)}}});$('#calculatorAmount').keyup(function(){calculator.updateAmount(parseFloat($('#calculatorAmount').val()))
// var slider=$("#cal-range").data("ionRangeSlider");slider.update({from:parseFloat($('#calculatorAmount').val())*1000});});}}})
// $('.hero .link').click(function(e){e.preventDefault()
// formSwitcher.changeForm(0)})
// $('#goToProfitSimulator').click(function(e){e.preventDefault()
// $("html, body").animate({scrollTop:$('#wrapper').offset().top},1500);formSwitcher.changeForm(0)})
// $(window).scroll(function(){if($(this).scrollTop()>200){$('#header').addClass('stuck')
// $('.navbar').addClass('navbar-light bg-light')}else{$('#header').removeClass('stuck')
// $('.navbar').removeClass('navbar-light bg-light')}})
// $('.trigger-animation').waypointsInit()
// $('[data-scroll]').scrollToDiv();$('#accordion').accordionInit();});if(typeof THREE!=='undefined'){var renderer,scene,camera,ww,wh,particles;ww=window.innerWidth,wh=window.innerHeight;var centerVector=new THREE.Vector3(0,0,0);var previousTime=0;var getImageData=function(image){var canvas=document.createElement("canvas");canvas.width=image.width;canvas.height=image.height;var ctx=canvas.getContext("2d");ctx.drawImage(image,0,0);return ctx.getImageData(0,0,image.width,image.height);}}
// var drawTheMap=function(){if(typeof THREE==='undefined'){return;}
// var geometry=new THREE.Geometry();var material=new THREE.PointsMaterial({size:5,color:0xffffff,sizeAttenuation:false});for(var y=0,y2=imagedata.height;y<y2;y+=2){for(var x=0,x2=imagedata.width;x<x2;x+=2){if(imagedata.data[(x*4+y*4*imagedata.width)+3]>128){var vertex=new THREE.Vector3();vertex.x=Math.random()*1000-500;vertex.y=Math.random()*1000-500;vertex.z=-Math.random()*500;vertex.destination={x:x-imagedata.width/2,y:-y+imagedata.height/2,z:0};vertex.speed=0.08;geometry.vertices.push(vertex);}}}
// particles=new THREE.Points(geometry,material);scene.add(particles);requestAnimationFrame(render);};var init=function(){if(typeof THREE==='undefined'||!document.getElementById("map")){return;}
// THREE.ImageUtils.crossOrigin='';renderer=new THREE.WebGLRenderer({canvas:document.getElementById("map"),antialias:true,alpha:true});renderer.setSize(ww,wh);scene=new THREE.Scene();camera=new THREE.PerspectiveCamera(50,ww/wh,0.1,10000);camera.position.set(-100,0,220);camera.lookAt(centerVector);scene.add(camera);texture=THREE.ImageUtils.loadTexture($('#imgTransparentMapSource').val(),undefined,function(){imagedata=getImageData(texture.image);drawTheMap();});window.addEventListener('resize',onResize,false);};var onResize=function(){ww=window.innerWidth;wh=window.innerHeight;renderer.setSize(ww,wh);camera.aspect=ww/wh;camera.updateProjectionMatrix();};var render=function(a){requestAnimationFrame(render);for(var i=0,j=particles.geometry.vertices.length;i<j;i++){var particle=particles.geometry.vertices[i];particle.x+=(particle.destination.x-particle.x)*particle.speed;particle.y+=(particle.destination.y-particle.y)*particle.speed;particle.z+=(particle.destination.z-particle.z)*particle.speed;}
// if(a-previousTime>100){var index=Math.floor(Math.random()*particles.geometry.vertices.length);var particle1=particles.geometry.vertices[index];var particle2=particles.geometry.vertices[particles.geometry.vertices.length-index];TweenMax.to(particle,Math.random()*2+1,{x:particle2.x,y:particle2.y,ease:Power2.easeInOut});TweenMax.to(particle2,Math.random()*2+1,{x:particle1.x,y:particle1.y,ease:Power2.easeInOut});previousTime=a;}
// particles.geometry.verticesNeedUpdate=true;camera.position.x=Math.sin(a/5000)*100;camera.lookAt(centerVector);renderer.render(scene,camera);};init();