<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|min:3|max:30',
            'middle_name' => 'nullable|string|max:30',
        ];
    }
}
