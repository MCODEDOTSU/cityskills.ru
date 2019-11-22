<?php get_header(); ?>

    <div class="page simple-page category-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <h1><?php single_cat_title(); ?></h1>

                <div class="projects-list">

                <?php if ( have_posts() ): ?>

                    <?php while ( have_posts() ): the_post(); ?>

                        <?php $url = get_the_post_thumbnail_url(get_the_ID()); ?>

                        <div class="project-item">

                            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                <div class="flipper">
                                    <div class="front">
                                        <a class="project-item-link up" href="#project-<?=get_the_ID()?>" title="<?=get_the_title()?>">
                                            <h2><span><?=get_the_title()?></span></h2>
                                            <div class="thumbnail">
                                                <div class="img" style="background-image:url(<?=$url?>)"></div>
                                            </div>
                                            <p class="project-description"><span><?=get_post_meta(get_the_ID(), 'project_description', true)?></span></p>
                                        </a>
                                    </div>
                                    <div class="back">
                                        <span>
                                            <div class="text"><?=get_post_meta(get_the_ID(), 'project_text', true)?></div>
                                            <div class="action">
                                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?=get_the_title()?>">подробнее</a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php endif; ?>

                </div>

            </div>

        </div>
    </div>

<?php get_footer(); ?>