<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Anns extends Admin_controller {
  private $uri_1 = null;
  private $ann = null;

  public function __construct () {
    parent::__construct ();

    $this->uri_1 = 'anns';

    if (in_array ($this->uri->rsegments (2, 0), array ('edit', 'update', 'destroy', 'sort')))
      if (!(($id = $this->uri->rsegments (3, 0)) && ($this->ann = Ann::find ('one', array ('conditions' => array ('id = ?', $id))))))
        return redirect_message (array ('admin', $this->uri_1), array (
            '_flash_message' => '找不到該筆資料。'
          ));

    $this->add_tab ('消息列表', array ('href' => base_url ('admin', $this->uri_1), 'index' => 1))
         ->add_tab ('新增消息', array ('href' => base_url ('admin', $this->uri_1, 'add'), 'index' => 2))
         ->add_param ('uri_1', $this->uri_1)
         ;
  }

  public function index ($offset = 0) {
    $columns = array (
        array ('key' => 'title',      'title' => '標題',    'sql' => 'title LIKE ?'), 
        array ('key' => 'content',    'title' => '內容',    'sql' => 'content LIKE ?'), 
      );

    $configs = array ('admin', $this->uri_1, '%s');
    $conditions = conditions ($columns, $configs);

    $limit = 25;
    $total = Ann::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination = $this->pagination->initialize (array_merge (array ('total_rows' => $total, 'num_links' => 3, 'per_page' => $limit, 'uri_segment' => 0, 'base_url' => '', 'page_query_string' => false, 'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁', 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li class="f">', 'first_tag_close' => '</li>', 'prev_tag_open' => '<li class="p">', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>', 'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>', 'next_tag_open' => '<li class="n">', 'next_tag_close' => '</li>', 'last_tag_open' => '<li class="l">', 'last_tag_close' => '</li>'), $configs))->create_links ();
    $anns = Ann::find ('all', array (
        'offset' => $offset,
        'limit' => $limit,
        'order' => 'id DESC',
        'conditions' => $conditions
      ));

    return $this->set_tab_index (1)
                ->set_subtitle ('消息列表')
                ->add_hidden (array ('id' => 'is_enabled_url', 'value' => base_url ('admin', $this->uri_1, 'is_enabled')))
                ->load_view (array (
                    'anns' => $anns,
                    'pagination' => $pagination,
                    'columns' => $columns
                  ));
  }

  public function add () {
    $posts = Session::getData ('posts', true);

    return $this->set_tab_index (2)
                ->set_subtitle ('新增消息')
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
    $posts['content'] = OAInput::post ('content', false);

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, 'add'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    $posts['user_id'] = User::current ()->id;

    $ann = null;
    $create = Ann::transaction (function () use (&$ann, $posts) {
      if (!verifyCreateOrm ($ann = Ann::create (array_intersect_key ($posts, Ann::table ()->columns))))
        return false;

      return true;
    });

    if (!($create && $ann))
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
    
    return $this->add_tab ('編輯消息', array ('href' => base_url ('admin', $this->uri_1, $this->ann->id, 'edit'), 'index' => 3))
                ->set_tab_index (3)
                ->set_subtitle ('編輯消息')
                ->load_view (array (
                    'posts' => $posts,
                    'ann' => $this->ann
                  ));
  }

  public function update () {
    if (!$this->has_post ())
      return redirect_message (array ('admin', $this->uri_1, $this->ann->id, 'edit'), array (
          '_flash_message' => '非 POST 方法，錯誤的頁面請求。'
        ));

    $posts = OAInput::post ();
    $posts['content'] = OAInput::post ('content', false);

    if ($msg = $this->_validation_posts ($posts))
      return redirect_message (array ('admin', $this->uri_1, $this->ann->id, 'edit'), array (
          '_flash_message' => $msg,
          'posts' => $posts
        ));

    if ($columns = array_intersect_key ($posts, $this->ann->table ()->columns))
      foreach ($columns as $column => $value)
        $this->ann->$column = $value;
    
    $ann = $this->ann;
    $update = Ann::transaction (function () use ($ann, $posts) {
      if (!$ann->save ())
        return false;

      return true;
    });

    if (!$update)
      return redirect_message (array ('admin', $this->uri_1, $this->ann->id, 'edit'), array (
          '_flash_message' => '更新失敗！',
          'posts' => $posts
        ));

    return redirect_message (array ('admin', $this->uri_1), array (
        '_flash_message' => '更新成功！'
      ));
  }

  public function destroy () {
    $ann = $this->ann;
    $delete = Ann::transaction (function () use ($ann) {
      return $ann->destroy ();
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
    if (!($id && ($ann = Ann::find_by_id ($id, array ('select' => 'id, is_enabled, updated_at')))))
      return $this->output_json (array ('status' => false, 'message' => '當案不存在，或者您的權限不夠喔！'));

    $posts = OAInput::post ();

    if ($msg = $this->_validation_is_enabled_posts ($posts))
      return $this->output_json (array ('status' => false, 'message' => $msg, 'content' => Ann::$isIsEnabledNames[$ann->is_enabled]));

    if ($columns = array_intersect_key ($posts, $ann->table ()->columns))
      foreach ($columns as $column => $value)
        $ann->$column = $value;

    $update = Ann::transaction (function () use ($ann) { return $ann->save (); });

    if (!$update)
      return $this->output_json (array ('status' => false, 'message' => '更新失敗！', 'content' => Ann::$isIsEnabledNames[$ann->is_enabled]));

    return $this->output_json (array ('status' => true, 'message' => '更新成功！', 'content' => Ann::$isIsEnabledNames[$ann->is_enabled]));
  }

  private function _validation_posts (&$posts) {
    if (!(isset ($posts['title']) && ($posts['title'] = trim ($posts['title']))))
      return '沒有填寫標題！';

    if (!(isset ($posts['content']) && ($posts['content'] = trim ($posts['content']))))
      return '沒有填寫內容！';

    if (!(isset ($posts['brand_id']) && is_numeric ($posts['brand_id'] = trim ($posts['brand_id'])) && in_array ($posts['brand_id'], column_array (Brand::all (), 'id'))))
      $posts['brand_id'] = null;


    if (!(isset ($posts['is_enabled']) && is_numeric ($posts['is_enabled'] = trim ($posts['is_enabled'])) && in_array ($posts['is_enabled'], array_keys (Ann::$isIsEnabledNames))))
      $posts['is_enabled'] = Ann::NO_ENABLED;

    return '';
  }
  private function _validation_is_enabled_posts (&$posts) {
    if (!(isset ($posts['is_enabled']) && is_numeric ($posts['is_enabled']) && in_array ($posts['is_enabled'], array_keys (Ann::$isIsEnabledNames))))
      return '參數錯誤！';
    return '';
  }
}
