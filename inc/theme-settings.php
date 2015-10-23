<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('Muri_theme_Settings' ) ):
    class Muri_theme_Settings {

        private $settings_api;

        function __construct() {
            $this->settings_api = new Muri_Settings_API;

            add_action( 'admin_init', array($this, 'admin_init') );
            add_action( 'admin_menu', array($this, 'admin_menu') );
        }

        function admin_init() {

            //set the settings
            $this->settings_api->set_sections( $this->get_settings_sections() );
            $this->settings_api->set_fields( $this->get_settings_fields() );

            //initialize settings
            $this->settings_api->admin_init();
        }

        function admin_menu() {
            add_theme_page( 'Muri Options', 'Muri Options', 'manage_options', 'muri_theme_settings', array($this, 'muri_theme_options') );

        }

        function get_settings_sections() {
            $sections = array(
                array(
                    'id' => 'muri_general',
                    'title' => __( 'General Settings', 'muri' )
                ),
                array(
                    'id' => 'muri_adds',
                    'title' => __( 'Advertisement', 'muri' )
                ),
                array(
                    'id' => 'muri_social',
                    'title' => __( 'Social Network', 'muri' )
                ),
            );
            return $sections;
        }

        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        function get_settings_fields() {
            $settings_fields = array(
                'muri_general' => array(
                    array(
                        'name'    => 'muri_logo',
                        'label'   => __( 'Logo', 'muri' ),
                        'desc'    => __( 'This Image will be use for logo', 'muri' ),
                        'type'    => 'file',
                        'default' => '',
                        'options' => array(
                            'button_label' => 'Choose Image'
                        )
                    ),
                    array(
                        'name'    => 'muri_primary_color',
                        'label'   => __( 'Primary Color', 'muri' ),
                        'desc'    => __( 'Color description', 'muri' ),
                        'type'    => 'color',
                        'default' => '#4A4A4A'
                    ),
                    array(
                        'name'    => 'muri_hover_color',
                        'label'   => __( 'Hover Color', 'muri' ),
                        'desc'    => __( 'Color description', 'muri' ),
                        'type'    => 'color',
                        'default' => '#00ac57'
                    ),
                    array(
                        'name'  => 'muri_scroll_txt',
                        'label' => __( 'Breaking News Text', 'muri' ),
                        'desc'  => __( 'This will be Home Page Top Breaking News text scroll', 'muri' ),
                        'type'  => 'textarea',
                        'default' => 'Hello I\'m Muri WordPress Minimal Magazine Theme',
                    ),
                    array(
                        'name'    => 'muri_scroll_amount',
                        'label'   => __( 'Breaking News Text Scroll Speed Amount', 'muri' ),
                        'desc'    => __( 'Select Speed Amount, Default is 2', 'muri' ),
                        'type'    => 'select',
                        'default' => '2',
                        'options' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                        ),
                    ),
                    array(
                        'name'    => 'muri_scroll_direction',
                        'label'   => __( 'Breaking News Text Scroll Direction', 'muri' ),
                        'desc'    => __( 'Select Scroll Direction', 'muri' ),
                        'type'    => 'select',
                        'default' => 'left',
                        'options' => array(
                            'left' => 'Left',
                            'right' => 'Right',
                        )
                    ),
                    array(
                        'name'  => 'google_analytics_code',
                        'label' => __( 'Google analytics Code', 'wedevs' ),
                        'desc'  => __( 'Put google analytics code here', 'wedevs' ),
                        'type'  => 'wysiwyg',
                        'default' => '',
                    ),
                    array(
                        'name'    => 'copyright_txt',
                        'label'   => __( 'Copyright Text', 'wedevs' ),
                        'desc'    => __( '', 'wedevs' ),
                        'type'    => 'textarea',
                        'default' => '&copy; Copyright 2015 |<a href="'.home_url('/').'">Terms & Condition</a>'
                    ),
                ),
                'muri_adds' => array(
                    array(
                        'name'    => 'muri_add_img',
                        'label'   => __( 'Header Advertisement Image', 'wedevs' ),
                        'desc'    => __( 'Header Advertisement Image', 'wedevs' ),
                        'type'    => 'file',
                        'default' => '',
                        'options' => array(
                            'button_label' => 'Choose Image'
                        )
                    ),
                    array(
                        'name'              => 'muri_add_link',
                        'label'             => __( 'Header Advertisement Link', 'muri' ),
                        'desc'              => __( 'Type Header Advertisement Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://facebook.com/#',
                    ),
                ),
                'muri_social' => array(
                    array(
                        'name'              => 'muri_social_fb',
                        'label'             => __( 'Facebook Page Link', 'muri' ),
                        'desc'              => __( 'Type Your Facebook Page Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://facebook.com/#',
                    ),
                    array(
                        'name'              => 'muri_social_tw',
                        'label'             => __( 'Twitter Page Link', 'muri' ),
                        'desc'              => __( 'Type Your Twitter Page Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://twitter.com/#',
                    ),
                    array(
                        'name'              => 'muri_social_link',
                        'label'             => __( 'LinkedIn Page Link', 'muri' ),
                        'desc'              => __( 'Type Your LinkedIn Page Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://linkedin.com/#',
                    ),
                    array(
                        'name'              => 'muri_social_gplus',
                        'label'             => __( 'GooglePlus Page Link', 'muri' ),
                        'desc'              => __( 'Type Your GooglePlus Page Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://googleplus.com/#',
                    ),
                    array(
                        'name'              => 'muri_social_pin',
                        'label'             => __( 'Pinterest Page Link', 'muri' ),
                        'desc'              => __( 'Type Your pinterest Page Link', 'muri' ),
                        'type'              => 'text',
                        'default'           => 'http://pinterest.com.com/#',
                    ),

                ),
            );

            return $settings_fields;
        }

        function muri_theme_options() {
            echo '<div class="wrap">';
            echo '<h1>Muri Theme Options</h1>';
                    $this->settings_api->show_navigation();
                    $this->settings_api->show_forms();
            echo '</div>';
        }

        /**
         * Get all the pages
         *
         * @return array page names with key value pairs
         */
        function get_pages() {
            $pages = get_pages();
            $pages_options = array();
            if ( $pages ) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }

            return $pages_options;
        }

    }
endif;

function getMuriOptions( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}
