(function ($) {
var is_visible = false;
 
$(".agenda-bullet-list").attr("href", "#");

$('.agenda-item').hide(); 

$('a.agenda-bullet-list').click(function() {

$(this).next('.agenda-item').toggle();
$(this).toggleClass('open')

return false;
 
});
}(jQuery));
