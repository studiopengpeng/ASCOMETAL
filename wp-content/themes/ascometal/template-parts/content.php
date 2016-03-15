<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
    <div id="post-<?php the_ID(); ?>" <?php post_class( 'blogpost-entry'); ?>>
        <article class="ih-item">
            <header>
<!--                <p>Lien vers fichier parmettant l'affichage des derniers articles dans archive.php = <strong>template-parts/content.php</strong></p>-->
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_post_thumbnail('vignette_actu'); ?>

                    <?php foundationpress_entry_meta(); ?>
            </header>

            <div class="entry-content">
                <?php the_content( __( 'Voir +', 'foundationpress' ) ); ?>
            </div>
            <footer>
                <?php $tag = get_the_tags(); if ( $tag ) { ?>
                    <p>
                        <?php the_tags(); ?>
                    </p>
                    <?php } ?>
            </footer>
            </artile>
            <hr />
    </div>