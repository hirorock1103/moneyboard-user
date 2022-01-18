<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|confirmed',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages() {
        return [
            'email.required'  => 'メールアドレスが入力されていません',
            'email.email'  => '正しい形式で入力してください',
            'email.confirmed'  => 'メールアドレスが一致しません',
            'password.required'  => 'パスワードが入力されていません',
            'password.min'  => '8文字以上のパスワードを入力してください',
            'password.confirmed'  => 'パスワードが一致しません',
        ];
    }
}

    // public function checkValidate(FormRequest $req) {
    //     /**
    //      * 拡張クラスに書いたルールでリクエストが自動的に検証される
    // 　　    * バリデーションをパスするとこの後の処理が実行される 
    // 　　    */ 
    //     $this->userService->createUser($req->all());
    //     return redirect()->back();
    // }

    
