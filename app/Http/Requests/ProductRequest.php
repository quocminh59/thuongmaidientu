<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|integer',
            'sales_percent' => 'required|integer|between:0,100',
            'feature_image' => 'required',
            'quantity' => 'required|integer',
            'brand_id' => 'required'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Bạn chưa nhập tên cho sản phẩm',
            'name.string' => 'Tên sản phẩm phải là kiểu chuỗi',

            'price.required' => 'Bạn chưa nhập giá cho sản phẩm',
            'price.integer' => 'Giá sản phẩm phải là số nguyên',
          

            'sales_percent.required' => 'Bạn chưa nhập giảmg giá cho sản phẩm',
            'sales_percent.integer' => 'Giảm giá sản phẩm phải là số nguyên',
            'sales_percent.between' => 'Giảm giá sản phẩm có giá trị trong khoảng từ 0 đến 100',

            'feature_image.required' => 'Bạn chưa upload ảnh đại diện sản phẩm',
     
            'quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
            'quantity.integer' => 'Dữ liệu nhập vào phải là số nguyên',

            'brand_id.required' => 'Bạn chưa chọn thương hiệu cho sản phẩm'
        ];
    }
}
