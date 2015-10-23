<?php



    require get_template_directory() . '/inc/muri_setups.php';

    require get_template_directory() . '/inc/muri_enqueue.php';

    require get_template_directory() .'/inc/muri_functions.php';

    require get_template_directory() .'/inc/muri_widgets.php';

    require get_template_directory() .'/inc/wp_bootstrap_navwalker.php';

    require get_template_directory() .'/inc/class-tgm-plugin-activation.php';



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


require get_template_directory().'/inc/class.settings-api.php';
require get_template_directory().'/inc/theme-settings.php';

new Muri_theme_Settings();


