<?php
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function muri_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'muri_content_width', 640 );
}
add_action( 'after_setup_theme', 'muri_content_width', 0 );

add_filter( 'comment_form_default_fields', 'muri_comment_form_fields' );
function muri_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="row">
                        <div class="col-md-4">
                            <div>' .
                                '<input class="form-control" id="author" placeholder="Name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
                            </div>
                        </div>',
            'url' => '<div class="col-md-4">
                            <div>' .
                '<input class="form-control" id="url" placeholder="'.__('Website URL','muri').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' />
                            </div>
                        </div>',
            'email'  => '<div class="col-md-4">
                            <div>' .
                                '<input class="form-control" id="email" placeholder="Email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
                            </div>
                        </div>
                    </div>',
    );

    return $fields;
}
add_filter( 'comment_form_defaults', 'muri_comment_form' );
function muri_comment_form( $args ) {
    $args['title_reply'] = 'Post a Comment';
    $args['comment_notes_before'] = '';
    $args['comment_field'] = '<div class="comment-box">
                                <textarea placeholder="Write Comments Here ..." class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                            </div>';
    $args['label_submit'] = 'Submit';
    $args['class_submit'] = 'btn-comment'; // since WP 4.1

    return $args;
}

function muri_comment_author($id, $comment_id)
{
    $user = new WP_User($id);
    if ($user) {
        return $user->display_name;
    }
    return get_comment_author($comment_id);
}

function muri_user_display_name($id)
{
    $user = new WP_User($id);
    return $user->display_name;
}

function muri_comment_walker($comment, $args, $depth)
{
    ?>
    <div class="row blog-comments" id="comment-<?php comment_ID(); ?>">
        <div class="col-sm-2">
            <?php echo get_avatar($comment->user_id); ?>
        </div>
        <div class="col-sm-10">
            <div class="comments-itself">
                <h4>
                    <?php echo muri_comment_author($comment->user_id, $comment->comment_ID); ?>
                    <span><?php echo get_comment_date("d F, Y"); ?> / <?php comment_reply_link(array_merge($args, array('add_below' => "comment", 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                </h4>
                <p>
                    <?php
                    $cmnt = get_comment_text();
                    echo wpautop($cmnt);
                    ?>
                </p>
            </div>
        </div>
    </div>
<?php
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}


function muriPagination() {

    if( is_singular() )
        return;
    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}

function getHeaderSearch(){
    $html = '<form role="search" method="get" class="searchbox" action="'.home_url( '/' ).'">
                <input type="search" placeholder="'.esc_attr_x( 'Search …', 'muri' ).'" name="search" class="searchbox-input" onkeyup="buttonUp();" required>
                <input type="submit" class="searchbox-submit" value="'.esc_attr_x( 'GO', 'muri' ).'" />
                <span class="searchbox-icon"><i class="fa fa-search"></i></span>
            </form>';
    return $html;
}


// Add Shortcode
function muri_postSlider( $atts ) {

    // Attributes
    extract( shortcode_atts(
            array(
                'cat_name' => 'slide',
                'slide_limit' => '4',
            ), $atts )
    );

    $output  = '<div class="featured-post">';
        $output .= '<div id="owl-featured-post" class="owl-carousel owl-theme">';
        $args = array( 'post_type' => 'post', 'category_name' => $cat_name ,'posts_per_page' =>$slide_limit, 'order' => 'DESC' );
        $loop = new WP_Query( $args );
        global $post;
        while ( $loop->have_posts() ) : $loop->the_post();
            if (has_post_thumbnail( $post->ID ) ) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
            }else{
                $image[0] = 'http://placehold.it/730x450';
            }
            $output .= '<div class="item">
                            <img src="'.$image[0].'" alt="'.get_the_title($post->ID).'" >
                            <div class="featured-post-text">
                                <a href="'.get_the_permalink($post->ID).'">
                                    <h3 class="text-center">'.get_the_title($post->ID).'</h3>
                                </a>
                                <a href="'.get_the_permalink($post->ID).'" class="btn btn-default btn-round-brd">'.__('LEARN MORE','muri').'</a>
                            </div>
                        </div>';
        endwhile;
        wp_reset_query();wp_reset_postdata();
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode( 'post_slider', 'muri_postSlider' );

function muri_CatPost($atts){
    extract( shortcode_atts(
            array(
                'title' => 'Business',
                'cat_name' => 'slide',
                'post_limit' => '4',
            ), $atts )
    );

    $output  = '<div class="cat-post-section">';
        $output .= '<h2 class="cat-title">'.esc_attr($title).'</h2>';
            $args = array( 'post_type' => 'post', 'category_name' => $cat_name ,'posts_per_page' =>$post_limit, 'order' => 'DESC' );
            $loop = new WP_Query( $args );
            global $post;
            while ( $loop->have_posts() ) : $loop->the_post();
                if (has_post_thumbnail( $post->ID ) ) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
                }else{
                    $image[0] = 'http://placehold.it/210x210';
                }
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
                $output .= '<div class="row item">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <img class="img-responsive" src="'.$image[0].'" alt="'.get_the_title($post->ID).'"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8">
                                    <h2 class="post-title">
                                        <a href="'.get_the_permalink($post->ID).'">
                                            '.get_the_title($post->ID).'
                                        </a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="author">
                                            <i class="fa fa-user"></i>
                                            <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))).'">
                                                '.esc_html( get_the_author() ).'
                                            </a>
                                        </span>
                                        <span class="date">
                                            <i class="fa fa-calendar"></i>
                                            '.date_i18n( get_option( 'date_format' ), strtotime( '11/15-1976' ) ).'
                                        </span>
                                        <span class="in-cate">
                                            <i class="fa fa-pencil"></i>
                                            '.$post_categories.'
                                        </span>
                                    </div>
                                    <p class="post-desc">
                                        '.excerpt(20).'
                                    </p>
                                    <p>
                                        <a href="'.get_the_permalink($post->ID).'" class="btn btn-default btn-txt"><i class="fa fa-long-arrow-right"></i>'.__('LEARN MORE','muri').'</a>
                                    </p>
                                </div>
                            </div>';
            endwhile;
            wp_reset_query();wp_reset_postdata();

    $output .= '</div>';

    return $output;
}
add_shortcode('cat','muri_CatPost');

