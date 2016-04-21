<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Stores extends Look_controller {

  public function index () {
    $tags = LookStoreTag::all ();
    $this->add_js ('https://maps.googleapis.com/maps/api/js?key=AIzaSyCUS9MyDZ-EylKzjSe_nswgTnwDj2sMmTk&v=3.exp&language=zh-TW', false)->load_view (array (
        'tags' => $tags
      ));
  }
}
