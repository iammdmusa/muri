<?php
    if(is_404()){

    }else{?>
        <form role="search" method="get" class="searchbox" action="<?php echo home_url( '/' ); ?>">
            <input type="search" placeholder="<?php echo esc_attr_x( 'Search …', 'muri' ) ?>" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
            <input type="submit" class="searchbox-submit" value="<?php echo esc_attr_x( 'GO', 'muri' ) ?>" />
            <span class="searchbox-icon"><i class="fa fa-search"></i></span>
        </form><?php

    }
?>