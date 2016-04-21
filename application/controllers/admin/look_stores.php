<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Look_stores extends Admin_controller {
  private $uri_1 = null;
  private $store = null;

  public function __construct () {
    parent::__construct ();

    $this->uri_1 = 'look_stores';

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->store = LookStore::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ('admin', $this->uri_1), array (
            '_flash_message' => '找不到該筆資料。'
          ));

    $this->add_tab ('代理商 列表', array ('href' => base_url ('admin', $this->uri_1), 'index' => 1))
         ->add_tab ('新增 代理商', array ('href' => base_url ('admin', $this->uri_1, 'add'), 'index' => 2))
         ->add_param ('uri_1', $this->uri_1)
         ;
  }

  public function index ($offset = 0) {
    $columns = array (
        array ('key' => 'name',   'title' => '名稱',    'sql' => 'name LIKE ?'), 
        array ('key' => 'phone',    'title' => '電話',    'sql' => 'phone LIKE ?'), 
        array ('key' => 'address',    'title' => '地址',    'sql' => 'address LIKE ?'), 
      );

    $configs = array ('admin', $this->uri_1, '%s');
    $conditions = conditions ($columns, $configs);

    $limit = 25;
    $total = LookStore::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination = $this->pagination->initialize (array_merge (array ('total_rows' => $total, 'num_links' => 3, 'per_page' => $limit, 'uri_segment' => 0, 'base_url' => '', 'page_query_string' => false, 'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁', 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li class="f">', 'first_tag_close' => '</li>', 'prev_tag_open' => '<li class="p">', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>', 'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>', 'next_tag_open' => '<li class="n">', 'next_tag_close' => '</li>', 'last_tag_open' => '<li class="l">', 'last_tag_close' => '</li>'), $configs))->create_links ();
    $stores = LookStore::find ('all', array (
        'offset' => $offset,
        'limit' => $limit,
        'order' => 'id DESC',
        'conditions' => $conditions
      ));

    return $this->set_tab_index (1)
                ->set_subtitle ('代理商 列表')
                ->add_hidden (array ('id' => 'is_enabled_url', 'value' => base_url ('admin', $this->uri_1, 'is_enabled')))
                ->load_view (array (
                    'stores' => $stores,
                    'pagination' => $pagination,
                    'columns' => $columns
                  ));
  }

  public function add () {
    $posts = Session::getData ('posts', true);

    return $this->set_tab_index (2)
                ->set_subtitle ('新增 代理商')
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

    $store = null;
    $create = LookStore::transaction (function () use (&$store, $posts) {
      if (!verifyCreateOrm ($store = LookStore::create (array_intersect_key ($posts, LookStore::table ()->columns))))
        return false;

      return true;
    });

    if (!($create && $store))
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
    
    return $this->add_tab ('編輯 代理商', array ('href' => base_url ('admin', $this->uri_1, $this->store->id, 'edit'), 'index' => 3))
                ->set_tab_index (3)
                ->set_subtitle ('編輯 代理商')
                ->load_view (array (
                    'posts' => $posts,
                    'store' => $this->store
                  ));
  }

  public function update () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', $this->uri_1, $this->store->id, 'edit'), array (
          '_flash_message' => '非 POST 方法，錯誤的頁面請求。'
        ));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, $this->store->id, 'edit'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    if ($columns = array_intersect_key ($posts, $this->store->table ()->columns))
      foreach ($columns as $column => $value)
        $this->store->$column = $value;
    
    $store = $this->store;
    $update = LookStore::transaction (function () use ($store, $posts) {
      if (!$store->save ())
        return false;

      return true;
    });

    if (!$update)
      return redirect_message (array ('admin', $this->uri_1, $this->store->id, 'edit'), array (
          '_flash_message' => '更新失敗！',
          'posts' => $posts
        ));

    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '更新成功！'
      ));
  }

  public function destroy () {
    $store = $this->store;
    $delete = LookStore::transaction (function () use ($store) {
      return $store->destroy ();
    });

    if (!$delete)
      return redirect_message (array ('admin', $this->uri_1), array (
          '_flash_message' => '刪除失敗！',
        ));
    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '刪除成功！'
      ));
  }

  public function is_enabled ($id = 0) {
    if (!($id && ($store = LookStore::find_by_id ($id, array ('select' => 'id, is_enabled, updated_at')))))
      return $this->output_json (array ('status' => false, 'message' => '當案不存在，或者您的權限不夠喔！'));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_is_enabled_posts ($posts))
      return $this->output_json (array ('status' => false, 'message' => $msg, 'content' => LookStore::$isIsEnabledNames[$store->is_enabled]));

    if ($columns = array_intersect_key ($posts, $store->table ()->columns))
      foreach ($columns as $column => $value)
        $store->$column = $value;

    $update = LookStore::transaction (function () use ($store) { return $store->save (); });

    if (!$update)
      return $this->output_json (array ('status' => false, 'message' => '更新失敗！', 'content' => LookStore::$isIsEnabledNames[$store->is_enabled]));

    return $this->output_json (array ('status' => true, 'message' => '更新成功！', 'content' => LookStore::$isIsEnabledNames[$store->is_enabled]));
  }

  private function _validation_posts (&$posts) {
    if (!(isset ($posts['user_id']) && ($posts['user_id'] = trim ($posts['user_id']))))
      return '您未登入！';

    if (!(isset ($posts['name']) && ($posts['name'] = trim ($posts['name']))))
      return '沒有填寫名稱！';

    if (!(isset ($posts['phone']) && ($posts['phone'] = trim ($posts['phone']))))
      return '沒有填寫電話！';

    if (!(isset ($posts['address']) && ($posts['address'] = trim ($posts['address']))))
      return '沒有填寫地址！';

    if (!LookStoreTag::count ())
      return '請先新增分類！';

    if (!(isset ($posts['look_store_tag_id']) && is_numeric ($posts['look_store_tag_id'] = trim ($posts['look_store_tag_id'])) && in_array ($posts['look_store_tag_id'], column_array (LookStoreTag::all (), 'id'))))
      return '請先新增分類！';

    return '';
  }
  private function _validation_is_enabled_posts (&$posts) {
    if (!(isset ($posts['is_enabled']) && is_numeric ($posts['is_enabled']) && in_array ($posts['is_enabled'], array_keys (LookStore::$isIsEnabledNames))))
      return '參數錯誤！';
    return '';
  }
}
