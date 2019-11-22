<?php
$query = new WP_Query(array(
    'category__in' => get_theme_mod('centerastrakhan_news_category'),
    'posts_per_page' => get_theme_mod('centerastrakhan_news_count'),
    'paged' => 0,
    'post_status' => 'publish'
));
if ($query->have_posts()):

    ?>

    <div class="news item">
        <label class="category">
            <a href="<?= get_category_link(get_theme_mod('centerastrakhan_news_category')) ?>"
               title="<?= get_theme_mod('centerastrakhan_news_name') ?>">
                <?= get_theme_mod('centerastrakhan_news_name') ?>
            </a>
        </label>
        <div class="content">
            <?php
            while ($query->have_posts()):
                $query->the_post();
                ?>
                <a href="<?=get_permalink(get_the_ID())?>" title="<?=get_the_title()?>" class="news-item">
                    <div class="date">
                        <span class="day"><?=get_the_time('j')?></span>
                        <?=getMonthName(get_the_time('F'))?>
                    </div>
                    <h2><?=get_the_title()?></h2>
                </a>
            <?php
            endwhile;
            ?>
        </div>
    </div>

<?php
endif;
wp_reset_query();
?>