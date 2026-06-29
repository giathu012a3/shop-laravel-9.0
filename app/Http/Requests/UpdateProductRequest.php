<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dis_price' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tên sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'quantity.required' => 'Vui lòng nhập số lượng sản phẩm',
        ];
    }
}