function muri_CatPost_minimal($atts){
    extract( shortcode_atts(
            array(
                'title' => 'Business',
                'cat_name' => 'slide',
                'post_limit' => '4',
            ), $atts )
    );

    $output  = '<div class="cat-post-section">';
    $output .= '<h2 class="cat-title-1">'.esc_attr($title).'</h2>';
    $args = array( 'post_type' => 'post', 'category_name' => $cat_name ,'posts_per_page' =>$post_limit, 'order' => 'DESC' );
    $loop = new WP_Query( $args );
    global $post;
    while ( $loop->have_posts() ) : $loop->the_post();
        if (has_post_thumbnail( $post->ID ) ) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
        }else{
            $image[0] = 'http://placehold.it/730x450';
        }
        $output .= '<div class="row item minimal">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <img class="img-responsive" src="'.$image[0].'" alt="'.get_the_title($post->ID).'"/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-10">
                                <h3 class="post-title">
                                        <a href="'.get_the_permalink($post->ID).'">
                                            '.get_the_title($post->ID).'
                                        </a>
                                    </h3>
                                <p class="post-desc">
                                    '.excerpt(20).'
                                </p>
                                <a href="'.get_the_permalink($post->ID).'" class="btn btn-default btn-txt-only"><i class="fa fa-long-arrow-right"></i>'.__('LEARN MORE','muri').'</a>

                            </div>
                        </div>';
    endwhile;
    wp_reset_query();wp_reset_postdata();

    $output .= '</div>';

    return $output;
}
add_shortcode('cat_minimal','muri_CatPost_minimal');

