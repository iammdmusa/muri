<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package muri
 */

get_header(); ?>

    <div id="main-content">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-8 post-content archive-content">
                <?php if ( have_posts() ) : ?>

                    <header class="page-header">
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'muri' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header><!-- .page-header -->

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content','search' );
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