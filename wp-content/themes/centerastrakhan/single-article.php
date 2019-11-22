<?php
get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page article">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">
                <?php if (have_posts()) : the_post(); ?>

                    <div class="data">
                        <div class="date">
                            <?= get_the_time('d F Y') ?>
                        </div>
                        <div class="views">
                            <?= plural_form(get_post_meta(get_the_ID(), 'post_views', true), ['просмотр', 'просмотра', 'просмотров']); ?>
                        </div>
                        <?php if (get_post_field('project_office_region') && get_post_field('project_office_region') != 'all'): ?>
                            <?php $region = get_post_field('project_office_region'); ?>
                            <div class="category">
                                <a href="<?= get_site_url() ?>/category/press-centr/novosti-proektnyx-ofisov/?region=<?= get_post_field('project_office_region') ?>&city=<?= get_post_field("project_office_city_$region") ?>"
                                   title="<?= get_post_field("project_office_city_$region") ?>">
                                    <?= get_post_field("project_office_city_$region") ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    if (get_post_field('articles_type') === 'cmk') {

                        ?>
                        <figure class="thumbnail cmk">

                            <a href="<?= get_template_directory_uri() . '/images/logo-full.png' ?>">
                                <img width="150" height="150"
                                     src="<?= get_template_directory_uri() . '/images/logo.png' ?>"
                                     class="attachment-thumbnail size-thumbnail" alt="<?= get_bloginfo('name') ?>">
                                <figcaption><?= get_bloginfo('name') ?></figcaption>
                            </a>
                        </figure>
                        <h1><?php the_title(); ?></h1>
                        <?php

                    } elseif (function_exists('get_centerastrakhan_person') && get_centerastrakhan_person(get_the_ID())) {

                        $person = get_centerastrakhan_person(get_the_ID());

                        ?>

                        <div class="fancybox-container">
                            <div id="person-data" class="fancybox-content">

                                <div class="person-photo">
                                    <?= wp_get_attachment_image($person['photo'], 'large') ?>
                                </div>

                                <div class="person-data">
                                    <p class="person-name"><?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?></p>
                                    <p class="person-post"><?= $person['post'] ?></p>
                                    <div class="person-description"><?= $person['description'] ?></div>
                                </div>


                            </div>
                        </div>

                        <figure class="thumbnail <?= get_post_field('articles_type') ?>">

                            <a href="#person-data" class="fancybox-click">
                                <?= wp_get_attachment_image($person['photo'], 'thumbnail') ?>
                                <figcaption><?= $person['firstname'] ?> <?= $person['lastname'] ?></figcaption>
                            </a>
                        </figure>

                        <h1><?php the_title(); ?></h1> <?php

                    } else {
                        ?> <h1 class="full"><?php the_title(); ?></h1> <?php
                    }
                    ?>

                    <?php the_content(); ?>

                    <div class="next-prev-post">

                        <?php
                        $next = get_next_post_link('%link', 'следующие <i class="fa fa-caret-right"></i>', 1);
                        $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущие', 1);
                        $category = get_category_by_slug('stati');
                        ?>

                        <div class="prev-post">
                            <?= $prev ?>
                        </div>

                        <div class="all-post">
                            <a href="<?= get_category_link($category->cat_ID) ?>" title="Все материалы">Все
                                материалы</a>
                        </div>

                        <div class="next-post">
                            <?= $next ?>
                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>

<?php get_footer(); ?>