function muri_CatPost_minimal_with_2cat($atts){
    extract( shortcode_atts(
            array(
                'title_1' => 'Business',
                'title_2' => 'News',
                'cat_name_1' => 'slide',
                'cat_name_2' => 'slide',
                'post_limit' => '4',
            ), $atts )
    );
    $output  = '<div class="cat-post-section">';
        $output .= '<div class="row">';
            $output .= '<div class="col-xs-12 col-sm-12 col-md-6">';
                $output .= '<div class="cat-post-section_minimal">';
                    $output .= '<h2 class="cat-title-1">'.$title_1.'</h2>';
                    $args = array( 'post_type' => 'post', 'category_name' => $cat_name_1 ,'posts_per_page' =>$post_limit, 'order' => 'DESC' );
                    $loop = new WP_Query( $args );
                    global $post;
                    while ( $loop->have_posts() ) : $loop->the_post();
                        if (has_post_thumbnail( $post->ID ) ) {
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
                        }else{
                            $image[0] = 'http://placehold.it/730x450';
                        }
                        $output .= '<div class="row item minimal">
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <img class="img-responsive" src="'.$image[0].'" alt="'.get_the_title($post->ID).'"/>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-8">
                                            <h3 class="post-title">
                                                <a href="'.get_the_permalink($post->ID).'">
                                                    '.get_the_title($post->ID).'
                                                </a>
                                            </h3>
                                            <a href="'.get_the_permalink($post->ID).'" class="btn btn-default btn-txt-only"><i class="fa fa-long-arrow-right"></i>'.__('LEARN MORE','muri').'</a>

                                        </div>
                                    </div>';
                    endwhile;
                    wp_reset_query();wp_reset_postdata();
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="col-xs-12 col-sm-12 col-md-6">';
                        $output .= '<div class="cat-post-section_minimal">';
                        $output .= '<h2 class="cat-title-1">'.$title_2.'</h2>';
                        $args = array( 'post_type' => 'post', 'category_name' => $cat_name_2 ,'posts_per_page' =>$post_limit, 'order' => 'DESC' );
                        $loop = new WP_Query( $args );
                        global $post;
                        while ( $loop->have_posts() ) : $loop->the_post();
                            if (has_post_thumbnail( $post->ID ) ) {
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide');
                            }else{
                                $image[0] = 'http://placehold.it/730x450';
                            }
                            $output .= '<div class="row item minimal">
                                            <div class="col-xs-12 col-sm-12 col-md-4">
                                                <img class="img-responsive" src="'.$image[0].'" alt="'.get_the_title($post->ID).'"/>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-8">
                                                <h3 class="post-title">
                                                    <a href="'.get_the_permalink($post->ID).'">
                                                        '.get_the_title($post->ID).'
                                                    </a>
                                                </h3>
                                                <a href="'.get_the_permalink($post->ID).'" class="btn btn-default btn-txt-only"><i class="fa fa-long-arrow-right"></i>'.__('LEARN MORE','muri').'</a>

                                            </div>
                                        </div>';
                        endwhile;
                        wp_reset_query();wp_reset_postdata();
    $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('cat_minimal_2','muri_CatPost_minimal_with_2cat');

function muri_adds($atts){
    extract( shortcode_atts(
            array(
                'img' => 'http://placehold.it/730x120',
                'url' => '#',
            ), $atts )
    );
    $output = ' <div class="add-section">
                    <a href="'.esc_url($url).'">
                        <img src="'.esc_url($img).'" class="img-responsive" alt="Muri adds"/>
                    </a>
                </div>';

    return $output;
}
add_shortcode('adds','muri_adds');

function muri_adds_2($atts){
    extract( shortcode_atts(
            array(
                'img_1' => 'http://placehold.it/730x120',
                'url_1' => '#',
                'img_2' => 'http://placehold.it/730x120',
                'url_2' => '#',
            ), $atts )
    );
    $output = '<div class="add-section">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 p-r-0">
                                <a href="'.esc_url($url_1).'">
                                    <img src="'.esc_url($img_1).'" class="img-responsive" alt=""/>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 p-l-0">
                                <a href="'.esc_url($url_2).'">
                                    <img class="img-responsive" src="'.esc_url($img_2).'" alt=""/>
                                </a>
                            </div>
                        </div>
                    </div>';

    return $output;
}
add_shortcode('adds_half','muri_adds_2');

function muri_stories_add_to_author_profile($contactmethods) {

    $contactmethods['google_profile'] = 'Google Profile URL';
    $contactmethods['twitter_profile'] = 'Twitter Profile URL';
    $contactmethods['facebook_profile'] = 'Facebook Profile URL';
    $contactmethods['linkedin_profile'] = 'LinkedIn Profile URL';
    $contactmethods['pinterest_profile'] = 'Pinterest Profile URL';

    return $contactmethods;
}
add_filter( 'user_contactmethods', 'muri_stories_add_to_author_profile', 10, 1);

function muri_setPostView_observe($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function muri_fetchPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

add_action('widgets_init','muri_load_widgets');
function muri_load_widgets(){
    register_widget('Muri_WidgetAbout');
    register_widget('Muri_WidgetPostTab');
    register_widget('Muri_WidgetRecent');
}
class Muri_WidgetAbout extends WP_Widget{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'muri_stories_logo_media_upload',
            'description' => __('Widget that use for company description','muri'),
        );
        parent::__construct( 'muri_stories_logo_media_upload', 'About us', $widget_ops );

    }
    public function widget( $args, $instance )
    {
        extract( $args );
        // these are the widget options
        $title = apply_filters( 'widget_title', $instance['title'] );
        $image = $instance['image'];
        $description = $instance['description'];

        $widget_html  = '<div class="about">';
            if(isset($title)){
                $widget_html .= '<h2 class="widget-title">'.esc_attr($title).'</h2>';
            }
            if(isset($image)){
                $widget_html .= '<a href="'.esc_url(home_url()).'"><img class="img-responsive" src="http://placehold.it/200x80" alt="'.get_bloginfo('name').'"/></a>';
            }else{
                $widget_html .= '<a href="'.esc_url(home_url()).'"><img class="img-responsive" src="http://placehold.it/200x80" alt="'.__('Company Name','muri').'"/></a>';
            }
            if(isset($description)){
                $widget_html .= '<p>'.esc_html($description).'</p>';
            }else{
                $widget_html .= '<p>'.__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur dolorum eaque enim excepturi illo ipsum, itaque neque nostrum officiis omnis perspiciatis praesentium quae quasi, qui reprehenderit tenetur totam, velit voluptatibus.','muri').'</p>';
            }
        $widget_html .= '</div>';

        echo $widget_html;

    }

    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['description'] = strip_tags($new_instance['description']);

        return $instance;
    }

    public function form( $instance )
    {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Latest Posts', 'mash_stories' );
        }
        $image = '';
        if(isset($instance['image'])) {
            $image = $instance['image'];
        }
        $description = '';
        if(isset($instance['description'])) {
            $description = $instance['description'];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','mash_stories'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:','mash_stories'); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
            <input class="upload_image_button button button-primary" type="button" value="Upload Image" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'description' ); ?>"><?php _e( 'Description:','mash_stories'); ?></label>
            <textarea rows="4" cols="35" class="mash_stories_description" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
        </p>
    <?php
    }
}
class Muri_WidgetPostTab extends WP_Widget{
    function __construct()
    {
        parent::__construct(
            'Muri_WidgetPostTab',__('Post Tabs', 'mash_stories'),
            array( 'description' => __( 'Display Most Recent Post & Popular Post in Tabs', 'mash_stories' ), )
        );
    }

    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $limit = $instance['limit'];
        $recent_title = $instance['recent_title'];
        $popular_title = $instance['popular_title'];

