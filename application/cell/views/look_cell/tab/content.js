/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('#tab_ a').click (function () {
    $("#tab_ span").eq ($(this).index ()).addClass ('s').siblings ().removeClass ('s');
    $(this).addClass ('a').siblings ().removeClass ('a');
  }).eq (0).click ();
});