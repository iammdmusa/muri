<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package muri
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="wrapper">
        <header id="header">
            <div class="top-header">
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-9">
                        <?php
                            $srcoll_txt = getMuriOptions('muri_scroll_txt','muri_general');
                            $srcoll_amount = getMuriOptions('muri_scroll_amount','muri_general');
                            $srcoll_direction = getMuriOptions('muri_scroll_direction','muri_general');
                        ?>
                        <div class="breaking-txt">
                            <div class="bn-title">
                                <h2><?php _e('Breaking News','muri')?></h2>
                                <span></span>
                            </div>
                            <marquee behavior="scroll" scrollamount="<?php echo esc_attr($srcoll_amount)?>" direction="<?php echo esc_attr($srcoll_direction);?>">
                                <?php echo esc_html($srcoll_txt)?>
                            </marquee>
                        </div>

                        <!-- /.breaking-txt -->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <?php getSocialProfileLink();?>
                        <!-- /.social-top -->
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.top-header -->
            <div class="logo">
                <div class="container">
                    <div class="row">
                        <div id="logo" class="col-xs-12 col-sm-12 col-md-3">
                            <a href="<?php echo home_url('/')?>">
                                <img src=" <?php echo getMuriOptions('muri_logo','muri_general');?>" class="img-responsive" alt=""/>
                            </a>
                        </div>
                        <div id="adds" class="col-xs-12 col-sm-12 col-md-offset-2 col-md-7">
                            <a href="<?php echo getMuriOptions('muri_add_link','muri_adds');?>">
                                <img src="<?php echo getMuriOptions('muri_add_img','muri_adds');?>" class="img-responsive" alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.logo -->
            <div class="navbar menu-nav"  data-spy="affix" data-offset-top="200">
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <?php
                            wp_nav_menu( array(
                                    'menu'              => 'primary',
                                    'theme_location'    => 'primary',
                                    'depth'             => 10,
                                    'container'         => 'ul',
                                    'container_class'   => 'navbar-collapse collapse',
                                    'container_id'      => 'navbar-collapse-1',
                                    'menu_class'        => 'nav navbar-nav',
                                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                    'walker'            => new wp_bootstrap_navwalker())
                            );
                            ?>
                        </div><!-- /.navbar-collapse -->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                       <?php echo getHeaderSearch();?>
                    </div>
                </div>
            </div>
            <!-- /.menu-nav -->
        </header>
        <!-- /#header -->
