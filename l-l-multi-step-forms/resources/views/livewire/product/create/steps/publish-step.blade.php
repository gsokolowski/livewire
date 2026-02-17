<div>
    @php
        $metaData = $this->getMetaData();
        $imageData = $this->getImageData();
    @endphp

    <div class="space-y-6">
        {{-- Title Section --}}
        <div>
            <x-input-label :value="__('Title')" />
            <div class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-900">
                {{ $metaData['title'] ?? 'N/A' }}
            </div>
        </div>

        {{-- Description Section --}}
        <div>
            <x-input-label :value="__('Description')" />
            <div class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-900 min-h-[100px]">
                {{ $metaData['description'] ?? 'N/A' }}
            </div>
        </div>

        {{-- Main Image Section --}}
        @if (!empty($imageData['image']))
            <div>
                <x-input-label :value="__('Main Image')" />
                <div class="mt-1">
                    @if (is_string($imageData['image']))
                        <img src="{{ asset('storage/' . $imageData['image']) }}" alt="Main Image" class="h-64 w-full object-cover rounded-md border border-gray-300">
                    @else
                        <img src="{{ $imageData['image']->temporaryUrl() }}" alt="Main Image" class="h-64 w-full object-cover rounded-md border border-gray-300">
                    @endif
                </div>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-4">
            <x-secondary-button type="button" wire:click="previousStep">
                {{ __('Previous') }}
            </x-secondary-button>
            <x-primary-button wire:click="publish">
                {{ __('Publish') }}
            </x-primary-button>
        </div>
    </div>
</div>