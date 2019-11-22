<?php
$month = empty($_GET['m']) ? 0 : (int)$_GET['m'];
$year = empty($_GET['y']) ? 0 : (int)$_GET['y'];
get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

<?php
if ($month && $year):
    get_template_part('category-date');
else:
    ?>

    <div class="page simple-page category-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">

                <h1><?php single_cat_title(); ?></h1>

                <?php get_template_part('inc/category-list-setting'); ?>

                <?php if (have_posts()) : ?>

                    <div class="post-list customizable">

                        <?php while (have_posts()): the_post(); ?>
                            <?php $url = get_the_post_thumbnail_url(get_the_ID()); ?>
                            <div class="post-item"><a href="<?= get_permalink(get_the_ID()) ?>"
                                                      title="<?= get_the_title() ?>">

                                    <div class="thumbnail">
                                        <div class="img" style="background-image:url(<?= $url ?>);"></div>
                                    </div>

                                    <div class="content">

                                        <div class="date">
                                            <span class="day"><?= get_the_time('j') ?></span>
                                            <?= getMonthName(get_the_time('F')) ?>
                                        </div>

                                        <?php if (get_post_field('post_icon') !== 'empty'): ?>
                                            <i class="fa <?= get_post_field('post_icon') ?> post-icon"></i>
                                        <?php endif; ?>

                                        <h2><?= get_the_title() ?></h2>
                                    </div>

                                </a>

                                <?php if (get_post_field('project_office_region') && get_post_field('project_office_region') != 'all'): ?>

                                    <?php $region = get_post_field('project_office_region'); ?>

                                    <div class="project-office-city">
                                        <a href="/category/press-centr/novosti-proektnyx-ofisov?region=<?= $region ?>&city=<?= get_post_field("project_office_city_$region") ?>"
                                           title="<?= get_post_field("project_office_city_$region") ?>">
                                            <?= get_post_field("project_office_city_$region") ?>
                                        </a>
                                    </div>

                                <?php endif; ?>

                            </div>
                        <?php endwhile; ?>
                    </div>

                <?php endif; ?>

            </div>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        </div>
    </div>

<?php endif; ?>

<?php get_footer(); ?>