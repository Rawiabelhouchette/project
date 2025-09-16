<?php

namespace App\Livewire\Admin;

trait StepperTrait
{
    public $currentStep = 0;
    
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
    }
}