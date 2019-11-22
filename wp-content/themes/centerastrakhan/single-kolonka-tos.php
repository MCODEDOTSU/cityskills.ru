<?php

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <?php $category = get_category_by_slug( 'kolonka-tos' ); ?>

                <?php if ( have_posts() ) : the_post(); ?>

                    <div class="data">
                        <div class="date">
                            <?= get_the_time('d F Y') ?>
                        </div>
                        <div class="category">
                            <a href="<?= get_category_link($category->cat_ID) ?>" title="<?= $category->cat_name ?>"><?= $category->cat_name ?></a>
                        </div>
                        <?php if(get_post_field( 'project_office_region' ) && get_post_field( 'project_office_region' ) != 'all'): ?>
                            <?php $region = get_post_field( 'project_office_region' ); ?>
                            <div class="category">
                                <a href="<?= get_site_url() ?>/category/press-centr/novosti-proektnyx-ofisov/?region=<?= get_post_field( 'project_office_region' )?>&city=<?= get_post_field( "project_office_city_$region" )?>" title="<?=get_post_field( "project_office_city_$region" )?>">
                                    <?=get_post_field( "project_office_city_$region" )?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <p class="post-thumbnail">
                        <a href="<?=get_the_post_thumbnail_url()?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                    </p>

                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                <?php endif; ?>

                <div class="next-prev-post">

                    <?php
                    $next = get_next_post_link('%link', 'слещующая <i class="fa fa-caret-right"></i>', 1);
                    $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущая', 1);
                    ?>

                    <div class="prev-post">
                        <?= $prev ?>
                    </div>

                    <div class="all-post">
                        <a href="<?= get_category_link($category->cat_ID) ?>" title="Все материалы">Все материалы</a>
                    </div>

                    <div class="next-post">
                        <?= $next ?>
                    </div>

                </div>

            </div>

        </div>
    </div>

<?php get_footer(); ?>