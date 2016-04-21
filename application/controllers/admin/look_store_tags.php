<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Look_store_tags extends Admin_controller {
  private $uri_1 = null;
  private $tag = null;

  public function __construct () {
    parent::__construct ();

    $this->uri_1 = 'look_store_tags';

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->tag = LookStoreTag::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ('admin', $this->uri_1), array (
            '_flash_message' => '找不到該筆資料。'
          ));

    $this->add_tab ('代理商分類 列表', array ('href' => base_url ('admin', $this->uri_1), 'index' => 1))
         ->add_tab ('新增 代理商分類', array ('href' => base_url ('admin', $this->uri_1, 'add'), 'index' => 2))
         ->add_param ('uri_1', $this->uri_1)
         ;
  }

  public function index ($offset = 0) {
    $columns = array ( 
        array ('key' => 'name', 'title' => '名稱', 'sql' => 'name LIKE ?'), 
        array ('key' => 'en_name', 'title' => '英文名稱', 'sql' => 'en_name LIKE ?'), 
      );

    $configs = array ('admin', $this->uri_1, '%s');
    $conditions = conditions ($columns, $configs);

    $limit = 25;
    $total = LookStoreTag::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination = $this->pagination->initialize (array_merge (array ('total_rows' => $total, 'num_links' => 3, 'per_page' => $limit, 'uri_segment' => 0, 'base_url' => '', 'page_query_string' => false, 'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁', 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li class="f">', 'first_tag_close' => '</li>', 'prev_tag_open' => '<li class="p">', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>', 'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>', 'next_tag_open' => '<li class="n">', 'next_tag_close' => '</li>', 'last_tag_open' => '<li class="l">', 'last_tag_close' => '</li>'), $configs))->create_links ();
    $store_tags = LookStoreTag::find ('all', array (
        'offset' => $offset,
        'limit' => $limit,
        'order' => 'id DESC',
        'conditions' => $conditions
      ));

    return $this->set_tab_index (1)
                ->set_subtitle ('代理商分類 列表')
                ->add_hidden (array ('id' => 'is_enabled_url', 'value' => base_url ('admin', $this->uri_1, 'is_enabled')))
                ->load_view (array (
                    'store_tags' => $store_tags,
                    'pagination' => $pagination,
                    'columns' => $columns
                  ));
  }

  public function add () {
    $posts = Session::getData ('posts', true);

    return $this->set_tab_index (2)
                ->set_subtitle ('新增 代理商分類')
                ->load_view (array (
                    'posts' => $posts
                  ));
  }

  public function create () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => '非 POST 方法，錯誤的頁面請求。'
        ));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    $tag = null;
    $create = LookStoreTag::transaction (function () use (&$tag, $posts) {
      if (!verifyCreateOrm ($tag = LookStoreTag::create (array_intersect_key ($posts, LookStoreTag::table ()->columns))))
        return false;

      return true;
    });

    if (!($create && $tag))
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => '新增失敗！',
          'posts' => $posts
        ));

    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '新增成功！'
      ));
  }
  public function edit () {
    $posts = Session::getData ('posts', true);
    
    return $this->add_tab ('編輯 代理商分類', array ('href' => base_url ('admin', $this->uri_1, $this->tag->id, 'edit'), 'index' => 3))
                ->set_tab_index (3)
                ->set_subtitle ('編輯 代理商分類')
                ->load_view (array (
                    'posts' => $posts,
                    'tag' => $this->tag
                  ));
  }

  public function update () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', $this->uri_1, $this->tag->id, 'edit'), array (
          '_flash_message' => '非 POST 方法，錯誤的頁面請求。'
        ));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, $this->tag->id, 'edit'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    if ($columns = array_intersect_key ($posts, $this->tag->table ()->columns))
      foreach ($columns as $column => $value)
        $this->tag->$column = $value;
    
    $tag = $this->tag;
    $update = LookStoreTag::transaction (function () use ($tag, $posts) {
      if (!$tag->save ())
        return false;

      return true;
    });

    if (!$update)
      return redirect_message (array ('admin', $this->uri_1, $this->tag->id, 'edit'), array (
          '_flash_message' => '更新失敗！',
          'posts' => $posts
        ));

    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '更新成功！'
      ));
  }

  public function destroy () {
    $tag = $this->tag;
    $delete = LookStoreTag::transaction (function () use ($tag) {
      return $tag->destroy ();
    });

    if (!$delete)
      return redirect_message (array ('admin', $this->uri_1), array (
          '_flash_message' => '刪除失敗！',
        ));
    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '刪除成功！'
      ));
  }

  private function _validation_posts (&$posts) {
    if (!(isset ($posts['name']) && $posts['name'] = trim ($posts['name'])))
      return '沒有輸入中文名稱！';
    if (!(isset ($posts['en_name']) && $posts['en_name'] = trim ($posts['en_name'])))
      return '沒有輸入英文名稱！';

    return '';
  }
}
