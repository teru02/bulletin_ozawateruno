<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'=>'required|max:30|string',
            'email'=>'required|max:100|email|unique:users,email',
            'password'=>'required|min:8|max:30',
            'password_confirmation'=>'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザー名は必ず入力してください。',
            'username.max' => 'ユーザー名は30文字以内で入力してください。',
            'username.string' => 'ユーザー名は文字型で入力してください。',
            'email.required' => 'メールアドレスは必ず入力してください。',
            'email.max' => 'メールアドレスは100文字以内で入力してください。',
            'email.email' => '無効なメールアドレスです。',
            'email.unique' => 'すでに使用されているメールアドレスです。',
            'password.required' => 'パスワードは必ず入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは30文字以内で入力してください。',
            'password_confirmation.required'=>'パスワード確認は必須です。',
            'password_confirmation.same'=>'パスワードと一致しません。'
        ];
    }
}
