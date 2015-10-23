<div class="search">
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="row">
            <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label','muri' ); ?></label>
            <input type="text" class="" value="<?php echo get_search_query(); ?>" name="s" id="s" />
            <input type="submit" class="btn-comment" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button','muri' ); ?>" />
        </div>
    </form>
</div>