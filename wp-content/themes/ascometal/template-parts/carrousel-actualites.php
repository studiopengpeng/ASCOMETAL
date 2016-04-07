<div class="ih-item actus-home">
<h4>Actualités</h3>
<div class="owl-carousel">
<?php
    
    $args = array(
    'numberposts' => 5,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true );

	$recent_posts = wp_get_recent_posts( $args );
    
	foreach( $recent_posts as $recent ){
//        print_r ($recent);
//		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   ( __($recent["post_title"])).'</a> </li> ';
        
    ?>
    <div class="item">
    <div class='thumb'><?php echo get_the_post_thumbnail($recent["ID"], 'vignette_actu' ); ?></div> 
    <div class='date'><?php echo get_the_time(get_option('date_format'), $recent["ID"]); ?></div>
    <div class='title'><?php echo __($recent["post_title"]); ?></div>
    <div class='texte'><?php echo tronk(__($recent["post_content"]), 250, "..."); ?></div>
    <div class='readmore'><a href="<?php echo get_the_permalink($recent["ID"]); ?>"><?php _e("Continue reading...", "foundationpress") ?></a></div>
    </div>
    
    <?php
	}
?>
    
</div>
</div>