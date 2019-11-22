jQuery(document).ready(function (e) {
    searchformInit();
    sliderScrollInit();
    fullscreenMenuInit();
    newsSliderInit();
    pageMenuInit();
    btnUpInit();

    jQuery(".fancybox-click").fancybox({
        'titlePosition': 'inside',
        'transitionIn': 'none',
        'transitionOut': 'none',
        'titleShow': false
    });
});

function searchformInit() {
    jQuery('#searchform-container .btn-cross').click(() => {
        jQuery('#searchform-container').addClass('hidden');
    });
    jQuery('#searchform-show').click(() => {
        jQuery('#searchform-container').removeClass('hidden');
    });
}

function sliderScrollInit() {
    let $window = jQuery(window);
    $window.on('load scroll', function () {
        if ($window.scrollTop() >= 300) {
            if (!jQuery('.homepage-slider').hasClass('hidden')) {
                jQuery('.homepage-slider').addClass('hidden');
                jQuery('.homepage-container').addClass('scroll');
            }
        } else {
            if (jQuery('.homepage-slider').hasClass('hidden')) {
                jQuery('.homepage-slider').removeClass('hidden');
                jQuery('.homepage-container').removeClass('scroll');
            }
        }
    });
}

function fullscreenMenuInit() {
    jQuery('#fullscreenmenu .close-menu').click(() => {
        jQuery('html, body').removeClass('noscroll');
        jQuery(window).scrollTop(jQuery('#fullscreenmenu').data('scroll'));
        jQuery('#fullscreenmenu').removeClass('visibility');
    });
    jQuery('.fullscreenmenu-show').click(() => {
        jQuery('#fullscreenmenu').data('scroll', jQuery(window).scrollTop());
        jQuery('#fullscreenmenu').addClass('visibility');
        jQuery('html, body').addClass('noscroll');
    });
}

function newsSliderInit() {
    jQuery('#opinion-slider-items').mcodeNewsSlider({delay: 5000, speed: 10000});
    jQuery('#tv-block-slider-items').mcodeNewsSlider({delay: 10000, speed: 10000});
    jQuery('#slider-news').mcodeNewsSlider({speed: 0});
}

function pageMenuInit() {
    jQuery('.simple-page nav.menu .menu > li, .simple-page nav.menu .sub-menu .menu-item-has-children').append(
        '<i class="fa fa-caret-down drop-down-menu"></i>'
    );

    jQuery('.simple-page nav.menu .current-menu-ancestor .drop-down-menu').removeClass('fa-caret-down').addClass('fa-caret-up');
    jQuery('.simple-page nav.menu .current-menu-ancestor > .sub-menu').css('height', 'auto');
    jQuery('.simple-page nav.menu .current-menu-ancestor').addClass('child-visibility');
    jQuery('.simple-page nav.menu .current-menu-item.menu-item-has-children').each(function () {
        jQuery(' > .drop-down-menu', jQuery(this)).removeClass('fa-caret-down').addClass('fa-caret-up');
        let height = jQuery(' > .sub-menu', jQuery(this)).css('height', 'auto').height();
        jQuery(' > .sub-menu', jQuery(this)).css('height', 0).animate({height: height}, 300);
        let $parent = jQuery(this).parent('.sub-menu');
        if ($parent.length !== 0) {
            let parentHeight = $parent.height();
            $parent.animate({height: (height + parentHeight)}, 300);
        }
    });
    jQuery('.simple-page nav.menu .current-post-ancestor').each(function () {
        jQuery(' > .drop-down-menu', jQuery(this)).removeClass('fa-caret-down').addClass('fa-caret-up');
        let height = jQuery(' > .sub-menu', jQuery(this)).css('height', 'auto').height();
        jQuery(' > .sub-menu', jQuery(this)).css('height', 0).animate({height: height}, 300);
    });

    jQuery('.simple-page nav.menu .drop-down-menu').on('click', function () {
        jQuery(this).parent('li').toggleClass('child-visibility');
        if (jQuery(this).parent('li').hasClass('child-visibility')) {
            jQuery(' > .drop-down-menu', jQuery(this).parent('li')).removeClass('fa-caret-down').addClass('fa-caret-up');
            let height = jQuery(' > .sub-menu', jQuery(this).parent('li')).css('height', 'auto').height();
            jQuery(' > .sub-menu', jQuery(this).parent('li')).css('height', 0).animate({height: height}, 300);
            let $parent = jQuery(this).parent('li').parent('.sub-menu');
            if ($parent.length !== 0) {
                let parentHeight = $parent.height();
                $parent.animate({height: (height + parentHeight)}, 300);
            }
        } else {
            let height = jQuery(' > .sub-menu', jQuery(this).parent('li')).height();
            jQuery(' > .drop-down-menu', jQuery(this).parent('li')).addClass('fa-caret-down').removeClass('fa-caret-up');
            jQuery(' > .sub-menu', jQuery(this).parent('li')).animate({height: 0}, 200);
            let $parent = jQuery(this).parent('li').parent('.sub-menu');
            if ($parent.length !== 0) {
                let parentHeight = $parent.height();
                $parent.animate({height: (parentHeight - height)}, 300);
            }
        }
    });
}

