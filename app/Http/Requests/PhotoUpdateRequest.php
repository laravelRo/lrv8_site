<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoUpdateRequest extends FormRequest
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
            'title' => 'nullable|max:250',
            'description' => 'nullable|max:250',
            'position' => 'integer',
            'photo' => 'nullable|image|max:1024'
        ];
    }
    public function messages()
    {
        return [
            'title.max' => 'Titlul imaginii nu poate avea mai mult de 250 caractere',
            'description.max' => 'Titlul imaginii nu poate avea mai mult de 250 caractere',
            'position' => 'Positia imaginii trebuie sa fie un numar intreg',
            'photo.max' => 'Imaginea nu poate avea mai mult de 1MB'
        ];
    }
}
