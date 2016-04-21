/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('#about_ a').click (function () {
    $(this).addClass ('a').siblings ().removeClass ('a');
    $('#about_ .c > div').hide ().eq ($(this).index ()).show ();
  });
});