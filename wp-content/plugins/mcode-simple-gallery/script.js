(function ($) {
    $(document).ready(function () {
        $('.simple-page .gallery').mcodeSimpleGallery();
    });
})(jQuery);

(function ($) {

    let methods = {

        /**
         * Инициализация
         * @returns {*|void}
         * @param options
         */
        init: function (options) {

            /**
             * Id, Class
             */
            this.attr('id', `mcode-${this.attr('id')}`);
            this.addClass('mcode-gallery');

            /**
             * Container
             */
            this.wrapInner('<div class="container"><div class="gallery-items"></div></div>');
            let width = 0;
            $('.gallery-item', this).each(function () {
                width += ($(this).width() + 10);
            });
            $('.gallery-items', this).width(width - 10);

            /**
             * Next, Prev Buttons
             */
            this.append('<div class="btn btn-prev fa fa-angle-left"></div><div class="btn btn-next fa fa-angle-right"></div>');
            let param = {width: $(this).outerWidth(), min: -1 * (width - this.width() - 10), max: 0};
            $('.btn-prev', this).on('click', (events, selector, data, handler) => {
                methods.prev.apply(this, [param]);
            });
            $('.btn-next', this).on('click', (events, selector, data, handler) => {
                methods.next.apply(this, [param]);
            });

            /**
             * BR remove
             */
            $('br', this).remove();

        },

        next: function (options) {
            let margin = parseInt($('.gallery-items', this).css('margin-left').replace('px', ''), 10);
            margin -= options.width;
            margin = margin < options.min ? options.min : margin;
            $('.gallery-items', this).css('margin-left', margin);
        },

        prev: function (options) {
            let margin = parseInt($('.gallery-items', this).css('margin-left').replace('px', ''), 10);
            margin += options.width;
            margin = margin > options.max ? options.max : margin;
            $('.gallery-items', this).css('margin-left', margin);
        },


    };

    $.fn.mcodeSimpleGallery = function (options) {
        return methods.init.apply(this, arguments);
    };

})(jQuery);