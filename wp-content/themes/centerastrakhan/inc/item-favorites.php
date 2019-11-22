<?php
$query = new WP_Query(array(
    'category__in' => get_theme_mod('centerastrakhan_favorites_category'),
    'posts_per_page' => 1,
    'paged' => 0,
    'post_status' => 'publish'
));
if ($query->have_posts()):

    ?>

    <div class="favorites item">
        <label class="category">
            <a href="<?= get_category_link(get_theme_mod('centerastrakhan_favorites_category')) ?>"
               title="<?= get_theme_mod('centerastrakhan_favorites_name') ?>">
                <?= get_theme_mod('centerastrakhan_favorites_name') ?>
            </a>
        </label>
        <?php
        $query->the_post();
        $url = get_the_post_thumbnail_url(get_the_ID());
        ?>
        <a href="<?=get_permalink(get_the_ID())?>" title="<?=get_the_title()?>">
            <div class="thumbnail">
                <div class="img" style="background-image:url(<?=$url?>);"></div>
            </div>

            <div class="content">
                <div class="date">
                    <span class="day"><?=get_the_time('j')?></span>
                    <?=getMonthName(get_the_time('F'))?>
                </div>
                <h2><?=get_the_title()?></h2>
            </div>
        </a>
        <?php
        ?>
    </div>

<?php
endif;
wp_reset_query();
?>