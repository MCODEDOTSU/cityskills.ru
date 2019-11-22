<?php
$query = new WP_Query(array(
    'category__in' => get_theme_mod('centerastrakhan_opinion_category'),
    'posts_per_page' => get_theme_mod('centerastrakhan_opinion_count'),
    'paged' => 0,
    'post_status' => 'publish'
));
if ($query->have_posts()):

    ?>

    <div class="opinion item">

        <label class="category">
            <a href="<?= get_category_link(get_theme_mod('centerastrakhan_opinion_category')) ?>"
               title="<?= get_theme_mod('centerastrakhan_opinion_name') ?>">
                <?= get_theme_mod('centerastrakhan_opinion_name') ?>
            </a>
        </label>

        <div id="opinion-slider-items">
        <?php
        while ($query->have_posts()):
            $query->the_post();
            $url = get_the_post_thumbnail_url(get_the_ID());
            ?>
            <a href="<?=get_permalink(get_the_ID())?>" title="<?=get_the_title()?>" class="opinion-item slider-item">
                <div class="content">
                    <div class="thumbnail">
                        <div class="img" style="background-image:url(<?=$url?>);"></div>
                    </div>
                    <div class="text"><p><?=get_post_field('opinion_description')?></p></div>
                </div>
                <div class="description">
                    <p class="opinion-name"><?=get_post_field('opinion_name')?></p>
                    <p class="opinion-work"><?=get_post_field('opinion_work')?></p>
                </div>
            </a>
        <?php
        endwhile;

        $paginator = "";
        for($i = 0; $i < $query->post_count; $i++) {
            $paginator .= "<i class='page' data-page='$i'></i>";
        }
        echo "<div class='pagination'>$paginator</div>";

        ?>
        </div>
    </div>

<?php
endif;
wp_reset_query();
?>