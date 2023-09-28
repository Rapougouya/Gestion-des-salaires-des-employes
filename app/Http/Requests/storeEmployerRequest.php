<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class storeEmployerRequest extends FormRequest
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
            'email'=>'required|unique:employers,email',
            'phone'=>'required|unique:employers,phone',
            'montant_journalier'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.require'=>'Le Mail est requis',
            'email.unique'=>'Le mail est déjà pris ',
            'phone.require'=>'Le numéro de téléphone requis',
            'phone.unique'=>'Le numéro de téléphone est déjà pris',
        ];
    }
}
