(function($) {
    $.fn.calculator = function(options) {
        var selected_currency = 'bitcoin';
        var amount = 0;
        var currency_list_active = false;
        var defaults = {
            currencyDropDown: null,
            currencyButton: null,
            eventListener: {
                currency: null,
                currency_items: null
            },
            image_path: '',
            currencies: [{
                'bitcoin': 'BTC'
            }, {
                'ethereum': 'ETH'
            },  ],
            daily_profit: null,
            total_return: null,
            onCurrencyChanged: function() {},
            onAmountChanged: function() {}
        };
        var settings = $.extend({}, defaults, options);

        function addDaysToDate(daysToAdd) {
            var currentDate = new Date(new Date().getTime() + daysToAdd * 24 * 60 * 60 * 1000);
            var dd = currentDate.getDate();
            var mm = currentDate.getMonth() + 1;
            var y = currentDate.getFullYear();
            return dd + '/' + mm + '/' + y;
        }

        function calculate() {
            settings.onAmountChanged.call({
                total_profit: ((((settings.total_return / 100) / (settings.daily_profit / 100)) * ((settings.daily_profit / 100) * amount))).toFixed(8),
                daily_income: (amount * (settings.daily_profit / 100)).toFixed(8),
                amount: amount
            })
        }

        function openCurrencyList() {
            currency_list_active = true
            $(settings.currencyDropDown).addClass('is-dropped animated flipInX').delay(300).queue(function() {
                $(this).removeClass('animated flipInX')
                $(this).dequeue()
                $('.dropdown.currencies .dropdown-menu a').each(function(i) {
                    var el = $(this)
                    setTimeout(function() {
                        el.addClass('animated bounceIn')
                    }, 50 * i)
                })
            })
        }

        function closeCurrencyList() {
            currency_list_active = false
            $(settings.currencyDropDown).addClass('animated flipOutX').delay(1000).queue(function() {
                $(this).removeClass('is-dropped animated flipOutX')
                $(settings.currencyDropDown).find('a').removeClass('animated bounceIn')
                $(this).dequeue()
            })
        }

        function updateSelectedCurrency() {
            settings.currencies.forEach(function(i) {
                for (var o in i) {
                    if (o == selected_currency) {
                        $('[data-currency-symbol]').html(i[o])
                    }
                }
            })
            $(settings.currencyButton).html($('[data-currency="' + selected_currency + '"]').html())
        }
        settings.currencies.forEach(function(i) {
            for (var o in i) {
                $(settings.currencyDropDown).append('<a class="dropdown-item text-capitalize" href="#" data-currency="' + o + '"><img src="' + settings.image_path + i[o].toLowerCase() + '.svg">' + o + '</a>')
            }
        })
        $(document).on('click', settings.eventListener.currency, function(e) {
            e.preventDefault();
            e.stopPropagation();
            openCurrencyList();
        })
        $(document).on('click', settings.eventListener.currency_items, function(e) {
            e.preventDefault();
            e.stopPropagation();
            selected_currency = $(this).attr('data-currency')
            updateSelectedCurrency()
            settings.onCurrencyChanged.call({
                currency: selected_currency
            })
        })
        $('body').on('click', function(e) {
            if (currency_list_active) {
                closeCurrencyList();
            }
        });
        return {
            updateAmount: function(val) {
                amount = parseFloat(val);
                if (!isNaN(amount) && amount > 0) {
                    calculate()
                }
            }
        }
    }
}(jQuery));




// (function($){$.fn.calculator=function(options){var selected_currency='bitcoin';var amount=0;var currency_list_active=false;var defaults={currencyDropDown:null,currencyButton:null,eventListener:{currency:null,currency_items:null},image_path:'',currencies:[{'bitcoin':'BTC'},{'litecoin':'LTC'},{'ethereum':'ETH'},{'dash':'DASH'},{'bitcoin cash':'BCH'},],daily_profit:null,total_return:null,onCurrencyChanged:function(){},onAmountChanged:function(){}};var settings=$.extend({},defaults,options);function addDaysToDate(daysToAdd){var currentDate=new Date(new Date().getTime()+daysToAdd*24*60*60*1000);var dd=currentDate.getDate();var mm=currentDate.getMonth()+1;var y=currentDate.getFullYear();return dd+'/'+mm+'/'+y;}
// function calculate(){settings.onAmountChanged.call({total_profit:((((settings.total_return/100)/(settings.daily_profit/100))*((settings.daily_profit/100)*amount))).toFixed(8),daily_income:(amount*(settings.daily_profit/100)).toFixed(8),amount:amount})}
// function openCurrencyList(){currency_list_active=true
// $(settings.currencyDropDown).addClass('is-dropped animated flipInX').delay(300).queue(function(){$(this).removeClass('animated flipInX')
// $(this).dequeue()
// $('.dropdown.currencies .dropdown-menu a').each(function(i){var el=$(this)
// setTimeout(function(){el.addClass('animated bounceIn')},50*i)})})}
// function closeCurrencyList(){currency_list_active=false
// $(settings.currencyDropDown).addClass('animated flipOutX').delay(1000).queue(function(){$(this).removeClass('is-dropped animated flipOutX')
// $(settings.currencyDropDown).find('a').removeClass('animated bounceIn')
// $(this).dequeue()})}
// function updateSelectedCurrency(){settings.currencies.forEach(function(i){for(var o in i){if(o==selected_currency){$('[data-currency-symbol]').html(i[o])}}})
// $(settings.currencyButton).html($('[data-currency="'+selected_currency+'"]').html())}
// settings.currencies.forEach(function(i){for(var o in i){$(settings.currencyDropDown).append('<a class="dropdown-item text-capitalize" href="#" data-currency="'+o+'"><img src="'+settings.image_path+i[o].toLowerCase()+'.svg">'+o+'</a>')}})
// $(document).on('click',settings.eventListener.currency,function(e){e.preventDefault();e.stopPropagation();openCurrencyList();})
// $(document).on('click',settings.eventListener.currency_items,function(e){e.preventDefault();e.stopPropagation();selected_currency=$(this).attr('data-currency')
// updateSelectedCurrency()
// settings.onCurrencyChanged.call({currency:selected_currency})})
// $('body').on('click',function(e){if(currency_list_active){closeCurrencyList();}});return{updateAmount:function(val){amount=parseFloat(val);if(!isNaN(amount)&&amount>0){calculate()}}}}}(jQuery));