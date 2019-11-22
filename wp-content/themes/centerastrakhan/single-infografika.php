<?php

get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <div class="page simple-page infografika">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <?php if ( have_posts() ) : the_post(); ?>

                    <h1><?php the_title(); ?></h1>
                    <div class="date"><?php the_time('d.m.Y'); ?></div>
                    <a href="/category/infografika/">Список инфографики</a>

                    <?php
                        $source = get_post_field('infographics_source');
                        $link = get_post_field('infographics_link');
                        if($source && $link) {
                            echo "<div class='source'>Источник: <a href='$link' title='$source'>$source</a></div>";
                        } elseif($source) {
                            echo "<div class='source'>Источник: $source</div>";
                        }

                        $img = get_post_field('infographics_img');
                        $url = wp_get_attachment_url($img);
                        $size = round(filesize(get_attached_file($img)) * 0.001 );

                        $previous = get_previous_post(true);
                        $next = get_next_post(true);
                    ?>

                    <a class='link nolightbox' href="<?=$url?>" download="<?=$url?>">Скачать (<?=$size?> Кбайт)</a>

                    <a class='link' href="<?=$url?>">
                        <?=wp_get_attachment_image($img, 'full')?>
                    </a>

                    <?php the_content(); ?>

                    <div class="pagination">
                        <div class="previous">
                            <?php if( ! empty($previous) ): ?>
                                <a href="<?= get_permalink( $previous ) ?>" class="btn">Предыдущая инфографика</a>
                            <?php endif; ?>
                        </div><div class="next">
                            <?php if( ! empty($next) ): ?>
                                <a href="<?= get_permalink( $next ) ?>" class="btn">Следующая инфографика</a>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>

<?php get_footer(); ?>