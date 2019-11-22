<div class="accreditation-block item">

    <?php

    $page = get_post(get_theme_mod('centerastrakhan_accreditation_page'));

    if (!empty($page)):

        $url = get_the_post_thumbnail_url($page->ID);
        ?>

        <a href="<?= get_permalink($page->ID) ?>" title="<?= $page->post_title ?>">

            <div class="thumbnail">
                <div class="img" style="background-image:url(<?= $url ?>);"></div>
            </div>

            <label class="category" title="<?=get_theme_mod('centerastrakhan_accreditation_name')?>">
                <?=get_theme_mod('centerastrakhan_accreditation_name')?>
            </label>

            <div class="content">
                <h2><?= $page->post_title ?></h2>
            </div>

        </a>

    <?php

    endif;
    wp_reset_query();

    ?>
</div>