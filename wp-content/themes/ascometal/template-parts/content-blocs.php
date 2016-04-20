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
$lien="";
$permalien ="";
if ($contexte_blocs=="avecID") {
	$titre = types_render_field("titre-bloc", array("output"=>"raw", "post_id"=>$idBloc));
	$imgSrc = types_render_field( "image-bloc", array("alt"=>"", "output"=>"raw", "post_id"=>$idBloc));
	$description = types_render_field("description-bloc", array("output"=>"raw", "post_id"=>$idBloc));
	$lien = types_render_field("lien-bloc", array("output"=>"raw", "post_id"=>$idBloc));
    $permalien = get_the_permalink($idBloc);
} else {
	$titre = types_render_field("titre-bloc", array("output"=>"raw"));
	$imgSrc = types_render_field( "image-bloc", array("alt"=>"", "output"=>"raw"));
	$description = types_render_field("description-bloc", array("output"=>"raw"));
	$lien = types_render_field("lien-bloc", array("output"=>"raw"));
    $permalien = get_the_permalink();
}

$classColorException="";
if ($exception_couleur==true) {$classColorException="contact";}
								 
?>

	<article class="rolling small-12 medium-6 large-3 columns end <?php echo $classColorException; ?>">

		<div class="ih-item square effect13 top_to_bottom">
			<a href="<?php if (strlen($lien)>3) {echo $lien;} else {echo $permalien;} ?>">
				<h3 class="title-rolling"><?php echo $titre ?></h3>
				<div class="img">
					<img src="<?php	echo $imgSrc; ?>" alt="">
				</div>
				<div class="info rol">
					<h3 class="title-rolled"><?php echo $titre; ?></h3>
					<p><?php echo $description;	?></p>
					<p class="seemore"><?php echo __("More...", "foundationpress") ?></p>
				</div>
			</a>
		</div>

	</article>