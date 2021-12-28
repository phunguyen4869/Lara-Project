<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|integer|min:1000',
            'description' => 'required',
            'thumb' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Cần phải nhập tên sản phẩm',
            'price.required' => 'Cần phải nhập giá sản phẩm',
            'price.min' => 'Giá sản phẩm phải lớn hơn 1.000',
            'description.required' => 'Cần phải nhập mô tả sản phẩm',
            'thumb.required' => 'Cần phải chọn ảnh sản phẩm',
        ];
    }
}
