<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Migration_Add_anns extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `anns` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `user_id` int(11) unsigned NOT NULL COMMENT 'User ID',
        `brand_id` int(11) unsigned DEFAULT NULL COMMENT 'Brand ID',

        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '標題',
        `content` text  COMMENT '內容',

        `is_enabled` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '上下架，1 上架，0 下架',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '新增時間',
        PRIMARY KEY (`id`),
        KEY `user_id_index` (`user_id`),
        KEY `brand_id_index` (`brand_id`),
        KEY `is_enabled_index` (`is_enabled`),
        KEY `id_is_enabled_index` (`id`, `is_enabled`),
        KEY `brand_id_is_enabled_index` (`brand_id`, `is_enabled`),
        KEY `id_brand_id_is_enabled_index` (`id`, `brand_id`, `is_enabled`),
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
        FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `anns`;"
    );
  }
}