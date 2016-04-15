<?php
 /*
 * The template for displaying all single posts and attachments
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

get_header(); ?>


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
		
		<!-- container single post -->
		<div id="single-post" role="main">
			<?php do_action( 'foundationpress_before_content' ); ?>

			<!-- boucle wp, même pour un seul article -->
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="main-container" class="small-12 medium-9 large-9 columns <?php echo $classColor; ?>" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
					<header class="row">
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
							<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
							<?php the_tags(); ?>
						 </p>
					</footer>
					
				<?php do_action( 'foundationpress_page_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_page_after_comments' ); ?>
				</article>
			
			<?php endwhile; ?>
			
			<?php do_action( 'foundationpress_after_content' ); ?>
            
            <?php if (get_post_type()=='post') { ?>
            <script type="text/javascript">
            $(document).ready(function(){
                <?php //fr // repere NM // ajout langue // addlang ?>
                $(".menu-item-2300").add(".menu-item-2648").addClass("current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor active");
                $(".menu-item-2413").add(".menu-item-2704").addClass("current-menu-item current_page_item current_page_parent active");
            });
            </script>
            <?php } ?>
		</div>
		<?php get_footer(); ?>