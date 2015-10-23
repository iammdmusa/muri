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
    <div class="cat-post-section blog-standard">
        <div class="row item">
            <a href="<?php the_permalink(); ?>">
                <blockquote cite="<?php the_permalink();?>">
                    <?php the_title();?>
                </blockquote>
            </a>
        </div>
    </div>

</article><!-- #post-## -->