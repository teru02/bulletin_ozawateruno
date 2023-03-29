<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'sub_category_id'=>'required|exists:post_sub_categories,id',
            'title'=>'required|max:100|string|',
            'post'=>'required|max:5000|string|',
       ];
    }

    public function messages(){
        return[
            'sub_category_id.required'=>'サブカテゴリーを選択してください。',
            'sub_category_id.exists'=>'選択したサブカテゴリーIDは存在しません。',
            'title.required'=>'タイトルを入力してください。',
            'title.max'=>'タイトルは100文字以下で入力してください。',
            'title.string'=>'タイトルは文字列で入力してください。',
            'post.required'=>'投稿内容を入力してください。',
            'post.max'=>'投稿内容は5000文字以下で入力してください。',
            'post.string'=>'投稿内容は文字列で入力してください。'
        ];
    }
}
