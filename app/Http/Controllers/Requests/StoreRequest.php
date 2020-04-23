<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
          'title' => 'required|max:30',
          'age' => 'required|numeric|digits_between:1,4',
          'image' => 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000',
          'category' => 'required',
          'comment' => 'required|max:500',
        ];
    }

    public function messages()
    {
      return[
        'title.required' => '名前を入力してください',
        'title.max' => 'タイトルは30文字以内で入力してください',
        'age.required' => '金額を入力してください',
        'age.digits_between' => '金額は1~7桁までで入力してください',
        'age.numeric' => '金額は半角数字で入力してください',
        'image.required' => '画像を選択してください',
        'category.required' => 'カテゴリーを選択してください',
        'comment.required' => '詳細を記入してください',
        'comment.max' => '詳細は500文字以内で入力してください',
      ];
    }
}
