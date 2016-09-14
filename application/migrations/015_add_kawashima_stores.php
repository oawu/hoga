<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_kawashima_stores extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `kawashima_stores` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
        `kawashima_store_tag_id` int(11) unsigned NOT NULL COMMENT 'Look Store Tag ID',

        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '電話',
        `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',

        `is_enabled` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '上下架，1 上架，0 下架',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`),
        KEY `user_id_index` (`user_id`),
        KEY `kawashima_store_tag_id_index` (`kawashima_store_tag_id`),
        KEY `is_enabled_index` (`is_enabled`),
        KEY `id_is_enabled_index` (`id`, `is_enabled`),
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
        FOREIGN KEY (`kawashima_store_tag_id`) REFERENCES `kawashima_store_tags` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `kawashima_stores`;"
    );
  }
}