<?php

namespace App\Livewire\Product\Create;

use App\Livewire\Product\Create\Steps\ImageStep;
use App\Livewire\Product\Create\Steps\MetaStep;
use App\Livewire\Product\Create\Steps\PublishStep;
use Spatie\LivewireWizard\Components\WizardComponent;

// this is parent class for all steps
class CreateProduct extends WizardComponent
{
    public string $title = 'Create Product';

    public function steps() : array
    {
        return [
            MetaStep::class,
            ImageStep::class,
            PublishStep::class,
        ];       
    }

    // note: no need to render anything here, because the steps are rendered automatically
}
