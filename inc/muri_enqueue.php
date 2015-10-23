<?php
/**
 * Enqueue scripts and styles.
 */
function muri_scripts() {
    /* Google font & API */
    wp_enqueue_style('Open_Sans_all','http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic','',false);

    wp_enqueue_style( 'muri-style', get_stylesheet_uri() );

    //CSS files
    wp_enqueue_style( 'muri-bootstrap_min', get_template_directory_uri().'/css/bootstrap.min.css' );
    wp_enqueue_style( 'muri-font_aw', get_template_directory_uri().'/css/font-awesome.min.css' );
    wp_enqueue_style( 'muri-animate_css', get_template_directory_uri().'/css/animate.css' );
    wp_enqueue_style( 'muri-owl_carousel_css', get_template_directory_uri().'/css/owl.carousel.css' );
    wp_enqueue_style( 'muri-owl_themes', get_template_directory_uri().'/css/owl.theme.css' );

    wp_enqueue_style( 'muri-main', get_template_directory_uri().'/css/themes.css' );


    wp_enqueue_script( 'muri-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'muri-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    //js files
    wp_enqueue_script( 'jquery' );

    /*Bootstrap Main JS*/
    wp_enqueue_script('muri-js_bootstrap_min',get_template_directory_uri().'/js/bootstrap.min.js',array(),'',true);

    wp_enqueue_script('muri-smooth_scroll_js',get_template_directory_uri().'/js/smoothscroll.js',array(),'',true);

    wp_enqueue_script('muri-owl_carousel_js',get_template_directory_uri().'/js/owl.carousel.min.js',array(),'',true);


    /*Theme Main JS*/
    wp_enqueue_script('muri-main_js',get_template_directory_uri().'/js/main.js',array(),'',true);

    /*HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries.WARNING: Respond.js doesn't work if you view the page via file*/

    wp_register_style( 'ie', get_template_directory_uri() . '/js/ie.js' );
    wp_enqueue_style( 'ie');
    wp_style_add_data( 'ie', 'conditional', 'lt IE 9' );

    wp_register_style( 'ie_html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js' );
    wp_enqueue_style( 'ie_html5shiv');
    wp_style_add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );

    wp_register_style( 'ie_respond', get_template_directory_uri() . '/js/respond.min.js' );
    wp_enqueue_style( 'ie_respond');
    wp_style_add_data( 'ie_respond', 'conditional', 'lt IE 9' );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'muri_scripts' );

if(!function_exists('lawful_admin_scripts')){
    function lawful_admin_scripts()
    {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/js/plugins.js', array('jquery'));

    }
}
add_action('admin_enqueue_scripts','lawful_admin_scripts');
