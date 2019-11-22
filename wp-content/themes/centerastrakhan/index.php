<?php get_header(); ?>

<div class="homepage-slider">
    <?php echo do_shortcode( get_theme_mod('centerastrakhan_code') ); ?>
</div>

<div class="container homepage-container">
    <div class="homepage-items">
        <?php get_template_part('inc/item-main'); ?>
        <?php get_template_part('inc/item-widget'); ?>
        <?php get_template_part('inc/item-news'); ?>
        <div class="line-1">
            <?php get_template_part('inc/item-opinion'); ?>
            <?php get_template_part('inc/item-favorites'); ?>
        </div>
        <div class="line-2">
            <div class="column column-1">
                <?php get_template_part('inc/item-accreditation'); ?>
                <?php get_template_part('inc/item-slider-news'); ?>
            </div>
            <div class="column column-2">
                <?php get_template_part('inc/item-widget-2'); ?>
            </div>
            <div class="column column-3">
                <?php get_template_part('inc/item-interview'); ?><!--
                --><?php get_template_part('inc/item-tv'); ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>