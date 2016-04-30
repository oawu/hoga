<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Anns extends Site_controller {

  public function show ($id = 0) {
    if (!($id && ($ann = Ann::find ('one', array ('conditions' => array ('id = ? AND is_enabled = ?', $id, Ann::IS_ENABLED))))))
      return redirect_message (array (''), array (
            '_flash_message' => '找不到該筆資料。'
          ));
    $next = Ann::find ('one', array ('order' => 'id DESC', 'conditions' => array ('id < ? AND is_enabled = ?', $ann->id, Ann::IS_ENABLED)));
    $prev = Ann::find ('one', array ('order' => 'id ASC', 'conditions' => array ('id > ? AND is_enabled = ?', $ann->id, Ann::IS_ENABLED)));

    return $this->load_view (array (
        'ann' => $ann,
        'next' => $next,
        'prev' => $prev,
      ));
  }
  public function index ($offset = 0) {
    $columns = array (
        array ('key' => 'year', 'title' => '年', 'sql' => 'YEAR(created_at) = ?'), 
        array ('key' => 'brand_id', 'title' => '品牌', 'sql' => 'brand_id = ?'), 
      );

    $configs = array ('anns', '%s');
    $conditions = conditions ($columns, $configs);
    Ann::addConditions ($conditions, 'is_enabled = 1');

    $limit = 10;
    $total = Ann::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination = $this->pagination->initialize (array_merge (array ('total_rows' => $total, 'num_links' => 3, 'per_page' => $limit, 'uri_segment' => 0, 'base_url' => '', 'page_query_string' => false, 'first_link' => '', 'last_link' => '', 'prev_link' => '', 'next_link' => '', 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '', 'first_tag_close' => '', 'prev_tag_open' => '', 'prev_tag_close' => '', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>', 'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>', 'next_tag_open' => '', 'next_tag_close' => '', 'last_tag_open' => '', 'last_tag_close' => ''), $configs))->create_links ();
    $anns = Ann::find ('all', array (
        'offset' => $offset,
        'limit' => $limit,
        'order' => 'id DESC',
        'conditions' => $conditions
      ));

    $year = 2016;
    foreach ($columns as $column)
      if ($column['key'] == 'year')
        $year = $column['value'];

    $brand_id = '';
    foreach ($columns as $column)
      if ($column['key'] == 'brand_id')
        $brand_id = $column['value'];

    return $this->load_view (array (
                    'anns' => $anns,
                    'pagination' => $pagination,
                    'year' => $year,
                    'brand_id' => $brand_id,
                  ));
  }
}
