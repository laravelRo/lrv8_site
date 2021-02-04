<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'max:30',
            'address' => 'max:120',
            'role' => 'required',
            'password' => 'required|min:8|confirmed',
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
            'email.unique' => 'Adresa de email este deja inregistrata pe acest site',
            'phone.max' => 'Numarul de telefon nu poate avea mai mult de 30 de caractere',
            'address.max' => 'Adresa nu poate avea mai mult de 120 de caractere',
            'role.required' => 'Trebuie sa atributi utilizatorului un rol',
            'password.required' => 'Trebuie sa introduceti o parola a utilizatorului',
            'password.min' => 'Parola trebuie sa aiba cel putin 8 caractere',
            'password.confirmed' => 'Parola confirmata nu este corecta!',
            'photo.max' => 'Fotografia utilizatorului nu poate aveam mai mult de 1 Mb!'


        ];
    }
}
