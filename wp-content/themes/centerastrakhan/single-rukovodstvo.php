<?php

get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page sovet">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">

                <?php
                if (have_posts()) :

                    the_post();

                    $person = get_centerastrakhan_person(get_the_ID());

                    $section = get_post_field('head_section');
                    $section = $section[0];
                    $page = get_page_by_title($section);
                    if(!empty($page)): ?>

                    <h1><?= $section ?></h1>
                    <a href="<?= get_page_link($page->ID); ?>" class="rukovodstvo-parent">Вернуться к списку</a>

                    <?php endif;



                    ?>

                    <p class="post-thumbnail">
                        <a href="<?= wp_get_attachment_url($person['photo']) ?>">
                            <?= wp_get_attachment_image($person['photo'], 'large') ?>
                        </a>
                    </p>

                    <h2 class="person-name"><?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?></h2>
                    <h3 class="person-post"><?= $person['post'] ?></h3>

                    <?php if($person['description']): ?>
                        <div class="person-description"><?= $person['description'] ?></div>
                    <?php endif; ?>

                    <h2>Биография</h2>

                    <?php the_content(); ?>

                <?php endif; ?>

                <div class="next-prev-post">

                    <?php
                    $next = get_next_post_link('%link', 'следующий <i class="fa fa-caret-right"></i>', 1);
                    $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущий', 1);
                    ?>

                    <div class="prev-post">
                        <?= $prev ?>
                    </div>

                    <div class="all-post">
                        <a href="<?= get_page_link($page->ID); ?>">Вернуться к списку</a>
                    </div>

                    <div class="next-post">
                        <?= $next ?>
                    </div>

                </div>

            </div>

        </div>
    </div>

<?php get_footer(); ?>