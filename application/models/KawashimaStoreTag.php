<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class KawashimaStoreTag extends OaModel {

  static $table_name = 'kawashima_store_tags';

  static $has_one = array (
  );

  static $has_many = array (
    array ('stores', 'class_name' => 'KawashimaStore', 'conditions' => array ('is_enabled = ?', KawashimaStore::IS_ENABLED))
  );

  static $belongs_to = array (
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function destroy () {
    foreach ($stores as $store)
      return $store->destroy ();

    return $this->delete ();
  }
}