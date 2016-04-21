/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  window.onhashchange = function () {
    if (window.location.hash)
      $('body').animate ({ scrollTop: $(window.location.hash + '_').offset ().top - 60 }, 'slow');
    return false;
  };
  if (window.location.hash)
    setTimeout (function () {
      $('body').animate ({ scrollTop: $(window.location.hash + '_').offset ().top - 60 }, 'slow');
    }, 500);
});