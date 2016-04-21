/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$(function () {
  var $product = $('#product_');
  var $productS = $('#_product');
  var $body = $('body');
  var _overflow = $body.css ('overflow');

  function loadProducts (p) {
    $.ajax ({
      url: $('#products_url').val (),
      data: { p: p },
      async: true, cache: false, dataType: 'json', type: 'GET',
      beforeSend: function () {}
    })
    .done (function (result) {
      if (!result.s) return;
      $product.find ('.d > div').empty ().html (result.d);
      $product.find ('.p').empty ().html (result.p);
    })
    .fail (function (result) {})
    .complete (function (result) {});
  }

  loadProducts (0);
  $product.on ('click', '.d a', function () {
    loadProducts ($(this).index ());
  });
  $productS.find ('.r a').click (function () {
    $productS.removeClass ('s');
    $body.css ('overflow', _overflow);
  });
  $product.on ('click', '.p a', function () {
    $productS.find ('img').attr ('src', $(this).data ('src'));
    $productS.data ('id', $(this).data ('id')).addClass ('s');
    $body.css ('overflow', 'hidden');
  });

  $productS.on ('click', '.l a', function () {
    $.ajax ({
      url: $('#products_next_url').val (),
      data: { s: $(this).index (), id: $productS.data ('id') },
      async: true, cache: false, dataType: 'json', type: 'GET',
      beforeSend: function () {}
    })
    .done (function (result) {
      if (!result.s) return;
      $productS.find ('img').attr ('src', result.src);
      $productS.data ('id', result.id);
    })
    .fail (function (result) {})
    .complete (function (result) {});
  });
});