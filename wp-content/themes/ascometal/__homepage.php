<?php
/*
Template Name: accueil-ascometal
*/
get_header();
// code langue pour redirection des liens statiques
$actulang=ICL_LANGUAGE_CODE;
$prelink="";
if ($actulang!="fr") {$prelink="/".$actulang;}
?>

    <!-- Ascometal content  -->

    <div id="page" role="main">
        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
        <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image' ); ?>
                    <h1><?php echo __( '...A partner<br />to your success', 'foundationpress') ?></h1>
            </header>
        </article>
        <!--END header de page-->
        <?php do_action( 'foundationpress_before_content' ); ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="row">
                    <div class="small-12 medium-12 large-12 columns" <?php post_class( 'main-content') ?> id="post-
                        <?php the_ID(); ?>">
                            <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                                <div class="entry-content">
                                    <!-- blocs marchés -->
                                   <?php get_template_part( 'template-parts/blocs-marches-index' ); ?>
                                    <!-- end blocs marchés -->
                                    <section id="about">
                                        <!-- Ascometal -->
                                        <article class="ascometal small-12 medium-12 large-5 columns">
                                            <div class="ih-item square effect13 top_to_bottom">
                                                <a href="<?php echo site_url().$prelink; ?>/ascometal-au-service-de-vos-performances/">
                                                    <h3 class="title-asco">Ascometal</h3>
                                                    <div class="img">
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ascometal-bobine.jpg" alt="bobines d'acier laminé par Ascometal">
                                                    </div>
                                                    <div class="info asco">
                                                        <h3>Ascometal</h3>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/asco.svg" alt="monogramme d'Ascometal">
                                                        <p><?php echo __( 'A key european producer of lng engineering steel products', 'foundationpress') ?></p>
                                                        <p class="seemore"><?php echo __("More...", "foundationpress") ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </article>
                                        <!-- END Ascometal -->
                                        <!-- Actualités -->
                                        <article class=" news small-12 medium-12 large-7 columns">
                                               <?php get_template_part( 'template-parts/carrousel-actualites' ); ?>
                                        </article>
                                        <!-- END Actualités -->

                                    </section>
                                    <!-- Logos-customers -->
                                    <h4 class="large-12 columns"><?php echo __( 'Among our references', 'foundationpress') ?></h4>
                                    <section class="customers small-12 medium-12 large-12 columns">
                                        <?php echo do_shortcode("[show-logos orderby='none' category='0' activeurl='inactive' style='hgrayscale' interface='hcarousel' tooltip='false' description='false' limit='0' filter='false' ]"); ?>
                                    </section>
                                    <!-- END logos-customers -->
                                    <footer>
                                        <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
                                            <p>
                                                <?php the_tags(); ?>
                                            </p>
                                    </footer>
                                    <?php do_action( 'foundationpress_page_before_comments' ); ?>
                                        <?php comments_template(); ?>
                                            <?php do_action( 'foundationpress_page_after_comments' ); ?>
                                </div>
                    </div>
                </article>
                <?php endwhile;?>
                    <?php do_action( 'foundationpress_after_content' ); ?>
    </div>

    <!-- END Ascometal content  -->

    <?php get_footer(); ?>