<?php
 /*
 * The template for displaying single recrutement
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// couleurs du marché en cours
$terms =  wp_get_post_terms( get_the_id(), "marches-asco" );
$classColor="corporate";
$linkUrlMarche=get_bloginfo('url')."/?p=2099";
$linkUrlMarcheSingle="";
$prelink="";
$nomMarche="";
$nomMarcheUrl="";
$contexte="standard";
$actulang=ICL_LANGUAGE_CODE;
if ($actulang!="fr") {$prelink="/".$actulang;}
global $classColor;
global $linkUrlMarche;
global $linkUrlMarcheSingle;
global $nomMarche;
global $contexteType;
global $nomMarcheUrl;
foreach ($terms as $term) {
    //echo "<br/>ID : ".$term->term_id;
    if ($term->term_id==18 || $term->term_id==22 || $term->term_id==23 || $term->term_id==24) {$classColor="automobile"; $linkUrlMarche=
$prelink."/marches-ascometal/";$nomMarche="Automotive";$contexteType="marche";$nomMarcheUrl="automotive";$linkUrlMarcheSingle=
$prelink."/marches-asco/";}
    else if ($term->term_id==19 || $term->term_id==37 || $term->term_id==35 || $term->term_id==36) {$classColor="roulement";$linkUrlMarche=
$prelink."/marches-ascometal/";$nomMarche="Bearing";$contexteType="marche";$nomMarcheUrl="bearing";$linkUrlMarcheSingle=
$prelink."/marches-asco/";}
    else if ($term->term_id==20 || $term->term_id==33 || $term->term_id==34 || $term->term_id==32) {$classColor="petrole";$linkUrlMarche=
$prelink."/marches-ascometal/";$nomMarche="Petrole";$contexteType="marche";$nomMarcheUrl="petrole";$linkUrlMarcheSingle=
$prelink."/marches-asco/";}
    else if ($term->term_id==21 || $term->term_id==29 || $term->term_id==30 || $term->term_id==31) {$classColor="mecanique";$linkUrlMarche=
$prelink."/marches-ascometal/";$nomMarche="Mechanical";$contexteType="marche";$nomMarcheUrl="mechanical";$linkUrlMarcheSingle=
$prelink."/marches-asco/";}
}

/*
echo __("bearing", "foundationpress")
echo __("automotive", "foundationpress")
echo __("petrole", "foundationpress")
echo __("mechanical", "foundationpress")
echo __("Bearing", "foundationpress")
echo __("Automotive", "foundationpress")
echo __("Petrole", "foundationpress")
echo __("Mechanical", "foundationpress")
*/

//echo "OOO : ".$classColor." / ".$linkUrlMarche;

get_header(); ?>


    <div id="page" role="main">
        <?php get_template_part( 'template-parts/header-banner-recrutement' ); ?>

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
			<?php while ( have_posts() ) : the_post();

            $fonction = types_render_field("offre-fonction", array("output"=>"raw"));
            $contact_mail = types_render_field("offre-mail-candidature", array("output"=>"raw"));
            $activites = types_render_field("offre-activites", array("output"=>"normal"));
            $profil = types_render_field("offre-profil", array("output"=>"normal"));
            $conditions = types_render_field("offre-conditions", array("output"=>"normal"));
            $resume =  types_render_field("offre-resume", array("output"=>"raw"));
            $secteur =  types_render_field("offre-secteur", array("output"=>"raw"));

            $terms = get_the_terms( get_the_ID(), 'site-offre');
            if ( $terms && ! is_wp_error( $terms ) ) :
            foreach ( $terms as $term ) {
                $lieu = $term->name;
            }
            endif;




            ?>

				<article id="main-container" class="small-12 medium-9 large-9 columns <?php echo $classColor; ?>" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
					<header class="row">
						<div class="title-area small-12 medium-8 large-8 columns">
                                        <h2 class="entry-title"><?php echo __('Trades in the heart of steel', 'foundationpress'); ?></h2>
                        </div>
                                     <div class="social-icons small-12 medium-4 large-4 columns">
                                         <?php echo do_shortcode("[ssba]"); ?>
                                     </div>
					</header>


					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content single-offre">
                        <div class="date"><span class="align-left"><a href="javascript:history.back()">< <?php echo __('Back to list', 'foundationpress'); ?></a></span> <?php the_date(); ?></div>
                        <div class="offre-header">
                        <div class="fonction"><?php echo $fonction; ?></div>
                        <div class="secteur"><?php echo __('Sector', 'foundationpress'); ?> : <?php echo $secteur; ?></div>
                            <div class="lieu"><?php echo __('Location', 'foundationpress'); ?> : <?php echo $lieu; ?></div>
                        </div>
                        <div class="elements-offre">
                        <div class="subtitle-offre"><?php echo __('Main goals', 'foundationpress'); ?></div>
						<?php the_content(); ?>
                            <div class="subtitle-offre"><?php echo __('Additional activities', 'foundationpress'); ?></div>
                        <?php echo $activites; ?>
                            <div class="subtitle-offre"><?php echo __('Required profile', 'foundationpress'); ?></div>
                        <?php echo $profil; ?>
                            <div class="subtitle-offre"><?php echo __('Plan and working conditions', 'foundationpress'); ?></div>
                        <?php echo $conditions; ?>
                            <div class="email-contact"><?php echo __('Thank you for sending your application to', 'foundationpress'); ?> <a href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a></div>
                        </div>
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

            <script type="text/javascript">
            $(document).ready(function(){
                <?php //fr // repere NM // ajout langue // addlang ?>
                $(".menu-item-2300").add(".menu-item-2648").add(".menu-item-2657").add(".menu-item-2665").addClass("current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor active");
                $(".menu-item-3118").add(".menu-item-3339").add(".menu-item-3343").add(".menu-item-2648").addClass("current-menu-item current_page_item current_page_parent active");
                $(".menu-item-6191").add(".menu-item-6385").add(".menu-item-3347").add(".menu-item-6409").addClass("current-menu-item current_page_item current_page_parent active");
            });
            </script>

		<?php get_footer(); ?>
