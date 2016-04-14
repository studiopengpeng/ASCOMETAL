        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
<div class="row">
    <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image-marches' ); ?>
                
<!--                Autres nbomsde classes selon les marchés : .automobile .roulement . petrol .corporate .mecanique (cf ascostyle.scss lignes 1593 -> 1625)-->
                <a href="#"><div class="every-market marches <?php $classColor; ?>"></div></a>
                <h1><?php echo __( '...A partner<br />to your success', 'foundationpress') ?></h1>
            </header>
    </article>
</div>
        <!--END header de page-->