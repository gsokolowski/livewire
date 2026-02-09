<div class="space-y-6">
    <!-- 3 Column Layout -->
    <div class="grid grid-cols-3 gap-4 p-4">
        <div class="bg-blue-100 p-4 rounded">
            <h2 class="font-bold mb-2">Column 1</h2>
            <p>aaaa</p>
        </div>
        <div class="bg-green-100 p-4 rounded">
            <h2 class="font-bold mb-2">Column 2</h2>
            <p>bbbb</p>
            <!-- Counter Section -->
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">{{ $count }}</h1>
                <div class="space-x-2">
                    <button wire:click="increment" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        +
                    </button>
                    <button wire:click="decrement" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        -
                    </button>
                    <button wire:click="resetCounter" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Reset
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-purple-100 p-4 rounded">
            <h2 class="font-bold mb-2">Column 3</h2>
            <p>cccc</p>
        </div>
    </div>
</div>