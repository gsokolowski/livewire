<div>
    <form wire:submit="next" class="space-y-6">
        <div>
            <x-input-label for="image" :value="__('Main Image')" />
            <input 
                id="image" 
                wire:model="image" 
                type="file" 
                accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100
                    border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
            
            @if ($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-32 w-32 object-cover rounded-md">
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-4">
            <x-secondary-button type="button" wire:click="previousStep">
                {{ __('Previous') }}
            </x-secondary-button>
            <x-primary-button type="submit">
                {{ __('Next Step') }}
            </x-primary-button>
        </div>
    </form>
</div>