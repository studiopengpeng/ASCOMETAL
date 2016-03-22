<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); ?>


    <div id="page" role="main">
<<<<<<< HEAD
<<<<<<< HEAD
        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
        <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image' ); ?>
                    <h1><?php parent_page_title() ?></h1>
            </header>
        </article>
        <!--END header de page-->

        <!--menu secondaire : Menu gauche -> page.php-->
        <?php
=======
=======
>>>>>>> origin/master
		<?php get_template_part( 'template-parts/header-banner' ); ?>
       
                    <!--menu secondaire : Menu gauche -> page.php-->
                    <?php
>>>>>>> origin/master
$args_menu1 = array(
'theme_location'  => '',
'menu'            => '13',
'container'       => 'nav',
'container_class' => 'sidenav small-12 medium-3 large-3 columns',
'container_id'    => 'touchscroller',
'menu_class'      => 'vertical menu',
'menu_id'         => '',
'echo'            => true,
'fallback_cb'     => 'false',
'before'          => '',
'after'           => '',
'link_before'     => '',
'link_after'      => '',
'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
'depth'           => 0,
'walker'          => ''
);
wp_nav_menu( $args_menu1 );
?>
<<<<<<< HEAD
            <!--END menu secondaire-->
            <?php do_action( 'foundationpress_before_content' ); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                   <div class="row">
                    <article id="main-container" class="small-12 medium-9 large-9 columns" <?php post_class( 'main-content') ?> id="post-
                        <?php the_ID(); ?>">
                            <header>
                                <h2 class="entry-title"><?php the_title(); ?></h2>
                            </header>
                            <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
=======
                        <!--END menu secondaire-->
		
		<!-- début boucle content posts -->
		 <?php do_action( 'foundationpress_before_content' ); ?>
         <?php while ( have_posts() ) : the_post(); ?>
        <article id="main-container" class="small-12 medium-9 large-9 columns" <?php post_class( 'main-content') ?> id="post-
                            <?php the_ID(); ?>">
                                <header>
                                    <h2 class="entry-title"><?php the_title(); ?></h2>
                                </header>
                                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
>>>>>>> origin/master

                                <div class="entry-content">

                                    <?php the_content(); ?>
                                </div>
                                <footer>
                                    <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
                                        <p>
                                            <?php the_tags(); ?>
                                        </p>
                                </footer>
                                <?php do_action( 'foundationpress_page_before_comments' ); ?>
                                    <?php comments_template(); ?>
                                        <?php do_action( 'foundationpress_page_after_comments' ); ?>
                    </article>
                    </div>
                    <?php endwhile;?>

                        <?php do_action( 'foundationpress_after_content' ); ?>


    </div>

    <?php get_footer();