(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {
    //Funcionalidad scroll ToTop
    $(window).scroll(function() {
      if ($(this).scrollTop() > 120)
      $('.gototop').fadeIn();
      else
      $('.gototop').fadeOut();
    });

    $('.gototop').click(function(e) {
      e.preventDefault();
      $("html, body").stop().animate({scrollTop: 0}, "slow");
    });

	});
})(jQuery, window, document);
