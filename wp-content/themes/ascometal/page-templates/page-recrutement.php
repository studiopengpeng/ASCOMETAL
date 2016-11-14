<?php
/*
Template Name: Recrutement [liste des offres]
*/
get_header();
?>


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

		<!-- début boucle content posts -->
		 <?php do_action( 'foundationpress_before_content' ); ?>
         <?php while ( have_posts() ) : the_post(); ?>
        <article id="main-container" class="small-12 medium-9 large-9 columns offres recrutement-liste" <?php post_class( 'main-content') ?> id="post-
                            <?php the_ID(); ?>">
                                <header class="social-header row">
                                   <div class="title-area small-12 medium-8 large-8 columns">
                                        <h2 class="entry-title"><?php the_title(); ?></h2>
                                        </div>
                                     <div class="social-icons small-12 medium-4 large-4 columns">
                                         <?php echo do_shortcode("[ssba]"); ?>
                                     </div>

                                </header>
                                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                                <div class="entry-content">
                                    <div class="small-12" style="margin-bottom:75px">
                                    <?php the_content(); ?>
                                    </div>
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



            <!-- start template : liste d'annonces -->

                                    <?php
                                    // ! WPML : suppress_filter sur false sinon renvoie les posts de toutes les langues
                                    $args = array(
                                        'posts_per_page'   => 40,
                                        'offset'           => 0,
                                        'category'         => '',
                                        'category_name'    => '',
                                        'orderby'          => 'date',
                                        'order'            => 'DESC',
                                        'include'          => '',
                                        'exclude'          => '',
                                        'meta_key'         => '',
                                        'meta_value'       => '',
                                        'post_type'        => 'recrutement',
                                        'post_mime_type'   => '',
                                        'post_parent'      => '',
                                        'author'	   => '',
                                        'post_status'      => 'publish',
                                        'suppress_filters' => false
                                    );
                                    $offres_array = get_posts( $args );

                                    //print_r ($offres_array);

                                    foreach ( $offres_array as $post ) : setup_postdata( $post );

                                        $fonction = types_render_field("offre-fonction", array("output"=>"raw"));
                                        $contact_mail = types_render_field("offre-mail-candidature", array("output"=>"raw"));
                                        $activites = types_render_field("offre-activites", array("output"=>"normal"));
                                        $profil = types_render_field("offre-profil", array("output"=>"html"));
                                        $conditions = types_render_field("offre-conditions", array("output"=>"normal"));
                                        $resume =  types_render_field("offre-resume", array("output"=>"raw"));
                                        $secteur =  types_render_field("offre-secteur", array("output"=>"normal"));

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
                                    <?php endforeach;
                                    wp_reset_postdata();?>

                                    </div>

                                    <!-- end template -->

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
