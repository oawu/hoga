/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var $container = $('#container');
  var overflow = $('body').css ('overflow');
  var navTimer = null;
  var $nav = $('nav');
  
  $nav.find ('.l').click (function () {
    if ($container.hasClass ('show')) {
      $container.removeClass ('show');
      $('body').css ('overflow', overflow);
    } else {
      $container.addClass ('show');
      $('body').css ('overflow', 'hidden');
    }
  });
  $nav.find ('.r').click (function () {
    $(this).toggleClass ('show');
  });

  var $tab = $('._t');
  $(window).scroll (function () {
    var t = $(this).scrollTop ();
    var l = $(this).get (0).l ? $(this).get (0).l : 0;
    if (t < 60 || t < l) {
      if ($tab.hasClass ('h'))
        $tab.removeClass ('h');
      if ($nav.hasClass ('h'))
        $nav.removeClass ('h');
    } else {
      if (!$tab.hasClass ('h'))
        $tab.addClass('h');
      if (!$nav.hasClass ('h'))
        $nav.addClass('h');
    }
    $(this).get (0).l = t;
  });
});