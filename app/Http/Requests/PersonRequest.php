<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'string|max:255',
            'zipcode' => 'integer',
            'city' => 'string|max:255',
            'mobile_phone' => [
                'max:255',
                Rule::unique('people')->where(function ($query) {
                    $query->where('section_id', session('section')->id);
                })
            ],
            'landline' => 'string|max:255',
            'university' => 'string|max:255',
            'major' => 'string|max:255',
            'email' => 'email|max:255',
            'messageable' => 'boolean',
            'comments' => 'string',
        ];
    }
}
