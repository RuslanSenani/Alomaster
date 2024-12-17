<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     *
     */
    public function rules(): array
    {
        return [
            'p_name' => 'required|string|max:255',
            'p_code' => 'required|string|max:255',
            'p_info' => 'string|max:255',
            'p_img' => 'required|string|max:255',

        ];
    }


    public function messages(): array
    {
        return [
            'p_name.required' => 'Məhsul Adı Doldurulmalıdır',
            'p_code.required' => 'Məhsul Kodu Doldurulmalıdır',
            'p_img.required' => 'Məhsul Şəkili Doldurulmalıdır',

        ];
    }


//    public function validated()
//    {
//        $data = parent::validated();
//        return [
//            'p_name' => $data['p_name'],
//            'p_code' => $data['p_code'],
//            'p_info' => $data['p_info'],
//            'p_img' => $data['p_img'],
//
//        ];
//    }

}
