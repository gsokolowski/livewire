<?php

namespace App\Livewire\Product\Create\Steps;

use Livewire\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;

class ImageStep extends StepComponent
{
    use WithFileUploads;

    public string $title = 'Images';

    public $image = null;

    public function next()
    {
        $this->validate([
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        $this->nextStep();
    }

    public function render()
    {
        return view('livewire.product.create.steps.image-step');
    }
}