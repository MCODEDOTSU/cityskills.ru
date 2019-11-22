<div id="tv-block-slider-items" class="tv-block item">

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

            //Youtube
            $video = get_post_meta(get_the_ID(), 'tv_url', true);

            ?>
            <a href="<?=$video?>" title="<?=get_the_title()?>" class="slider-item">
                <?php $category = getPrimaryCategory(get_the_ID()); ?>
                <i class="fa fa-play" title="<?=$category->name?>"></i>
                <div class="thumbnail">
                    <div class="img" style="background-image:url(<?=$url?>);"></div>
                </div>
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

    <script type="text/javascript">
        jQuery(document).ready(function(e) {
            jQuery('.tv-block .slider-item').fancybox({
                'width'				: '75%',
                'height'			: '75%',
                'autoScale'     	: false,
                'transitionIn'		: 'none',
                'transitionOut'		: 'none',
                'type'				: 'iframe',
                // 'onStart'           : function (e, t, f) {
                //     if(jQuery('#fancybox-expand').length == 0) {
                //         jQuery('#fancybox-outer').append('<button id="fancybox-expand"><i class="fa fa-expand"></i></button>');
                //         jQuery('#fancybox-expand').on('click', function () {
                //             f.height = '100%';
                //             f.width = '100%';
                //             f.resize();
                //         });
                //     }
                // }
            });
        });
    </script>

</div>