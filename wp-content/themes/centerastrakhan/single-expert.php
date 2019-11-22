<?php

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page article">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <?php if ( have_posts() ) : the_post(); ?>

                    <figure class="thumbnail">
                        <a href="<?=get_the_post_thumbnail_url()?>">
                            <?php the_post_thumbnail( 'full' ); ?>
                            <figcaption><?=get_post_field('opinion_name')?></figcaption>
                        </a>
                    </figure>
                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                <?php endif; ?>

                <div class="next-prev-post">

                    <?php
                    $next = get_next_post_link('%link', 'следующий <i class="fa fa-caret-right"></i>', 1);
                    $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущий', 1);
                    $category = get_category_by_slug( 'ekspertnoe-mnenie' );
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