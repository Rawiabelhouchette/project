<?php

namespace App\Livewire\Admin;

use App\Models\Fichier;
use App\Utils\AnnoncesUtils;
use Livewire\WithFileUploads;

trait AnnonceBaseCreate
{
    // Add stepper functionality to the base trait
    public $currentStep = 0;
    
    // Step navigation methods
    public function nextStep()
    {
        // Validate current step before proceeding
        $this->validateCurrentStep();
        
        // If validation passes, move to next step
        $this->currentStep++;
    }

    public function previousStep()
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
        }
    }
    
    // This method should be overridden in child classes to provide step-specific validation
    protected function validateCurrentStep()
    {
        // Default implementation - can be overridden in child classes
        if ($this->currentStep == 0) {
            $this->validate([
                'entreprise_id' => 'required|exists:entreprises,id',
                'nom' => 'required|string|min:3',
            ]);
        }
    }
    
    public $selected_images = [];

    public $galerie = [];

    public $image;

    public function updatedSelectedImages($images)
    {
        foreach ($images as $image) {
            $this->galerie[] = $image;
        }

        $this->selected_images = [];
    }

    public function removeImage($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }

    public function removeAllImages()
    {
        $this->galerie = [];
    }

    public function removeGalerie($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }
}

