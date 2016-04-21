<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class User extends OaModel {

  static $table_name = 'users';

  static $has_one = array (
  );

  static $has_many = array (
  );

  static $belongs_to = array (
  );
  private static $current = '';

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }

  public static function current () {
    if (self::$current !== '') return self::$current;
    return self::$current = ($id = Session::getData ('user_id')) ? User::find_by_id ($id) : null;
  }

  public function avatar ($w = 100, $h = 100) {
    $size = array ();
    array_push ($size, isset ($w) && $w ? 'width=' . $w : '');
    array_push ($size, isset ($h) && $h ? 'height=' . $h : '');

    return 'https://graph.facebook.com/' . $this->uid . '/picture' . (($size = implode ('&', array_filter ($size))) ? '?' . $size : '');
  }
  public function facebook_link () {
    if (!isset ($this->uid)) return '';
    return 'https://www.facebook.com/' . $this->uid;
  }
}