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

    public function render()
    {
        $currentStepState = $this->getCurrentStepState();
        $stepNames = $this->stepNames();
        $currentStepName = $this->currentStepName;
        
        // Map step classes to labels
        $stepClassLabels = [
            MetaStep::class => 'Meta Information',
            ImageStep::class => 'Upload Product Image',
            PublishStep::class => 'Review & Publish Product',
        ];
        
        // Map step names (aliases) to labels
        $stepLabels = [];
        $registry = app(\Livewire\Mechanisms\ComponentRegistry::class);
        foreach ($this->steps() as $stepClass) {
            $stepName = $registry->getName($stepClass);
            if ($stepName) {
                $stepLabels[$stepName] = $stepClassLabels[$stepClass] ?? class_basename($stepClass);
            }
        }

        return view('livewire.product.create.wizard', compact('currentStepState', 'stepNames', 'currentStepName', 'stepLabels'));
    }

    public function goToStep(string $stepName)
    {
        // Get current step state if we have a current step
        $currentStepState = [];
        if ($this->currentStepName) {
            $currentStepState = $this->getCurrentStepState();
        }
        
        $this->showStep($stepName, $currentStepState);
    }
}
