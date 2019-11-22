<div id="searchform-container" class="searchform-container hidden">
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="search-input-container">
            <input type="text" class="search-input" value="<?php echo get_search_query(); ?>" name="s" id="s" />
        </div>
        <button class="fa fa-search btn-search"></button>
    </form>
    <button class="fa fa-angle-left btn-cross"></button>
</div>