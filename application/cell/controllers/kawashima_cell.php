<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Kawashima_cell extends Cell_Controller {

  /* render_cell ('kawashima_cell', 'banner', var1, ..); */
  // public function _cache_banner () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banner () {
    $banners = KawashimaBanner::find ('all', array ('conditions' => array ('is_enabled = ?', Banner::IS_ENABLED)));

    return $this->load_view (array (
        'banners' => $banners
      ));
  }

  /* render_cell ('kawashima_cell', 'header', var1, ..); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header ($is_fix = false, $key = '') {
    return $this->load_view (array (
        'is_fix' => $is_fix,
        'key' => $key,
      ));
  }

  /* render_cell ('kawashima_cell', 'abouts', var1, ..); */
  // public function _cache_abouts () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function abouts () {
    return $this->load_view ();
  }

  /* render_cell ('kawashima_cell', 'products', var1, ..); */
  // public function _cache_products () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function products () {
    return $this->load_view ();
  }

  /* render_cell ('kawashima_cell', 'stores', var1, ..); */
  // public function _cache_stores () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function stores () {
    return $this->load_view ();
  }

  /* render_cell ('kawashima_cell', 'footer', var1, ..); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer ($top = true) {
    return $this->load_view (array (
        'top' => $top
      ));
  }

  /* render_cell ('kawashima_cell', 'up', var1, ..); */
  // public function _cache_up () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function up () {
    return $this->load_view ();
  }

  /* render_cell ('kawashima_cell', 'press', var1, ..); */
  // public function _cache_press () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function press () {
    return $this->load_view ();
  }



















}