<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Route::root ('main');

Route::get ('/login', 'platform@login');
Route::get ('/sign_out', 'platform@sign_out');
Route::get ('/platform/index', 'platform@login');
Route::get ('/platform', 'platform@login');

Route::resourcePagination (array ('anns'), 'anns');
Route::get ('/ann/(:id)', 'anns@show($1)');

Route::group ('admin', function () {
  Route::get ('/', 'main');
  Route::resourcePagination_is_enabled (array ('users'), 'users');
  Route::resourcePagination_is_enabled (array ('brands'), 'brands');
  Route::resourcePagination_is_enabled (array ('anns'), 'anns');
  Route::resourcePagination_is_enabled (array ('banners'), 'banners');
  Route::resourcePagination_is_enabled (array ('look_banners'), 'look_banners');
  Route::resourcePagination_is_enabled (array ('look_products'), 'look_products');
  Route::resourcePagination_is_enabled (array ('look_presses'), 'look_presses');
  Route::resourcePagination_is_enabled (array ('look_store_tags'), 'look_store_tags');
  Route::resourcePagination_is_enabled (array ('look_stores'), 'look_stores');
});

Route::group ('look', function () {
  Route::get ('/', 'main');
  Route::get ('/abouts/1', 'abouts@index(1)');
  Route::get ('/abouts/', 'abouts@index(1)');
  Route::get ('/abouts/2', 'abouts@index(2)');
});
