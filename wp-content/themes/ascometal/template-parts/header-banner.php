        <!--header de page : contient le bandeau image + le titre de la rubrique principale-->
<div class="row">
    <article class="small-12 medium-12 large-12 columns">
            <header class="header-image">
                <?php get_template_part( 'template-parts/featured-image' ); ?>
                <a href="<?php global $linkUrlMarche; echo $linkUrlMarche; ?>"><div class="every-market <?php global $classColor; echo $classColor; ?>"></div></a>
                <h1><?php parent_page_title() ?></h1>
            </header>
    </article>
</div>
        <!--END header de page-->