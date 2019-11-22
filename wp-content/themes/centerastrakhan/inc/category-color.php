<?php

function category_color_style() {

    $categories = get_categories( [
        'hide_empty' => 0
    ] ); ?>

    <style rel="stylesheet" type="text/css">
        <?php foreach( $categories as $category ):
        if(get_term_meta($category->cat_ID, 'category_background', true)): ?>

        .category.cat-<?=$category->cat_ID?>,
        .date.cat-<?=$category->cat_ID?> {
            background: <?=get_term_meta($category->cat_ID, 'category_background', true)?>;
        }

        .category.cat-<?=$category->cat_ID?>:before {
            border-left-color: <?=get_term_meta($category->cat_ID, 'category_background', true)?>;
        }

        .category.cat-<?=$category->cat_ID?>:after {
            border-left-color: <?=getDarketColor(get_term_meta($category->cat_ID, 'category_background', true), 30)?>;
        }

        .post-icon.cat-<?=$category->cat_ID?> {
            color: <?=get_term_meta($category->cat_ID, 'category_background', true)?>;
        }

        <?php else: ?>

        .category.cat-<?=$category->cat_ID?>,
        .date.cat-<?=$category->cat_ID?> {
            background: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .category.cat-<?=$category->cat_ID?>:before {
            border-left-color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        .category.cat-<?=$category->cat_ID?>:after {
            border-left-color: <?=getDarketColor(get_theme_mod('centerastrakhan_theme_color', '#344081'), 30)?>;
        }

        .post-icon.cat-<?=$category->cat_ID?> {
            color: <?=get_theme_mod('centerastrakhan_theme_color', '#344081') ?>;
        }

        <?php endif;
        endforeach; ?>
    </style>

<?php }

add_action('wp_head', 'category_color_style');
