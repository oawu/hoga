<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Ann extends OaModel {

  static $table_name = 'anns';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
    array ('brand', 'class_name' => 'Brand')
  );

  const NO_ENABLED = 0;
  const IS_ENABLED = 1;

  static $isIsEnabledNames = array(
    self::NO_ENABLED => '關閉',
    self::IS_ENABLED => '啟用',
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
  public function mini_title ($length = 25) {
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->title), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->title);
  }
  public function mini_content ($length = 100) {
    return $length ? mb_strimwidth (remove_ckedit_tag ($this->content), 0, $length, '…','UTF-8') : remove_ckedit_tag ($this->content);
  }
  public function destroy () {
    return $this->delete ();
  }
}