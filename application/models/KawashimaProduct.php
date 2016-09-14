<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class KawashimaProduct extends OaModel {

  static $table_name = 'kawashima_products';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );

  const NO_ENABLED = 0;
  const IS_ENABLED = 1;

  static $isIsEnabledNames = array(
    self::NO_ENABLED => '關閉',
    self::IS_ENABLED => '啟用',
  );
  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);

    OrmImageUploader::bind ('big', 'KawashimaProductBigImageUploader');
    OrmImageUploader::bind ('small', 'KawashimaProductSmallImageUploader');
  }
  public function destroy () {
    return $this->big->cleanAllFiles () && $this->small->cleanAllFiles () && $this->delete ();
  }
}