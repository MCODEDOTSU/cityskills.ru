<?php

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page category-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <h1 style="display: none;"><?php single_cat_title(); ?></h1>

                <?php if ( have_posts() ) : ?>

                    <div class="post-list-avtografy">

                        <?php
                        $i = 0;
                        while ( have_posts() ):
                            the_post();

                            //thumbnail
                            $attachmentId = get_post_meta(get_the_ID(), 'sign_photo', true);
                            if($attachmentId) {
                                $url = wp_get_attachment_image_url($attachmentId, [400, 400]);
                            } else {
                                $url = get_the_post_thumbnail_url(get_the_ID(), [400, 400]);
                            }

                            $type = $i % 6;
                            if($type == 0 || $type == 3) echo "<div class='row'>";
                            if($type == 0 || $type == 4) echo "<div class='cell cell-2'>";
                            if($type == 2 || $type == 3) echo "<div class='cell cell-1'>";
                            if($type == 2 || $type == 3):
                        ?>
                            <div class="post-item type-full">
                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?=get_the_title()?>" class="post" style="background-image:url(<?=$url?>);">

                                    <div class="post-title">
                                        <h2><?=get_the_title()?></h2>
                                        <p><?=get_post_meta(get_the_ID(), 'sign_description', true)?></p>
                                    </div>

                                    <div class="post-meta"><div>
                                        <label class="meta-date">
                                            <?=get_the_time('d.m.Y')?>
                                        </label>
                                        |
                                        <label class="meta-views">
                                            <i class="fa fa-eye"></i>
                                            <?=get_post_meta(get_the_ID(), 'post_views', true)?>
                                        </label>
                                    </div></div>

                                </a>
                            </div>
                        <?php else: ?>
                            <div class="post-item type-rows">
                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?=get_the_title()?>" class="post">

                                    <div class="post-thumbnail">
                                        <div class="img" style="background-image:url(<?=$url?>);"></div>
                                    </div>

                                    <div class="post-title">
                                        <h2><?=get_the_title()?></h2>
                                        <p><?=get_post_meta(get_the_ID(), 'sign_description', true)?></p>
                                    </div>

                                    <div class="post-meta"><div>
                                        <label class="meta-date">
                                            <?=get_the_time('d.m.Y')?>
                                        </label>
                                        |
                                        <label class="meta-views">
                                            <i class="fa fa-eye"></i>
                                            <?=get_post_meta(get_the_ID(), 'post_views', true)?>
                                        </label>
                                    </div></div>

                                </a>
                            </div>
                        <?php
                            endif;
                            if($type == 1 || $type == 5 || $type == 2 || $type == 3) echo "</div>";
                            if($type == 2 || $type == 5) echo "</div>";
                            $i++;
                        endwhile;

                        if($type == 0 || $type == 4) echo "</div>";

                        ?>
                    </div>

                <?php endif; ?>

            </div>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        </div>
    </div>

<?php get_footer(); ?>