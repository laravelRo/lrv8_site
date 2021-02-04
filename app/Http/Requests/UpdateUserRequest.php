<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'max:30',
            'address' => 'max:120',
            // 'role' => 'required',
            'photo' => 'max:1024'


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Introducerea numelui utilizatorului este obligatorie',
            'name.max' => 'Numele utilizatorului nu poate avea mai mult de 50 de caractere',
            'email.required' => 'Adresa de email este obligatorie',
            'email.email' => 'Trebuie sa introduceti o adresa de email valida',

            'phone.max' => 'Numarul de telefon nu poate avea mai mult de 30 de caractere',
            'address.max' => 'Adresa nu poate avea mai mult de 120 de caractere',
            'role.required' => 'Trebuie sa atributi utilizatorului un rol',

            'photo.max' => 'Fotografia utilizatorului nu poate aveam mai mult de 1 Mb!'


        ];
    }
}
