<?php
$month = empty($_GET['m']) ? 0 : (int)$_GET['m'];
$year = empty($_GET['y']) ? 0 : (int)$_GET['y'];
get_header();
?>

<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div id="breadcrumbs"><div class="container">', '</div></div>');
}
?>

<?php
if ($month && $year):
    get_template_part('category-date');
else:
    ?>

    <div class="page simple-page material category-page">
        <div class="container">

            <nav class="menu">
                <?php wp_nav_menu(['theme_location' => 'fullscreen', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            </nav>

            <div class="content">

                <div class="category-list-setting material-setting">
                    <button class="btn large active" data-type="book" onclick="setTypeMaterial(event)">Книги</button>
                    <button class="btn list" data-type="guidelines" onclick="setTypeMaterial(event)">Методические рекомендации</button>
                    <button class="btn list" data-type="media" onclick="setTypeMaterial(event)">Статьи в СМИ</button>
                    <button class="btn list" data-type="regulations" onclick="setTypeMaterial(event)">Нормативные документы</button>
                </div>

                <div id="device">
                    <div class="device-wrapper"></div>
                    <input type="hidden" name="category" value="<?= $cat ?>" />
                    <input type="hidden" name="type" value="book" />
                </div>

                <div id="mdevice">
                    <div class="device-wrapper"></div>
                </div>

                <script type="text/javascript">
                    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>';
                    jQuery(document).ready(function(e) { loadMaterials(); });
                </script>
            </div>

        </div>
    </div>

<?php endif ?>

<?php get_footer(); ?>