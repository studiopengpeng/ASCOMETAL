<!-- menu / outil industriel -->
<div id="menu-usines">
    <div id="filet1" class="mu-filets">Les Dunes <span style="font-size:70%">(Dunkerque)</span></div>
    <div id="filet2" class="mu-filets">Hagondange</div>
    <div id="filet3" class="mu-filets">Custines</div>
    <div id="filet4" class="mu-filets">Le Marais <span style="font-size:70%">(St Etienne)</span></div>
    <div id="filet5" class="mu-filets">Fos-sur-Mer</div>
    
    <div id="filet1-svg"><img class="svgmod" id="filet1-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu-usines/filet-1.svg" /></div>
    <div id="filet2-svg"><img class="svgmod" id="filet2-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu-usines/filet-2.svg" /></div>
    <div id="filet3-svg"><img class="svgmod" id="filet3-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu-usines/filet-3.svg" /></div>
    <div id="filet4-svg"><img class="svgmod" id="filet4-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu-usines/filet-4.svg" /></div>
    <div id="filet5-svg"><img class="svgmod" id="filet5-img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/menu-usines/filet-5.svg" /></div>
    
    <div id="filet1-map" class="filets-map"></div>
    <div id="filet2-map" class="filets-map"></div>
    <div id="filet3-map" class="filets-map"></div>
    <div id="filet4-map" class="filets-map"></div>
    <div id="filet5-map" class="filets-map"></div>
    
    <div id="mu-bg-carte"></div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        
        // svg comme code source inclus ds la page -> svg manipulable par css
       // $('.svgmod').each(function() {
            $('img[src$=".svg"]').each(function() {
                var $img = jQuery(this);
                var imgURL = $img.attr('src');
                var attributes = $img.prop("attributes");
                if ($(this).hasClass( "svgmod" )) {
                    
                    $.get(imgURL, function(data) {
                        var $svg = jQuery(data).find('svg');
                        $svg = $svg.removeAttr('xmlns:a');
                        $.each(attributes, function() {
                            $svg.attr(this.name, this.value);
                        });
                        $img.replaceWith($svg);
                    }, 'xml');
                    
                }
            });
       // }
        // fonctions survol/out
        function filethover(idfilet){
            $('#filet'+idfilet).addClass("active");
            var actuClass=$('#filet'+idfilet+'-img').attr('class');
            if (actuClass!="forcedactive") {
                $('#filet'+idfilet+'-img').find("path").css({fill:'#e52713', transition:'all .5s'});
                $('#filet'+idfilet+'-img').find("polyline").css({stroke:'#e52713', transition:'all .5s'});
            }
        }
        function filetout(idfilet){
            $('#filet'+idfilet).removeClass("active");
            var actuClass=$('#filet'+idfilet+'-img').attr('class');
            if (actuClass!="forcedactive") {
                $('#filet'+idfilet+'-img').find("path").css({fill:'#8F9198', transition:'all .5s'});
                $('#filet'+idfilet+'-img').find("polyline").css('stroke', '#1C1C1B');
            }
        }
        function filetactive(idfilet){
            $('#filet'+idfilet).addClass("forcedactive");
            $('#filet'+idfilet+'-img').addClass("forcedactive");
        }
        // vars / ids selon langue
        var idActuUsine=<?php echo get_the_id(); ?>;
        
        //var idUsine1="2559";
        var idUsine1="<?php echo icl_object_id('2559', 'usine', false, $curr_lang); ?>";
        var idUsine2="<?php echo icl_object_id('2566', 'usine', false, $curr_lang); ?>";
        var idUsine3="<?php echo icl_object_id('2571', 'usine', false, $curr_lang); ?>";
        var idUsine4="<?php echo icl_object_id('2576', 'usine', false, $curr_lang); ?>";
        var idUsine5="<?php echo icl_object_id('2581', 'usine', false, $curr_lang); ?>";
        var urlUsine1="<?php echo get_permalink(icl_object_id(2559,get_post_type(),false,ICL_LANGUAGE_CODE))?>";
        var urlUsine2="<?php echo get_permalink(icl_object_id(2566,get_post_type(),false,ICL_LANGUAGE_CODE))?>";
        var urlUsine3="<?php echo get_permalink(icl_object_id(2571,get_post_type(),false,ICL_LANGUAGE_CODE))?>";
        var urlUsine4="<?php echo get_permalink(icl_object_id(2576,get_post_type(),false,ICL_LANGUAGE_CODE))?>";
        var urlUsine5="<?php echo get_permalink(icl_object_id(2581,get_post_type(),false,ICL_LANGUAGE_CODE))?>";
        // interactions
        $("#filet1").add("#filet1-map").mouseover(function(){filethover(1);});
        $("#filet1").add("#filet1-map").mouseout(function(){filetout(1);});
        $("#filet2").add("#filet2-map").mouseover(function(){filethover(2);});
        $("#filet2").add("#filet2-map").mouseout(function(){filetout(2);});
        $("#filet3").add("#filet3-map").mouseover(function(){filethover(3);});
        $("#filet3").add("#filet3-map").mouseout(function(){filetout(3);});
        $("#filet4").add("#filet4-map").mouseover(function(){filethover(4);});
        $("#filet4").add("#filet4-map").mouseout(function(){filetout(4);});
        $("#filet5").add("#filet5-map").mouseover(function(){filethover(5);});
        $("#filet5").add("#filet5-map").mouseout(function(){filetout(5);});
        // liens
         $("#filet1").add("#filet1-map").click(function(){location.href = urlUsine1;});
         $("#filet2").add("#filet2-map").click(function(){location.href = urlUsine2;});
         $("#filet3").add("#filet3-map").click(function(){location.href = urlUsine3;});
         $("#filet4").add("#filet4-map").click(function(){location.href = urlUsine4;});
         $("#filet5").add("#filet5-map").click(function(){location.href = urlUsine5;});
        // surbrillance à l'arrivée
        if (idActuUsine == idUsine1) filetactive(1);
        if (idActuUsine == idUsine2) filetactive(2);
        if (idActuUsine == idUsine3) filetactive(3);
        if (idActuUsine == idUsine4) filetactive(4);
        if (idActuUsine == idUsine5) filetactive(5);
        
    });

</script>