        $widget_html  = '<div class="post_tab">';
                if(isset($title)){
                    $widget_html .= '<h2 class="widget-title">'.$title.'</h2>';
                }
            $widget_html .= '<ul class="nav nav-tabs nav-post">
                                <li class="active"><a data-toggle="tab" href="#recent-post">'.esc_html($recent_title).'</a></li>
                                <li><a data-toggle="tab" href="#popular-post">'.esc_html($popular_title).'</a></li>
                             </ul>';
            $widget_html .= '<div class="tab-content">';
                $widget_html .= '<div id="recent-post" class="tab-pane fade in active">';

                        $args = array(
                            'post_type'  => 'post',
                            'posts_per_page' => $limit,
                            'order' => 'DESC'
                        );
                        $loop = new WP_Query($args);
                        if($loop->have_posts()){
                            while($loop->have_posts()):$loop->the_post();
                                if (has_post_thumbnail( $loop->ID ) ) {
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($loop->ID), 'small_thumbnail');
                                }else{
                                    $image[0] = 'http://placehold.it/64x64';
                                }
                                $widget_html .= '<div class="media">
                                                <a href="'.get_the_permalink($loop->ID).'" class="pull-left">
                                                    <img src="'.$image[0].'" class="media-object" alt="'.get_the_title($loop->ID).'">
                                                </a>
                                                <div class="media-body">
                                                    <a href="'.get_the_permalink($loop->ID).'">
                                                        <h4 class="media-heading">'.get_the_title($loop->ID).'</h4>
                                                    </a>
                                                    <p>'.excerpt(12).'</p>
                                                </div>
                                            </div>';
                            endwhile;
                            wp_reset_query();wp_reset_postdata();
                        }else{
                            $widget_html .= 'Sorry No Post Right Now!!!';
                        }

                $widget_html .= '</div>';
                $widget_html .= '<div id="popular-post" class="tab-pane fade">';
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $limit,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC'
                        );
                    $popularPosts = new WP_Query($args);
                    while($popularPosts->have_posts()):$popularPosts->the_post();
                        if (has_post_thumbnail( $loop->ID ) ) {
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($popularPosts->ID), 'small_thumbnail');
                        }else{
                            $image[0] = 'http://placehold.it/64x64';
                        }
                        $widget_html .= '<div class="media">
                                                <a href="'.get_the_permalink($popularPosts->ID).'" class="pull-left">
                                                    <img src="'.$image[0].'" class="media-object" alt="'.get_the_title($loop->ID).'">
                                                </a>
                                                <div class="media-body">
                                                    <a href="'.get_the_permalink($popularPosts->ID).'">
                                                        <h4 class="media-heading">'.get_the_title($popularPosts->ID).'</h4>
                                                    </a>
                                                    <p>'.excerpt(12).'</p>
                                                </div>
                                            </div>';
                    endwhile;
                    wp_reset_query();wp_reset_postdata();
                $widget_html .= '</div>';
            $widget_html .= '</div>';
        $widget_html .= '</div>';

        echo $widget_html;
    }

    // Widget Backend
    public function form( $instance )
    {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'lawful' );
        }

        if(isset($instance['limit'])) {
            $limit = $instance['limit'];
        }else{
            $limit = 2;
        }
        $recent_title = 'Recent Post';
        if(isset($instance['recent_title'])){
            $recent_title = $instance['recent_title'];
        }
        $popular_title = 'Popular Post';
        if(isset($instance['popular_title'])){
            $popular_title = $instance['popular_title'];
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','lawful'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'limit' ); ?>"><?php _e('How Many Post Will be Display:','lawful'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr($limit);?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'recent_title' ); ?>"><?php _e( 'Tab: Section Title ','lawful'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'recent_title' ); ?>" name="<?php echo $this->get_field_name( 'recent_title' ); ?>" type="text" value="<?php echo esc_attr($recent_title);?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_name( 'popular_title' ); ?>"><?php _e( 'Tab: Section Title ','lawful'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'popular_title' ); ?>" name="<?php echo $this->get_field_name( 'popular_title' ); ?>" type="text" value="<?php echo esc_attr($popular_title);?>" />
        </p><?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['recent_title'] = strip_tags($new_instance['recent_title']);
        $instance['popular_title'] = strip_tags($new_instance['popular_title']);
        return $instance;
    }
}
class Muri_WidgetRecent extends WP_Widget{
    function __construct()
    {
        parent::__construct(
            'Muri_WidgetRecent',__('Muri: Recent Posts', 'muri'),
            array( 'description' => __( 'Display Most Recent Post', 'muri' ), )
        );
    }

