<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'category_code' => 'required',
            'status' => 'required',
        ];
    }

    public function messages() {
        return [
            'category_name.required' => 'Bạn chưa nhập tên cho danh mục', 
            'category_code.required' => 'Bạn chưa chọn danh mục cha',
            'status.required' => 'Bạn chưa chọn trạng thái cho danh mục'
        ];
    }

}
