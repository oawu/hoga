<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

$admin['title'] = '後台管理 - 嘉豪光學';
$admin['footer']['title'] = '嘉豪光學 © 2016';
$admin['footer']['description'] = '如有相關問題歡迎與<a href="http://www.zeusdesign.com.tw/" target="_blank">作者</a>討論。';


$admin['menu'] = array (
    '嘉豪後台' => array (
        '品牌列表' => array ('icon' => 'icon-3dglasses', 'href' => base_url ('admin', 'brands'), 'class' => 'brands', 'method' => '', 'target' => '_self'),
        '公告列表' => array ('icon' => 'icon-note', 'href' => base_url ('admin', 'anns'), 'class' => 'anns', 'method' => '', 'target' => '_self'),
        'Banner 列表' => array ('icon' => 'icon-images', 'href' => base_url ('admin', 'banners'), 'class' => 'banners', 'method' => '', 'target' => '_self'),
      ),
    'LOOK 後台' => array (
        '產品列表' => array ('icon' => 'icon-3dglasses', 'href' => base_url ('admin', 'look_products'), 'class' => 'look_products', 'method' => '', 'target' => '_self'),
        '媒體列表' => array ('icon' => 'icon-3dglasses', 'href' => base_url ('admin', 'look_presses'), 'class' => 'look_presses', 'method' => '', 'target' => '_self'),
        'Banner 列表' => array ('icon' => 'icon-images', 'href' => base_url ('admin', 'look_banners'), 'class' => 'look_banners', 'method' => '', 'target' => '_self'),
        '代理商分類列表' => array ('icon' => 'icon-images', 'href' => base_url ('admin', 'look_store_tags'), 'class' => 'look_store_tags', 'method' => '', 'target' => '_self'),
        '代理商列表' => array ('icon' => 'icon-images', 'href' => base_url ('admin', 'look_stores'), 'class' => 'look_stores', 'method' => '', 'target' => '_self'),
      ),
    '其他' => array (
        '工具' => array ('no_show' => true, 'icon' => '', 'href' => base_url ('tools'), 'class' => 'tools', 'method' => '', 'target' => '_self'),
      ),
  );