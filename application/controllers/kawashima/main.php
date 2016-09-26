<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Main extends Kawashima_controller {

  public function products () {
    $offset = ($offset = OAInput::get ('p')) ? $offset : 0;
    $limit = 8;
    $total = KawashimaProduct::count (array ('conditions' => array ('is_enabled = ?', KawashimaProduct::IS_ENABLED)));
    $ps = ceil ($total / $limit);
    $d = '';
    for ($i = 0; $i < $ps; $i++) $d .= '<a' . ($i == $offset ? ' class="a"' : '') . '></a>';

    $products = KawashimaProduct::find ('all', array ('limit' => $limit, 'offset' => $offset * $limit, 'order' => 'id DESC', 'conditions' => array ('is_enabled = ?', KawashimaProduct::IS_ENABLED)));

    return $this->output_json (array ('s' => true, 'd' => $d, 'p' => $this->load_content (array (
        'products' => $products
      ), true)));
  }
  public function products_next () {
    $s = is_numeric ($s = OAInput::get ('s')) ? $s : 1;
    $id = is_numeric ($id = OAInput::get ('id')) ? $id : 0;

    if (!(in_array ($s, array (0, 1)) && ($id && ($product = KawashimaProduct::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, KawashimaProduct::IS_ENABLED)))))))
      return $this->output_json (array ('s' => false));

    if ($s) $product = KawashimaProduct::find ('one', array ('order' => 'id DESC', 'conditions' => array ('id < ? AND is_enabled = ?', $id, KawashimaProduct::IS_ENABLED)));
    else $product = KawashimaProduct::find ('one', array ('order' => 'id ASC', 'conditions' => array ('id > ? AND is_enabled = ?', $id, KawashimaProduct::IS_ENABLED)));

    if (!$product) $product = KawashimaProduct::find ('one', array ('order' => $s ? 'id DESC' : 'id ASC', 'conditions' => array ('id != ? AND is_enabled = ?', $id, KawashimaProduct::IS_ENABLED)));
    if (!$product) return $this->output_json (array ('s' => false));

    return $this->output_json (array ('s' => true, 'id' => $product->id, 'src' => $product->big->url ()));
  }
  public function presses () {
    $year = ($year = OAInput::get ('y')) ? $year : 0;
    $limit = 6;
    $y = implode ('', array_map (function ($y) use ($year) {
      return '<a' . ($y == $year ? ' class="a"' : '') . '>' . $y . '</a>';
    }, column_array (KawashimaPress::find ('all', array ('select' => 'year', 'group' => 'year', 'order' => 'year DESC')), 'year')));

    $presses = KawashimaPress::find ('all', array ('order' => 'id DESC', 'limit' => $limit, 'conditions' => array ('year = ? AND is_enabled = ?', $year, KawashimaPress::IS_ENABLED)));

    return $this->output_json (array ('s' => true, 'y' => $y, 'p' => $this->load_content (array (
        'presses' => $presses
      ), true)));
  }
  public function presses_next () {
    $s = is_numeric ($s = OAInput::get ('s')) ? $s : 1;
    $id = is_numeric ($id = OAInput::get ('id')) ? $id : 0;

    if (!(in_array ($s, array (0, 1)) && ($id && ($press = KawashimaPress::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, KawashimaPress::IS_ENABLED)))))))
      return $this->output_json (array ('s' => false));
    $year = $press->year;

    if ($s) $press = KawashimaPress::find ('one', array ('order' => 'id DESC', 'conditions' => array ('id < ? AND year = ? AND is_enabled = ?', $id, $year, KawashimaPress::IS_ENABLED)));
    else $press = KawashimaPress::find ('one', array ('order' => 'id ASC', 'conditions' => array ('id > ? AND year = ? AND is_enabled = ?', $id, $year, KawashimaPress::IS_ENABLED)));

    if (!$press) $press = KawashimaPress::find ('one', array ('order' => $s ? 'id DESC' : 'id ASC', 'conditions' => array ('id != ? AND year = ? AND is_enabled = ?', $id, $year, KawashimaPress::IS_ENABLED)));
    if (!$press) return $this->output_json (array ('s' => false));

    return $this->output_json (array ('s' => true, 'id' => $press->id, 'title' => $press->title, 'src' => $press->big->url ()));
  }
  public function index () {
    return $this->add_hidden (array ('id' => 'products_url', 'value' => base_url ('kawashima', 'main', 'products')))
                ->add_hidden (array ('id' => 'presses_url', 'value' => base_url ('kawashima', 'main', 'presses')))
                ->add_hidden (array ('id' => 'products_next_url', 'value' => base_url ('kawashima', 'main', 'products_next')))
                ->add_hidden (array ('id' => 'presses_next_url', 'value' => base_url ('kawashima', 'main', 'presses_next')))
                ->load_view (array (
                  ));
  }
}
