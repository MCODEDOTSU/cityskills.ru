<?php
/*
    Template Name: О нас
*/

get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page about-page no-tumb">

        <?php if (have_posts()) : the_post(); ?>

            <div class="concept">
                <div class="container">
                    <div class="concept-left">
                        <h1><?php the_title() ?></h1>
                    </div>
                    <div class="concept-right">
                        <h2><?= get_post_field('about_concept_title') ?></h2>
                        <p><?= get_post_field('about_concept') ?></p>
                    </div>
                </div>

            </div>

            <div class="mission">
                <div class="container">
                    <div class="mission-left">
                        <?php if (get_post_field('about_mission_image')): ?>
                            <?= wp_get_attachment_image(get_post_field('about_mission_image')) ?>
                        <?php endif; ?>
                    </div>
                    <div class="mission-right">
                        <?php if (get_post_field('about_mission_title')): ?>
                            <h2><?= get_post_field('about_mission_title') ?></h2>
                        <?php endif; ?>
                        <?php if (get_post_field('about_mission')): ?>
                            <?= get_post_field('about_mission') ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="container display-table">

                    <div class="display-cell">
                        <?php if (get_post_field('about_activity_title')): ?>
                            <h2><?= get_post_field('about_activity_title') ?></h2>
                        <?php endif; ?>
                        <?php if (get_post_field('about_activity')): ?>
                            <?= get_post_field('about_activity') ?>
                        <?php endif; ?>
                    </div>

                    <?php if (get_post_field('about_quote')): ?>
                        <div class="quote display-cell">
                            <div>
                                <p><?= get_post_field('about_quote') ?></p>
                                <div class="author">
                                    <?= get_post_field('about_quote_autor') ?>
                                </div>
                                <div class="photo">
                                    <?= wp_get_attachment_image(get_post_field('about_quote_photo')) ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="trend">
                <div class="container">
                    <h2><?= get_post_field('about_trend_title') ?></h2>
                    <?php $trends = get_about_trends(get_post_field('about_trend')); ?>
                    <dev class="trends-left"><?= $trends['left'] ?></dev>
                    <dev class="trends-right"><?= $trends['right'] ?></dev>
                </div>
            </div>

        <?php endif; ?>
    </div>

<?php get_footer(); ?>