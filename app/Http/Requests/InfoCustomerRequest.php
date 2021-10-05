<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoCustomerRequest extends FormRequest
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
            'name' => 'required|string|min:10',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email:rfc,dns',
            'district' => 'required',
            'ward' => 'required',
            'province' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.string' => 'Tên nhập không được chứa số',
            'name.min' => 'Chưa đạt độ dài tối thiểu',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => "Số điện thoại không hợp lệ",
            'phone.min' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'district.required' => 'Vui lòng chọn quận/huyện',
            'ward.required' => 'Vui lòng chọn phường/xã',
            'province.required' => 'Vui lòng chọn tỉnh/thành',
            'address.required' => 'Vui lòng nhập địa chỉ cụ thể'
        ];
    }
}
