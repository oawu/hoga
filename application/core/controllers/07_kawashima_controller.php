<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Kawashima_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();

    $this
         ->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'kawashima')
         ->set_content_path ('content', 'kawashima')
         ->set_public_path ('public')

         ->set_title ("川嶋．Kawashima")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ;
  }

  private function _add_meta () {
    // <meta name="description" content=“">
                
    return $this->add_meta (array ('name' => 'keywords', 'content' => 'Kawashima,Japan,Japanese,日本,日本設計,日本眼鏡,嘉豪,gaho,光學,台灣總代理,眼鏡批發業,精密儀器批發業,國際貿易'))
                ->add_meta (array ('name' => 'description', 'content' => '眼鏡の産地、鯖江にて若者向けに 鯖江市生產，針對年輕人所設計，完全符合市場時尚與潮流之作。川嶋Kawashima Optical為日本福井縣鯖江市當地多位設計師一同利用靈感、巧思、創作來設計出最具流行尖端的新潮眼鏡，日本眼鏡王國福井縣產地，更是品質保證。'));
  }

  private function _add_css () {
    return $this;
  }

  private function _add_js () {
    return $this->add_js (base_url ('resource', 'javascript', 'jrit.js'))
                ;
  }
}