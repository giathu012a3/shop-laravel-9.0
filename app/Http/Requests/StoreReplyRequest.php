<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reply' => 'required|string|max:1000',
            'commentId' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'reply.required' => 'Nội dung phản hồi không được để trống',
            'reply.max' => 'Phản hồi không được vượt quá 1000 ký tự',
            'commentId.required' => 'Mã bình luận không hợp lệ',
        ];
    }
}
