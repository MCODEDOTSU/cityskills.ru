(function( $ ) {

    let methods = {

        /**
         * Инициализация
         * @returns {*|void}
         * @param options
         */
        init: function(options) {

            if(options.speed && options.speed !== 0) {
                let delay = options.delay ? options.delay : 0;
                setTimeout( () => { methods.auto.apply(this, arguments); }, delay);
            }

            if($('.pagination', this).length != 0) {
                $('.pagination .page', this).eq(0).addClass('current');
                $('.pagination .page', this).on('click', (events, selector, data, handler) => {
                    methods.page.apply(this, [ $(events.currentTarget).data('page') ] );
                });
                $('.pagination .next-page', this).on('click', (events, selector, data, handler) => {
                    methods.next.apply(this, arguments);
                });
                $('.pagination .prev-page', this).on('click', (events, selector, data, handler) => {
                    methods.prev.apply(this, arguments);
                });
            }

            return this.each(function() {
                $('> .slider-item', this).addClass('news-slider-item').eq(0).addClass('current');
            });

        },

        next: function() {
            $current = $('.news-slider-item.current', this);
            $next = $current.next('.news-slider-item');
            if(!$next.length) $next = $('.news-slider-item', this).eq(0);
            methods.page.apply(this, [ $('.news-slider-item', this).index($next) ] );
        },

        prev: function() {
            $current = $('.news-slider-item.current', this);
            $prev = $current.prev('.news-slider-item');
            if(!$prev.length) $prev = $('.news-slider-item', this).last();
            methods.page.apply(this, [ $('.news-slider-item', this).index($prev) ] );
        },

        page: function(page) {
            $('.news-slider-item.current', this).removeClass('current');
            $('.news-slider-item', this).eq(page).addClass('current');
            if($('.pagination', this).length != 0) {
                $('.pagination .page.current', this).removeClass('current');
                $('.pagination .page', this).eq(page).addClass('current');
            }
        },

        auto: function(options) {
            if(options.speed === 0) {
                return;
            }
            methods.next.apply(this);
            setTimeout( () => { methods.auto.apply(this, arguments); }, options.speed);
        },

    };

    $.fn.mcodeNewsSlider = function(options) {
        return methods.init.apply(this, arguments);
    };

})(jQuery);