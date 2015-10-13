<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package muri
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="search-page">
        <h2 class="post-title">
            <a href="<?php the_permalink();?>">
                <?php the_title();?>
            </a>
        </h2>
        <p class="post-desc">
            <?php echo excerpt(40);?>
        </p>
        <p>
            <a href="<?php the_permalink();?>" class="btn btn-default btn-txt"><i class="fa fa-long-arrow-right"></i><?php _e('LEARN MORE','muri');?></a>
        </p>
    </div>

</article><!-- #post-## -->

