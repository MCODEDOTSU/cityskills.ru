<?php
/*
    Template Name: Руководство
*/

get_header(); ?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

<div class="page simple-page pravlenie">
    <div class="container">

        <nav class="menu">
            <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
        </nav>

        <div class="content">
            <?php if (have_posts()) : the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php

                $query = new WP_Query([
                    'meta_query' => [
                        [
                            'key' => 'head_section',
                            'compare' => 'LIKE',
                            'value' => get_the_title()
                        ],
                    ],
                    'orderby' => [
                        'head_position_clause' => 'ASC',
                        'head_sort_clause' => 'ASC',
                    ],
                ]);

                $row = 0;
                ?>
                <div class="pravlenie-items"> <?php

                while ($query->have_posts()) :

                    $query->the_post();

                    if (!function_exists('get_centerastrakhan_person') || !get_centerastrakhan_person(get_the_ID())) {
                        continue;
                    }
                    $person = get_centerastrakhan_person(get_the_ID());
                    $src = wp_get_attachment_url($person['photo']);

                    if (get_post_field('head_position') != $row) {
                        $row = get_post_field('head_position');
                        ?> </div><div class="pravlenie-items"> <?php
                    }

                    ?>

                    <div class="item">
                        <a href="<?= get_post_permalink() ?>">
                            <div class="person-image" style="background-image: url('<?= $src ?>')"></div>
                            <div class="person-data">
                                <p class="person-name"><?= $person['lastname'] ?> <?= $person['firstname'] ?> <?= $person['middlename'] ?></p>
                                <p class="person-post"><?= $person['post'] ?></p>
                            </div>
                        </a>
                    </div>

                <?php

                endwhile;

                ?> </div> <?php

                wp_reset_postdata();

                ?>

            <?php endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
