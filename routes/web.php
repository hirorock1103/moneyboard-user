<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function() {
    return view('app');
})->where('any', '.*');


// TOP画面
Route::get('/', function () {
    return view('index');
});
// Route::get('/index', function () {
//     return view('index');
// });

// ログイン画面
Route::get('/login', function () {
    return view('login');
});

// マイページホーム画面
Route::get('home_top', [
    'uses' => 'LoginController@login'
]);
Route::post('home_top', [
    'uses' => 'LoginController@login'
]);

// 新規登録画面
Route::get('/sign_up', function () {
    return view('sign_up');
});

// メール入力画面
Route::get('/send_mail', [
    'uses' => 'SignUpController@sendRegistrationMail'
 ]);
 Route::post('/send_mail', [
     'uses' => 'SignUpController@sendRegistrationMail'
 ]);

// メール送信完了画面
Route::post('/complete_send_mail', 'NavigationController@signUpCheck');

// 基本情報入力画面
Route::get('/registration', 'RegistrationController@baseInfo');
// Route::get('/registration', function () {
//     return view('registration');
// });

// 基本情報確認画面
Route::get('/registration_confirm', [
   'uses' => 'RegistrationController@baseInfoConfirm'
]);
Route::post('/registration_confirm', [
    'uses' => 'RegistrationController@baseInfoConfirm'
]);

// クレカ情報入力画面
Route::get('/credit_card_registration', [
    'uses' => 'RegistrationController@creditCardRegistration'
 ]);
 Route::post('/credit_card_registration', [
     'uses' => 'RegistrationController@creditCardRegistration'
 ]);

//  クレカ情報確認画面
 Route::get('/credit_card_confirm', [
    'uses' => 'RegistrationController@creditCardConfirm'
 ]);
 Route::post('/credit_card_confirm', [
     'uses' => 'RegistrationController@creditCardConfirm'
 ]);

 // 新規登録完了画面
 Route::get('/complete_sign_up', [
    'uses' => 'RegistrationController@showMailSendView'
 ]);
 Route::post('/complete_sign_up', [
     'uses' => 'RegistrationController@showMailSendView'
 ]);

// パスワード再発行画面
Route::get('/password_reissue', function () {
    return view('password_reissue');
});

// パスワード再設定メール送信完了画面
 Route::get('/password_reissue_email_send', [
    'uses' => 'SendMailController@sendMailForNewPassword'
 ]);
 Route::post('/password_reissue_email_send', [
     'uses' => 'SendMailController@sendMailForNewPassword'
 ]);

 // パスワード再設定画面
 Route::get('/password_reset', function () {
    return view('password_reset');
});

// パスワード再設定メール送信完了画面
Route::get('/password_reset_complete', [
    'uses' => 'AccountController@resetPassword'
 ]);
 Route::post('/password_reset_complete', [
     'uses' => 'AccountController@resetPassword'
 ]);

//  // プラン変更/使用会社数の増減
//  Route::get('/change_plan', [
//      'uses' => 'PlansController@getPlanData'
//   ]);
//   Route::post('/change_plan', [
//     'uses' => 'PlansController@getPlanData'
// ]);

// プラン変更/使用会社数の増減
Route::get('/plan_confirmation', 'PlansController@getPlanData');
Route::post('/plan_confirmation', 'PlansController@getPlanData');

// TODO: ここコントローラ挟むべき？？？
// プラン変更/使用会社数の増減(変更)
Route::get('/plan_change', function () {
    return view('plan_change');
});
Route::post('/plan_change', function () {
    return view('plan_change');
});

// プラン変更/使用会社数の増減(確認)
Route::get('/plan_change_confirm', [
    'uses' => 'PlansController@showPlanConfirm'
 ]);
 Route::post('/plan_change_confirm', [
     'uses' => 'PlansController@showPlanConfirm'
 ]);

//Stripe用のサンプル
Route::get('/stripe_index', 'StripePaymentsController@index')->name('stripe_index');
Route::get('/stripe_payment', 'StripePaymentsController@payment')->name('stripe_payment');
Route::get('/stripe_complete', 'StripePaymentsController@complete')->name('stripe_complete');
Route::post('/charge', 'StripePaymentsController@charge');


//お問い合わせ
Route::get('/inquiry', 'InquiryController@index');
