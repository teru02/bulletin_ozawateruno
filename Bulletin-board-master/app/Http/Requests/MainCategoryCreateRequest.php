<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryCreateRequest extends FormRequest
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
            'main_category'=>'required|max:100|string|unique:post_main_categories,main_category'
       ];
    }

    public function messages(){
        return[
            'main_category.required'=>'カテゴリー名を入力してください。',
            'main_category.max'=>'カテゴリー名は100文字以下で入力してください。',
            'main_category.string'=>'カテゴリー名は文字列で入力してください。',
            'main_category.unique'=>'すでに存在するカテゴリーです。'
        ];
    }
}
