<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package muri
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="cat-post-section blog-link">
        <div class="row item">
            <h2 class="post-title">
                <a href="<?php the_permalink();?>">
                    <?php the_title();?>
                </a>
            </h2>
        </div>
    </div>

</article><!-- #post-## -->