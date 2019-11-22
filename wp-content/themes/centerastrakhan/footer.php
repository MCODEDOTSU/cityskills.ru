</div>

<footer>
    <div class="container">
        <nav class="menu">
            <?php wp_nav_menu(['theme_location' => 'footer', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            <button class="fa fa-bars fullscreenmenu-show"></button>
        </nav>
        <div class="footer-left">
            <div class="copyright-widget">
                <?php dynamic_sidebar( 'copyright-sidebar' ); ?>
            </div>
            <div class="about-widget">
                <?php dynamic_sidebar( 'about-sidebar' ); ?>
            </div>
        </div>
        <div class="footer-right">
            <div class="social">
                <a href="<?=get_theme_mod('centerastrakhan_facebook', '#')?>" title="Facebook">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="<?=get_theme_mod('centerastrakhan_vkontakte', '#')?>" title="Вконтакте">
                    <i class="fa fa-vk"></i>
                </a>
                <a href="<?=get_theme_mod('centerastrakhan_instagram', '#')?>" title="Instagram">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="<?=get_theme_mod('centerastrakhan_youtube', '#')?>" title="Youtube">
                    <i class="fa fa-youtube"></i>
                </a>
            </div>
            <span class="footer-title"><?=bloginfo('name')?></span>
        </div>
    </div>

    <div id="btn-up">
        <i class="fa fa-angle-up"></i>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>