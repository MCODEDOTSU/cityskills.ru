<?php
/*
	Plugin Name: MCode Slider
	Author: Sirotkina Aliona (info@mcode.su)
	Author URI: http://mcode.su/
*/

/**
 * Frontend script
 */
function mcode_slider_scripts()
{
    wp_register_script('mcode_slider', plugins_url('/js/mcode.slider.js', __FILE__), array('jquery'), date('His'));
    wp_enqueue_script('mcode_slider');
    wp_register_script('mcode_slider_script', plugins_url('/js/script.js', __FILE__), array('jquery', 'mcode_slider'), date('His'));
    wp_enqueue_script('mcode_slider_script');
    wp_register_style('mcode_slider_style', plugins_url('/style/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_slider_style');
}

add_action('wp_enqueue_scripts', 'mcode_slider_scripts');

/**
 * Plugin install
 */
global $wpdb;
$wpdb->mcode_sliders = $wpdb->prefix . 'mcode_sliders';
$wpdb->mcode_sliders_items = $wpdb->prefix . 'mcode_sliders_items';
global $mcode_version;
$mcode_version = '1.1';

function mcode_slider_install()
{
    global $wpdb;
    global $mcode_version;
    if (@is_file(ABSPATH . '/wp-admin/includes/upgrade.php')) {
        include_once(ABSPATH . '/wp-admin/includes/upgrade.php');
    } elseif (@is_file(ABSPATH . '/wp-admin/upgrade-functions.php')) {
        include_once(ABSPATH . '/wp-admin/upgrade-functions.php');
    } else {
        die('We have problem finding your "/wp-admin/upgrade-functions.php" and "/wp-admin/includes/upgrade.php"');
    }
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->mcode_sliders . "'") != $wpdb->mcode_sliders) {
        $sql = 'CREATE TABLE `' . $wpdb->mcode_sliders . '` (
				`id` INT NOT NULL AUTO_INCREMENT, 
				`title` VARCHAR( 254 ) NOT NULL,
				`height` VARCHAR( 254 ) NOT NULL,
				`speed` INT NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE = MYISAM;';
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("sliders_version", $mcode_version);
    }
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->mcode_sliders_items . "'") != $wpdb->mcode_sliders_items) {
        $sql = 'CREATE TABLE `' . $wpdb->mcode_sliders_items . '` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`slider_id` INT NOT NULL,
				`sort` INT NOT NULL,
				`image` VARCHAR( 254 ),
				`title` VARCHAR( 254 ),
				`description` TEXT,
				`button` VARCHAR( 254 ),
				`link` VARCHAR( 254 ),
				`color` VARCHAR( 254 ),
				PRIMARY KEY (`id`)
				) ENGINE = MYISAM;';
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("sliders_version", $mcode_version);
    }
}

register_activation_hook(__FILE__, 'mcode_slider_install');

if (is_admin()) {
    add_action('admin_menu', 'slider_admin');
}
function slider_admin()
{
    add_menu_page('Слайдеры', 'Слайдеры', 'manage_options', 'sliders', 'mcode_slider_setting', 'dashicons-images-alt2');
}