function btnUpInit() {
    jQuery('#btn-up').on('click', function () {
        jQuery('html, body').animate({scrollTop: 0}, 500);
    });
    let $window = jQuery(window);
    $window.on('load scroll', function () {
        if ($window.scrollTop() >= 300) {
            jQuery('#btn-up').addClass('shown');
        } else {
            jQuery('#btn-up').removeClass('shown');
        }
    });
}

/***
 Загрузка инфографики
 */
function loadInfografics() {
    let top = jQuery('#infographics input[name="top"]').val();
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: {action: 'get_infografics', name: jQuery('#infographics input[name="slug"]').val(), top: top},
        dataType: 'json',
        success: function (response) {
            jQuery('#infographics .left-post-list').append(response['left']);
            jQuery('#infographics .right-post-list').append(response['right']);
            jQuery('#infographics input[name="top"]').val(parseInt(top, 10) + 1)
        }
    });
}

/***
 * Переключения типа полезного материала
 */
function setTypeMaterial(e) {
    jQuery('#device input[name="type"]').val(jQuery(e.target).data('type'));
    jQuery('.btn', jQuery(e.target).parent()).removeClass('active');
    jQuery(e.target).addClass('active');
    loadMaterials();
}

/***
 Загрузка полезных материалов
 */
function loadMaterials() {
    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: 'get_materials',
            category: jQuery('#device input[name="category"]').val(),
            type: jQuery('#device input[name="type"]').val()
        },
        dataType: 'json',
        success: function (response) {
            jQuery('#device .device-wrapper').html(response['pc']);
            jQuery('#mdevice .device-wrapper').html(response['mb']);
            jQuery("#device .fancybox, #mdevice .fancybox").fancybox({
                width: Math.min(jQuery(window).innerWidth() - 40, 900),
                height: jQuery(window).innerHeight() - 40,
                padding: 0,
                onComplete: () => {
                    let href = jQuery('#fancybox-content object').attr('data');
                    jQuery('#fancybox-outer #download-button').remove();
                    jQuery('#fancybox-outer').append(`<a href="${href}" id="download-button" download>Скачать</a>`);
                }
            });
        }
    });
}

/***
 Переключение вида новостей, фильтр в списке новостей
 */

