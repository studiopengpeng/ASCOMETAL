<?php 
global $post;
global $nomMarche;
global $contexteType;
global $linkUrlMarche;
global $linkUrlMarcheSingle;
global $nomMarcheUrl;
?>
<header id="featured-hero" role="banner" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bgi-nouveaux-produits.jpg');">
		<div class="breadcrumbs" typeof="BreadcrumbList">
			<a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/breadcrumb-home-icon.png" class="bc_home_icon" width="24" height="21"> <?php echo __( 'Home', 'foundationpress'); ?></a> > <a href="<?php echo $linkUrlMarcheSingle; echo __($nomMarcheUrl, "foundationpress") ?>"><?php echo __($nomMarche, "foundationpress"); ?></a> > <a href="/ascometal/produits-ascometal/">Produits</a> > <?php the_title() ?>
            
            
            
		</div>
	</header>
	




