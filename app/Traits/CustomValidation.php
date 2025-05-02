<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait CustomValidation
{
    /**
     * Valide les données du formulaire avec les règles et messages spécifiés
     *
     * @return bool|array Retourne true si la validation réussit, ou un tableau d'erreurs si elle échoue
     */
    protected function validateWithCustom()
    {
        $validator = Validator::make(
            $this->all(),
            $this->rules(),
            $this->messages()
        );

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->errors()->all() as $error) {
                $errors .= $error . "<br>";
            }
            $this->errorMessage = "Veuillez corriger les erreurs ci-dessous.";
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => __('Validation échouée'),
                'message' => $errors,
            ]);

            $this->setErrorBag($validator->errors());
            return false;
        }

        return true;
    }
}
