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
            <h2 class="post-title">
                <a href="<?php the_permalink();?>">
                    <?php the_title();?>
                </a>
            </h2>
            <?php
            $cats = array();
            global $post;
            foreach(wp_get_post_categories($post->ID) as $c)
            {
                $cat = get_category($c);
                array_push($cats,$cat->name);
            }
            $post_categories = '';
            if(sizeOf($cats)>0)
            {
                $post_categories = sprintf(esc_html_x('%s','post category','muri'),'<a href="'.esc_url( get_category_link( $cat->term_id ) ) .'">'.implode(',',$cats).'</a>');
            }
            ?>
            <div class="post-meta">
                <span class="author">
                    <i class="fa fa-user"></i>
                    <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )));?>">
                        <?php echo esc_html( get_the_author() );?>
                    </a>
                </span>
                <span class="date">
                    <i class="fa fa-calendar"></i>
                    <?php echo date_i18n( get_option( 'date_format' ), strtotime( '11/15-1976' ) );?>
                </span>
                <span class="in-cate">
                    <i class="fa fa-pencil"></i>
                    <?php echo $post_categories; ?>
                </span>
            </div>
            <?php
                preg_match('/src="([^"]+)"/', get_the_content(), $match);
                $url = $match[1];
            ?>
            <iframe width="100%" height="170" scrolling="no" frameborder="no" src="<?php echo $url;?>&amp;color=#C81717&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            <p class="post-desc">
                <?php echo excerpt(40);?>
            </p>
            <p>
                <a href="<?php the_permalink();?>" class="btn btn-default btn-txt"><i class="fa fa-long-arrow-right"></i><?php _e('LEARN MORE','muri');?></a>
            </p>
        </div>
    </div>

</article><!-- #post-## -->