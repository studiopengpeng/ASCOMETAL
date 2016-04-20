<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// If a feature image is set, get the id, so it can be injected as a css background property
	if ( has_post_thumbnail( $post->ID ) ) :
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'vignette_actu' );
		$image = $image[0];
    else :
        $image = get_stylesheet_directory_uri()."/assets/images/news-defaut.png";
    endif;
?>
    <div class="ih-item article-preview" id="post-<?php the_ID(); ?>" <?php post_class( 'blogpost-entry'); ?>>
        <!--                <p>boucle vers fichier parmettant l'affichage des derniers articles dans archive.php = <strong>template-parts/content.php</strong></p>-->
        <div class="thumb small-12 medium-3 large-3">
            <div style="background-image: url('<?php echo $image ?>')">
            </div>
        </div>
            <div class="infos small-12 medium-9 large-9">
                <?php foundationpress_entry_meta(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                    <div class="entry-content">
                        <?php 
                        $more_link_text = __( 'More...', 'foundationpress') ;
                        echo get_the_content( $more_link_text ); ?>
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