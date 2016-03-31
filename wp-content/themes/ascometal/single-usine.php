<?php
/**
 * The template for displaying all single posts usines
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

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
		<div id="single-post" class="usines" role="main">
			<?php do_action( 'foundationpress_before_content' ); ?>

			<!-- boucle wp, même pour un seul article -->
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="row"> <!--start row-->
              <article class="small-12 medium-12 large-5 columns articlepadding rightpadding" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">

                <div class="itempadding">
                    <?php echo types_render_field("texte-introduction-usine", array("output"=>"raw")); ?>
                </div>
                <div class="itempadding">
                    <h5><?php echo types_render_field("titre-references-usine", array("output"=>"raw")); ?></h5>
                    <img src="<?php echo types_render_field("image-references-usine", array("output"=>"raw")); ?>" />
                </div>
                <div class="itempadding">
                     <img src="<?php echo types_render_field("image-illustration-usine", array("output"=>"raw")); ?>" />
                </div>
 
            </article>

			
            <article class="small-12 medium-12 large-4 columns articlepadding" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
					<header>
						<h2 class="entry-title text-center market-color"><?php the_title(); ?></h2>
					</header>

					<?php do_action( 'foundationpress_page_before_entry_content' ); ?> 
					<div class="entry-content row">
                        <article class="small-12 ">
                            <?php the_content(); ?>
                        </article>
                        
                        <?php echo types_render_field("lien-plan-usine", array("output"=>"raw")); ?>
                    </div>
                    
            </article>
                
            </div> <!--end row-->

				
			
			<?php endwhile; ?>
			
			<?php do_action( 'foundationpress_after_content' ); ?>
		</div>
		<?php get_footer(); ?>

