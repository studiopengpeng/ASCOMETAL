
jQuery.noConflict();
	
	jQuery('#ls-all').addClass('ls-current-li');
	jQuery("#ls-enhance-filter-nav > li").click(function(){
	    ls_show_enhance(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ls-enhance-filter-nav > li > ul > li").click(function(){
	    ls_show_enhance(this.id);
	});


//FILTER CODE
function ls_show_enhance(category) {	

	if (category == "ls-all") {
        jQuery('#ls-enhance-filter-nav > li').removeClass('ls-current-li');
        jQuery('#ls-all').addClass('ls-current-li');
        jQuery('.lshowcase-filter-active').addClass('ls-current').removeClass('ls-not-current');
		}
	
	else {
		jQuery('#ls-enhance-filter-nav > li').removeClass('ls-current-li');
   		jQuery('#' + category).addClass('ls-current-li');  
		jQuery('.' + category).addClass('ls-current').removeClass('ls-not-current'); 
		jQuery('.lshowcase-filter-active:not(.'+ category+')').addClass('ls-not-current').removeClass('ls-current');
	}
	
}



jQuery(document).ajaxSuccess(function() {
	jQuery('#ls-all').addClass('ls-current-li');
	jQuery("#ls-enhance-filter-nav > li").click(function(){
	    ls_show_enhance(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ls-enhance-filter-nav > li > ul > li").click(function(){
	    ls_show_enhance(this.id);
	});
});