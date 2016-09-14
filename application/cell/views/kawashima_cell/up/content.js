/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $(window).scroll (function () {
    var t = $(this).scrollTop ();
    if (t > $(window).height ())
      $('#up').addClass ('s');
    else
      $('#up').removeClass ('s');
  });

  $('#up').click (function () {
    $('body').animate ({ scrollTop: 0 }, 'slow');
  });
});