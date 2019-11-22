<?php

get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page category-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">

                <h1 style="display: none;"><?php single_cat_title(); ?></h1>

                <?php if (have_posts()) : ?>

                    <div class="post-list-stati">

                        <?php while (have_posts()): the_post(); ?>
                            <?php

                            $author = '';
                            if((function_exists('get_centerastrakhan_person') && get_centerastrakhan_person(get_the_ID()))) {

                                $person = get_centerastrakhan_person(get_the_ID());
                                $url = wp_get_attachment_image_url($person['photo'], 'thumbnail');
                                $author = "{$person['firstname']} {$person['lastname']}";

                            } else {

                                $url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');

                            }

                            ?>
                            <div class="post-item <?= get_post_meta(get_the_ID(), 'articles_type', true) ?>">

                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>" class="post">

                                    <?php if (get_post_meta(get_the_ID(), 'articles_type', true) === 'article'): ?>

                                        <div class="header">
                                            <div class="thumbnail">
                                                <div class="img" style="background-image:url(<?= $url ?>);"></div>
                                            </div>
                                            <h4>
                                                <span><?= $author ?></span>
                                            </h4>
                                        </div>

                                        <h2>
                                            <?= get_the_title() ?>
                                        </h2>

                                        <h3>
                                            <?= get_post_meta(get_the_ID(), 'articles_description', true) ?>
                                        </h3>

                                        <div class="meta">
                                            <div>
                                                <label class="meta-date">
                                                    <?= get_the_time('d.m.Y') ?>
                                                </label>
                                                |
                                                <label class="meta-date">
                                                    <i class="fa fa-eye"></i>
                                                    <?= get_post_meta(get_the_ID(), 'post_views', true) ?>
                                                </label>
                                            </div>
                                        </div>

                                    <?php elseif (get_post_meta(get_the_ID(), 'articles_type', true) === 'cmk'): ?>

                                        <div class="header">ЦМК</div>

                                        <div class="thumbnail">
                                            <div class="img"
                                                 style="background-image:url(<?= get_the_post_thumbnail_url(get_the_ID(), [300, 300]) ?>);"></div>
                                        </div>

                                        <h2><?= get_the_title() ?></h2>

                                        <div class="meta">
                                            <div>
                                                <label class="meta-date">
                                                    <?= get_the_time('d.m.Y') ?>
                                                </label>
                                                |
                                                <label class="meta-views">
                                                    <i class="fa fa-eye"></i>
                                                    <?= get_post_meta(get_the_ID(), 'post_views', true) ?>
                                                </label>
                                            </div>
                                        </div>

                                    <?php else: ?>

                                        <div class="header">Выступление</div>
                                        <div class="thumbnail">
                                            <div class="img" style="background-image:url(<?= $url ?>);"></div>
                                        </div>

                                        <h2>
                                            <?= $author ?>
                                        </h2>
                                        <h3>
                                            <?= get_post_meta(get_the_ID(), 'articles_place', true) ?>
                                        </h3>

                                        <div class="meta">
                                            <div>
                                                <label class="meta-date">
                                                    <?= get_the_time('d.m.Y') ?>
                                                </label>
                                                |
                                                <label class="meta-date">
                                                    <i class="fa fa-eye"></i>
                                                    <?= get_post_meta(get_the_ID(), 'post_views', true) ?>
                                                </label>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                </a>

                                <?php if (get_post_meta(get_the_ID(), 'articles_site', true)): ?>
                                    <a class="link" href="<?= get_post_meta(get_the_ID(), 'articles_site', true) ?>">
                                        <?= str_replace('http://', '', str_replace('https://', '', get_post_meta(get_the_ID(), 'articles_site', true))) ?>
                                    </a>
                                <?php endif; ?>

                            </div>
                        <?php endwhile; ?>
                    </div>

                <?php endif; ?>

            </div>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        </div>
    </div>

<?php get_footer(); ?>