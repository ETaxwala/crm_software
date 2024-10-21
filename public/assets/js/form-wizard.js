(function($) {
  'use strict';

  $("#default-wizard").steps({
    headerTag: "h3",
    bodyTag: "div",
    autoFocus: true,
    titleTemplate: '#title#',
    labels: {
      current: "",
      finish: 'Submit',
      previous: 'Back'
    },
    onFinished: function(event, currentIndex) {
      alert("Form Submitted Successfully!");
    }
  });

})(jQuery);
