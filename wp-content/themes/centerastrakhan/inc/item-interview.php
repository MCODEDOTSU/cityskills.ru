<div class="interview-block item">
    <?php
    $query = new WP_Query(array(
        'category__in' => get_theme_mod('centerastrakhan_second_category'),
        'posts_per_page' => 1,
        'paged' => 0,
        'post_status' => 'publish'
    ));

    if ($query->have_posts()):
        $query->the_post();
        $url = get_the_post_thumbnail_url(get_the_ID());
        ?>

        <label class="category">
            <a href="<?= get_category_link(get_theme_mod('centerastrakhan_second_category')) ?>" title="Все интервью">
                <i class="fa fa-microphone" title="Все интервью"></i>
            </a>
        </label>

        <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
            <div class="thumbnail">
                <div class="img" style="background-image:url(<?= $url ?>);"></div>
            </div>
            <div class="content">
                <?php $category = getPrimaryCategory(get_the_ID()); ?>
                <h2><?=get_the_title()?></h2>
            </div>
        </a>
    <?php
    endif;
    wp_reset_query();
    ?>
</div>