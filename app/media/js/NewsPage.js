var NewsPage = function (options) {
    var pageOptions = $.extend(true, {
        loadMoreUrl: '',
        category: 'all'
    }, options);

    var selectors = {
        newsList: '#news-list'
    };

    $('body').on('click', '#load-more-news', function (e) {
        e.preventDefault();

        var $loadMore = $(this),
            lastId = parseInt($loadMore.attr('data-last-id'));

        $.post(
            pageOptions.loadMoreUrl,
            {
                lastId: lastId, category: pageOptions.category, _csrf: SiteCore.getCsrfToken()
            },
            function (response) {
                if (typeof response.items !== 'undefined') {
                    $(selectors.newsList).append(response.items);
                }

                if (response.items !== 'undefined' && response.items) {
                    if (response.hasToLoadMore === true) {
                        $loadMore.attr('data-last-id', response.lastItemId);
                    } else {
                        $loadMore.remove();
                    }
                } else {
                    $loadMore.remove();
                }
            }, 'json')
            .then(function () {
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy"
            });
        });

        $loadMore.blur();
        $(window).trigger('resize');
    });
};
