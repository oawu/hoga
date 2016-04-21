/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  $('#fm a').click (function () {
    $(this).addClass ('a').siblings ().removeClass ('a');
    $('<input />', { name: 'year', type: 'hidden' }).val ($('#fm #year a.a').data ('val')).appendTo ($('#fm'));
    $('<input />', { name: 'brand_id', type: 'hidden' }).val ($('#fm #brand a.a').data ('val')).appendTo ($('#fm'));
    $('#fm').submit ();
  });
});