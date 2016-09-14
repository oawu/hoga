<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Abouts extends Kawashima_controller {

  public function index ($index = 1) {
    $this->set_method ($index)->load_view ();
  }
}
