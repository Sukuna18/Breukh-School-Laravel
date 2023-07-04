<?php

namespace App\Http\Requests;
use Carbon\Carbon;

use Illuminate\Foundation\Http\FormRequest;

class StoreEleveRequest extends FormRequest
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
        // function ($attribute, $value, $fail) {
            
        //     if (Carbon::parse($value)->year >= now()->year) {
        //         $fail("La date de naissance doit être inférieure à l'année actuelle.");
        //     }
    
           
        //     if (Carbon::parse($value)->age < 5) {
        //         $fail('La personne doit avoir au moins 5 ans.');
        //     }
        // },
        return [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'naissance' => 'sometimes|date|before:today - 4 years',
            'lieu' => 'required|string',
            'gender' => 'in:Masculin,Feminin',
            'classe' => 'required|integer',
        ];
    }
}
