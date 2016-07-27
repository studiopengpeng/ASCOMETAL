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

// couleurs du marché en cours
$terms =  wp_get_post_terms( get_the_id(), "marches-asco" );
$classColor="corporate";
$linkUrlMarche=get_bloginfo('url')."/?p=2099";
$prelink="";
$actulang=ICL_LANGUAGE_CODE;
if ($actulang!="fr") {$prelink="/".$actulang;}
global $classColor;
global $linkUrlMarche;
foreach ($terms as $term) {
    //echo "<br/>ID : ".$term->term_id;
    if ($term->term_id==18 || $term->term_id==22 || $term->term_id==23 || $term->term_id==24) {$classColor="automobile"; $linkUrlMarche=
$prelink."/marches-ascometal/";}
    else if ($term->term_id==19 || $term->term_id==37 || $term->term_id==35 || $term->term_id==36) {$classColor="roulement";$linkUrlMarche=
$prelink."/marches-ascometal/";}
    else if ($term->term_id==20 || $term->term_id==33 || $term->term_id==34 || $term->term_id==32) {$classColor="petrole";$linkUrlMarche=
$prelink."/marches-ascometal/";}
    else if ($term->term_id==21 || $term->term_id==29 || $term->term_id==30 || $term->term_id==31) {$classColor="mecanique";$linkUrlMarche=
$prelink."/marches-ascometal/";}
}

//echo "OOO : ".$classColor." / ".$linkUrlMarche;

 get_header();
?>


    <div id="page" role="main">
		<?php get_template_part( 'template-parts/header-banner' ); ?>

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

		<!-- début boucle content posts -->
		 <?php do_action( 'foundationpress_before_content' ); ?>
         <?php while ( have_posts() ) : the_post(); ?>
        <article id="main-container" class="small-12 medium-12 large-9 columns" <?php post_class( 'main-content') ?> id="post-
                            <?php the_ID(); ?>">
                                <header class="social-header row">
                                   <div class="title-area small-12 medium-8 large-8= columns">
                                        <h2 class="entry-title"><?php the_title(); ?></h2>
                                        </div>
                                     <div class="social-icons small-12 medium-4 large-4 columns">
                                         <?php echo do_shortcode("[ssba]"); ?>
                                     </div>

                                </header>
                                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
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


    

    <?php get_footer();
