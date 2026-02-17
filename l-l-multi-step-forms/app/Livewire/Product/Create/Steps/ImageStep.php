<?php

namespace App\Livewire\Product\Create\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class ImageStep extends StepComponent
{
    public string $title = 'Images';

    public function render()
    {
        return view('livewire.product.create.steps.image-step');
    }
}
