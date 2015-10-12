<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package muri
 */

if ( ! function_exists( 'muri_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function muri_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'muri' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'muri' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'muri_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function muri_entry_footer() {
	// Hide category and tag text for pages.
    global $post;
    $user_email = get_the_author_meta('user_email');
    $hash = md5($user_email);
    $author_desc = wp_trim_words(get_the_author_meta('user_description'),40,'');

    $author_site = get_the_author_meta('website');
    $google_profile = get_the_author_meta( 'google_profile' );
    $twitter_profile = get_the_author_meta( 'twitter_profile' );
    $facebook_profile = get_the_author_meta( 'facebook_profile' );
    $linkedin_profile = get_the_author_meta( 'linkedin_profile' );
    $pinterest_profile = get_the_author_meta( 'pinterest_profile' );

    if(!empty($author_site)){
        $web = '<li><a href="'.esc_url($author_site).'"><i class="fa fa-link"></i></i></a></li>';
    }
    if(!empty($facebook_profile)){
        $fb = '<li><a href="'.esc_url($facebook_profile).'"><i class="fa fa-facebook"></i></a></li>';
    }
    if(!empty($twitter_profile)){
        $tw = '<li><a href="'.esc_url($twitter_profile).'"><i class="fa fa-twitter"></i></a></li>';
    }
    if(!empty($google_profile)){
        $gplus = '<li><a href="'.esc_url($google_profile).'"><i class="fa fa-google-plus"></i></a></li>';
    }
    if(!empty($linkedin_profile)){
        $in = '<li><a href="'.esc_url($linkedin_profile).'"><i class="fa fa-linkedin"></i></a></li>';
    }
    if(!empty($pinterest_profile)){
        $pin = ' <li><a href="'.esc_url($pinterest_profile).'"><i class="fa fa-pinterest-p"></i></a></li>';
    }

    $html = '<div class="about-author">';

        $html .= '<div class="media">
                        <img class="media-object pull-left" width="120px" height="120px" src="http://www.gravatar.com/avatar/'.$hash.'" alt="'.get_the_author_meta('display_name').'">
                    <div class="media-body">
                        <h4 class="media-heading">'.get_the_author_meta('display_name').'</h4>
                        <ul class="list-inline">'.$web.$fb.$tw.$gplus.$in.$pin.'</ul>
                        <p>'.$author_desc.'</p>
                    </div>
                </div>';
    $html .= '</div>';


	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'muri' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
    echo $html;
}
endif;

function muri_post_tags_cate(){
    $html = '<div class="tags-cate">';
    $html .= '<div class="row">';
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'muri' ) );
        if ( $categories_list && muri_categorized_blog() ) {
            $html .= '<div class="col-xs-12 col-sm-12 col-md-6">
                                       <span class="tags">
                                          <i class="fa fa-paperclip"></i>
                                           '.$categories_list.'
                                       </span>
                                    </div>';
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'muri' ) );
        if ( $tags_list ) {
            $html .= '<div class="col-xs-12 col-sm-12 col-md-6">
                                        <span class="tags pull-right">
                                           <i class="fa fa-tags"></i>
                                           '.$tags_list.'
                                       </span>
                                    </div>';
        }
    }
    $html .= '</div>';
    $html .= '</div>';
    echo $html;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function muri_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'muri_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'muri_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so muri_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so muri_categorized_blog should return false.
		return false;
	}
}


function muri_related_tag_posts(){

    global $post;
    $html = '';
    $tags = wp_get_post_tags($post->ID);
    if($tags){
        $html .= '<div class="related-post">
                        <h3 class="title">'.__('Related Posts','muri').'</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="related-post">';

                                    $tag_ids = array();
                                    foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                                    $args = array(
                                        'tag__in' => $tag_ids,
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page' => 3,
                                        'caller_get_posts' => 1,
                                    );
                                    $loop = new WP_Query($args);
                                    while ( $loop->have_posts() ): $loop->the_post();
                                        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'related_post');
                                        $html .= '<a href="'.get_the_permalink($post->ID).'">
                                                    <div class="item">
                                                        <img src="'.$img[0].'" alt="'.get_the_title($post->ID).'">
                                                        <a href="'.get_the_permalink($post->ID).'">
                                                            <h4>'.get_the_title($post->ID).'</h4>
                                                        </a>
                                                    </div>
                                                </a>';
                                    endwhile;
                                    wp_reset_query();
        $html .= '</div>
                        </div>
                    </div>
                </div>';

    }


    echo $html;
}
/**
 * Flush out the transients used in muri_categorized_blog.
 */
function muri_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'muri_categories' );
}
add_action( 'edit_category', 'muri_category_transient_flusher' );
add_action( 'save_post',     'muri_category_transient_flusher' );
