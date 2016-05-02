<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2016 OA Wu Design
 */

class Mail extends Site_controller {

  public function index () {
    $company = OAInput::post ('company');
    $name = OAInput::post ('name');
    $mail = OAInput::post ('mail');
    $phone = OAInput::post ('phone');
    $message = OAInput::post ('message');

    if (!($mail && $message))
    return redirect_message (array (), array (
        '_flash_message' => '寄送失敗，請填寫詳細內容與正確的 E-Mail！'
      ));

    $from = $mail;
    $to = 'info@hogaoptical.com.tw';
    $subject = 'Contact form';

    $body = '';
    $body .= 'Name: ' . $name . "\n";
    $body .= 'Email: ' . $mail . "\n";
    $body .= 'Phone: ' . $phone . "\n";
    $body .= 'Company: ' . $company . "\n";
    $body .= "Message: \n\n" . $message . "\n";

    mail ($to, $subject, $body, "From: <$from>");

    return redirect_message (array (), array (
        '_flash_message' => '寄送成功！'
      ));
  }
}
