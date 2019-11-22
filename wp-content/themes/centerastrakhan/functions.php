<?php

/* enqueue scripts */
function enqueue_scripts()
{
    wp_register_style('main', get_template_directory_uri() . '/style.css', array(), date('His'));
    wp_enqueue_style('main');
    wp_register_script('news-slider', get_template_directory_uri() . '/js/mcode.news.slider.js', array('jquery'), date('His'));
    wp_enqueue_script('news-slider');
    wp_register_script('core', get_template_directory_uri() . '/js/core.js', array('news-slider'), date('His'));
    wp_enqueue_script('core');
    wp_register_script('map', get_template_directory_uri() . '/js/map.js', array('jquery'));
    wp_enqueue_script('map');
    wp_enqueue_style('font', get_template_directory_uri() . '/fonts/font.css');
    wp_enqueue_style('responsive', get_template_directory_uri() . '/responsive.css', array(), date('His'));
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');

//function enqueue_admin_scripts($hook) {
//    if($hook != 'toplevel_page_mypluginname') {
//        return;
//    }
//    wp_register_script('tinymce-buttons', get_template_directory_uri() . '/js/tinymce_buttons.js', array( 'jquery' ));
//    wp_enqueue_script('tinymce-buttons');
//}
//add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );

/* end enqueue scripts */

add_theme_support('post-thumbnails');

/**
 * Sidebars
 */
function centerastrakhan_register_sidebar()
{
    register_sidebar([
        'name' => 'Баннер в шапке',
        'id' => 'header-banner',
        'description' => "Для баннера в шапке: 728x90",
        'before_widget' => '<div id="%1$s" class="widget header-banner %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ]);

    register_sidebar([
        'name' => 'Виджеты на главной',
        'id' => 'main-sidebar',
        'description' => "Виджеты на главной (300px)",
        'before_widget' => '<div id="%1$s" class="widget main-sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ]);

    register_sidebar([
        'name' => 'Виджеты на главной внизу',
        'id' => 'second-sidebar',
        'description' => "Виджеты на главной внизу (300px)",
        'before_widget' => '<div id="%1$s" class="widget main-sidebar %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ]);

    register_sidebar([
        'name' => 'Виджет в подвале, копирайты',
        'id' => 'copyright-sidebar',
        'description' => "Виджет в подвале, копирайты",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
    ]);

    register_sidebar([
        'name' => 'Виджет в подвале, описание',
        'id' => 'about-sidebar',
        'description' => "Виджет в подвале, описание",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
    ]);

    register_sidebar([
        'name' => 'Виджет в разделе "Мероприятия"',
        'id' => 'meropriyatiya-sidebar',
        'description' => "Виджет в разделе \"Мероприятия\"",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
    ]);
}

add_action('widgets_init', 'centerastrakhan_register_sidebar');

/* menu */
add_theme_support('menus');

class MenuWalker extends Walker_Nav_Menu
{
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>";
    }
}

add_action('after_setup_theme', 'register_menu');
function register_menu()
{
    register_nav_menu('header', 'Меню в шапке');
    register_nav_menu('footer', 'Меню в подвале');
    register_nav_menu('fullscreen', 'Полноэкраное меню');
}

/* end menu */

/* theme settings */
require get_template_directory() . '/inc/theme-setting.php';
require get_template_directory() . '/inc/swpbtn-shortcode.php';
/* end theme settings */

/**
 * Корректировка названия месяца
 */
function getMonthName($month)
{
    $monthArray = [
        'Январь' => 'Января',
        'Февраль' => 'Февраля',
        'Март' => 'Марта',
        'Апрель' => 'Апреля',
        'Май' => 'Мая',
        'Июнь' => 'Июня',
        'Июль' => 'Июля',
        'Август' => 'Августа',
        'Сентябрь' => 'Сентября',
        'Октябрь' => 'Октября',
        'Ноябрь' => 'Ноября',
        'Декабрь' => 'Декабря'
    ];
    return $monthArray[$month];
}

/**
 * Склонение
 */
function plural_form($number, $after)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    echo $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

/**
 * Вывести основную категорию поста
 */
function getPrimaryCategory($postId)
{
    $terms = wp_get_post_terms($postId, 'category', ['fields' => 'all']);
    foreach ($terms as $term) {
        if (get_post_meta($postId, '_yoast_wpseo_primary_category', true) == $term->term_id) {
            return $term;
        }
    }
    return $terms[0];
}

/**
 * Подсчет просмотров
 */
function setPostViews($postId)
{
    $count = get_post_meta($postId, 'post_views', true);
    if (!$count) $count = 0;
    update_post_meta($postId, 'post_views', ++$count);
    return $count;
}

/**
 * Дополнительные кнопки в редакторе
 */
function swp_btn_func($atts)
{
    $a = shortcode_atts(array(
        'link' => '',
        'name' => 'Try it Out',
        'color' => 'green',
    ), $atts);
    return '<div class="swp-btn"><a style="background-color:' . $a['color'] . ';" class="" href="' . $a['link'] . '" target="_blank">' . $a['name'] . '</a></div>';
}

add_shortcode('swp-btn', 'swp_btn_func');

/**
 * GOOGLE AMP API
 */
function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyB2GQE6iJiz6lxj5nlCzu4HC3ghsU8vNGM';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/***
 * ИНФОГРАФИКА
 */
add_action('wp_ajax_get_infografics', 'get_infografics');
add_action('wp_ajax_nopriv_get_infografics', 'get_infografics');
function get_infografics()
{

    $count = 6;

    $name = $_POST['name'];
    $top = (int)$_POST['top'];

    $query = new WP_Query([
        'category_name' => $name,
        'posts_per_page' => $count,
        'offset' => $top * $count
    ]);

    $i = 0;
    $left = '';
    $right = '';
    while ($query->have_posts()) {
        $query->the_post();
        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large ');
        $link = get_permalink(get_the_ID());
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $html = "<div class='post-item'><a href='$link' title='$title'>
                                        <div class='thumbnail'>$thumbnail</div>
                                        <h2>$title</h2>
                                        <h3>$excerpt</h3>
                                     </a></div>";
        if ($i % 2 === 0) $left .= $html;
        else $right .= $html;
        $i++;
    }

    wp_reset_postdata();

    echo json_encode([
        'left' => $left,
        'right' => $right
    ]);

    wp_die();
}

/***
 * Новости для страницы проектного офиса
 */
function get_city_office_news($pageId)
{
    $parentId = wp_get_post_parent_id($pageId);

    $parent = get_post($parentId);
    $post = get_post($pageId);

    $query = new WP_Query([
        'posts_per_page' => 4,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'project_office_region',
                'value' => $parent->post_name
            ],
            [
                'key' => "project_office_city_{$parent->post_name}",
                'value' => $post->post_title
            ]
        ]
    ]);

    $result = [];
    while ($query->have_posts()) {
        $query->the_post();
        $result[] = [
            'id' => get_the_ID(),
            'url' => get_the_post_thumbnail_url(get_the_ID()),
            'date' => get_the_time('j'),
            'month' => getMonthName(get_the_time('F')),
            'title' => get_the_title(),
            'city' => $post->post_title,
        ];
    }

    wp_reset_postdata();

    return $result;
}

/**
 * Направления деятельности
 */
function get_about_trends($category)
{

    $query = new WP_Query(['cat' => $category]);

    $i = 0;
    $left = '';
    $right = '';
    while ($query->have_posts()) {
        $query->the_post();
        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large ');
        $link = get_permalink(get_the_ID());
        $title = get_the_title();
        $content = get_the_content();
        $html = "<div class='post-item'>
                    <a href='$link' title='$title'>
                        <div class='thumbnail'>$thumbnail</div>
                        <h3>$title</h3>
                    </a>
                    <p>$content</p>
                  </div>";
        if ($i % 2 === 0) $left .= $html;
        else $right .= $html;
        $i++;
    }

    wp_reset_postdata();

    return [
        'left' => $left,
        'right' => $right
    ];
}

/***
 * Полезные материалы
 */
add_action('wp_ajax_get_materials', 'get_materials');
add_action('wp_ajax_nopriv_get_materials', 'get_materials');
function get_materials()
{

    $type = $_POST['type'];
    $cat = (int)$_POST['category'];

    $query = new WP_Query([
        'cat' => $cat,
        'posts_per_page' => -1,
        'meta_key' => 'material_type',
        'meta_value' => $type
    ]);

    $i = 0;
    $pc = '';
    $mb = '';
    while ($query->have_posts()) {

        $query->the_post();

        $url = get_the_post_thumbnail_url(get_the_ID());
        $href = wp_get_attachment_url(get_post_field( 'material_pdf' ));
        $title = get_the_title();

        if ($i == 0) {
            $pc .= '<div class="shelf">';
        } elseif ($i % 5 == 0) {
            $pc .= '</div><div class="shelf">';
        }

        if ($i == 0) {
            $mb .= '<div class="shelf">';
        } elseif ($i % 3 == 0) {
            $mb .= '</div><div class="shelf">';
        }

        $pc .= "<a class='item fancybox' href='$href' title='$title' style='background-image:url($url);' data-fancybox-type='iframe'></a>";
        $mb .= "<a class='item fancybox' href='$href' title='$title' style='background-image:url($url);' data-fancybox-type='iframe'></a>";

        $i++;
    }
    $pc .= '</div>';
    $mb .= '</div>';

    $j = ceil($i / 5);
    while ($j < 5) {
        $pc .= '<div class="shelf"></div>';
        $j++;
    }

    $j = ceil($i / 3);
    while ($j < 3) {
        $mb .= '<div class="shelf"></div>';
        $j++;
    }

    wp_reset_postdata();

    echo json_encode([ 'pc' => $pc, 'mb' => $mb ]);

    wp_die();
}

/***
 * Фильтр на получения контента
 */
add_filter( 'the_content', 'filter_the_content' );
function filter_the_content( $content ) {
    preg_match_all("/href=\"(.+\.pdf)\"/", $content, $out);
    $links = $out[1];
    $url = get_site_url() . '/';
    foreach ($links as $link) {
        $path = str_replace($url, "", $link);
        $size = filesize($_SERVER['DOCUMENT_ROOT'] . '/' . $path);
        if ($size >= 1024 * 1024) {
            $size = round($size / (1024 * 1024), 2) . ' МБ';
        } else if ($size >= 1024) {
            $size = round($size / 1024, 2) . ' KБ';
        } else {
            $size .= ' Б';
        }
        $content = str_replace("href=\"{$link}\"", "href=\"{$link}\" data-size=\"{$size}\"", $content);
    }
    return $content;
}