<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffreAbonnementRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $authenticated = auth()->user()->hasRole('Professionnel');
        return [
            'offre_id' => 'required|exists:offre_abonnements,id',
            'nom_entreprise' => $authenticated ? 'nullable' : 'required|string|unique:entreprises,nom',
            'numero_telephone' => $authenticated ? 'nullable' : 'required|string|unique:entreprises,telephone',
            'numero_whatsapp' => $authenticated ? 'nullable' : 'required|string|unique:entreprises,whatsapp',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'offre_id.required' => 'Le champ offre est obligatoire.',
            'offre_id.exists' => 'L\'offre sélectionnée est invalide.',

            'nom_entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
            'nom_entreprise.string' => 'Le nom de l\'entreprise doit être une chaîne de caractères.',
            'nom_entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé.',

            'numero_telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'numero_telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'numero_telephone.unique' => 'Ce numéro de téléphone est déjà utilisé.',

            'numero_whatsapp.required' => 'Le numéro WhatsApp est obligatoire.',
            'numero_whatsapp.string' => 'Le numéro WhatsApp doit être une chaîne de caractères.',
            'numero_whatsapp.unique' => 'Ce numéro WhatsApp est déjà utilisé.',
        ];
    }
}
