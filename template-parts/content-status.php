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
    <div class="cat-post-section post-status">
        <div class="row item">
            <pre>
                <a href="<?php the_permalink();?>">
                    <?php the_title();?>
                </a>
            </pre>
        </div>
    </div>

</article><!-- #post-## -->