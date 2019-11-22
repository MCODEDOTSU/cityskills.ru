<?php
$month = empty($_GET['m']) ? 0 : (int)$_GET['m'];
$year = empty($_GET['y']) ? 0 : (int)$_GET['y'];
get_header();
?>

<?php
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div id="breadcrumbs"><div class="container">','</div></div>' );
}
?>

    <?php
        if($month && $year):
            get_template_part('category-date');
        else:
    ?>

    <div class="page simple-page category-page category-infografika">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker() ]) ?>
            </nav>

            <div class="content">

                <h1><?php single_cat_title(); ?></h1>

                <?php $category = get_queried_object(); ?>

                <div class="post-list customizable" id="infographics">

                    <div class="left-post-list"></div><div class="right-post-list"></div>

                    <div class="action">
                        <button class="btn" onclick="loadInfografics()">показать еще</button>
                        <input type="hidden" name="slug" value="<?=$category->slug?>">
                        <input type="hidden" name="top" value="0">
                    </div>

                    <script type="text/javascript">
                        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>';
                        jQuery(document).ready(function(e) {
                            loadInfografics();
                        });
                    </script>

                </div>

            </div>

        </div>
    </div>

    <?php endif ?>

<?php get_footer(); ?>