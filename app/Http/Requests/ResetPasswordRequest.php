<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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

            'password' => 'required|min:8',
            'passwordnew' => 'required|min:8',
            'passwordnew_confirmation' => 'required|same:passwordnew'
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Introducerea parolei curente este obligatorie',
            'password.min' => 'Parola trebuie sa aibe minimum 8 caractere',
            'passwordnew.min' => 'Parola trebuie sa aibe minimum 8 caractere',
            'passwordnew.required' => 'Trebuie sa introduceti o noua parola',
            'passwordnew_confirmation.same' => 'Confirmarea parolei nu este exacta!'

        ];
    }
}
