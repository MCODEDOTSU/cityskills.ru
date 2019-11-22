<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2GQE6iJiz6lxj5nlCzu4HC3ghsU8vNGM"></script>
    <?php wp_head(); ?>
    <?php get_template_part('inc/counters'); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="container">
        <div class="mobile-banner">
            <?php dynamic_sidebar( 'header-banner' ); ?>
        </div>
        <div class="header-left">
            <a href="/" title="<?=bloginfo('name')?>. <?=bloginfo('description')?>">
                <img src="<?=get_theme_mod('centerastrakhan_logo')?>" alt="<?=bloginfo('name')?>. <?=bloginfo('description')?>">
                <div class="title">
                    <h3><?=bloginfo('description')?></h3>
                    <?php if (!is_front_page()): ?>
                        <h2><?=bloginfo('name')?></h2>
                    <?php else: ?>
                        <h1><?=bloginfo('name')?></h1>
                    <?php endif; ?>
                </div>
            </a>
        </div><div class="header-right">
            <?php dynamic_sidebar( 'header-banner' ); ?>
        </div>
    </div>

    <?php if(get_theme_mod('centerastrakhan_panorama_url')): ?>
        <a href="<?=get_theme_mod('centerastrakhan_panorama_url')?>" title="Панорама" target="_blank" class="fa fa-user panorama-enter"></a>
    <?php endif; ?>

</header>

<nav class="menu header-menu">
    <div class="container">
        <div class="action-container">
            <button class="fa fa-bars fullscreenmenu-show"></button>
            <button id="searchform-show" class="fa fa-search"></button>
        </div>
        <?php get_search_form() ?>
        <?php wp_nav_menu(['theme_location' => 'header', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
    </div>
</nav>

<div class="full-screen-menu" id="fullscreenmenu">
    <button class="close-menu"><i class="fa fa-angle-up"></i></button>
    <div class="container">
        <nav class="menu">
            <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
        </nav>
    </div>
</div>

<div class="wrapper">

	