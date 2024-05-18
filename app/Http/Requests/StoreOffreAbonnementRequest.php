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
        return [
            'offre_id' => 'required|exists:offre_abonnements,id',
            'nom_entreprise' => 'required|string|unique:entreprises,nom',
            'numero_telephone' => 'required|string',
            'numero_whatsapp' => 'required|string',
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
            'offer_id.required' => 'Veuillez choisir une offre',
            'offer_id.exists' => 'L\'offre choisie n\'existe pas',
            'nom_entreprise.required' => 'Veuillez saisir le nom de l\'entreprise',
            'nom_entreprise.unique' => 'Ce nom d\'entreprise est déjà utilisé',
            'numero_telephone.required' => 'Veuillez saisir le numéro de téléphone de l\'entreprise',
            'numero_whatsapp.required' => 'Veuillez saisir le numéro de WhatsApp de l\'entreprise',
        ];
    }
}
