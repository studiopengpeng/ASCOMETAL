<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


    <div id="page" role="main">
        <?php get_template_part( 'template-parts/header-banner-recrutement' ); ?>


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
	 <article id="main-container" class="small-12 medium-9 large-9 columns offres recrutement-liste" <?php post_class( 'main-content') ?> id="post-
                            <?php the_ID(); ?>">
                                <header class="social-header row">
                                   <div class="title-area small-12 medium-8 large-8 columns">
                                        <h2 class="entry-title"><?php echo __('Trades in the heart of steel', 'foundationpress'); ?></h2>
                                        </div>
                                     <div class="social-icons small-12 medium-4 large-4 columns">
                                         <?php echo do_shortcode("[ssba]"); ?>
                                     </div>
                                    
                                </header>
                                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                                <div class="entry-content">

                                    <div class="small-12 medium-5 large-5 columns ">
                                        <?php
                                        // catégorie d'offre
                                            $taxonomy = 'categorie-offres';
                                            $term_args=array(
                                              'taxonomy' => $taxonomy,
                                              'hide_empty' => false,
                                              'orderby' => 'name',
                                              'order' => 'ASC'
                                            );
                                            $tax_terms = get_terms($taxonomy,$term_args);
                                            $count = count($tax_terms);
                                            if ( $count > 0 ){
                                                    echo '<div class="titre-taxo-offres">';
                                                    echo __('Our offers:', 'foundationpress');
                                                    echo '</div>';
                                                    echo '<ul class="liste-taxo-offres">';
                                                    foreach ( $tax_terms as $term ) {
                                                       echo '<li data-filter="' . $term->slug . '"><a href="'.get_term_link( $term).'">' . $term->name . '</a>&nbsp;<span class="badge"> ' . $term->count . '</span></li>';
                                                    }
                                                    echo '</ul>';
                                            }
                                        
                                        
                                            // type de poste
                                            $taxonomy = 'type-de-poste';
                                            $term_args=array(
                                              'taxonomy' => $taxonomy,
                                              'hide_empty' => false,
                                              'orderby' => 'name',
                                              'order' => 'ASC'
                                            );
                                            $tax_terms = get_terms($taxonomy,$term_args);
                                            $count = count($tax_terms);
                                            if ( $count > 0 ){
                                                    echo '<div class="titre-taxo-offres">';
                                                    echo __('You are:', 'foundationpress');
                                                    echo '</div>';
                                                    echo '<ul class="liste-taxo-offres">';
                                                    foreach ( $tax_terms as $term ) {
                                                       echo '<li data-filter="' . $term->slug . '"><a href="'.get_term_link( $term).'">' . $term->name . '</a>&nbsp;<span class="badge"> ' . $term->count . '</span></li>';
                                                    }
                                                    echo '</ul>';
                                            }
                                        
                                        // type de poste
                                            $taxonomy = 'site-offre';
                                            $term_args=array(
                                              'taxonomy' => $taxonomy,
                                              'hide_empty' => false,
                                              'orderby' => 'name',
                                              'order' => 'ASC'
                                            );
                                            $tax_terms = get_terms($taxonomy,$term_args);
                                            $count = count($tax_terms);
                                            if ( $count > 0 ){
                                                    echo '<div class="titre-taxo-offres">';
                                                    echo __('Locations:', 'foundationpress');
                                                    echo '</div>';
                                                    echo '<ul class="liste-taxo-offres">';
                                                    foreach ( $tax_terms as $term ) {
                                                       echo '<li data-filter="' . $term->slug . '"><a href="'.get_term_link( $term).'">' . $term->name . '</a>&nbsp;<span class="badge"> ' . $term->count . '</span></li>';
                                                    }
                                                    echo '</ul>';
                                            }
                                        
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                
                                    </div>
                                     <div class="small-12 medium-7 large-7 columns ">
                                         <?php
                                         	
                                            $taxonomy = get_queried_object();
                                            echo  "<h3>".$taxonomy->name."</h3>";
                                         
                                         ?>
                                    
	<?php if ( have_posts() ) : ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); 
                                         
        $fonction = types_render_field("offre-fonction", array("output"=>"raw"));
        $contact_mail = types_render_field("offre-mail-candidature", array("output"=>"raw"));
        $activites = types_render_field("offre-activites", array("output"=>"raw"));
        $profil = types_render_field("offre-profil", array("output"=>"raw"));
        $conditions = types_render_field("offre-conditions", array("output"=>"raw"));
        $resume =  types_render_field("offre-resume", array("output"=>"raw"));
        $secteur =  types_render_field("offre-secteur", array("output"=>"raw"));

        $terms = get_the_terms( get_the_ID(), 'site-offre');
        if ( $terms && ! is_wp_error( $terms ) ) : 
        foreach ( $terms as $term ) {
            $lieu = $term->name;
        }
        endif;
        ?>

         <li class="ih-item article-preview">
            <div class="date"><?php the_date(); ?></div>
            <div><span class="fonction"><a href="<?php the_permalink(); ?>"><?php echo $fonction ?></a></span> - <span class="lieu"> 
            <?php echo $lieu; ?></span></div>
            <div class="resume"><?php echo $resume; ?></div>
            <div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo __("More...", "foundationpress") ?></a></div>
        </li>
                              
		<?php endwhile; ?>

		<?php else : ?>
			
        <?php 
        
            echo "<p>";
            echo __("No offer matching this criteria", "foundationpress");
            echo "</p>";
        
        ?> 
		<?php endif; // End have_posts() check. ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
			</nav>
		<?php } ?>

	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
