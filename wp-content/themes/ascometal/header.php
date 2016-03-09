<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
    <!doctype html>
    <html class="no-js" <?php language_attributes(); ?> >

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700italic,400italic,700' rel='stylesheet' type='text/css'>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php do_action( 'foundationpress_after_body' ); ?>

            <?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
                <div class="off-canvas-wrapper">
                    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
                        <?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
                            <?php endif; ?>

                                <?php do_action( 'foundationpress_layout_start' ); ?>

                                    <header id="masthead" class="site-header" role="banner">
                                        <div class="title-bar" data-responsive-toggle="site-navigation">
                                            <button class="menu-icon" type="button" data-toggle="mobile-menu"></button>
                                            <div class="title-bar-title">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                    <?php bloginfo( 'name' ); ?>
                                                </a>
                                            </div>
                                        </div>

                                        <nav id="site-navigation" class="main-navigation top-bar" role="navigation">
                                            <div class="top-bar-left">
                                                <ul class="menu">
                                                    <li class="home">
                                                        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                                            <div class="indent">
                                                                <?php bloginfo( 'name' ); ?>
                                                            </div><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" alt="Logo d'Ascometal"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="top-bar-right">
                                                <?php foundationpress_top_bar_r(); ?>

                                                    <?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'topbar' ) : ?>
                                                        <?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
                                                            <?php endif; ?>
                                            </div>
                                        </nav>
                                    </header>

                                    <section class="container">
                                        <?php do_action( 'foundationpress_after_header' );