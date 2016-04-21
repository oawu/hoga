<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Look_cell extends Cell_Controller {

  /* render_cell ('look_cell', 'header', var1, ..); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header ($is_fix = false, $key = '') {
    return $this->load_view (array (
        'is_fix' => $is_fix,
        'key' => $key,
      ));
  }

  /* render_cell ('look_cell', 'banner', var1, ..); */
  // public function _cache_banner () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banner () {
    $banners = LookBanner::find ('all', array ('conditions' => array ('is_enabled = ?', Banner::IS_ENABLED)));

    return $this->load_view (array (
        'banners' => $banners
      ));
  }

  /* render_cell ('look_cell', 'block1', var1, ..); */
  // public function _cache_block1 () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function block1 () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'video', var1, ..); */
  // public function _cache_video () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function video () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'features', var1, ..); */
  // public function _cache_features () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function features () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'black2', var1, ..); */
  // public function _cache_black2 () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function block2 () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'block3', var1, ..); */
  // public function _cache_block3 () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function block3 () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'tab', var1, ..); */
  // public function _cache_tab () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function tab () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'products', var1, ..); */
  // public function _cache_products () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function products () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'press', var1, ..); */
  // public function _cache_press () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function press () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'more', var1, ..); */
  // public function _cache_more () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function more () {
    return $this->load_view ();
  }

  /* render_cell ('look_cell', 'footer', var1, ..); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer ($top = true) {
    return $this->load_view (array (
        'top' => $top
      ));
  }

  /* render_cell ('look_cell', 'up', var1, ..); */
  // public function _cache_up () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function up () {
    return $this->load_view ();
  }
}