<?php

namespace App\Http\Requests;

use App\Models\User;
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $authenticated = auth()->user()->hasRole('Professionnel');

        if ($authenticated) {
            $user = User::find(auth()->user()->id);
            $entreprise = $user->entreprise();
            $validated['nom_entreprise'] = $entreprise->nom;
            $validated['numero_telephone'] = $entreprise->telephone;
            $validated['numero_whatsapp'] = $entreprise->whatsapp;
            $validated['ville_id'] = $entreprise->ville_id;
            $this->merge($validated);
        }
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
            'numero_telephone' => $authenticated ? 'nullable' : 'required|regex:/^\+[0-9 ]+$/|unique:entreprises,telephone',
            'numero_whatsapp' => $authenticated ? 'nullable' : 'required|regex:/^\+[0-9 ]+$/|unique:entreprises,whatsapp',
            'ville_id' => $authenticated ? 'nullable' : 'required|exists:villes,id',
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
            'numero_telephone.regex' => 'Le format du numéro doit commencer par + suivi de chiffres et espaces.',

            'numero_whatsapp.required' => 'Le numéro WhatsApp est obligatoire.',
            'numero_whatsapp.string' => 'Le numéro WhatsApp doit être une chaîne de caractères.',
            'numero_whatsapp.unique' => 'Ce numéro WhatsApp est déjà utilisé.',
            'numero_whatsapp.regex' => 'Le format du numéro doit commencer par + suivi de chiffres et espaces.',

            'ville_id.required' => 'Le champ ville est obligatoire.',
            'ville_id.exists' => 'La ville sélectionnée est invalide.',
            'ville_id.string' => 'La ville doit être une chaîne de caractères.',
        ];
    }
}
