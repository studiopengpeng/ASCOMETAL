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

        <article class="row">
            <div class="small-12 medium-12 large-12 columns" <?php post_class( 'main-content') ?> id="post-
                <?php the_ID(); ?>">
                    <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
                        <article class="rolling small-12 medium-6 large-3 columns">

                            <div class="ih-item square effect13 top_to_bottom">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="title-rolling"><?php echo types_render_field("titre-bloc", array("output"=>"raw")); ?></h3>
                                    <div class="img">
                                        <?php //the_post_thumbnail('large'); ?>
                                         <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/auto.jpg" alt="automobile Ascometal">
                                    </div>
                                    <div class="info rol">
                                        <h3><?php echo types_render_field("titre-bloc", array("output"=>"raw")); ?></h3>
                                        <p><?php echo types_render_field("description-bloc", array("output"=>"raw")); ?></p>
                                        <p class="seemore">voir+</p>
                                    </div>
                                </a>
                            </div>

                        </article>
            </div>
        </article>
    </div>
    
   
  
 


