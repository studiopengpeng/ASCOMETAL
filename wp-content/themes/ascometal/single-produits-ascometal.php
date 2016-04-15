<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


    <div id="page" role="main">
        <?php get_template_part( 'template-parts/header-banner-produits' ); ?>

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
		<div id="single-post" class="produits" role="main">
			<?php do_action( 'foundationpress_before_content' ); ?>

			<!-- boucle wp, même pour un seul article -->
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="main-container" class="small-12 medium-12 large-9 columns" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
					<header>
						<h2 class="entry-title text-center market-color"><?php the_title(); ?></h2>
					</header>

					<?php do_action( 'foundationpress_page_before_entry_content' ); ?> 
					<div class="entry-content row">
                        <article class="small-12 ">
                            <div class="social-icons small-12 columns">
                                <?php echo do_shortcode("[ssba]"); ?>
                            </div>
                            <?php the_content(); ?>
                        </article>
                    </div>
                    <div class="description row">
                        <div class="pad-0 small-12 medium-6 large-6 columns">
            
                            <div class="product-view"><?php the_post_thumbnail(); ?>

                            <ul class="product-menu">
                            <li class="product-icon features"></li>
                               <li class="product-icon advantage"></li>
                                <li class="product-icon benefits"></li>
                            </ul>

                            </div>
                        </div>

                    <div class="pad-0 small-12 medium-6 large-6 columns">
                        
                        <div data-alert class=" text- center alert-box ih-item">
                            <?php echo types_render_field("description-courte", array("output"=>"raw")); ?>
                        
                    <div class="alert-info ">
                        <section class="features-alert">
                           <div class="features-info"></div>
                            <h3><?php echo __("Properties","foundationpress"); ?></h3>
                            <?php echo types_render_field("carecteristiques", array("output"=>"raw")); ?>
                        </section>
                        <section class="advantage-alert hide">
                            <div class="advantage-info"></div>
                            <h3><?php echo __("Advantages","foundationpress"); ?></h3>
                            <?php echo types_render_field("avantages", array("output"=>"raw")); ?>
                        </section>
                        <section class="benefits-alert hide">
                            <div class="benefits-info"></div>
                            <h3><?php echo __("Benefits","foundationpress"); ?></h3>
                            <?php echo types_render_field("benefices", array("output"=>"raw")); ?>
                        </section>
                    </div>
                     
                    
					</div>
                        <!--
					<a href="#">
					        <div class="ih-item documentation ">
                                    <div class="left picto">                           </div>
                                    <div class="left infos">
                                        <p class="title">DOCUMENTATION</p>
                                        <p>Consultez et téléchargez votre fiche produit</p>
                                    </div>
                            </div>
                        </a>
                        -->
                    <?php echo types_render_field("brochure-telecharger", array("output"=>"raw")); ?>
					</div>
                        
					</div>
					<div class="row">
                       
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
		</div>
		<?php get_footer(); ?>

