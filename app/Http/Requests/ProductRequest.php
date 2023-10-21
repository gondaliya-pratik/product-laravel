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
            'name' => 'required',
            'product_image'   => 'required|mimes:jpeg,png,jpg',
            'category_id'   => 'required',
            'sub_category_id'   => 'required',
            'status'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'The :attribute is required.',
        ];
    }
}
