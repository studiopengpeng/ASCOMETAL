<?php
/*
Template Name: Calculatrice [carboneEQ]
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
            <div id="form" class="form-carbone">                 
          <div class="sous-titre">
				<h4><?php echo __('Equivalent carbon', 'foundationpress'); ?></h4>
			</div>
		
			<table width="100%" class="carbone" width="100%">
				<tr>
					<th><?php echo __('Element', 'foundationpress'); ?></th>
					
					<th><?php echo __('Result', 'foundationpress'); ?></th>
				</tr>
				<tr>
					<td><label for="form_C" class="required">C</label><input id="form_C" name="form[C]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
                    <td class="commentaire" rowspan="6"><div><?php echo __('Please enter a value in each box, and use a POINT to separate decimal', 'foundationpress'); ?></br>
					 CEV = C + Mn/6 + (Cr + Mo + V)/5 + (Cu + Ni)/15<br/>
					 CET = C + (Mn + Mo)/10 +(Cr + Cu)/20 + Ni/40<br/>
					 Pcm = C + Si/30 + (Mn + Cu + Cr)/20 + Ni/60 + Mo/15 + V/10 + 5B
                    </div>
                </td>
				</tr>
				<tr>
					<td><label for="form_Nm" class="required">Mn</label><input id="form_Nm" name="form[Nm]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
				</tr>
				<tr>
					<td><label for="form_Ni" class="required">Ni</label><input id="form_Ni" name="form[Ni]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
				</tr>
				<tr>
					<td><label for="form_Cu" class="required">Cu</label><input id="form_Cu" name="form[Cu]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
				</tr>
				<tr>
					<td><label for="form_Mo" class="required">Mo</label><input id="form_Mo" name="form[Mo]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
				</tr>
				<tr>
					<td><label for="form_Cr" class="required">Cr</label><input id="form_Cr" name="form[Cr]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
				</tr>
				<tr>
					<td><label for="form_B" class="required">B</label><input id="form_B" name="form[B]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
					<td><label for="form_barre_res_CEV" class="small required">CEV =</label><input disabled id="form_barre_res_CEV" class="small" name="form[barRes]" required="required" type="text" placeholder=""></td>
				</tr>
				<tr>
					<td><label for="form_V" class="required">V</label><input id="form_V" name="form[V]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
					<td><label for="form_barre_res_CET" class="small required">CET =</label><input disabled id="form_barre_res_CET" class="small" name="form[barRes]" required="required" type="text" placeholder=""></td>
				</tr>
				<tr>
					<td><label for="form_Si" class="required">Si</label><input id="form_Si" name="form[Si]" required="required" type="text" placeholder="<?php echo __('Enter the average value', 'foundationpress'); ?>"></td>
                    <td><label for="form_barre_res_Pcm" class="small required">Pcm =</label><input disabled id="form_barre_res_Pcm" class="small" name="form[barRes]" required="required" type="text" placeholder=""></td>
				
				</tr>
				</table>
				              
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
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/custom/carbonne.js">
    <?php get_footer();