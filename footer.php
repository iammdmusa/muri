<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package muri
 */

?>

</div>
<?php get_template_part('template-parts/content','footer');?>
<?php wp_footer(); ?>
<?php echo getMuriOptions('google_analytics_code','muri_general');?>
<style type="text/css">
    .navbar-nav>li>.dropdown-menu,#header .top-header, #header .menu-nav, #header .menu-nav .navbar-collapse, #footer .copyright,.post_tab ul.nav-post li.active a{
        background-color: <?php echo getMuriOptions('muri_primary_color','muri_general');?>;
    }
    .wrapper .nav>li>a:focus, .wrapper .nav>li>a:hover, .wrapper .btn-round-brd:hover, .navigation li a:hover, .navigation li.active a, #header .breaking-txt .bn-title, #header .menu-nav .searchbox-icon, #header .menu-nav .searchbox-submit,#header .menu-nav ul li a.active, #header .menu-nav ul li a:hover, .post_tab ul.nav-post li a, .wrapper .btn-comment, .widget select option{
        background-color: <?php echo getMuriOptions('muri_hover_color','muri_general');?>;
    }
    .wrapper .btn-round-brd, #main-content .cat-post-section .minimal, .blog-chat blockquote, .wrapper .btn-txt:hover, .wrapper .btn-comment:hover, #comments .form-control:focus,#footer .copyright .social-icons li a:hover, blockquote, .widget .tagcloud a:hover{
        border-color: <?php echo getMuriOptions('muri_hover_color','muri_general');?>;
    }
    #header .breaking-txt .bn-title span{
        border-color: transparent transparent transparent <?php echo getMuriOptions('muri_hover_color','muri_general');?>;
    }
    #header .top-header .social-icons li a:hover {
        color: #fff;
        background: -webkit-linear-gradient(left,<?php echo getMuriOptions('muri_hover_color','muri_general');?>,<?php echo getMuriOptions('muri_hover_color','muri_general');?>) rgba(0,0,0,0);
        background: linear-gradient(to right,<?php echo getMuriOptions('muri_hover_color','muri_general');?>,<?php echo getMuriOptions('muri_hover_color','muri_general');?>) rgba(0,0,0,0);
    }
    .widget ul li a:hover,#footer .copyright p a:hover, #main-content .cat-post-section .item .post-title a:hover, #header .menu-nav .searchbox-input, .wrapper .btn-round-brd, #main-content .featured-post #owl-featured-post .owl-next:hover, #main-content .featured-post #owl-featured-post .owl-prev:hover, #main-content .cat-post-section .cat-title-1, #main-content .cat-post-section .item .post-meta a:hover, #main-content .cat-post-section .item .post-meta i:hover, #main-content .cat-post-section .cat-title, a:hover, a:visited , .wrapper .btn-comment:hover,.widget-title, .widget h2.widget-title, .about h2.widget-title, #footer .copyright .social-icons li a:hover, #today{
        color: <?php echo getMuriOptions('muri_hover_color','muri_general');?>;
    }

</style>
</body>
</html>
