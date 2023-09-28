<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'departement_id'=>'required|integer',
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required',
            'phone'=>'required',
            'montant_journalier'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.require'=>'Le Mail est requis',
            'phone.require'=>'Le numéro de téléphone requis',
            'name.require'=>'Le name est requis'
        ];
    }
}
