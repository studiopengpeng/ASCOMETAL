<?php
/*
Template Name: Calculatrice [masse]
*/
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
        <article id="main-container" class="small-12 medium-9 large-9 columns calculatrice-unites" <?php post_class( 'main-content') ?> id="post-
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
                
             <!-- start masse -->                       
            <div id="form" class="form-masse">                 
            <div>
                <h4><?php echo __('Linear Weight', 'foundationpress'); ?></h4>
			</div>
		
			<table width="100%" class="masse" width="100%">
				<tr>
					<th><?php echo __('Product dimension', 'foundationpress'); ?></th>
					
					<th><?php echo __('Result', 'foundationpress'); ?></th>
				</tr>
				<tr><td colspan="2"><label for="form_barre" class="required"><?php echo __('Bar', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_barre" name="form[barDiam]" required="required" type="text" placeholder="<?php echo __('Enter the section in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					
					<td><input disabled id="form_barre_res" name="form[barRes]" required="required" type="text" placeholder=""> <span class="unites">kg/m</span></td>
				</tr>
				
				<tr><td colspan="2"><label for="form_billetes" class="required"><?php echo __('Square blooms/billets', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_billetes" name="form[bilHaut]" required="required" type="text" placeholder="<?php echo __('Enter the height in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					
					<td><input disabled id="form_billetes_res" name="form[bilRes]" required="required" type="text" placeholder=""> <span class="unites">kg/m</span></td>
				</tr>
				
				<tr><td colspan="2"><label for="form_larget" class="required"><?php echo __('Rectangular rolled bloom', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_larget_haut" name="form[larHaut]" required="required" type="text" placeholder="<?php echo __('Enter the height in mm', 'foundationpress'); ?>"> <span class="unites">mm</span><br/>
					    <input id="form_larget_larg" name="form[larLarg]" required="required" type="text" placeholder="<?php echo __('Enter the width in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
				 
					<td><input disabled id="form_larget_res" name="form[larRes]" required="required" type="text" placeholder=""> <span class="unites">kg/m</span></td>
				</tr>
				</table>
			
			<hr>
			
	         <div class="sous-titre">
				<h4><?php echo __('Mass', 'foundationpress'); ?></h4>
			</div>    
			
			<table width="100%" class="convertisseur">
				<tr>
					<th><?php echo __('Product dimension', 'foundationpress'); ?></th>
					<th><?php echo __('Length', 'foundationpress'); ?></th>
					<th><?php echo __('Result', 'foundationpress'); ?></th>
				</tr>
				<tr><td colspan="3"><label for="form_barre2" class="required"><?php echo __('Bar', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_barre2" name="form[bar2Diam]" required="required" type="text" placeholder="<?php echo __('Enter the section in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input id="form_barre2_long" name="form[bar2long]" required="required" type="text" placeholder="<?php echo __('Enter the length in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input disabled id="form_barre2_res" name="form[bar2Res]" required="required" type="text" placeholder=""> <span class="unites">Kg</span></td>
				</tr>
				
				<tr><td colspan="3"><label for="form_billetes2" class="required"><?php echo __('Square blooms/billets', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_billetes2" name="form[bil2Haut]" required="required" type="text" placeholder="<?php echo __('Enter the height in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input id="form_billetes2_long" name="form[bil2Long]" required="required" type="text" placeholder="<?php echo __('Enter the length in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input disabled id="form_billetes2_res" name="form[bil2Res]" required="required" type="text" placeholder=""> <span class="unites">Kg</span></td>
				</tr>
				
				<tr><td colspan="3"><label for="form_larget2" class="required"><?php echo __('Rectangular rolled bloom', 'foundationpress'); ?></label></td></tr>
				<tr>
					<td><input id="form_larget2_haut" name="form[lar2Haut]" required="required" type="text" placeholder="<?php echo __('Enter the height in mm', 'foundationpress'); ?>"> <span class="unites">mm</span><br/>
					    <input id="form_larget2_larg" name="form[lar2Larg]" required="required" type="text" placeholder="<?php echo __('Enter the width in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input id="form_larget2_long" name="form[lar2Long]" required="required" type="text" placeholder="<?php echo __('Enter the length in mm', 'foundationpress'); ?>"> <span class="unites">mm</span></td>
					<td><input disabled id="form_larget2_res" name="form[lar2Res]" required="required" type="text" placeholder=""> <span class="unites">Kg</span></td>
				</tr>
				</table>
                
                   </div>
				              
	              <!-- end masse -->       
                                            
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
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/custom/calculmasse.js"></script>
        
    <?php get_footer();