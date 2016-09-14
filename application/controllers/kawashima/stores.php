<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Stores extends Kawashima_controller {

  public function index () {
    $tags = KawashimaStoreTag::all ();
    $this->load_view (array (
        'tags' => $tags
      ));
  }
}
