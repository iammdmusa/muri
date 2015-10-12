<?php
/*
Template Name: Full Width Page
*/
get_header();?>
    <div id="main-content">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 post-content">
                <?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile; // end of the loop.
                ?>
            </div>
        </div>
    </div>
<?php
get_footer();
?>