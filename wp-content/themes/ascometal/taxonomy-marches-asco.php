<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

    <div id="page" role="main">
        <article class="main-content">
            <?php if ( have_posts() ) : ?>
                <h1>Page taxonomie marchés</h1>
                <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/content', 'blocs' ); ?>
                            <?php endwhile; ?>

                                <?php else : ?>
                                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                                        <?php endif; // End have_posts() check. ?>

                                            <?php /* Display navigation to next/previous pages when applicable */ ?>


        </article>
        <?php get_sidebar(); ?>

    </div>

    <?php get_footer();