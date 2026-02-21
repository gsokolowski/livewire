<?php

namespace App\Livewire\Product\Create\Steps;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\LivewireWizard\Components\StepComponent;

class PublishStep extends StepComponent
{
    public string $title = 'Publish';

    public function getMetaData()
    {
        return $this->state()->forStepClass(MetaStep::class);
    }

    public function getImageData()
    {
        return $this->state()->forStepClass(ImageStep::class);
    }

    /**
     * Override nextStep() to prevent going to next step from the final step.
     * 
     * The wizard knows this is the last step because:
     * 1. Steps are defined in CreateProduct::steps() as [MetaStep, ImageStep, PublishStep]
     * 2. The StepComponent has a hasNextStep() method that checks if the current step
     *    is the last one by comparing it to the last element in $this->allStepNames
     * 3. When nextStep() is called on the wizard, it uses Collection::after() to find
     *    the next step - if none exists, it throws NoNextStep exception
     * 
     * By overriding this method, we prevent the dispatch to the wizard and instead
     * call publish() directly when we're on the last step.
     */
    public function nextStep()
    {
        // Check if this is actually the last step using the built-in method
        if (!$this->hasNextStep()) {
            // This is the last step, so instead of going to next step, publish the product
            $this->publish();
            return;
        }
        
        // If somehow there's a next step (shouldn't happen for PublishStep), 
        // use the parent's dispatch behavior
        $this->dispatchDehydrated('nextStep', $this->state()->currentStep())->to($this->wizardClassName);
    }

    public function publish()
    {
        // Get all step data
        $metaData = $this->getMetaData();
        $imageData = $this->getImageData();

        // Validate required fields manually
        $validated = validator($metaData, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
        ])->validate();

        // Handle image upload
        $imagePath = null;
        if (!empty($imageData['image'])) {
            $image = $imageData['image'];
            
            // Store the image in public storage
            $imagePath = $image->store('products', 'public');
        }

        // Create the product
        $product = Product::create([
            'user_id' => Auth::id(),
            'title' => $metaData['title'] ?? '',
            'description' => $metaData['description'] ?? '',
            'image_path' => $imagePath,
            'published' => true,
        ]);

        // Handle additional images if needed (you might want to create a product_images table)
        // For now, we're only storing the main image
        
        // Show toast notification on next page after redirect using SweetAlert2
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Product published successfully!'
        ]);
        
        return redirect()->route('products.show', $product);
    }

    public function render()
    {
        return view('livewire.product.create.steps.publish-step');
    }
}