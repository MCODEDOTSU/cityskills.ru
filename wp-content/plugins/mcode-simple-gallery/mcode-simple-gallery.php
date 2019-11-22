<?php
/*
	Plugin Name: MCode Simple Gallery
	Author: Sirotkina Aliona (info@mcode.su)
	Author URI: http://mcode.su/
*/

/**
 * Frontend script
 */
function mcode_simple_gallery_scripts()
{
    wp_register_script('mcode_simple_gallery_script', plugins_url('/script.js', __FILE__), array('jquery'), date('His'));
    wp_enqueue_script('mcode_simple_gallery_script');
    wp_register_style('mcode_simple_gallery_style', plugins_url('/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_simple_gallery_style');
}

add_action('wp_enqueue_scripts', 'mcode_simple_gallery_scripts');