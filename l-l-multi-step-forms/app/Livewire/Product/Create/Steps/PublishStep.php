<?php

namespace App\Livewire\Product\Create\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class PublishStep extends StepComponent
{
    public string $title = 'Publish';

    public function render()
    {
        return view('livewire.product.create.steps.publish-step');
    }
}