(function ($) {

    function btnViewInit() {

        let currentView = localStorage['category_list_setting_view'] ? localStorage['category_list_setting_view'] : 'large';
        setCategorySettingView(currentView);

        $('.category-list-setting .setting-view .large').click(function () {
            setCategorySettingView('large');
        });
        $('.category-list-setting .setting-view .list').click(function () {
            setCategorySettingView('list');
        });
    }

    function setCategorySettingView(type) {
        $('.post-list.customizable').fadeOut(100, function () {
            localStorage['category_list_setting_view'] = type;
            $('.category-list-setting .setting-view .btn').removeClass('active');
            $(`.category-list-setting .setting-view .btn.${type}`).addClass('active');
            $('.post-list.customizable').removeClass((type == 'list' ? 'large' : 'list'));
            $('.post-list.customizable').addClass(type);
            $('.post-list.customizable').fadeIn(100);
        });
    }

    function btnDateInit() {

        $('.category-list-setting .setting-date .btn').click(function () {
            $('.category-list-setting .calendar').toggleClass('shown');
        });

        let month = $('.category-list-setting .calendar .current-month').val();
        if (month !== 0) {
            $(`.category-list-setting .calendar .month .btn[data-item="${month}"]`).addClass('active');
        }

        $('.category-list-setting .calendar .month .btn').click(function () {
            let year = $('.category-list-setting .calendar .current-year').val();
            let month = $(this).data('item');
            let search = window.location.search.replace(/\&?y=\d+/, '')
                .replace(/\&?m=\d+/, '');
            search = search === "" ? "?" : search;
            window.location = `${window.location.pathname}${search}&y=${year}&m=${month}`;
        });
        $('.category-list-setting .calendar .clean').click(function () {
            let search = window.location.search.replace(/\&?y=\d+/, '')
                .replace(/\&?m=\d+/, '');
            window.location = window.location.pathname + (search === '?' ? '' : search);
        });

        $('.category-list-setting .calendar .year .prev').click(function () {
            let year = parseInt($('.category-list-setting .calendar .current-year').val(), 10);
            setYear(year == 2010 ? 2010 : (year - 1));
        });

        $('.category-list-setting .calendar .year .next').click(function () {
            let year = parseInt($('.category-list-setting .calendar .current-year').val(), 10);
            setYear(year == (new Date().getFullYear()) ? (new Date().getFullYear()) : (year + 1));
        });
    }

    function setYear(year) {
        $('.category-list-setting .calendar .current-year').val(year);
        $('.category-list-setting .calendar .year .item').html(year);
        $(`.category-list-setting .calendar .month .btn`).removeClass('active');
        if (year === parseInt($('.category-list-setting .calendar .get-year').val(), 10)) {
            let month = $('.category-list-setting .calendar .current-month').val();
            if (month !== 0) {
                $(`.category-list-setting .calendar .month .btn[data-item="${month}"]`).addClass('active');
            }
        }
    }

    $(document).ready(function () {
        btnViewInit();
        btnDateInit();
    });

})(jQuery);

/***
 Оформление загруженных PDF
 */

