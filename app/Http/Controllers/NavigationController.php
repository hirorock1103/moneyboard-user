<?php

namespace App\Http\Controllers;

use Request;

class NavigationController extends Controller {

  /**
  * signUpCheck
  *
  * 入力されたメールアドレスのバリデーションチェック
  */
  public function signUpCheck() {
    $email1 = Request::input('email');
    $email2 = Request::input('email-check');

    // TODO: バリデーションチェック入れる！
    // if (($email1 != "" && $email2 != "") && $email1 == $email2) {
    if ($email1 == $email2) {
      return view('complete_send_mail', compact('email1'));
    } else {
      return;
    }
  }

}

?>
