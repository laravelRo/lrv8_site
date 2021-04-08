<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'photo' => 'image|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'photo.image' => 'Fisierul selectat trebuie sa fie o imagine',
            'photo.max' => 'Imaginea selectata nu poate avea mai mult de 1MB'
        ];
    }
}
