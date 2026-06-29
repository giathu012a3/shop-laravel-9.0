<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category' => 'required|string|max:255|unique:categories,category_name',
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Vui lòng nhập tên danh mục',
            'category.unique' => 'Tên danh mục này đã tồn tại',
        ];
    }
}
