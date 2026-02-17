<?php

namespace App\Livewire\Product\Create\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class MetaStep extends StepComponent
{
    public string $title = '';
    public string $description = '';

    public function next()
    {
        $this->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3',
        ]);

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.product.create.steps.meta-step');
    }
}
