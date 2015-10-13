<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package muri
 */

get_header(); ?>

<div id="main-content">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-8 post-content">
            <section class="error-404 not-found">
                <header class="page-header">

                    <h1 class="page-title"><i class="fa fa-tripadvisor"></i>
                        <?php
                            esc_html_e( 'ps! That page can&rsquo;t be found.', 'muri' );
                        ?>
                    </h1>
                </header><!-- .page-header -->
                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'muri' ); ?></p>

                    <?php get_search_form(); ?>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->
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
