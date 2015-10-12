<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package muri
 */

get_header(); ?>


    <div id="main-content">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-8 post-content archive-content">
                <?php if ( have_posts() ) : ?>

                    <header class="page-header">
                        <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
                        ?>
                    </header><!-- .page-header -->

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content','archives' );
                        ?>

                    <?php endwhile; ?>

                    <?php muriPagination(); ?>


                <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                <?php endif; ?>

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