
jQuery.noConflict();

jQuery('#ls-all').addClass('ls-current-li');
jQuery("#ls-filter-nav > li").click(function(){
    ls_show(this.id);
}).children().click(function(e) {
  return false;
});

jQuery("#ls-filter-nav > li > ul > li").click(function(){
    ls_show(this.id);
});

//In case you want all entries to hide when the page loads
//jQuery('.ls-05_project-5').hide();	
//To load a particular category
//jQuery('#ls-01-sales-team').click();
	


//FILTER CODE
function ls_show(category) {	 

	
	
	if (category == "ls-all") {
        jQuery('#ls-filter-nav > li').removeClass('ls-current-li');
        jQuery('#ls-all').addClass('ls-current-li');
        jQuery('.lshowcase-filter-active').show(800);
		}
	
	else {
		
		jQuery('#ls-filter-nav > li').removeClass('ls-current-li');
   		jQuery('#' + category).addClass('ls-current-li');  
		jQuery('.' + category).show(800);
		jQuery('.lshowcase-filter-active:not(.'+ category+')').hide(800);

	}
	
}


jQuery(document).ajaxSuccess(function() {
  
	jQuery('#ls-all').addClass('ls-current-li');
	jQuery("#ls-filter-nav > li").click(function(){
	    ls_show(this.id);
	}).children().click(function(e) {
	  return false;
	});

	jQuery("#ls-filter-nav > li > ul > li").click(function(){
	    ls_show(this.id);
	});
});