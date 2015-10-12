<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package muri
 */

?>

<article id="post-single post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php muri_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
            the_post_thumbnail('single-post',array('class' => 'single-post'));
            the_content();
        ?>
	</div><!-- .entry-content -->
    <div class="post-tags">
        <?php
            muri_post_tags_cate();
        ?>
    </div>
    <div class="pre-next">
        <h3 class="post-nav-title"><?php _e('Previous & Next Post','muri');?></h3>
        <div class="row">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <?php
                    if (!empty( $prev_post )):
                        if (has_post_thumbnail( $prev_post->ID ) ) {
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'next_prev');
                        }?>
                        <img class="img-responsive" src="<?php echo $image[0];?>" alt="<?php echo get_the_title($prev_post->ID);?>">
                        <h3><a href="<?php echo get_the_permalink($prev_post->ID);?>"><?php echo get_the_title($prev_post->ID);?></a></h3><?php
                    endif;
                ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <?php
                    if (!empty( $next_post )):
                        if (has_post_thumbnail( $next_post->ID ) ) {
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'next_prev');
                        }?>
                        <img class="img-responsive" src="<?php echo $image[0];?>" alt="<?php echo get_the_title($next_post->ID);?>">
                        <h3><a href="<?php echo get_the_permalink($next_post->ID);?>"><?php echo get_the_title($next_post->ID);?></a></h3><?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->

