(function($, document) {
  $('.system-nav a').tooltip({
    placement: 'bottom'
  });

  $('.revision-accept, .revision-deny').tooltip({
    placement: 'right'
  });

  $(document).popover({
    selector: ".has-note",
    placement: "top",
    trigger: "focus",
    animation: false
  });
})(jQuery, document);