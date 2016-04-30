/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var $banner = $('#banner_'), timer;

  $banner.find ('a:first-child').click (function () {
    var $first = $banner.find ('img').first ();
    $banner.find ('div').append ($first.clone ());
    $first.remove ();
    clearTimeout (timer);
    timer = setTimeout (function () {
      $banner.height ($banner.find ('img').eq (1).height ());
    }, 100);
  });
  $banner.find ('a:last-child').click (function () {
    var $last = $banner.find ('img').last ();
    $banner.find ('div').prepend ($last.clone ());
    $last.remove ();

    clearTimeout (timer);
    timer = setTimeout (function () {
      $banner.height ($banner.find ('img').eq (1).height ());
    }, 100);
  }).click ();
  
  setTimeout (function () {
    $banner.addClass ('transition');
  }, 500);

  setInterval (function () {
    $banner.find ('a:last-child').click ();
  }, 5000);

});