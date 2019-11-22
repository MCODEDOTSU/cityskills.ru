<?php
/*
    Template Name: Проекты
*/

get_header();
?>

<div class="page simple-page">
    <div class="container">

        <nav class="menu">
            <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
        </nav>

        <div class="content">
            <?php if ( have_posts() ) : the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php
                $pages = get_pages(['child_of' => get_the_ID()]);
                foreach( $pages as $post ){
                    ?>
                    <div class="project-item">
                        <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                            <div class="flipper">
                                <div class="front">
                                    <a class="project-item-link up" href="#project-<?=$post->ID?>" title="<?=get_the_title($post->ID)?>">
                                        <div class="thumbnail">
                                            <?=get_the_post_thumbnail($post->ID, 'thumbnail') ?>
                                        </div>
                                        <h2><?=get_the_title($post->ID)?></h2>
                                    </a>
                                </div>
                                <div class="back">
                                    <h3><?=get_the_title($post->ID)?></h3>
                                    <div class="text"><?=get_post_meta($post->ID, 'project_text', true)?></div>
                                    <div class="action">
                                        <a href="#project-<?=$post->ID?>" title="<?=get_the_title($post->ID)?>">подробнее</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-fancybox-content">
                        <div class="page-fancybox simple-page" id="project-<?=$post->ID?>">
                            <div class="header">
                                <div class="icon">
                                    <?=get_the_post_thumbnail($post->ID, 'thumbnail') ?>
                                </div>
                                <div class="title">
                                    <h2><?=get_the_title($post->ID)?></h2>
                                    <div class="description"><?=get_post_meta($post->ID, 'project_description', true)?></div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="left-block">
                                    <?=$post->post_content?>
                                </div>
                                <div class="right-block">
                                    <?php
                                        $documents = get_post_meta($post->ID, 'project_documents', true);
                                        if($documents): ?>
                                            <div class="documents">
                                                <h3>Документы:</h3>
                                                <?=$documents?>
                                            </div>
                                        <?php endif;
                                        $sciences = get_post_meta($post->ID, 'project_sciences', true);
                                        if($sciences): ?>
                                            <div class="sciences">
                                                <h3>Научные работы:</h3>
                                                <?=$sciences?>
                                            </div>
                                        <?php endif;
                                    ?>
                                    <a href="<?= get_post_meta($post->ID, 'project_link', true) ?>" title="<?=get_the_title($post->ID)?>" class="to-project">
                                        <?= get_post_meta($post->ID, 'project_link_title', true) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                wp_reset_postdata();
                ?>

            <?php endif; ?>

        </div>

    </div>
</div>

<?php get_footer(); ?>