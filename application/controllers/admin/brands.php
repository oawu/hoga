<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Brands extends Admin_controller {
  private $uri_1 = null;
  private $brand = null;

  public function __construct () {
    parent::__construct ();

    $this->uri_1 = 'brands';

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->brand = Brand::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ('admin', $this->uri_1), array (
            '_flash_message' => '找不到該筆資料。'
          ));

    $this->add_tab ('品牌列表', array ('href' => base_url ('admin', $this->uri_1), 'index' => 1))
         ->add_tab ('新增品牌', array ('href' => base_url ('admin', $this->uri_1, 'add'), 'index' => 2))
         ->add_param ('uri_1', $this->uri_1)
         ;
  }

  public function index ($offset = 0) {
    $columns = array (
        array ('key' => 'name',       'title' => '名稱',    'sql' => 'name LIKE ?'), 
        array ('key' => 'content',    'title' => '內容',    'sql' => 'content LIKE ?'), 
        array ('key' => 'link',       'title' => '鏈結',    'sql' => 'link LIKE ?'), 
      );

    $configs = array ('admin', $this->uri_1, '%s');
    $conditions = conditions ($columns, $configs);

    $limit = 25;
    $total = Brand::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination = $this->pagination->initialize (array_merge (array ('total_rows' => $total, 'num_links' => 3, 'per_page' => $limit, 'uri_segment' => 0, 'base_url' => '', 'page_query_string' => false, 'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁', 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li class="f">', 'first_tag_close' => '</li>', 'prev_tag_open' => '<li class="p">', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>', 'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>', 'next_tag_open' => '<li class="n">', 'next_tag_close' => '</li>', 'last_tag_open' => '<li class="l">', 'last_tag_close' => '</li>'), $configs))->create_links ();
    $brands = Brand::find ('all', array (
        'offset' => $offset,
        'limit' => $limit,
        'order' => 'id DESC',
        'conditions' => $conditions
      ));

    return $this->set_tab_index (1)
                ->set_subtitle ('品牌列表')
                ->add_hidden (array ('id' => 'is_enabled_url', 'value' => base_url ('admin', $this->uri_1, 'is_enabled')))
                ->load_view (array (
                    'brands' => $brands,
                    'pagination' => $pagination,
                    'columns' => $columns
                  ));
  }

  public function add () {
    $posts = Session::getData ('posts', true);

    return $this->set_tab_index (2)
                ->set_subtitle ('新增品牌')
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
    $cover = OAInput::file ('cover');

    if (!$cover)
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => '請選擇照片(gif、jpg、png)檔案!',
          'posts' => $posts
        ));

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    $posts['cover'] = '';
    $posts['user_id'] = User::current ()->id;

    $brand = null;
    $create = Brand::transaction (function () use (&$brand, $posts, $cover) {
      if (!verifyCreateOrm ($brand = Brand::create (array_intersect_key ($posts, Brand::table ()->columns))))
        return false;

      if (!($cover && $brand->cover->put ($cover)))
        return false;

      return true;
    });

    if (!($create && $brand))
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
    
    return $this->add_tab ('編輯品牌', array ('href' => base_url ('admin', $this->uri_1, $this->brand->id, 'edit'), 'index' => 3))
                ->set_tab_index (3)
                ->set_subtitle ('編輯品牌')
                ->load_view (array (
                    'posts' => $posts,
                    'brand' => $this->brand
                  ));
  }

  public function update () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', $this->uri_1, $this->brand->id, 'edit'), array (
          '_flash_message' => '非 POST 方法，錯誤的頁面請求。'
        ));

    $posts = OAInput::post ();
    $cover = OAInput::file ('cover');

    if (!((string)$this->brand->cover || $cover))
      return redirect_message (array ('admin', $this->uri_1, $this->brand->id, 'edit'), array (
          '_flash_message' => '請選擇圖片(gif、jpg、png)檔案!',
          'posts' => $posts
        ));

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, $this->brand->id, 'edit'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    if ($columns = array_intersect_key ($posts, $this->brand->table ()->columns))
      foreach ($columns as $column => $value)
        $this->brand->$column = $value;
    
    $brand = $this->brand;
    $update = Brand::transaction (function () use ($brand, $posts, $cover) {
      if (!$brand->save ())
        return false;

      if ($cover && !$brand->cover->put ($cover))
        return false;
      
      return true;
    });

    if (!$update)
      return redirect_message (array ('admin', $this->uri_1, $this->brand->id, 'edit'), array (
          '_flash_message' => '更新失敗！',
          'posts' => $posts
        ));

    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '更新成功！'
      ));
  }

  public function destroy () {
    $brand = $this->brand;
    $delete = Brand::transaction (function () use ($brand) {
      return $brand->destroy ();
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
    if (!($id && ($brand = Brand::find_by_id ($id, array ('select' => 'id, is_enabled, updated_at')))))
      return $this->output_json (array ('status' => false, 'message' => '當案不存在，或者您的權限不夠喔！'));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_is_enabled_posts ($posts))
      return $this->output_json (array ('status' => false, 'message' => $msg, 'content' => Brand::$isIsEnabledNames[$brand->is_enabled]));

    if ($columns = array_intersect_key ($posts, $brand->table ()->columns))
      foreach ($columns as $column => $value)
        $brand->$column = $value;

    $update = Brand::transaction (function () use ($brand) { return $brand->save (); });

    if (!$update)
      return $this->output_json (array ('status' => false, 'message' => '更新失敗！', 'content' => Brand::$isIsEnabledNames[$brand->is_enabled]));

    return $this->output_json (array ('status' => true, 'message' => '更新成功！', 'content' => Brand::$isIsEnabledNames[$brand->is_enabled]));
  }

  private function _validation_posts (&$posts) {
    if (!(isset ($posts['name']) && ($posts['name'] = trim ($posts['name']))))
      return '沒有填寫名稱！';

    if (!(isset ($posts['link']) && ($posts['link'] = trim ($posts['link']))))
      return '沒有填寫鏈結！';

    if (!(isset ($posts['content']) && ($posts['content'] = trim ($posts['content']))))
      return '沒有填寫內容！';

    if (!(isset ($posts['is_enabled']) && is_numeric ($posts['is_enabled'] = trim ($posts['is_enabled'])) && in_array ($posts['is_enabled'], array_keys (Brand::$isIsEnabledNames))))
      $posts['is_enabled'] = Brand::NO_ENABLED;

    return '';
  }
  private function _validation_is_enabled_posts (&$posts) {
    if (!(isset ($posts['is_enabled']) && is_numeric ($posts['is_enabled']) && in_array ($posts['is_enabled'], array_keys (Brand::$isIsEnabledNames))))
      return '參數錯誤！';
    return '';
  }
}
