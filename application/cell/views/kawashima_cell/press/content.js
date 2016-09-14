/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var $press = $('#press_');
  var $pressS = $('#_press');
  var $body = $('body');
  var _overflow = $body.css ('overflow');
  $press.imgLiquid ({verticalAlign: 'center'});

  function loadPresses (y) {
    $.ajax ({
      url: $('#presses_url').val (),
      data: { y: y },
      async: true, cache: false, dataType: 'json', type: 'GET',
      beforeSend: function () {}
    })
    .done (function (result) {
      if (!result.s) return;
      $press.find ('.y').empty ().html (result.y);
      $press.find ('.p').empty ().html (result.p);
    })
    .fail (function (result) {})
    .complete (function (result) {});
  }

  loadPresses (2016);
  $press.on ('click', '.y a', function () {
    loadPresses ($(this).text ());
  });

  $pressS.find ('.r a').click (function () {
    $pressS.removeClass ('s');
    $body.css ('overflow', _overflow);
  });
  $press.on ('click', '.p a', function () {
    $pressS.find ('img').attr ('src', $(this).data ('src'));
    $pressS.data ('id', $(this).data ('id')).addClass ('s');
    $body.css ('overflow', 'hidden');
  });

  $pressS.on ('click', '.l a', function () {
    $.ajax ({
      url: $('#presses_next_url').val (),
      data: { s: $(this).index (), id: $pressS.data ('id') },
      async: true, cache: false, dataType: 'json', type: 'GET',
      beforeSend: function () {}
    })
    .done (function (result) {
      if (!result.s) return;
      $pressS.find ('img').attr ('src', result.src);
      $pressS.data ('id', result.id);
    })
    .fail (function (result) {})
    .complete (function (result) {});
  });
});