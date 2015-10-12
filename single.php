<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package muri
 */

get_header(); ?>
<div id="main-content">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-8 post-content">
            <?php while ( have_posts() ) : the_post();muri_setPostView_observe(get_the_ID());muri_fetchPostViews(get_the_ID()); ?>

                <?php get_template_part( 'template-parts/content', 'single' ); ?>

                <?php muri_related_tag_posts();?>
                <footer class="entry-footer">
                    <?php muri_entry_footer(); ?>
                </footer><!-- .entry-footer -->
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // End of the loop. ?>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-4">
            <?php
            dynamic_sidebar('sidebar-1');
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>