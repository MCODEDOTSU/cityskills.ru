<?php

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page meropriyatiya">
        <div class="container">

            <div class="content">
                <?php if ( have_posts() ) : the_post(); ?>

                    <div class="data">
                        <div class="date">
                            <?= get_the_time('d F Y') ?>
                        </div>
                        <div class="views">
                            <?= plural_form( get_post_meta(get_the_ID(), 'post_views', true), ['просмотр','просмотра','просмотров'] ); ?>
                        </div>
                    </div>

                    <p class="post-thumbnail">
                        <a href="<?=get_the_post_thumbnail_url()?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
                    </p>
                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>

                    <?php $dt = explode(' ', get_post_meta(get_the_ID(), 'event_datetime', true)); ?>
                    <table class="meropriyatiya-data">
                        <?php if(count($dt) == 2): $tm = strtotime($dt[0]);?>
                        <tr><td rowspan="5" class="title"><?php the_title(); ?></td>
                            <td>Когда</td><td><?= date('d.m.Y', $tm) ?></td></tr>
                        <tr><td>Во сколько</td><td><?= $dt[1] ?></td></tr>
                        <tr><td>Где</td><td><?= get_post_meta(get_the_ID(), 'event_where', true) ?></td></tr>
                        <tr><td>Адрес</td><td><?= get_post_meta(get_the_ID(), 'event_address', true) ?></td></tr>
                        <?php else: ?>
                        <tr><td rowspan="4" class="title"><?php the_title(); ?></td>
                            <td>Где</td><td><?= get_post_meta(get_the_ID(), 'event_where', true) ?></td></tr>
                        <tr><td>Адрес</td><td><?= get_post_meta(get_the_ID(), 'event_address', true) ?></td></tr>
                        <?php endif ?>
                    </table>

                    <?php $location = get_post_meta(get_the_ID(), 'event_map', true) ?>
                    <?php if( !empty($location) ): ?>
                        <div class="acf-map">
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                        </div>
                    <?php endif ?>

                <?php endif; ?>

                <div class="next-prev-post">

                    <?php
                    $next = get_next_post_link('%link', 'следующее <i class="fa fa-caret-right"></i>', 1);
                    $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущее', 1);
                    $category = get_category_by_slug( 'meropriyatiya' );
                    ?>

                    <div class="prev-post">
                        <?= $prev ?>
                    </div>

                    <div class="all-post">
                        <a href="<?= get_category_link($category->cat_ID) ?>" title="Все мероприятия">Все мероприятия</a>
                    </div>

                    <div class="next-post">
                        <?= $next ?>
                    </div>

                </div>

            </div><!--

            --><div class="sidebar">
                <?php dynamic_sidebar( 'meropriyatiya-sidebar' ); ?>
            </div>

        </div>
    </div>

<?php get_footer(); ?>