(function ($) {

    function getSVG() {
        return "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 298 394.8\" class='pdf-svg'><defs><style>.a{fill:#969696;}</style></defs><title>document</title><path class=\"a\" d=\"M218.4,167.6a27.9,27.9,0,0,0-9.6-5.2,56.6,56.6,0,0,0-12.4-1.2H178a10.6,10.6,0,0,0-6.8,2c-1.2,1.2-2,3.6-2,6.8v51.6c0,2.4,0,4,.8,5.6a5,5,0,0,0,2.4,3.2q1.8,1.2,6,1.2h18.4a59.9,59.9,0,0,0,8.8-.8,48.4,48.4,0,0,0,7.2-2,22.4,22.4,0,0,0,6-4,35.8,35.8,0,0,0,6-7.6,34.2,34.2,0,0,0,3.6-9.6,51.7,51.7,0,0,0,1.2-11.6C229.6,183.6,226,174,218.4,167.6ZM208,217.2a16.2,16.2,0,0,1-3.6,2,17.6,17.6,0,0,1-4,.8H184V172h9.6a31.5,31.5,0,0,1,11.2,1.6c3.2.8,5.6,3.2,7.6,6.8s3.2,8.8,3.2,15.6C215.2,206.4,212.8,213.2,208,217.2Z\" transform=\"translate(-48.4)\"/><path class=\"a\" d=\"M345.6,78.8l-.4-.4V78l-76-76-.4-.4a.4.4,0,0,1-.4-.4.4.4,0,0,1-.4-.4c-1.2-.8-2.4-.8-4-.8H75.6A26.6,26.6,0,0,0,56.8,7.6l-.4.4a27.9,27.9,0,0,0-8,19.2V367.6a27.2,27.2,0,0,0,8,19.2,27.9,27.9,0,0,0,19.2,8H319.2a27.2,27.2,0,0,0,19.2-8,27.9,27.9,0,0,0,8-19.2V82.8A11.8,11.8,0,0,0,345.6,78.8Zm-74-50L316.8,74H283.6a10.9,10.9,0,0,1-8.4-3.6,12.5,12.5,0,0,1-3.6-8.4V28.8Zm57.6,338.8A11,11,0,0,1,318.8,378H75.6a11.5,11.5,0,0,1-7.2-2.8,9.6,9.6,0,0,1-2.8-7.2V26.8a10,10,0,0,1,3.2-7.2l.4-.4A11.3,11.3,0,0,1,76,16.4H255.2V61.6A29,29,0,0,0,264,82.4a29.7,29.7,0,0,0,20.8,8.4h44.4V367.6Z\" transform=\"translate(-48.4)\"/><path class=\"a\" d=\"M150.8,166.8a15.4,15.4,0,0,0-7.6-4,49.6,49.6,0,0,0-12.4-1.2H112.4c-3.2,0-5.6.8-6.8,2s-2,3.6-2,6.8v54.4a10.2,10.2,0,0,0,2,6.4c1.2,1.6,3.2,2,5.2,2a7,7,0,0,0,5.2-2.4,10.2,10.2,0,0,0,2-6.4v-20h13.2c8.8,0,15.2-2,19.6-5.6s6.8-9.2,6.8-16.4a23.5,23.5,0,0,0-1.6-9.2A27.9,27.9,0,0,0,150.8,166.8Zm-9.6,22.4a10.2,10.2,0,0,1-5.2,3.6,26.6,26.6,0,0,1-8.4,1.2H118V172.4h9.6c6.4,0,10.4,1.2,12.8,3.2s2.8,4.4,2.8,7.6S142.4,187.6,141.2,189.2Z\" transform=\"translate(-48.4)\"/><path class=\"a\" d=\"M250.8,160.8a13.3,13.3,0,0,0-5.2,1.6,4.8,4.8,0,0,0-2.8,2.8c-.8,1.2-.8,2.8-.8,5.2v54c0,2.8.8,5.2,2,6.4s3.2,2,5.2,2a8.4,8.4,0,0,0,5.2-2,10.2,10.2,0,0,0,2-6.4V201.2H280a6.4,6.4,0,0,0,4.8-1.6c1.2-.8,1.6-2.4,1.6-4a5.1,5.1,0,0,0-1.6-4A8.6,8.6,0,0,0,280,190H256.4V172h28c2.4,0,4-.4,5.2-1.6a5.8,5.8,0,0,0,0-8c-1.2-1.2-2.8-1.6-5.2-1.6H250.8Z\" transform=\"translate(-48.4)\"/></svg>";
    }

    function pdfSearch() {

        $('.simple-page a').each(function () {
            let href = $(this).attr('href');
            if (href.indexOf('.pdf') !== -1) {
                let svg = getSVG();
                let title = $(this).html();
                let size = $(this).data('size');
                $(this).html(`${svg}<div class="pdf-data"><span class="pdf-size">PDF, ${size}</span><span class="pdf-title">${title}</span></div>`);
                $(this).addClass("pdf-container");
            }
        });
    }

    $(document).ready(function () {
        pdfSearch();
    });

})(jQuery);

/***
 Вкладки
 */

(function ($) {

    function tabInit() {
        $('.simple-page .tabs .tab').eq(0).addClass('current');
        let link = $('.simple-page .tabs .tab').eq(0).find('a').attr('href');
        $(link).addClass('current');
        $('.simple-page .tabs .tab a').click(function (event) {
            $('.simple-page .tabs .tab.current').removeClass('current');
            $(this).parent('.tab').addClass('current');
            $('.simple-page .tab-content.current').removeClass('current');
            $($(this).attr('href')).addClass('current');
            preventDefault(event);
        });
    }

    function preventDefault(event) {
        if (event) {
            event.preventDefault ? event.preventDefault() : (event.returnValue = false);
        }
    }

    $(document).ready(function () {
        tabInit();
    });

})(jQuery);