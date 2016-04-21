<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class main extends Look_controller {

  public function products () {
    $offset = ($offset = OAInput::get ('p')) ? $offset : 0;
    $limit = 8;
    $total = LookProduct::count (array ('conditions' => array ('is_enabled = ?', LookProduct::IS_ENABLED)));
    $ps = ceil ($total / $limit);
    $d = '';
    for ($i = 0; $i < $ps; $i++) $d .= '<a' . ($i == $offset ? ' class="a"' : '') . '></a>';

    $products = LookProduct::find ('all', array ('limit' => $limit, 'offset' => $offset, 'order' => 'id DESC', 'conditions' => array ('is_enabled = ?', LookProduct::IS_ENABLED)));

    return $this->output_json (array ('s' => true, 'd' => $d, 'p' => $this->load_content (array (
        'products' => $products
      ), true)));
  }
  public function products_next () {
    $s = is_numeric ($s = OAInput::get ('s')) ? $s : 1;
    $id = is_numeric ($id = OAInput::get ('id')) ? $id : 0;

    if (!(in_array ($s, array (0, 1)) && ($id && ($product = LookProduct::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, LookProduct::IS_ENABLED)))))))
      return $this->output_json (array ('s' => false));

    if ($s) $product = LookProduct::find ('one', array ('order' => 'id DESC', 'conditions' => array ('id < ? AND is_enabled = ?', $id, LookProduct::IS_ENABLED)));
    else $product = LookProduct::find ('one', array ('order' => 'id ASC', 'conditions' => array ('id > ? AND is_enabled = ?', $id, LookProduct::IS_ENABLED)));

    if (!$product) $product = LookProduct::find ('one', array ('order' => $s ? 'id DESC' : 'id ASC', 'conditions' => array ('id != ? AND is_enabled = ?', $id, LookProduct::IS_ENABLED)));
    if (!$product) return $this->output_json (array ('s' => false));

    return $this->output_json (array ('s' => true, 'id' => $product->id, 'src' => $product->big->url ()));
  }
  public function presses () {
    $year = ($year = OAInput::get ('y')) ? $year : 0;
    $limit = 4;
    $y = implode ('', array_map (function ($y) use ($year) {
      return '<a' . ($y == $year ? ' class="a"' : '') . '>' . $y . '</a>';
    }, column_array (LookPress::find ('all', array ('select' => 'year', 'group' => 'year', 'order' => 'year DESC')), 'year')));

    $presses = LookPress::find ('all', array ('limit' => $limit, 'order' => 'id DESC', 'conditions' => array ('year = ? AND is_enabled = ?', $year, LookPress::IS_ENABLED)));

    return $this->output_json (array ('s' => true, 'y' => $y, 'p' => $this->load_content (array (
        'presses' => $presses
      ), true)));
  }
  public function presses_next () {
    $s = is_numeric ($s = OAInput::get ('s')) ? $s : 1;
    $id = is_numeric ($id = OAInput::get ('id')) ? $id : 0;

    if (!(in_array ($s, array (0, 1)) && ($id && ($press = LookPress::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, LookPress::IS_ENABLED)))))))
      return $this->output_json (array ('s' => false));
    $year = $press->year;

    if ($s) $press = LookPress::find ('one', array ('order' => 'id DESC', 'conditions' => array ('id < ? AND year = ? AND is_enabled = ?', $id, $year, LookPress::IS_ENABLED)));
    else $press = LookPress::find ('one', array ('order' => 'id ASC', 'conditions' => array ('id > ? AND year = ? AND is_enabled = ?', $id, $year, LookPress::IS_ENABLED)));

    if (!$press) $press = LookPress::find ('one', array ('order' => $s ? 'id DESC' : 'id ASC', 'conditions' => array ('id != ? AND year = ? AND is_enabled = ?', $id, $year, LookPress::IS_ENABLED)));
    if (!$press) return $this->output_json (array ('s' => false));

    return $this->output_json (array ('s' => true, 'id' => $press->id, 'src' => $press->big->url ()));
  }
  public function index () {
    return $this->add_hidden (array ('id' => 'products_url', 'value' => base_url ('look', 'main', 'products')))
                ->add_hidden (array ('id' => 'presses_url', 'value' => base_url ('look', 'main', 'presses')))
                ->add_hidden (array ('id' => 'products_next_url', 'value' => base_url ('look', 'main', 'products_next')))
                ->add_hidden (array ('id' => 'presses_next_url', 'value' => base_url ('look', 'main', 'presses_next')))
                ->load_view (array (
                  ));
  }
}
