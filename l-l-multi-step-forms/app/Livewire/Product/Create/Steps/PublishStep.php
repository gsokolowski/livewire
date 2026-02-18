<?php

namespace App\Livewire\Product\Create\Steps;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\LivewireWizard\Components\StepComponent;
use Usernotnull\Toast\Concerns\WireToast;

class PublishStep extends StepComponent
{
    use WireToast;
    public string $title = 'Publish';

    public function getMetaData()
    {
        return $this->state()->forStepClass(MetaStep::class);
    }

    public function getImageData()
    {
        return $this->state()->forStepClass(ImageStep::class);
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
        
        // Show toast notification on next page after redirect
        toast()
            ->success('Product published successfully!')
            ->pushOnNextPage();
        
        return redirect()->route('products.show', $product);
    }

    public function render()
    {
        return view('livewire.product.create.steps.publish-step');
    }
}