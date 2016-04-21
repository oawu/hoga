<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Index_cell extends Cell_Controller {

  /* render_cell ('index_cell', 'banner', var1, ..); */
  // public function _cache_banner () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banner () {
    $banners = Banner::find ('all', array ('conditions' => array ('is_enabled = ?', Banner::IS_ENABLED)));
    return $this->load_view (array (
        'banners' => $banners
      ));
  }

  /* render_cell ('index_cell', 'main', var1, ..); */
  // public function _cache_main () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function main () {
    $anns = Ann::find ('all', array ('order' => 'id DESC', 'limit' => 5, 'conditions' => array ('is_enabled = ?', Ann::IS_ENABLED)));
    $brands = Brand::find ('all', array ('order' => 'id DESC', 'conditions' => array ('is_enabled = ?', Brand::IS_ENABLED)));
    return $this->load_view (array (
        'anns' => $anns,
        'brands' => $brands
      ));
  }

  /* render_cell ('index_cell', 'about', var1, ..); */
  // public function _cache_about () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function about () {
    return $this->load_view ();
  }

  /* render_cell ('index_cell', 'contact', var1, ..); */
  // public function _cache_contact () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function contact () {
    return $this->load_view ();
  }

  /* render_cell ('index_cell', 'header', var1, ..); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header ($is_index = true) {
    return $this->load_view (array (
        'is_index' => $is_index
      ));
  }

  /* render_cell ('index_cell', 'footer', var1, ..); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->load_view ();
  }

  /* render_cell ('index_cell', 'top', var1, ..); */
  // public function _cache_top () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function top () {
    return $this->load_view ();
  }
}