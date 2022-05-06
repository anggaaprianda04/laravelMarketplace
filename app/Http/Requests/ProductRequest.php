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
            // 'categories_id' => 'required|exists:category_product,id|unique:product,categories_id',
            // 'store_id' => 'required|exists:store,id|unique:store,store_id',
            'name' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'stock' => 'required|string',
            'price' => 'required|string',
            'image' => 'nullable',
            'description' => 'required|string'
        ];
    }
}