    public function widget( $args, $instance )
    {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $post_limit = $instance['post_limit'];


        $widget_html  = '<div class="post_tab">';
            if(isset($title)){
                $widget_html .= '<h2 class="widget-title">'.$title.'</h2>';
            }
            $widget_html .= '<div class="tab-content">';
                $widget_html .= '<div id="recent-post" class="tab-pane fade in active">';
                $args = array(
                    'post_type'  => 'post',
                    'post_per_page' => $post_limit,
                    'order' => 'DESC'
                );
                $loop = new WP_Query($args);
                while($loop->have_posts()):$loop->the_post();
                    if (has_post_thumbnail( $loop->ID ) ) {
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($loop->ID), 'small_thumbnail');
                    }else{
                        $image[0] = 'http://placehold.it/64x64';
                    }
                    $widget_html .= '<div class="media">
                                                        <a href="'.get_the_permalink($loop->ID).'" class="pull-left">
                                                            <img src="'.$image[0].'" class="media-object" alt="'.get_the_title($loop->ID).'">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="'.get_the_permalink($loop->ID).'">
                                                                <h4 class="media-heading">'.get_the_title($loop->ID).'</h4>
                                                            </a>
                                                            <p>'.excerpt(12).'</p>
                                                        </div>
                                                    </div>';
                endwhile;
                wp_reset_query();wp_reset_postdata();
                $widget_html .= '</div>';

            $widget_html .= '</div>';
        $widget_html .= '</div>';

        echo $widget_html;
    }

    // Widget Backend
    public function form( $instance )
    {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'lawful' );
        }
        $post_limit = '5';
        if(isset($instance['post_limit'])) {
            $post_limit = $instance['post_limit'];
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','lawful'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'post_limit' ); ?>"><?php _e('How Many Post Will be Display:','lawful'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'post_limit' ); ?>" name="<?php echo $this->get_field_name( 'post_limit' ); ?>" type="text" value="<?php echo esc_attr($post_limit);?>" />
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_limit'] = strip_tags($new_instance['post_limit']);
        return $instance;
    }
}
