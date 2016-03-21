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
    <div class="ih-item article-preview" id="post-<?php the_ID(); ?>" <?php post_class( 'blogpost-entry'); ?>>
            <!--                <p>Lien vers fichier parmettant l'affichage des derniers articles dans archive.php = <strong>template-parts/content.php</strong></p>-->
            <div class= "thumb small-12 medium-3 large-3">
                <?php the_post_thumbnail('vignette_actu'); ?>
            </div>
            <div  class="infos small-12 medium-9 large-9">
            <?php foundationpress_entry_meta(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <div class="entry-content">
            <?php the_content( __( 'Voir +', 'foundationpress' ) ); ?>
        </div>
        </div>
        <footer>
            <?php $tag = get_the_tags(); if ( $tag ) { ?>
                <p>
                    <?php the_tags(); ?>
                </p>
                <?php } ?>
        </footer>
    </div>