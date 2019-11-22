jQuery(document).ready(function () {
    jQuery('.mcode-slider').each(function () {
        let tm = jQuery(this).data('speed') * 1000;
        jQuery(this).mcodeSlider(tm);
    });
});