<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

    <div id="page" role="main">
        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
        <div class="row">
            <article class="small-12 medium-12 large-12 columns">
                <header class="header-image">
                    <?php get_template_part( 'template-parts/featured-image' ); ?>
                        <h1>Actualités</h1>
                </header>
            </article>
        </div>
       
        <!--END header de page-->


 <div class="row">
   <?php do_action( 'foundationpress_before_content' ); ?>
                    <!--menu secondaire : Menu gauche -> page.php-->
                    <?php
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
                        <!--END menu secondaire-->
                      
<!-- J'ai retiré la classe main-content qui était appliquée sur le div article et ça roule, elle doit comprendre des css qui entrent en conflit. Peut être que le main content à des propriétés spéciales... Le main-content ne doit peut être pas s'appliquer sur ce genre de listes mais juste sur le contenu d'un article. -->
        <article class="small-12 medium-9 large-9 columns"> 
                <?php if ( have_posts() ) : ?>

                    <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                        <?php endwhile; ?>

                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; // End have_posts() check. ?>

                <?php /* Display navigation to next/previous pages when applicable */ ?>
                    <?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
                        <nav id="post-nav">
                            <div class="post-previous">
                                <?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?>
                            </div>
                            <div class="post-next">
                                <?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?>
                            </div>
                        </nav>
                    <?php } ?>

            </article>
                      
                       </div>
                    </div>

    <?php get_footer();
