var AppConfig = $.extend(true, {
    systemLanguage: 'uk',
    userTimeZone: '',
    domain: '',
    httpScheme: ''
}, (typeof AppConfig !== 'undefined' ? AppConfig : {}));

var SiteCore = function (options) {
    return {
        init: function () {
            this.initPNotify();

            $.fn.extend({
                equalHeights: function (options) {
                    var ah = (Math.max.apply(null, $(this).map(function () {
                        return $(this).height();
                    }).get()));
                    if (typeof ah === 'number') $(this).height(ah);
                }
            });

            var IS_IOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

            if (IS_IOS) {
                document.documentElement.classList.add('ios');
            }

            $('.news-item.small').equalHeights();
            $(window).resize(function () {
                $('.news-item.small').equalHeights();
            }).trigger('resize');
        },
        initPNotify: function () {
            var $flashMessages = $('#flash-messages').find('.message');

            if ($flashMessages.length) {
                $flashMessages.each(function (i) {
                    var $msg = $(this);

                    new PNotify({
                        title: $msg.data('title'),
                        text: $msg.text(),
                        icon: $msg.data('icon'),
                        type: $msg.data('style'),
                        delay: 6000 //Show the notification 4sec
                    });
                });
            }
        },
        getCsrfToken: function () {
            var token = $('meta[name="csrf-token"]').attr("content");
            return (typeof token !== 'undefined' ? token : null);
        },
        t: function (key, params, lang) {
            lang = lang || AppConfig.systemLanguage;
            params = params || {};

            var keys = key.split('.'),
                result = undefined,
                keysStr = '';

            for (var i in keys) {
                keysStr += '["' + keys[i] + '"]';
            }

            if (keysStr) {
                result = eval('Translations["' + lang + '"]' + keysStr + ';');
            }

            if (result && params) {
                for (var paramName in params) {
                    result = result.replace(new RegExp('\{' + paramName + '\}', 'g'), params[paramName]);
                }
            }

            return result;
        }
    }
}();

$(function () {
    SiteCore.init();
});