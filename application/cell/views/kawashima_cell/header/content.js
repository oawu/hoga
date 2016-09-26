/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $(window).scroll (function () {
    var t = $(this).scrollTop ();
    if (t > $(window).height () - 100)
      $('header').addClass ('f');
    else
      $('header').removeClass ('f');
  });
  window.onhashchange = function () {
    if (window.location.hash)
      $('body').animate ({ scrollTop: $(window.location.hash + '_').offset ().top - 100 }, 'slow');
    return false;
  };
    
  if (window.location.hash)
    setTimeout (function () {
      $('body').animate ({ scrollTop: $(window.location.hash + '_').offset ().top - 100 }, 'slow');
    }, 500);
});