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
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <div class="breaking-txt">
                            <div class="bn-title">
                                <h2>Breaking News</h2>
                                <span></span>
                            </div>
                            <marquee behavior="scroll" scrollamount="2" direction="left" width="350">
                                Welcome the Muri Online Newspaper Themes
                            </marquee>
                        </div>
                        <!-- /.breaking-txt -->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <ul class="list-inline social-icons text-right">
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </li>
                        </ul>
                        <!-- /.social-top -->
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.top-header -->
            <div class="logo">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <a href="#">
                                <img src="img/logo.png" class="img-responsive" alt=""/>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-7">
                            <a href="#">
                                <img src="img/banner-top.png" class="img-responsive" alt=""/>
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
                                    'depth'             => 6,
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
