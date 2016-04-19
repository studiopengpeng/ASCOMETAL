<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

		</section>
		<!--ascenseur-->
        <div class="lift"></div>
		<div id="footer-container">
			<footer id="footer" class="row">
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php do_action( 'foundationpress_after_footer' ); ?>
				
				<!--menu secondaire : Menu gauche -> page.php-->
                    <?php
$args_menu1 = array(
'theme_location'  => '',
'menu'            => '39',
'container'       => 'nav',
'container_class' => 'small-12 medium-10 large-10 columns',
'container_id'    => 'footernav',
'menu_class'      => 'menu-footer',
'menu_id'         => '',
'echo'            => true,
'fallback_cb'     => 'false',
'before'          => '',
'after'           => '',
'link_before'     => '',
'link_after'      => '',
'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
'depth'           => 0,
'walker'          => ''
);
wp_nav_menu( $args_menu1 );
?>
                <!--END menu secondaire-->
                <nav class="social small-12 medium-2 large-2 columns">
                    <ul>
                       <li><a href="https://www.facebook.com/pages/Ascometal/117989414924769?fref=ts" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/facebook.svg" alt="facebook"></a></li>
                        <li><a href="https://www.linkedin.com/company/ascometal" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/linkedin.svg" alt="linkedin"></a></li>
                    </ul>
                </nav>
			</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</div>
<!--live reload-->
<script type='text/javascript' id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.11.1.js'><\/script>".replace("HOST", location.hostname));
//]]></script>

<!--Toggle sur le champs de recherche-->
<script>
$( "li.searchbtn" ).click(function() {
  $( ".offsearch" ).toggleClass( "onsearch" );
});
</script>

<!--Toggle sur le champs d'appel-->
<script>
$( "li.callbtn" ).click(function() {
  $( ".offcall" ).toggleClass( "oncall" );
});
</script>

<!--Add & remove class sur les icônes nouveaux produits de la page single-produits-ascometal.php-->
<script>
$(document).ready(function(){
    $(".features").mouseover(function(){
        $(".features-alert").removeClass("hide");
        $(".features-alert").addClass("show");
        $(".advantage-alert").removeClass("show");
        $(".advantage-alert").addClass("hide");
        $(".benefits-alert").removeClass("show");
        $(".benefits-alert").addClass("hide");
    });
    $(".advantage").mouseover(function(){
        $(".advantage-alert").removeClass("hide");
        $(".advantage-alert").addClass("show");
        $(".features-alert").removeClass("show");
        $(".features-alert").addClass("hide");
        $(".benefits-alert").removeClass("show");
        $(".benefits-alert").addClass("hide");
    });
    $(".benefits").mouseover(function(){
        $(".benefits-alert").removeClass("hide");
        $(".benefits-alert").addClass("show");
        $(".features-alert").removeClass("show");
        $(".features-alert").addClass("hide");
        $(".advantage-alert").removeClass("show");
        $(".advantage-alert").addClass("hide");
    });
});
</script>

<!--Carousel homepage only -->
<?php if (is_home() || is_front_page()) { ?>
<script type='text/javascript'>
jQuery(document).ready(function(){
  jQuery(".owl-carousel").owlCarousel(
  {
   loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        }
    },
   navText: ["&lt;", "&gt;"]
  });
});
</script>
<?php } ?>

<!-- cache la boite de coordonnées sur les cartes -->
<script>
$(document).ready(function(){
    
     $("#close-imapmessage").click(function(){
         
        $("#imap1message").addClass("hide");
         
    });
});

</script>

<!-- Active l'apparition de la fleche "retours en haut" au scroll -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.lift').append('<a href="#top" class="top_link"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/up.svg" alt="remonter"</a>');

        $(window).scroll(function () {
            posScroll = $(document).scrollTop();
            if (posScroll >= 200)
                $('.top_link').fadeIn(600);
            else
                $('.top_link').fadeOut(600);
        });

    });
</script>

</body>
</html>
