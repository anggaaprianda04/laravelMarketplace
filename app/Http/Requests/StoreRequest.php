<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'users_id' => 'required|exists:users,id|unique:store,users_id',
            'name_store' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required',
            'verification_store' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }
}
