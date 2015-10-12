<?php
/*
Template Name: Left Sidebar Page
*/
get_header();?>
    <div id="main-content">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <?php
                dynamic_sidebar('sidebar-1');
                ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 post-content">
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