<?php
/**
 * Template part for off canvas menu
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
if (ICL_LANGUAGE_CODE=="en") {
$linkAuto="/en/marches-asco/automotive/";
$linkRoul="/en/marches-asco/bearing/";
$linkMec="/en/marches-asco/mechanical/";
$linkPet="/en/marches-asco/oil-gaz/";
    
} else {
$linkAuto="/marches-asco/automobile/";
$linkRoul="/marches-asco/roulement/";
$linkMec="/marches-asco/mecanique/";
$linkPet="/marches-asco/petrolegaz/";
}

?>

 <section id="markets">
                                        <!-- Automobile -->
                                        <article class="auto small-12 medium-6 large-3 columns">
                                            <div class="ih-item square effect13 top_to_bottom">
                                                <a href="<?php echo $linkAuto; ?>">
                                                    <h3 class="title-auto"><?php echo __( 'Automotive', 'foundationpress') ?></h3>
                                                    <div class="img">
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto.jpg" alt="automobile Ascometal">
                                                    </div>
                                                    <div class="info aut">
                                                        <h3><?php echo __( 'Automotive', 'foundationpress') ?></h3>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto.svg" alt="automobile Ascometal">
                                                        <p><?php echo __( 'A perfect understanding of the technical and economic challenges...', 'foundationpress') ?></p>
                                                        <p class="seemore"><?php echo __("Continue reading...", "foundationpress") ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </article>
                                        <!-- END automobile -->
                                        <!-- Roulement -->
                                        <article class="rolling small-12 medium-6 large-3 columns">

                                            <div class="ih-item square effect13 top_to_bottom">
                                                <a href="<?php echo $linkRoul; ?>">
                                                    <h3 class="title-rolling"><?php echo __( 'Bearings', 'foundationpress') ?></h3>
                                                    <div class="img">
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rolling.jpg" alt="roulement en acier Ascometal">
                                                    </div>
                                                    <div class="info rol">
                                                        <h3><?php echo __( 'Bearings', 'foundationpress') ?></h3>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rolling.svg" alt="roulement en acier Ascometal">
                                                        <p><?php echo __( "A long-term partnership with the world's bearing manufacturers...", 'foundationpress') ?>
                                                        </p>
                                                        <p class="seemore"><?php echo __("Continue reading...", "foundationpress") ?></p>
                                                    </div>
                                                </a>
                                            </div>

                                        </article>
                                        <!-- END roulement -->
                                        <!-- Méchanique -->
                                        <article class="mechanical small-12 medium-6 large-3 columns">

                                            <div class="ih-item square effect13 top_to_bottom">
                                                <a href="<?php echo $linkMec; ?>">
                                                    <h3 class="title-mechanical"><?php echo __( 'Mechanical engineering', 'foundationpress') ?></h3>
                                                    <div class="img">
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mechanical.jpg" alt="engrenage mécanique d'Ascometal">
                                                    </div>
                                                    <div class="info mec">
                                                        <h3><?php echo __( 'Mechanical engineering', 'foundationpress') ?></h3>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/mechanical.svg" alt="engrenage mécanique d'Ascometal">
                                                        <p><?php echo __( 'High level technical assistance for innovative solutions...', 'foundationpress') ?>
                                                        </p>
                                                        <p class="seemore"><?php echo __("Continue reading...", "foundationpress") ?></p>
                                                    </div>
                                                </a>
                                            </div>

                                        </article>
                                        <!-- END méchanique -->
                                        <!-- Pétrole -->
                                        <article class="petrol small-12 medium-6 large-3 columns">
                                            <div class="ih-item square effect13 top_to_bottom">
                                                <a href="<?php echo $linkPet; ?>">
                                                    <h3 class="title-petrol"><?php echo __( 'Oil / Gas', 'foundationpress') ?></h3>
                                                    <div class="img">
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/petrol.jpg" alt="plateforme pétrolière d'Ascometal">
                                                    </div>
                                                    <div class="info pet">
                                                        <h3><?php echo __( 'Oil / Gas', 'foundationpress') ?></h3>
                                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/petrol.svg" alt="plateforme pétrolière d'Ascometal">
                                                        <p><?php echo __( 'A world-renowned player in drilling and extraction...', 'foundationpress') ?></p>
                                                        <p class="seemore"><?php echo __("Continue reading...", "foundationpress") ?></p>
                                                    </div>
                                                </a>
                                            </div>

                                        </article>
                                        <!-- END pétrole -->
                                    </section>