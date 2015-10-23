<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="cat-post-section blog-chat">
        <div class="row item">
            <a href="<?php the_permalink(); ?>">
                <blockquote cite="<?php the_permalink();?>">
                    <?php the_title();?>
                </blockquote>
            </a>
        </div>
    </div>

</article><!-- #post-## -->