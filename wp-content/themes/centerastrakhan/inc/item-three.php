<div class="three-items">
    <div class="first-block item">
        <?php
        $query = new WP_Query(array(
            'category__in' => get_theme_mod('centerastrakhan_first_category'),
            'posts_per_page' => 1,
            'paged' => 0,
            'post_status' => 'publish'
        ));

        if ($query->have_posts()):
            $query->the_post();
            $url = get_the_post_thumbnail_url(get_the_ID());
            ?>
            <a href="<?=get_permalink(get_the_ID())?>" title="<?=get_the_title() ?>">
                <div class="thumbnail">
                    <div class="img" style="background-image:url(<?= $url ?>);"></div>
                </div>

                <label class="category" title="<?=get_theme_mod('centerastrakhan_first_name')?>">
                    <?=get_theme_mod('centerastrakhan_first_name')?>
                </label>

                <div class="content">
                    <h2><?= get_the_title() ?></h2>
                </div>
            </a>
        <?php
        endif;
        wp_reset_query();
        ?>
    </div>

    <div class="second-block item">
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
            <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                <div class="thumbnail">
                    <div class="img" style="background-image:url(<?= $url ?>);"></div>
                </div>
                <div class="content">
                    <?php $category = getPrimaryCategory(get_the_ID()); ?>
                    <h2><?= get_the_title() ?></h2>
                </div>
                <i class="fa fa-microphone" title="<?=$category->name?>"></i>
            </a>
        <?php
        endif;
        wp_reset_query();
        ?>
    </div>

    <div id="third-slider-items" class="third-block item">

        <?php
        $query = new WP_Query(array(
            'category__in' => get_theme_mod('centerastrakhan_third_category'),
            'posts_per_page' => get_theme_mod('centerastrakhan_third_count'),
            'paged' => 0,
            'post_status' => 'publish'
        ));

        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();
                $url = get_the_post_thumbnail_url(get_the_ID());
                ?>
                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>" class="slider-item">
                    <?php $category = getPrimaryCategory(get_the_ID()); ?>
                    <i class="fa fa-play" title="<?=$category->name?>"></i>
                    <div class="thumbnail">
                        <div class="img" style="background-image:url(<?= $url ?>);"></div>
                    </div>
                    <!--div class="content">
                        <h2><?= get_the_title() ?></h2>
                    </div-->
                </a>
            <?php endwhile;

            $paginator = "";
            for($i = 0; $i < $query->post_count; $i++) {
                $paginator .= "<i class='page' data-page='$i'></i>";
            }
            echo "<div class='pagination'>$paginator</div>";

        endif;
        wp_reset_query();
        ?>
    </div>
</div>