jQuery(document).ready(function () {
	var slideNavItems = jQuery('.custom-slideshow .item-bg');
	slideNavItems.each(function(k,v) {
		jQuery(v).parent().parent().parent().css('background-image','url('+jQuery(v).attr("title")+')');
	});

	jQuery('.custom-slideshow').mouseover(function() {
		jQuery('.custom-slideshow .active').addClass('hover', 500);
		jQuery('#views_slideshow_cycle_main_rotating_image_view-block').addClass('hover', 500);
	}).mouseout(function() {
		jQuery('.custom-slideshow .hover').removeClass('hover', 500);
	});

	jQuery('.pane-newslist ul li').not(':last-child').each(function(k,v) {
		jQuery(v).find('.news-list-next').html(jQuery(v).next().find('.news-list-right').html());
	});
});
