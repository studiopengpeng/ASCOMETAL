<?php
/*
Template Name: liste pages corporate
*/

get_header(); ?>
<?php 
$contexte_blocs="nc";
$idBloc=0;
//global $classeRubrique;
global $contexte_blocs;
global $idBloc;
?>

    <div id="page" role="main">
        <article class="main-content corporate">
			<?php get_template_part( 'template-parts/header-banner-marches' ); ?>
			
			<div class="row">
				<div class="small-12 columns" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>

					<?php /* récupère une liste de toutes les pages */ ?>
					<?php 
					$pages = get_pages();
					foreach ($pages as $page_data) {
						$pageID = 0;
						$pageID = $page_data->ID;
						$idBloc=$pageID;
						$contexte_blocs="avecID";
	//					$classeRubrique="corporate";

						/* si la case "afficher dans les blocs" est cochée, on affiche la page */
						if (types_render_field("afficher-bloc", array("output"=>"raw", "post_id"=>$pageID)) == 1) :
							get_template_part( 'template-parts/content', 'blocs' ); 
						endif;
					}
					?>

				</div>
			</div>
        </article>
    </div>
    <?php get_footer(); ?>