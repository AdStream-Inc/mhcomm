(function($) {
  $('.system-nav a').tooltip({
    placement: 'bottom'
  })
})(jQuery);

$(document).popover({
	selector: ".has-note",
	placement: "top",
	trigger: "focus",
	animation: false
});