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
                <div class="heading-404">
                   404!
                </div>
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
