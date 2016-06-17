        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
<div class="row">
    <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image-recrutement' ); ?>
                
                <?php 
                global $classColor; global $linkUrlMarche; 
                ?>
                <a href="<?php echo get_stylesheet_directory_uri(); ?>?p=2099"><div class="every-market corporate"></div></a>
                <h1><?php echo __( 'Ascometal recruits', 'foundationpress') ?></h1>
            </header>
    </article>
</div>
        <!--END header de page-->