function mcode_slider_setting()
{
    wp_enqueue_media();
    wp_register_style('mcode_slider_astyle', plugins_url('/style/astyle.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_slider_astyle');
    wp_register_script('mcode_slider_ascript', plugins_url('/js/ascript.js', __FILE__), array('jquery'), date('His'));
    wp_enqueue_script('mcode_slider_ascript');
    require_once plugin_dir_path(__FILE__) . 'setting.php';
}

/**
 * Shortcode
 * @param $attr
 * @return bool|string
 */
function mcode_sliders_shortcode($attr)
{
    $id = 0;
    extract(shortcode_atts(array('id' => 0), $attr));
    if ($id == 0) return false;

    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/Sliders.php';
    require_once plugin_dir_path(__FILE__) . 'Classes/SlidersItems.php';

    $slider = new Sliders($wpdb->mcode_sliders);
    $result = $slider->getById($id);
    $setting = $result['result'];

    $itemModel = new SlidersItems($wpdb->mcode_sliders_items);
    $items = $itemModel->getAll($id);

    $html = "<div id='slider-$id' class='mcode-slider' data-speed='{$setting->speed}'>";
    $firstPage = "";
    $pages = "";

    foreach ($items['result'] as $i => $item) {

        $itemImageStyle = $item->image == '' ? '' : "background-image:url({$item->image});";
        $itemStyle = "style='$itemImageStyle'";

        $titleArray = explode(";", $item->title);
        $title = "";
        foreach ($titleArray as $tlt) {
            $title .= "<span style='background:{$item->color};'>$tlt</span><br/>";
        }

        $current = $i == 0 ? 'current' : '';
        $html .= "<div class='mcode-slider-item $current' $itemStyle><div class='container'>
            <div class='title'>
                <h2 class='title'>$title</h2>
            </div>
            <div class='description'>
                <h3>{$item->description}</h3>
                <div class='action'>
                    <a class='btn' href='{$item->link}' style='background:{$item->color};'>{$item->button}</a>
                </div>                
            </div>
        </div></div>";

        $pageContent = "<div class='btn'><i class='fa fa-play' style='color:{$item->color};'></i></div>";
        if($i === 0) {
            $firstPage = "<div class='page' $itemStyle>$pageContent</div>";
        } elseif($i === 1) {
            $pages .= "<div class='page current' $itemStyle>$pageContent</div>";
        } else {
            $pages .= "<div class='page' $itemStyle>$pageContent</div>";
        }
    }
    $html .= "<div class='pages'>
        <div class='container'>$pages$firstPage</div>
    </div><div class='mcode-slider-loader'>" . getSvgLoader(50, $setting->speed) . "</div></div>";

    return $html;
}

add_shortcode('slider', 'mcode_sliders_shortcode');

function getSvgLoader($size = 40, $speed = 10) {

    $svgSize = $size + 6;
    $circleCX = ($size / 2) + 1;
    $strokeDasharray = $size * M_PI;
    $pathM = ($size / 2) + 3;
    $pathStep = $size / 2;
    $pathLStep = -1 * $pathStep;
    $lSize = -1 * $size;

    return "<svg class='loader' width='$svgSize' height='$svgSize'>
        <g class='circle'><circle fill='#ffffff' cx='$circleCX' cy='3' r='3'></circle></g>
        <path style='stroke:#ffffff;stroke-dasharray:$strokeDasharray;stroke-dashoffset:$strokeDasharray;stroke-width:1;fill:transparent' d='M$pathM,$pathM m0,$pathLStep a $pathStep,$pathStep 0 0,1 0,$size a $pathStep,$pathStep 0 0,1 0,$lSize'>
            <animate attributeName='stroke-dashoffset' dur='{$speed}s' to='0' repeatCount='indefinite'></animate>
        </path>
        <style>
            @-webkit-keyframes rotate-right { from { -webkit-transform: rotate(0deg); } to { -webkit-transform: rotate(360deg); } }
            .circle { -webkit-transform: translate3d(0, 0, 0); -webkit-transform-origin: {$pathM}px {$pathM}px; -webkit-transform: translate3d(0, 0, 0); -webkit-animation: rotate-right {$speed}s linear 0s infinite; }
        </style>
    </svg>";
}

/**
 * AJAX
 */

/**
 * Get all sliders
 */
function mcode_slider_block_select()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/Sliders.php';

    $slider = new Sliders($wpdb->mcode_sliders);
    $result = $slider->getAll();

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_block_select', 'mcode_slider_block_select');

/**
 * Create new slider
 */
function mcode_slider_block_create()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/Sliders.php';

    $block = new Sliders($wpdb->mcode_sliders);
    $result = $block->create($_POST['title'], $_POST['height'], $_POST['speed']);

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_block_create', 'mcode_slider_block_create');

/**
 * Edit slider
 */
function mcode_slider_block_update()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/Sliders.php';

    $block = new Sliders($wpdb->mcode_sliders);
    $result = $block->update($_POST['title'], $_POST['height'], $_POST['speed'], $_POST['id']);

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_block_update', 'mcode_slider_block_update');

/**
 * Delete slider
 */
function mcode_slider_block_delete()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/Sliders.php';

    $block = new Sliders($wpdb->mcode_sliders);
    $result = $block->delete($_POST['id']);

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_block_delete', 'mcode_slider_block_delete');

/**
 * Get slider's items
 */
function mcode_slider_item_select()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/SlidersItems.php';

    $item = new SlidersItems($wpdb->mcode_sliders_items);
    $result = $item->getAll($_POST['slider_id']);

    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_item_select', 'mcode_slider_item_select');

/**
 * Create slider's item
 */
function mcode_slider_item_create()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/SlidersItems.php';
    $item = new SlidersItems($wpdb->mcode_sliders_items);
    $result = $item->create($_POST['slider_id'], $_POST['sort'], $_POST['image'], $_POST['title'], $_POST['description'],
        $_POST['button'], $_POST['link'], $_POST['color']);
    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_item_create', 'mcode_slider_item_create');

/**
 * Edit slider's item
 */
function mcode_slider_item_update()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/SlidersItems.php';
    $item = new SlidersItems($wpdb->mcode_sliders_items);
    $result = $item->update($_POST['sort'], $_POST['image'], $_POST['title'], $_POST['description'], $_POST['button'],
        $_POST['link'], $_POST['color'], $_POST['id']);
    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_item_update', 'mcode_slider_item_update');

/**
 * Delete slider's item
 */
function mcode_slider_item_delete()
{
    global $wpdb;
    require_once plugin_dir_path(__FILE__) . 'Classes/SlidersItems.php';
    $item = new SlidersItems($wpdb->mcode_sliders_items);
    $result = $item->delete($_POST['id']);
    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_mcode_slider_item_delete', 'mcode_slider_item_delete');
