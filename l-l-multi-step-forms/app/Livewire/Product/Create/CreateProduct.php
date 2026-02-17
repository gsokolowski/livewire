<?php

namespace App\Livewire\Product\Create;

use Livewire\Component;
use Spatie\LivewireWizard\Components\WizardComponent;

// this is parent class for all steps
class CreateProduct extends WizardComponent
{
    public string $title = 'Create Product';

    public function steps() : array
    {
        return [
            CartStepComponent::class,
            DeliveryAddressStepComponent::class,
            ConfirmOrderStepComponent::class,
        ];       
    }
}
