<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageAddRequest extends FormRequest
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
            'title' => 'required|max:100',
            'slug' => 'required|max:255',
            'subtitle' => 'max:255',

            'excerpt' => 'max:6000',
            'presentation' => 'max:6000',
            'content' => 'max:20000',
            'views' => 'required|numeric|min:0',

            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
            'meta_keywords' => 'max:255',

            'photo' => 'max:1024'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Orice pagina trebuie sa aiba un title',
            'title.max' => 'Titlul paginii nu poate avea mai mult de 100 de caractere',
            'slug.required' => 'Adresa slug a paginii este obligatorie',
            'slug.max' => 'Slugul paginii nu poate avea mai mult de 255 de caractere',

            'subtitle.max' => 'Subtitlul paginii nu poate avea mai mult de 255 de caractere',
            'excerpt.max' => 'Excerptul paginii nu poate avea mai mult de 6000 de caractere',
            'presentation.max' => 'Prezentarea paginii nu poate avea mai mult de 6000 de caractere',
            'content.max' => 'Continutul paginii nu poate avea mai mult de 20.000 de caractere',

            'views.numeric' => 'Numarul de vizualizari trebuie sa fie un numar mai mare ca 0',
            'views.min' => 'Numarul de vizualizari trebuie sa fie un numar mai mare ca 0',
            'views.required' => 'Numarul de vizualizari trebuie sa fie un numar mai mare ca 0',

            'meta_title.max' => 'Tagul meta title nu poate avea mai mult de 255 de caractere',
            'meta_description.max' => 'Tagul meta description nu poate avea mai mult de 255 de caractere',
            'meta_keywords.max' => 'Tagul meta keywords nu poate avea mai mult de 255 de caractere',

            'photo.max' => 'Fotografia utilizatorului nu poate aveam mai mult de 1 Mb!'


        ];
    }
}
