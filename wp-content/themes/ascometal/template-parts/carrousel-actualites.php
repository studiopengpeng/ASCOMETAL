<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/actu.png" alt="">

<h3>Actualités</h3>
<div class="owl-carousel">
<?php
    
    $args = array(
    'numberposts' => 5,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
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
    <div class='date'><?php echo get_the_date(); ?></div>
    <div class='title'><?php echo __($recent["post_title"]); ?></div>
    <div class='texte'><?php echo tronk(__($recent["post_content"]), 100, "..."); ?></div>
    </div>
    
    <?php
	}
?>
    
    
    
</div>
