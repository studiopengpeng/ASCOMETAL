<?php
/*
Template Name: accueil-ascometal
*/
get_header(); ?>

    <!-- Ascometal content  -->

    <div id="page" role="main">
        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
        <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image' ); ?>
                    <h1>Au service </br>de vos performances</h1>
            </header>
        </article>
        <!--END header de page-->
        <?php do_action( 'foundationpress_before_content' ); ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="small-12 medium-12 large-12 columns" <?php post_class( 'main-content') ?> id="post-
                    <?php the_ID(); ?>">
                        <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                            <div class="entry-content">
                                <section id="markets">
                                    <!-- Automobile -->
                                    <article class="auto small-12 medium-6 large-3 columns">
                                        <div class="ih-item square effect13 top_to_bottom">
                                            <a href="#">
                                                <h3 class="title-auto">Automobile</h3>
                                                <div class="img">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto.jpg" alt="automobile Ascometal">
                                                </div>
                                                <div class="info aut">
                                                    <h3>Automobile</h3>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto.svg" alt="automobile Ascometal">
                                                    <p>Une parfaite compréhension des enjeux techniques et économiques...</p>
                                                    <p class="seemore">voir+</p>
                                                </div>
                                            </a>
                                        </div>
                                    </article>
                                    <!-- END automobile -->
                                    <!-- Roulement -->
                                    <article class="rolling small-12 medium-6 large-3 columns">

                                        <div class="ih-item square effect13 top_to_bottom">
                                            <a href="#">
                                                <h3 class="title-rolling">Roulement</h3>
                                                <div class="img">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rolling.jpg" alt="roulement en acier Ascometal">
                                                </div>
                                                <div class="info rol">
                                                    <h3>Roulements</h3>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rolling.svg" alt="roulement en acier Ascometal">
                                                    <p>Un partenariat durable avec les roulements mondiaux...
                                                    </p>
                                                    <p class="seemore">voir+</p>
                                                </div>
                                            </a>
                                        </div>

                                    </article>
                                    <!-- END roulement -->
                                    <!-- Méchanique -->
                                    <article class="mechanical small-12 medium-6 large-3 columns">

                                        <div class="ih-item square effect13 top_to_bottom">
                                            <a href="#">
                                                <h3 class="title-mechanical">Mécanique</h3>
                                                <div class="img">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mechanical.jpg" alt="engrenage mécanique d'Ascometal">
                                                </div>
                                                <div class="info mec">
                                                    <h3>Mécanique</h3>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mechanical.svg" alt="engrenage mécanique d'Ascometal">
                                                    <p>Un partenariat durable avec les roulements mondiaux...
                                                    </p>
                                                    <p class="seemore">voir+</p>
                                                </div>
                                            </a>
                                        </div>

                                    </article>
                                    <!-- END méchanique -->
                                    <!-- Pétrole -->
                                    <article class="petrol small-12 medium-6 large-3 columns">
                                        <div class="ih-item square effect13 top_to_bottom">
                                            <a href="#">
                                                <h3 class="title-petrol">Pétrole</h3>
                                                <div class="img">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/petrol.jpg" alt="plateforme pétrolière d'Ascometal">
                                                </div>
                                                <div class="info pet">
                                                    <h3>Pétrole</h3>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/petrol.svg" alt="plateforme pétrolière d'Ascometal">
                                                    <p>Un acteur de renommée mondiale pour le forage et l’exploitation...</p>
                                                    <p class="seemore">voir+</p>
                                                </div>
                                            </a>
                                        </div>

                                    </article>
                                    <!-- END pétrole -->
                                </section>
                                <section id="about">
                                    <!-- Ascometal -->
                                    <article class="small-12 medium-12 large-5 columns">
                                        <div class="ih-item square effect13 top_to_bottom">
                                            <a href="#">
                                                <h3 class="title-asco">Ascometal</h3>
                                                <div class="img">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ascometal-bobine.jpg" alt="bobines d'acier laminé par Ascometal">
                                                </div>
                                                <div class="info asco">
                                                    <h3>Ascometal</h3>
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/asco.svg" alt="monogramme d'Ascometal">
                                                    <p>Un acteur européen incontournable dans les aciers longs spéciaux...</p>
                                                    <p class="seemore">voir+</p>
                                                </div>
                                            </a>
                                        </div>
                                    </article>
                                    <!-- END Ascometal -->
                                    <!-- Actualités -->
                                    <article class=" news small-12 medium-12 large-7 columns">
                                        <div class="ih-item">
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/actu.png" alt="">
                                         </div>
                                    </article>
                                    <!-- END Actualités -->

                                </section>
                                <!-- Logos -->
                                <?php echo do_shortcode("[show-logos orderby='none' category='0' activeurl='inactive' style='normal' interface='hcarousel' tooltip='false' description='false' limit='0' filter='false' carousel='false,4000,false,false,500,10,true,false,true,1,0,1']"); ?>
                                    <!-- END logos -->
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

                <?php endwhile;?>
                    <?php do_action( 'foundationpress_after_content' ); ?>
    </div>

    <!-- END Ascometal content  -->

    <?php get_footer(); ?>