<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryCreateRequest extends FormRequest
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
            'main_category_id'=>'required|exists:post_main_categories,id',
            'sub_category'=>'required|max:100|string|unique:post_sub_categories,sub_category'
       ];
    }

    public function messages(){
        return[
            'main_category_id.required'=>'メインカテゴリーを選択してください。',
            'main_category_id.exists'=>'選択したメインカテゴリーIDは存在しません。',
            'sub_category.required'=>'サブカテゴリー名を入力してください。',
            'sub_category.max'=>'サブカテゴリー名は100文字以下で入力してください。',
            'sub_category.string'=>'サブカテゴリー名は文字列で入力してください。',
            'sub_category.unique'=>'すでに存在するサブカテゴリーです。'
        ];
    }
}
