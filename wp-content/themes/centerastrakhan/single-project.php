<?php
get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

    <div class="page simple-page project">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">
                <?php if (have_posts()) : the_post(); ?>

                    <figure class="thumbnail">
                        <a href="<?= get_the_post_thumbnail_url() ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                            <figcaption><?= get_post_field('opinion_name') ?></figcaption>
                        </a>
                    </figure>

                    <div class="title">
                        <h1><?php the_title(); ?></h1>
                        <div class="description"><?= get_post_meta(get_the_ID(), 'project_description', true) ?></div>
                    </div>

                    <h2>Информация о проекте</h2>

                    <table class="project-description">

                        <!-- Полное название проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_full_title', true)): ?>
                            <tr>
                                <td>Полное наименование проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_full_title', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Логотип проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_logo', true)): ?>
                            <?php $src = wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'project_logo', true)) ?>
                            <tr>
                                <td>Логотип проекта</td>
                                <td>
                                    <figure class="logo">
                                        <a href="<?= $src ?>">
                                            <img src="<?= $src ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                    </figure>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <!-- Краткое описание проекта (деятельности в рамках проекта) -->
                        <?php if (get_post_meta(get_the_ID(), 'project_activity', true)): ?>
                            <tr>
                                <td>Краткое описание проекта (деятельности в рамках проекта)</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_activity', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- География проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_geography', true)): ?>
                            <tr>
                                <td>География проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_geography', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Социальная значимость проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_sociality', true)): ?>
                            <tr>
                                <td>Социальная значимость проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_sociality', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Целевые группы проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_groups', true)): ?>
                            <tr>
                                <td>Целевые группы проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_groups', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Цель проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_goal', true)): ?>
                            <tr>
                                <td>Цель проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_goal', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Задачи проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_task', true)): ?>
                            <tr>
                                <td>Задачи проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_task', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Команда проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_team', true)): ?>
                            <tr>
                                <td>Команда проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_team', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Партнёры проекта -->
                        <?php if (get_post_meta(get_the_ID(), 'project_partners', true)): ?>
                            <tr>
                                <td>Партнёры проекта</td>
                                <td><?= get_post_meta(get_the_ID(), 'project_partners', true) ?></td>
                            </tr>
                        <?php endif; ?>

                        <!-- Ссылка -->
                        <?php if (get_post_meta(get_the_ID(), 'project_link', true)): ?>
                            <tr>
                                <td>Сайт проекта</td>
                                <td>
                                    <a href="<?= get_post_meta(get_the_ID(), 'project_link', true) ?>"
                                       title="<?php the_title(); ?>" target="_blank">
                                        <?= get_post_meta($post->ID, 'project_link_title', true) ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </table>

                    <h2>Дополнительная информация о проекте</h2>

                    <?php the_content(); ?>

                <?php endif; ?>

                <div class="next-prev-post">

                    <?php
                    $next = get_next_post_link('%link', 'следующий <i class="fa fa-caret-right"></i>', 1);
                    $prev = get_previous_post_link('%link', '<i class="fa fa-caret-left"></i> предыдущий', 1);
                    $category = get_category_by_slug( 'projects' );
                    ?>

                    <div class="prev-post">
                        <?= $prev ?>
                    </div>

                    <div class="all-post">
                        <a href="<?= get_category_link($category->cat_ID) ?>" title="Все проекты">Все проекты</a>
                    </div>

                    <div class="next-post">
                        <?= $next ?>
                    </div>

                </div>

            </div>

        </div>
    </div>

<?php get_footer(); ?>