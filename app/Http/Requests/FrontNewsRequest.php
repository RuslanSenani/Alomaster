<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'news_type' => 'required|string|max:5',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|string|max:100'
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => "Salam EEE",
            'title.required' => "Salam BBB",
        ];
    }
}
