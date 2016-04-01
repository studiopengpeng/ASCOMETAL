<?php
/*
Template Name: liste des marchés ascométal
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
        <?php get_template_part( 'template-parts/header-banner-marches' ); ?>
        
        <article class="main-content-large">
            <header>
			<h2 class="entry-title"><?php the_title(); ?></h1>
			</header>
            
			<div class="row">
				<div class="small-12 columns" <?php post_class( 'main-content') ?> id="post-<?php the_ID(); ?>">
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>

                    <section id="content">
                    <?php the_content(); ?>
                        </section>
					<?php get_template_part( 'template-parts/blocs-marches-index' ); ?>
					

				</div>
			</div>
        </article>
    </div>
    <?php get_footer(); ?>