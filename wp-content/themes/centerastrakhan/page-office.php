<?php
/*
    Template Name: Проектные офисы
*/

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page office-page">

        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">
                <?php if ( have_posts() ) : the_post(); ?>

                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <?php get_template_part('inc/office/map'); ?>

                <?php endif; ?>
            </div>

        </div>

    </div>

<?php get_footer(); ?>