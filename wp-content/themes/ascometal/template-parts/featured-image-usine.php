<?php
global $post;
	// If a feature image is set, get the id, so it can be injected as a css background property
	if ( has_post_thumbnail( $post->ID ) ) :
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$image = "background-image: url('".$image[0]."')";
	endif;
?>

	<header id="featured-hero" role="banner" style="<?php echo $image ?>">
		<div class="breadcrumbs" typeof="BreadcrumbList">
			<a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/breadcrumb-home-icon.png" class="bc_home_icon" width="24" height="21"> Accueil</a> > <a href="/ascometal-au-service-de-vos-performances/">Ascométal® au service de vos performances</a> > Outil industriel > <?php the_title() ?>
		</div>
	</header>