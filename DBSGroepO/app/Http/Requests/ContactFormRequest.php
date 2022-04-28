<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'preposition' => 'max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'title' => 'required|string|max:255',
            'phonenumber' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'message' => 'required|string|max:255'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'title.required' => 'Onderwerp mag niet leeg zijn',
            'title.max:255' => 'Onderwerp is te lang',

            'firstname.required' => 'voornaam mag niet leeg zijn',
            'firstname.max:255' => 'voornaam is te lang',

            'lastname.required' => 'achternaam mag niet leeg zijn',
            'lastname.max:255' => 'achternaam is te lang',

            'preposition.required' => 'tussenvoegsel mag niet leeg zijn',
            'preposition.max:255' => 'tussenvoegsel is te lang',

            'email.required' => 'Email adres mag niet leeg zijn',
            'email.max:255' => 'Email adres is te lang',
            'email.email' => 'Geen geldig e-mail adres',

            'phonenumber.required' => 'Telefoonnummer mag niet leeg zijn',
            'phonenumber.min:10' => 'telefoonnummer moet minimaal 10 tekens lang zijn',
            'phonenumber.regex:/^([0-9\s\-\+\(\)]*)$/' => 'telefoonnummer voldoet niet aan het juiste formaat'
        ];
    }

}
