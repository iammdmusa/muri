<?php

if ( ! function_exists( 'muri_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function muri_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on muri, use a find and replace
         * to change 'muri' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'muri', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        add_image_size('slide',740,450,array('center','top'));
        add_image_size('related_post',200,200,array('center','top'));
        add_image_size('next_prev',345,235,array('center','top'));
        add_image_size('small_thumbnail',64,64,array('center','top'));
        add_image_size('single-post',740,450,array('center','top'));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'top_menu' => esc_html__( 'Header Top Menu', 'muri' ),
            'primary' => esc_html__( 'Primary Menu', 'muri' ),
            'footer' => esc_html__( 'Footer Menu', 'muri' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'muri_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
    }
endif; // muri_setup
add_action( 'after_setup_theme', 'muri_setup' );