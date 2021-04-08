<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotosUploadRequest extends FormRequest
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
            'photo' => 'max:8',
            'photo.*' => 'image|max:1024'
        ];
    }
    public function messages()
    {
        return [
            'photo.max' => 'Nu puteti incarca mai mult de 8 imagini',
            'photo.*.max' => 'Imaginea nu poate avea mai mult de 1 MB'
        ];
    }
}
