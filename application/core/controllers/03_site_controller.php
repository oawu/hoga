<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Site_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();

    $this
         ->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'site')
         ->set_public_path ('public')

         ->set_title ("嘉豪光學有限公司")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ;
  }

  private function _add_meta () {
    return $this->add_meta (array ('name' => 'keywords', 'content' => 'hoga,嘉豪,光學,眼鏡,代理商,台灣總代理,眼鏡批發業,精密儀器批發業,國際貿易'))
                ->add_meta (array ('name' => 'description', 'content' => '嘉豪光學有限公司為多國外知名品牌之總代理。嘉豪光學對於市場擁有絕對的熟悉度，團隊們憑著共同理念，各人員兼具不同經歷、特長與能力，對於品牌有傑出的經營及行銷能力，使品牌能迅速滲透台灣市場。嘉豪光學團隊擁有絕對的向心力，有能力帶領店家及合作廠商翱翔於天空。'));
  }

  private function _add_css () {
    return $this;
  }

  private function _add_js () {
    return $this->add_js (base_url ('resource', 'javascript', 'jrit.js'))
                ;
  }
}