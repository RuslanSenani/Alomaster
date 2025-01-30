<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FProductRequest extends FormRequest
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

        if ($this->ajax()) {
            return [];
        }
        return [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        if ($this->ajax()) {
            return [];
        }

        return [
            'title.required' => 'Başlıq tələb olunur',
            'url.required' => 'Url tələb olunur',
            'description.required' => 'Təsvir tələb olunur',

            'title.string' => 'Başlıq sətir olmalıdır',
            'url.string' => 'Url sətir olmalıdır',
            'description.string' => 'Təsvir sətir olmalıdır',

            'title.max' => 'Maksimum 255 simvol',
            'url.max' => 'Maksimum 255 simvol',
            'description.max' => 'Maksimum 255 simvol',


        ];
    }
}
