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
?>

    <div id="page" role="main">
		<?php get_template_part( 'template-parts/header-banner-marches' ); ?>
		
        <article class="main-content">
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

                               
            <?php endif; // End have_posts() check. ?>
		</div>
   	</div>


                                            <?php /* Display navigation to next/previous pages when applicable */ ?>
				     


        </article>
        <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>