<?php
/*
    Template Name: Страца проектного офиса
*/

get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page office-city-page no-tumb">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">

                <?php if (have_posts()) : the_post(); ?>

                        <?php

                        if (function_exists('get_centerastrakhan_person') && get_centerastrakhan_person(get_the_ID())):

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
                                        <p class="person-description"><?= $person['description'] ?></p>
                                    </div>


                                </div>
                            </div>

                            <figure class="thumbnail <?= get_post_field('articles_type') ?>">

                                <a href="#person-data" class="fancybox-click">
                                    <?= wp_get_attachment_image($person['photo'], 'thumbnail') ?>
                                    <figcaption><?= $person['firstname'] ?> <?= $person['lastname'] ?></figcaption>
                                </a>
                            </figure>

                        <?php endif; ?>

                    <div class="office-contacts">

                        <h1><?php the_title(); ?></h1>

                        <?php if (get_post_field('office_contact')): ?>
                            <div class="contact-title">Данные проектного офиса</div>
                            <div class="contact-field"><?= the_field('office_contact') ?></div>
                        <?php endif; ?>

                    </div>

                    <?php the_content(); ?>

                <?php endif; ?>

                <!-- Новости проектного офиса -->
                <?php $posts = get_city_office_news(get_the_ID()) ?>

                <?php if (count($posts)) : ?>

                    <h2>Новости проектного офиса</h2>

                    <div class="post-list customizable">

                        <?php foreach ($posts as $post): ?>

                            <div class="post-item"><a href="<?= get_permalink($post['id']) ?>"
                                                      title="<?= $post['title'] ?>">

                                    <div class="thumbnail">
                                        <div class="img" style="background-image:url(<?= $post['url'] ?>);"></div>
                                    </div>

                                    <div class="content">

                                        <div class="date">
                                            <span class="day"><?= $post['date'] ?></span>
                                            <?= $post['month'] ?>
                                        </div>

                                        <h2><?= $post['title'] ?></h2>
                                    </div>

                                    <div class="project-office-city"><?= $post['city'] ?></div>

                                </a></div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>

<?php get_footer(); ?>