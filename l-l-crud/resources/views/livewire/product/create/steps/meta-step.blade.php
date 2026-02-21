<div>
    <form wire:submit="next" class="space-y-6">
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input 
                id="title" 
                wire:model="title" 
                type="text" 
                class="mt-1 block w-full" 
                required 
                autofocus 
            />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea 
                id="description" 
                wire:model="description" 
                rows="4"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required
            ></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button type="submit">
                {{ __('Next Step') }}
            </x-primary-button>
        </div>
    </form>
</div>
