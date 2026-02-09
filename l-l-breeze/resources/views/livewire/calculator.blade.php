<div class="max-w-md mx-auto p-6 bg-gray-100 rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-center">Calculator</h1>
    
    <div class="space-y-4">
        <!-- Input Fields -->
        <div>
            <label class="block mb-1">Number 1:</label>
            <input 
                type="number" 
                wire:model="number1" 
                class="w-full border rounded px-4 py-2"
            >
        </div>
        
        <div>
            <label class="block mb-1">Number 2:</label>
            <input 
                type="number" 
                wire:model="number2" 
                class="w-full border rounded px-4 py-2"
            >
        </div>
        
        <!-- Operation Buttons -->
        <div class="grid grid-cols-4 gap-2">
            <button wire:click="calculate('+')" class="bg-blue-500 text-white px-4 py-2 rounded">
                +
            </button>
            <button wire:click="calculate('-')" class="bg-blue-500 text-white px-4 py-2 rounded">
                -
            </button>
            <button wire:click="calculate('*')" class="bg-blue-500 text-white px-4 py-2 rounded">
                ×
            </button>
            <button wire:click="calculate('/')" class="bg-blue-500 text-white px-4 py-2 rounded">
                ÷
            </button>
        </div>
        
        <!-- Result -->
        <div class="bg-white p-4 rounded text-center">
            <p class="text-sm text-gray-600">Result:</p>
            <p class="text-3xl font-bold">{{ $result }}</p>
        </div>
        
        <!-- Quick Set Examples -->
        <div class="text-center space-x-2">
            <button wire:click="setNumbers(10, 5)" class="bg-gray-500 text-white px-3 py-1 rounded text-sm">
                Set 10 & 5
            </button>
            <button wire:click="setNumbers(20, 4)" class="bg-gray-500 text-white px-3 py-1 rounded text-sm">
                Set 20 & 4
            </button>
        </div>
    </div>
</div>