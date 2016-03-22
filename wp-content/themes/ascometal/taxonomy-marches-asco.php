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

get_header(); 
$contexte_blocs="nc";
global $contexte_blocs;
$exception_couleur=false;
global $exception_couleur;
// couleurs du marché en cours
$tax_array=Array();
$queried_object = get_queried_object();
foreach($queried_object as $cur)
{
    $tax_array[]=$cur;
}
// automobile
if ($tax_array[4]==18) ($classColor="automobile");
else if ($tax_array[4]==19) ($classColor="roulement");
else if ($tax_array[4]==20) ($classColor="petrole");
else if ($tax_array[4]==21) ($classColor="mecanique");
?>

    <div id="page" role="main">
		<?php get_template_part( 'template-parts/header-banner-marches' ); ?>
		
        <article class="main-content <?php echo $classColor ?>">
            <?php if ( have_posts() ) : ?>
                <h1><?php parent_page_title() ?></h1>
			
			<div class="row">
            <div class="small-12 columns" <?php post_class( 'main-content') ?> id="post-
                <?php the_ID(); ?>">
                    <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
				
			
                <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); 
				$contexte_blocs="sansID";
				if (types_render_field("afficher-bloc", array("output"=>"raw")) == 1) :
				get_template_part( 'template-parts/content', 'blocs' ); 
				endif;
				
				endwhile; ?>
				
				<?php 	/* pages contact et international */
						/* récupère une liste de toutes les pages */ ?>
					<?php 
					$pages = get_pages();
					foreach ($pages as $page_data) {
						$pageID = 0;
						$pageID = $page_data->ID;
						$idBloc=$pageID;
						$contexte_blocs="avecID";
						$exception_couleur=true; // blocs gris
						
						if ($idBloc==25 || $idBloc==27) { // IDs pages contact et international
							/* si la case "afficher dans les blocs" est cochée, on affiche la page */
							if (types_render_field("afficher-bloc", array("output"=>"raw", "post_id"=>$pageID)) == 1) :
								get_template_part( 'template-parts/content', 'blocs' ); 
							endif;
						}
					}
					?>

                               
            <?php endif; // End have_posts() check. ?>
		</div>
   	</div>

        </article>
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>