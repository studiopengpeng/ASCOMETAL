<?php
/* 
Template Name: Page pour carte interactive
*/ 
get_header(); 
?>


    <div id="page" role="main">
		<?php get_template_part( 'template-parts/header-banner' ); ?>
       


                        <!--END menu secondaire-->
		
		<!-- début boucle content posts -->
		 <?php do_action( 'foundationpress_before_content' ); ?>
         <?php while ( have_posts() ) : the_post(); ?>
        <article id="main-container" class="small-12  columns" <?php post_class( 'main-content') ?> id="post-
                            <?php the_ID(); ?>">
                                <header>
                                    <h2 class="entry-title"><?php the_title(); ?></h2>
                                </header>
                                <?php do_action( 'foundationpress_page_before_entry_content' ); ?>


                                <div class="entry-content">
                                    <div id="imap1message" class="ih-item hide"><div id="inner-message"><?php echo __("Sélectionnez un pays", "foundationpress"); ?></div><a id="close-imapmessage">X</a></div>

                                    <?php the_content(); ?>
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

    <?php get_footer();