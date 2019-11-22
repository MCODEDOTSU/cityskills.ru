(function( $ ) {

    var autoSliderTimer = 0;
    var autoSliderTimerPause = false;
    
    $.fn.mcodeSlider = function(dt = 0) {
        this.addClass('init');
        slidersInit(this);
        pageButtonInit(this);
        $slider = this;
        if(dt !== 0) {
            autoSliderTimer = dt;
            setTimeout(function() { autoSlider($slider); }, autoSliderTimer);
        }
        appendLoader($slider);
    };

    function mcodeSlideNext($slider) {
        $current = jQuery('.mcode-slider-item.current', $slider);
        $next = $current.next('.mcode-slider-item ');
        if(!$next.length) $next = jQuery('.mcode-slider-item', $slider).eq(0);
        mcodeSlideSetPage($slider, $next.data('index'));
    }

    function mcodeSlidePrev($slider) {
        $current = jQuery('.mcode-slider-item.current', jQuery(this));
        $prev = $current.prev('.mcode-slider-item');
        if(!$prev.length) $prev = jQuery('.mcode-slider-item', jQuery(this)).last();
        mcodeSlideSetPage($slider, $prev.data('index'));
    }

    function mcodeSlideSetPage($slider, page) {
        jQuery('.mcode-slider-item.current', $slider).removeClass('current');
        jQuery('.mcode-slider-item', $slider).eq(page).addClass('current');
        jQuery('.pages .page.current', $slider).removeClass('current');
        jQuery('.pages .page', $slider).eq(page).addClass('current');

        //loader
        appendLoader($slider);
    }

    function slidersInit($slider) {
        jQuery('.mcode-slider-item', $slider).each(function(i, value) {
            jQuery(this).data('index', i);
        });
    }

    function pageButtonInit($slider) {
        jQuery('.page', $slider).each((i, value) => {
            jQuery(value).on('click', () => {
                autoSliderTimerPause = true;
                mcodeSlideNext($slider);
            });
        });
    }

    function appendLoader($slider) {
        $loader = jQuery('.mcode-slider-loader', $slider).eq(0).clone().addClass('clone-loader');
        jQuery('.clone-loader', $slider).remove();
        jQuery('.pages .page.current', $slider).append($loader);
        $loader.show(200);
    }

    function autoSlider($slider) {
        if(autoSliderTimer === 0) { return; }
        if(!autoSliderTimerPause) {
            mcodeSlideNext($slider);
        }
        autoSliderTimerPause = false;
        setTimeout(function() { autoSlider($slider); }, autoSliderTimer);
    }

})(jQuery);