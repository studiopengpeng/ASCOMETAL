<?php
/**
 * Contenus des pages d'index de bloc / tuiles
 *
 * 
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// récupération des variables indiquant le contexte (marchés ou corporate)
// si corporate : il faut avoir les IDs des pages car pas une boucle WP mais boucle ds un tableau des pages (array du fichier corporate-index.php)
//global $classeRubrique;
global $contexte_blocs;
global $idBloc;
global $exception_couleur;

// préparation des variables à réutiliser dans la page
if ($contexte_blocs=="avecID") {
	$titre = types_render_field("titre-bloc", array("output"=>"raw", "post_id"=>$idBloc));
	$imgSrc = types_render_field( "image-bloc", array("alt"=>"", "output"=>"raw", "post_id"=>$idBloc));
	$description = types_render_field("description-bloc", array("output"=>"raw", "post_id"=>$idBloc));
} else {
	$titre = types_render_field("titre-bloc", array("output"=>"raw"));
	$imgSrc = types_render_field( "image-bloc", array("alt"=>"", "output"=>"raw"));
	$description = types_render_field("description-bloc", array("output"=>"raw"));
}

$classColorException="";
if ($exception_couleur==true) {$classColorException="contact";}
								 
?>

	<article class="rolling small-12 medium-6 large-3 columns end <?php echo $classColorException; ?>">

		<div class="ih-item square effect13 top_to_bottom">
			<a href="<?php the_permalink(); ?>">
				<h3 class="title-rolling"><?php echo $titre ?></h3>
				<div class="img">
					<img src="<?php	echo $imgSrc; ?>" alt="">
				</div>
				<div class="info rol">
					<h3><?php echo $titre; ?></h3>
					<p><?php echo $description;	?></p>
					<p class="seemore">voir+</p>
				</div>
			</a>
		</div>

	</article>