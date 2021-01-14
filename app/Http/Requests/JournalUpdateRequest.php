<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date_format:Y-m-d',
            'authors' => 'required|array',
            'authors.*' => 'integer|exists:authors,id',
        ];
    }
}
