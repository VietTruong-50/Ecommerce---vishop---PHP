<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:200|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required|max:200|min:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ten khong duoc de trong',
            'name.unique' => 'Ten khong duoc trung lap',
            'name.max' => 'Ten khong duoc phep hon 200 ky tu',
            'name.min' => 'Ten khong duoc phep it hon 10 ky tu',
            'price.required'  => 'Gia san pham khong duoc de trong',
            'category_id.required'  => 'Danh muc khong duoc de trong',
            'contents.required'  => 'Noi dung khong duoc de trong',
        ];
    }
}
