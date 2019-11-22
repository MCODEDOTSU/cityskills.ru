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

                <h1>
                    <?php if ( is_category() ) :
                        single_cat_title();
                    elseif (is_year()):
                        printf('<span>' . get_the_date(_x('Y', 'yearly archives date format', 'striped')) . '</span>');
                    elseif (is_month()):
                        printf('<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'striped')) . '</span>');
                    elseif (is_day()):
                        printf('<span>' . get_the_date() . '</span>');
                    endif; ?>
                </h1>

                <?php get_template_part('inc/category-list-setting'); ?>

                <?php if ( have_posts() ) : ?>

                    <div class="post-list customizable">

                        <?php while ( have_posts() ): the_post(); ?>
                            <?php $url = get_the_post_thumbnail_url(get_the_ID()); ?>
                            <div class="post-item"><a href="<?=get_permalink(get_the_ID())?>" title="<?=get_the_title()?>">

                                <div class="thumbnail">
                                    <div class="img" style="background-image:url(<?=$url?>);"></div>
                                </div>

                                <?php $category = getPrimaryCategory(get_the_ID()); ?>

                                <div class="content">

                                    <div class="date">
                                        <span class="day"><?=get_the_time('j')?></span>
                                        <?=getMonthName(get_the_time('F'))?>
                                    </div>

                                    <?php if(get_post_field( 'post_icon' ) !== 'empty'): ?>
                                        <i class="fa <?=get_post_field( 'post_icon' )?> post-icon"></i>
                                    <?php endif; ?>

                                    <h2><?=get_the_title()?></h2>
                                </div>

                            </a></div>
                        <?php endwhile; ?>
                    </div>

                <?php endif; ?>

            </div>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        </div>
    </div>

<?php get_footer(); ?>