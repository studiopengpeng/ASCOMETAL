<?php
/**
 * The template for displaying all single posts usines
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
// couleurs du marché en cours
$terms =  wp_get_post_terms( get_the_id(), "marches-produits" );
$classColor="corporate";
$linkUrlMarche=get_bloginfo('url')."/?p=2099";
$prelink="";
$actulang=ICL_LANGUAGE_CODE;
if ($actulang!="fr") {$prelink="/".$actulang;}
global $classColor;
global $linkUrlMarche;
foreach ($terms as $term) {
    //echo "<br/>ID : ".$term->term_id;
    if ($term->term_id==42 || $term->term_id==54 || $term->term_id==55 || $term->term_id==56) {$classColor="automobile"; $linkUrlMarche=	
$prelink."/marches-ascometal/";}
    else if ($term->term_id==43 || $term->term_id==65 || $term->term_id==69 || $term->term_id==71) {$classColor="roulement";$linkUrlMarche=	
$prelink."/marches-ascometal/";}
    else if ($term->term_id==45 || $term->term_id==64 || $term->term_id==68 || $term->term_id==70) {$classColor="petrole";$linkUrlMarche=	
$prelink."/marches-ascometal/";}
    else if ($term->term_id==44 || $term->term_id==63 || $term->term_id==66 || $term->term_id==67) {$classColor="mecanique";$linkUrlMarche=	
$prelink."/marches-ascometal/";}
}
get_header(); ?>


    <div id="page" role="main">
        <?php get_template_part( 'template-parts/header-banner-usine' ); ?>

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
		<div id="single-post" class="usines small-12 medium-12 large-9 columns norightpadding" role="main">
			<?php do_action( 'foundationpress_before_content' ); ?>

			<!-- boucle wp, même pour un seul article -->
			<?php while ( have_posts() ) : the_post(); ?>
            
                <div class="row" id="main-container">
           
                  <article class="small-12 medium-12 large-8 columns articlepadding rightpadding" id="post-<?php the_ID(); ?>">

                <div class="paddingbottom rightpadding leftpadding toppadding5">
                    <?php echo types_render_field("texte-introduction-usine", array("output"=>"raw")); ?>
                </div>
                  
                  <div id="menu-usines-container" class="paddingbottom">
                      <div class="paddingbottom"><h6><b><?php echo __("Select a site :","foundationpress"); ?></b></h6></div>
                       <?php get_template_part( 'template-parts/menu-usines' ); ?>
                  </div>
                  
                  
                <div class="paddingbottom">
                    <h5 class="corporate-color"><?php echo types_render_field("titre-references-usine", array("output"=>"raw")); ?></h5>
                    <img src="<?php echo types_render_field("image-references-usine", array("output"=>"raw")); ?>" />
                </div>
                <div class="paddingbottom">
                     <img src="<?php echo types_render_field("image-illustration-usine", array("output"=>"raw")); ?>" />
                </div>
 
            </article>

			
            <article class="small-12 medium-12 large-4 columns articlepadding rightcol" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
					<header>
						<h1 class="entry-title corporate-color"><?php the_title(); ?></h1>
                        <div class="small-7" style="margin-bottom:5px">
                           <?php echo do_shortcode("[ssba]"); ?>
                        </div>
					</header>

					<?php do_action( 'foundationpress_page_before_entry_content' ); ?> 
					<div class="entry-content row">
                        <article class="small-12 ">
                            <?php the_content(); ?>
                        </article>
                        
                        <a href="<?php echo types_render_field("lien-plan-usine", array("output"=>"raw")); ?>" target="blank" class="maps_button ih-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icone-plan-acces-usine.png"> <?php _e("Access map", "foundationpress"); ?></a>
                    </div>
                
            </article>
                
         </div>
			<?php endwhile; ?>
			
			<?php do_action( 'foundationpress_after_content' ); ?>
		</div>
		<?php get_footer(); ?>

