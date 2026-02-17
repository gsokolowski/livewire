<?php

namespace App\Livewire\Product\Create\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class MetaStep extends StepComponent
{
    public string $title = 'Meta';

    public function render()
    {
        return view('livewire.product.create.steps.meta-step');
    }
}
