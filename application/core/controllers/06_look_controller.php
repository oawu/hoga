<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Look_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();

    $this
         ->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'look')
         ->set_content_path ('content', 'look')
         ->set_public_path ('public')

         ->set_title ("LOOK OCCHIALI")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ;
  }

  private function _add_meta () {
    // <meta name="description" content=“">
                
    return $this->add_meta (array ('name' => 'keywords', 'content' => 'LOOK,LOOK OCCHIALI,義大利,義大利設計,義大利眼鏡,嘉豪,hoga,光學,台灣總代理,眼鏡批發業,精密儀器批發業,國際貿易'))
                ->add_meta (array ('name' => 'description', 'content' => 'LOOK鏡框100%由傳統義大利製造業及滿懷熱忱的工人製造，使用LHS專利結構螺絲，兼具傳統工藝與現代藝術之美，具有人體工學及抗壓鏡架可釋放任何壓力，合身舒適。LOOK鏡框色彩豐富搭配不同材質結合，在不凡中也能享受安心舒適。真實體驗每一刻的輕盈及簡單，追求心中從未放棄的熱情。'));
  }

  private function _add_css () {
    return $this;
  }

  private function _add_js () {
    return $this->add_js (base_url ('resource', 'javascript', 'jrit.js'))
                ;
  }
}