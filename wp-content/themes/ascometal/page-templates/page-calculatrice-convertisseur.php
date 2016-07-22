<?php
/*
Template Name: Calculatrice [convertisseur]
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
                
             <!-- start unites -->                       
            <div id="form" class="form-conv">                 
             <table width="100%" class="convertisseur">
				<tr>
					<th><?php echo __('Amount', 'foundationpress'); ?></th>
					<th><?php echo __('From', 'foundationpress'); ?></th>
					<th><?php echo __('To', 'foundationpress'); ?></th>
					<th><?php echo __('Result', 'foundationpress'); ?></th>
				</tr>
				<tr><td colspan="4"><label for="form_longueur" class="required"><?php echo __('Length', 'foundationpress'); ?> <span>(m ↔ ft)</span></label></td></tr>
				<tr>
					<td><input id="form_longueur" name="form[longueur]" required="required" type="text">
                 </td>
					
					<td>	<select id="form_unite1" name="form[unite1]">
								<option value="1">m</option>
								<option value="2">ft</option>
							</select>
					</td>
					
					<td><select id="form_unite2" name="form[unite2]">
						
						<option value="1">m</option>
						<option value="2" selected>ft</option>
					</select></td>
					<td><input disabled id="form_longueur_res" name="form[longueur]" required="required" type="text"></td>
				</tr>
				
				<tr ><td colspan="4"><label for="form_Surface" class="required"><?php echo __('Surface', 'foundationpress'); ?> <span>(mm&sup2; ↔ in&sup2;)</span></label></td></tr>
				<tr >
				<td><input id="form_Surface" name="form[Surface]" required="required" type="text"></td>
					<td><select id="form_unite7" name="form[unite7]">
						
						<option value="1">mm &sup2;</option>
						<option value="2">in&#178;</option>
					</select></td>
					<td><select id="form_unite8" name="form[unite8]">
						<option value="1">mm&#178;</option>
						<option value="2" selected>in&#178;</option>
					</select></td>
					<td><input disabled id="form_Surface_res" name="form[Surface]" required="required" type="text"></td>
				
				</tr>
				<tr ><td colspan="4"><label for="form_Volume" class="required"><?php echo __('Volume', 'foundationpress'); ?> <span>(m&sup3; ↔ ft&sup3;)</span></label></td></tr>
				<tr >
					<td><input id="form_Volume" name="form[Volume]" required="required" type="text"></td>
					<td><select id="form_unite3" name="form[unite3]">
						<option value="1">m&sup3;</option>
                        <option value="2">ft&sup3;</option>
					</select></td>
					<td><select id="form_unite4" name="form[unite4]">
					
					<option value="1">m&sup3;</option>
					<option value="2" selected>ft&sup3;</option>
					</select></td>
					<td><input disabled id="form_Volume_res" name="form[Volume]" required="required" type="text"></td>
				</tr>
                 
                <tr class="calc-separator">
				<td colspan="4"></td></tr>
				<tr >

				<tr class="border-red">
				<td colspan="4"><label for="form_Masse" class="required"><?php echo __('Mass', 'foundationpress'); ?> <span>(kg ↔ lbs)</span></label></td></tr>
				<tr >
					<td><input id="form_Masse" name="form[Masse]" required="required" type="text"></td>
					<td><select id="form_unite5" name="form[unite5]">
						
						<option value="1">kg</option>
						<option value="2">lbs</option>
					</select></td>
					<td><select id="form_unite6" name="form[unite6]">
						<option value="1">kg</option>
                        <option value="2" selected>lbs</option>
					</select></td>
					<td><input disabled id="form_Masse_res" name="form[Masse]" required="required" type="text"></td>
				</tr>
				
				
				<tr><td colspan="4"><label for="form_Densite" class="required"><?php echo __('Density', 'foundationpress'); ?> <span>(kg/m&sup3; ↔ lbs/in&sup3;)</span></label></td></tr>
				<tr >
					<td><input id="form_Densite" name="form[Densite]" required="required" type="text"></td>
					<td><select id="form_unite9" name="form[unite9]">
						<option value="1">kg/m&#179;</option>
						<option value="2">lbs/in&#179;</option>
					</select></td>
					<td><select id="form_unite10" name="form[unite10]">
						<option value="1">kg/m&#179;</option>
						<option value="2" selected>lbs/in&#179;</option>
					</select></td>
					<td><input disabled id="form_Densite_res" name="form[Densite]" required="required" type="text"></td>
				</tr>
                 
                <tr class="calc-separator">
				<td colspan="4"></td></tr>
				<tr >
            
				<tr><td colspan="4"><label for="form_Contrainte" class="required"><?php echo __('Stress', 'foundationpress'); ?> <span>(N/mm&sup2; ou MPa ↔ ksi)</span></label></td></tr>
				<tr>
					<td><input id="form_Contrainte" name="form[Contrainte]" required="required" type="text"></td>
					<td><select id="form_unite11" name="form[unite11]">
						<option value="1">N/mm&#178; <?php echo __('or', 'foundationpress'); ?> MPa</option>
						<option value="2">ksi</option>
					</select></td>
					<td><select id="form_unite12" name="form[unite12]">
						<option value="1">N/mm&#178; <?php echo __('or', 'foundationpress'); ?> MPa</option>
						<option value="2" selected>ksi</option>
					</select></td>
					<td><input disabled id="form_Contrainte_res" name="form[Contrainte]" required="required" type="text"></td>
				</tr>
				<tr><td colspan="4"><label for="form_Pression" class="required"><?php echo __('Pressure', 'foundationpress'); ?> <span>(bar ↔ psi)</span></label></td></tr>
				<tr>
					<td><input id="form_Pression" name="form[Pression]" required="required" type="text"></td>
					<td><select id="form_unite13" name="form[unite11]">
						<option value="1">bar</option>
						<option value="2">psi</option>
					</select></td>
					<td><select id="form_unite14" name="form[unite12]">
						<option value="1">bar</option>
						<option value="2" selected>psi</option>
					</select></td>
					<td><input disabled id="form_Pression_res" name="form[Pression]" required="required" type="text"></td>
				</tr>
				<tr><td colspan="4"><label for="form_Temperature" class="required"><?php echo __('Temperature', 'foundationpress'); ?> <span>(°C ↔ °F)</span></label></td></tr>
				<tr>
					<td><input id="form_Temperature" name="form[Temperature]" required="required" type="text"></td>
					<td><select id="form_unite15" name="form[unite11]">
						<option value="1">&#176;C</option>
						<option value="2">&#176;F</option>
					</select></td>
					<td><select id="form_unite16" name="form[unite12]">
						<option value="1">&#176;C</option>
						<option value="2" selected>&#176;F</option>
					</select></td>
					<td><input disabled id="form_Temperature_res" name="form[Temperature]" required="required" type="text"></td>
				</tr>
				<tr><td colspan="4"><label for="form_Energie" class="required"><?php echo __('Energy', 'foundationpress'); ?> <span>(J ↔ ft/lbf)</span></label></td></tr>
				<tr>
					<td><input id="form_Energie" name="form[Energie]" required="required" type="text"></td>
					<td><select id="form_unite17" name="form[unite11]">
						<option value="1">J</option>
						<option value="2">ft/lbf</option>
					</select></td>
					<td><select id="form_unite18" name="form[unite12]">
						<option value="1">J</option>
						<option value="2" selected>ft/lbf</option>
					</select></td>
					<td><input disabled id="form_Energie_res" name="form[Energie]" required="required" type="text"></td>
				</tr>
				</table>
                
                   </div>
				              
	              <!-- end unites -->       


                                            
                            
                                            
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
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/custom/convertisseur.js">
        
    <?php get_footer();