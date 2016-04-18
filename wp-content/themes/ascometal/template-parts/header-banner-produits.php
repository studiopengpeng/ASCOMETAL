        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
<div class="row">
    <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image-produits' ); ?>
                
                <?php 
                global $classColor; global $linkUrlMarche; 
                if (isset($classColor) and strlen($classColor)>3) {?>
                <a href="<?php echo $linkUrlMarche; ?>"><div class="every-market <?php echo $classColor; ?>"></div></a>
                <?php } ?>
                <h1><?php echo __( '...A partner<br />to your success', 'foundationpress') ?></h1>
            </header>
    </article>
</div>
        <!--END header de page-->