<?php

function theme_setting($wp_customize)
{

    /**
     * Шапка
     */

    $wp_customize->add_section(
        'centerastrakhan_theme',
        [
            'title' => 'Индивидуальные настройки',
            'description' => 'Настройка логотипа, цветовой схемы',
            'priority' => 10,
        ]
    );

    /* Logo */
    $wp_customize->add_setting('centerastrakhan_logo');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'centerastrakhan_logo',
            [
                'label' => 'Логотип в шапке',
                'section' => 'centerastrakhan_theme',
                'settings' => 'centerastrakhan_logo',
                'height' => 170,
                'width' => 170
            ]
        )
    );

    /* Headers Color */
    $wp_customize->add_setting(
        'centerastrakhan_theme_color',
        [
            'default' => '#344081',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_theme_color',
            [
                'label' => 'Цвет шапки',
                'section' => 'centerastrakhan_theme'
            ]
        )
    );

    /* Menu Color */
    $wp_customize->add_setting(
        'centerastrakhan_menu_color',
        [
            'default' => '#353c60',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_menu_color',
            [
                'label' => 'Цвет меню',
                'section' => 'centerastrakhan_theme'
            ]
        )
    );

    /* Цвет заливки */
    $wp_customize->add_setting(
        'centerastrakhan_background_color',
        [
            'default' => '#f7f7f7',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_background_color',
            [
                'label' => 'Цвет фона сайта',
                'section' => 'centerastrakhan_theme'
            ]
        )
    );

    /* Цвет подвала */
    $wp_customize->add_setting(
        'centerastrakhan_footer_color',
        [
            'default' => '#969696',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_footer_color',
            [
                'label' => 'Цвет подвала',
                'section' => 'centerastrakhan_theme'
            ]
        )
    );

    /* Констрастный цвет */
    $wp_customize->add_setting(
        'centerastrakhan_bright_color',
        [
            'default' => '#84b000',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_bright_color',
            [
                'label' => 'Констрастный цвет',
                'section' => 'centerastrakhan_theme'
            ]
        )
    );

    /* Код слайдера */
    $wp_customize->add_setting(
        'centerastrakhan_code'
    );
    $wp_customize->add_control(
        'centerastrakhan_code',
        array(
            'label' => 'Код слайдера:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /* Ссылка на Панораму */
    $wp_customize->add_setting(
        'centerastrakhan_panorama_url'
    );
    $wp_customize->add_control(
        'centerastrakhan_panorama_url',
        array(
            'label' => 'Ссылка на Панораму:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /* Ссылка на страницу Фейсбук */
    $wp_customize->add_setting(
        'centerastrakhan_facebook'
    );
    $wp_customize->add_control(
        'centerastrakhan_facebook',
        array(
            'label' => 'Ссылка на страницу Фейсбук:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /* Ссылка на страницу Вконтакте */
    $wp_customize->add_setting(
        'centerastrakhan_vkontakte'
    );
    $wp_customize->add_control(
        'centerastrakhan_vkontakte',
        array(
            'label' => 'Ссылка на страницу Вконтакте:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /* Ссылка на страницу Инстаграм */
    $wp_customize->add_setting(
        'centerastrakhan_instagram'
    );
    $wp_customize->add_control(
        'centerastrakhan_instagram',
        array(
            'label' => 'Ссылка на страницу Инстаграм:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /* Ссылка на страницу Ютуб */
    $wp_customize->add_setting(
        'centerastrakhan_youtube'
    );
    $wp_customize->add_control(
        'centerastrakhan_youtube',
        array(
            'label' => 'Ссылка на страницу Ютуб:',
            'section' => 'centerastrakhan_theme',
            'type' => 'text',
        )
    );

    /**
     * Главная страница с новостями
     */

    $categories = get_categories(['hide_empty' => 0]);
    $categoriesList = [];
    foreach ($categories as $category) {
        $categoriesList[$category->term_id] = $category->name;
    }

    $wp_customize->add_section(
        'centerastrakhan_home',
        [
            'title' => 'Новости на главной',
            'description' => 'Настройка новостей на главной странице',
            'priority' => 11,
        ]
    );

    /* Главная новость, наименование */
    $wp_customize->add_setting(
        'centerastrakhan_main_name'
    );
    $wp_customize->add_control(
        'centerastrakhan_main_name',
        array(
            'label' => 'Блок "Главная новость", наименование:',
            'section' => 'centerastrakhan_home',
            'type' => 'text',
        )
    );

    /* Главная новость, категория */
    $wp_customize->add_setting(
        'centerastrakhan_main_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_main_category',
        [
            'label' => 'Блок "Главная новость", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Главная новость, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_main_color',
        [
            'default' => '#f87070',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_main_color',
            [
                'label' => 'Блок "Главная новость", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Последние новости, наименование */
    $wp_customize->add_setting(
        'centerastrakhan_news_name'
    );
    $wp_customize->add_control(
        'centerastrakhan_news_name',
        array(
            'label' => 'Блок "Последние новости", наименование:',
            'section' => 'centerastrakhan_home',
            'type' => 'text',
        )
    );

    /* Последние новости, количество */
    $wp_customize->add_setting(
        'centerastrakhan_news_count'
    );
    $wp_customize->add_control(
        'centerastrakhan_news_count',
        array(
            'label' => 'Блок "Последние новости", количество:',
            'section' => 'centerastrakhan_home',
            'type' => 'number',
        )
    );

    /* Последние новости, категория */
    $wp_customize->add_setting(
        'centerastrakhan_news_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_news_category',
        [
            'label' => 'Блок "Последние новости", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Последние новости, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_news_color',
        [
            'default' => '#238fd4',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_news_color',
            [
                'label' => 'Блок "Последние новости", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Последние новости, задний фон */
    $wp_customize->add_setting(
        'centerastrakhan_news_background',
        [
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_news_background',
            [
                'label' => 'Блок "Последние новости", задний фон:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Экспертное мнение, наименование */
    $wp_customize->add_setting(
        'centerastrakhan_opinion_name'
    );
    $wp_customize->add_control(
        'centerastrakhan_opinion_name',
        array(
            'label' => 'Блок "Экспертное мнение", наименование:',
            'section' => 'centerastrakhan_home',
            'type' => 'text',
        )
    );

    /* Экспертное мнение, количество */
    $wp_customize->add_setting(
        'centerastrakhan_opinion_count'
    );
    $wp_customize->add_control(
        'centerastrakhan_opinion_count',
        array(
            'label' => 'Блок "Экспертное мнение", количество:',
            'section' => 'centerastrakhan_home',
            'type' => 'number',
        )
    );

    /* Экспертное мнение, категория */
    $wp_customize->add_setting(
        'centerastrakhan_opinion_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_opinion_category',
        [
            'label' => 'Блок "Экспертное мнение", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Экспертное мнение, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_opinion_color',
        [
            'default' => '#84b000',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_opinion_color',
            [
                'label' => 'Блок "Экспертное мнение", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Экспертное мнение, задний фон */
    $wp_customize->add_setting(
        'centerastrakhan_opinion_background',
        [
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_opinion_background',
            [
                'label' => 'Блок "Экспертное мнение", задний фон:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Избранная новость, наименование */
    $wp_customize->add_setting(
        'centerastrakhan_favorites_name'
    );
    $wp_customize->add_control(
        'centerastrakhan_favorites_name',
        array(
            'label' => 'Блок "Избранная новость", наименование:',
            'section' => 'centerastrakhan_home',
            'type' => 'text',
        )
    );

    /* Избранная новость, категория */
    $wp_customize->add_setting(
        'centerastrakhan_favorites_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_favorites_category',
        [
            'label' => 'Блок "Избранная новость", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Избранная новость, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_favorites_color',
        [
            'default' => '#08666e',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_favorites_color',
            [
                'label' => 'Блок "Избранная новость", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Аккредитация, наименование */
    $wp_customize->add_setting(
        'centerastrakhan_accreditation_name'
    );
    $wp_customize->add_control(
        'centerastrakhan_accreditation_name',
        array(
            'label' => 'Блок "Аккредитация", наименование:',
            'section' => 'centerastrakhan_home',
            'type' => 'text',
        )
    );

    $pages = get_pages();
    $pagesList = [];
    foreach ($pages as $page) {
        $pagesList[$page->ID] = $page->post_title;
    }

    /* Аккредитация, категория */
    $wp_customize->add_setting(
        'centerastrakhan_accreditation_page'
    );
    $wp_customize->add_control(
        'centerastrakhan_accreditation_page',
        [
            'label' => 'Блок "Аккредитация", страница:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $pagesList,
        ]
    );

    /* Аккредитация, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_accreditation_color',
        [
            'default' => '#008eb3',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_accreditation_color',
            [
                'label' => 'Блок "Аккредитация", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Слайдер с новостями, категория */
    $wp_customize->add_setting(
        'centerastrakhan_slider_news_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_slider_news_category',
        [
            'label' => 'Блок "Слайдер с новостями", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Слайдер с новостями, количество */
    $wp_customize->add_setting(
        'centerastrakhan_slider_news_count'
    );
    $wp_customize->add_control(
        'centerastrakhan_slider_news_count',
        [
            'label' => 'Блок "Слайдер с новостями", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'number',
            'choices' => $categoriesList,
        ]
    );

    /* Слайдер с новостями, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_slider_news_color',
        [
            'default' => '#344081',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_slider_news_color',
            [
                'label' => 'Слайдер с новостями, цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Интервью, категория */
    $wp_customize->add_setting(
        'centerastrakhan_interview_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_interview_category',
        [
            'label' => 'Блок "Интервью", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Интервью, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_interview_color',
        [
            'default' => '#a83859',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_interview_color',
            [
                'label' => 'Блок "Интервью", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Видео, категория */
    $wp_customize->add_setting(
        'centerastrakhan_tv_category'
    );
    $wp_customize->add_control(
        'centerastrakhan_tv_category',
        [
            'label' => 'Блок "Видео", категория:',
            'section' => 'centerastrakhan_home',
            'type' => 'select',
            'choices' => $categoriesList,
        ]
    );

    /* Видео, цвет */
    $wp_customize->add_setting(
        'centerastrakhan_tv_color',
        [
            'default' => '#353c60',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'centerastrakhan_tv_color',
            [
                'label' => 'Блок "Видео", цвет:',
                'section' => 'centerastrakhan_home'
            ]
        )
    );

    /* Видео, количество */
    $wp_customize->add_setting(
        'centerastrakhan_tv_count'
    );
    $wp_customize->add_control(
        'centerastrakhan_tv_count',
        array(
            'label' => 'Блок "Видео", количество:',
            'section' => 'centerastrakhan_home',
            'type' => 'number',
        )
    );

}

add_action('customize_register', 'theme_setting');


function theme_setting_style()
{ ?>
    <style rel="stylesheet" type="text/css">

        header {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .panorama-enter {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .header-menu,
        .full-screen-menu,
        .nav-links a.page-numbers,
        .nav-links span {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .header-menu a:hover,
        .header-menu button:hover,
        .full-screen-menu .close-menu:hover {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .header-menu .searchform-container:before {
            background: -moz-linear-gradient(left, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 0%, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 50%, rgba(255, 255, 255, 0) 100%);
            background: -webkit-linear-gradient(left, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 0%, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 50%, rgba(255, 255, 255, 0) 100%);
            background: linear-gradient(to right, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 0%, <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?> 50%, rgba(255, 255, 255, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>', endColorstr='<?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>', GradientType=1);
        }

        .header-menu .searchform-container .btn-cross {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .header-menu .searchform .search-input {
            border: 2px solid<?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .header-menu .searchform .btn-search {
            color: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .header-menu .searchform .btn-search:hover {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .home .wrapper,
        #breadcrumbs {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        #breadcrumbs,
        #breadcrumbs a {
            color: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        @media only screen and (max-width: 980px) {
            .homepage-items .line-1 .item {
                background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
            }
        }

        .homepage-items .main .category {
            background: <?=get_theme_mod('centerastrakhan_main_color', '#f87070')?>;
        }

        .homepage-items .main .category:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_main_color', '#f87070')?>;
        }

        .homepage-items .main .category:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_main_color', '#f87070'), 55)?>;
        }

        .homepage-items .main .date {
            background: <?=get_theme_mod('centerastrakhan_main_color', '#f87070')?>;
        }

        .homepage-items .sidebar {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .homepage-items .news {
            background: <?=get_theme_mod('centerastrakhan_news_background', '#ffffff') ?>;
        }

        .homepage-items .news a.news-item:hover {
            color: <?=get_theme_mod('centerastrakhan_news_color', '#238fd4') ?>;
        }

        .homepage-items .news .category {
            background: <?=get_theme_mod('centerastrakhan_news_color', '#238fd4')?>;
        }

        .homepage-items .news .category:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_news_color', '#238fd4')?>;
        }

        .homepage-items .news .category:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_news_color', '#238fd4'), 30)?>;
        }

        .homepage-items .news .news-item .day {
            color: <?=get_theme_mod('centerastrakhan_news_color', '#238fd4')?>;
        }

        .homepage-items .opinion {
            background: <?=get_theme_mod('centerastrakhan_opinion_background', '#ffffff') ?>;
        }

        .homepage-items .opinion .category {
            background: <?=get_theme_mod('centerastrakhan_opinion_color', '#84b000')?>;
        }

        .homepage-items .opinion .category:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_opinion_color', '#84b000')?>;
        }

        .homepage-items .opinion .category:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_opinion_color', '#84b000'), 30)?>;
        }

        .homepage-items .opinion:hover a.opinion-item {
            color: <?=get_theme_mod('centerastrakhan_opinion_color', '#84b000')?>;
        }

        .homepage-items .opinion .pagination .page {
            border: 1px solid<?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .homepage-items .opinion .pagination .page.current {
            background: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .homepage-items .favorites .category {
            background: <?=get_theme_mod('centerastrakhan_favorites_color', '#08666e')?>;
        }

        .homepage-items .favorites .category:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_favorites_color', '#08666e')?>;
        }

        .homepage-items .favorites .category:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_favorites_color', '#08666e'), 30)?>;
        }

        .homepage-items .favorites .date {
            background: <?=get_theme_mod('centerastrakhan_favorites_color', '#08666e')?>;
        }

        .homepage-items .accreditation-block .category {
            background: <?=get_theme_mod('centerastrakhan_accreditation_color', '#008eb3')?>;
        }

        .homepage-items .accreditation-block .category:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_accreditation_color', '#008eb3')?>;
        }

        .homepage-items .accreditation-block .category:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_accreditation_color', '#008eb3'), 30)?>;
        }

        .homepage-items .slider-news-block .header {
            background: <?=get_theme_mod('centerastrakhan_slider_news_color', '#344081') ?>;
        }

        .homepage-items .slider-news-block .header:hover {
            background: <?=getDarketColor(get_theme_mod('centerastrakhan_slider_news_color', '#344081'), 30)?>;
        }

        .homepage-items .slider-news-block .pagination {
            background: <?=get_theme_mod('centerastrakhan_slider_news_color', '#344081') ?>;
        }

        .homepage-items .slider-news-block .pagination .fa:hover {
            background: <?=getDarketColor(get_theme_mod('centerastrakhan_slider_news_color', '#344081'), 30)?>;
        }

        .homepage-items .tv-block .fa-play {
            color: <?=get_theme_mod('centerastrakhan_tv_color', '#353c60') ?>;
        }

        .homepage-items .tv-block {
            background: <?=get_theme_mod('centerastrakhan_tv_color', '#353c60') ?>;
        }

        .homepage-items .tv-block .pagination .page {
            border-color: <?=get_theme_mod('centerastrakhan_tv_color', '#353c60') ?>;
        }

        .homepage-items .tv-block .pagination .page.current {
            background: <?=get_theme_mod('centerastrakhan_tv_color', '#353c60') ?>;
        }

        .post-list.list .day {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .post-list.list .post-item:hover {
            border-bottom: 3px solid<?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .category-list-setting .btn {
            border-color: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .category-list-setting .btn.active {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
            border-color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .category-list-setting .setting-date .calendar {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .category-list-setting .setting-date .calendar .month .item .btn.active {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page a {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page nav.menu .menu > li.current-menu-item > a,
        .simple-page nav.menu .menu > li.current-menu-ancestor > a,
        .simple-page nav.menu .menu > li.current-menu-parent > a {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page nav.menu .menu > li.current-menu-item > a:before,
        .simple-page nav.menu .menu > li.current-menu-ancestor > a:before,
        .simple-page nav.menu .menu > li.current-menu-parent > a:before {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page nav.menu .sub-menu > li.current-menu-item > a,
        .simple-page nav.menu .sub-menu > li.current-menu-parent > a {
            color: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .simple-page nav.menu .sub-menu > li.current-menu-item > a:before,
        .simple-page nav.menu .sub-menu > li.current-menu-parent > a:before {
            background: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .simple-page.article .thumbnail figcaption,
        .simple-page.office-city-page figure.thumbnail figcaption,
        .simple-page.article .thumbnail.cmk {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page.meropriyatiya .meropriyatiya-data {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page blockquote {
            background: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>30;
        }

        .simple-page.project .project-data {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .simple-page.project .project-description tr td:first-child {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page blockquote.color {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>99;
        }

        .simple-page table tr.cls-1 {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .next-prev-post .all-post a {
            border-color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page .pdf-container:hover {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .simple-page .tab.current a {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .about-page .concept {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        .about-page .mission {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .about-page .trend {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .projects-list .project-item .front {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .projects-list .project-item .back {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .post-list .project-office-city, .simple-page.office-page .region-title {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .post-list-meropriyatiya .post-item .post-type {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .post-list-meropriyatiya .post-item .post-title {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .post-list-avtografy .type-rows > a {
            background: <?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        footer {
            background: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        footer nav.menu {
            border-bottom: 1px solid<?=get_theme_mod('centerastrakhan_background_color', '#f7f7f7') ?>;
        }

        #btn-up {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .post-list-stati .speech .header,
        .post-list-stati .cmk .header {
            background: <?=get_theme_mod('centerastrakhan_bright_color', '#84b000') ?>;
        }

        .post-list-stati .article .header {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
            border-bottom: 1px solid<?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .post-list-stati .post-item .post {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .category-infografika .action button {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        .simple-page.infografika .pagination .btn {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>;
        }

        /***
        GALLERY
         */
        .mcode-gallery .btn {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>99;
        }

        .mcode-gallery:hover .btn {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>bb;
        }

        .mcode-gallery .btn:hover {
            background: <?=get_theme_mod('centerastrakhan_menu_color', '#353c60') ?>dd;
        }

        /***
        CALENDAR
         */
        .mcode-calendar table.calendar th > div {
            background: <?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

        .mcode-calendar table.calendar td > a,
        .mcode-calendar table.calendar td input[type="submit"] {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .mcode-calendar table.calendar td.current div {
            border: 1px solid<?=get_theme_mod('centerastrakhan_footer_color', '#969696')?>;
        }

    </style>
<?php }

add_action('wp_head', 'theme_setting_style');

function getDarketColor($color, $value = 50)
{
    $color = str_replace('#', '', $color);
    $items = str_split($color, 2);
    foreach ($items as &$item) {
        $item = hexdec($item) - $value;
        if ($item < 0) $item = 0;
        $item = dechex($item);
        if (strlen($item) === 1) $item = "0$item";
    }
    return '#' . implode($items);
}

function getContrastColor($color)
{
    $color = str_replace('#', '', $color);
    $items = str_split($color, 2);
    foreach ($items as &$item) {
        $item = dechex(255 - hexdec($item));
        if (strlen($item) === 1) $item = "0$item";
    }
    return '#' . implode($items);
}