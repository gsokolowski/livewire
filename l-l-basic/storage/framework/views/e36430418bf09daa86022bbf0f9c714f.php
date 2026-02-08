<div class="max-w-2xl mx-auto p-6 space-y-4">
    <h1 class="text-3xl font-bold mb-6">User Profile Component</h1>
    
    <!-- String Property -->
    <div class="bg-blue-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Name (String):</h2>
        <p class="text-lg"><?php echo e($name); ?></p>
        <button wire:click="updateName('Jane Smith')" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
            Change Name
        </button>
    </div>
    
    <!-- Integer Property -->
    <div class="bg-green-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Age (Integer):</h2>
        <p class="text-lg"><?php echo e($age); ?></p>
        <div class="mt-2 space-x-2">
            <button wire:click="$set('age', <?php echo e($age + 1); ?>)" class="bg-green-500 text-white px-4 py-2 rounded">
                +1 Year
            </button>
            <button wire:click="$set('age', <?php echo e($age - 1); ?>)" class="bg-green-600 text-white px-4 py-2 rounded">
                -1 Year
            </button>
        </div>
    </div>
    
    <!-- Boolean Property -->
    <div class="bg-purple-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Status (Boolean):</h2>
        <p class="text-lg">
            <span class="px-3 py-1 rounded <?php echo e($isActive ? 'bg-green-500 text-white' : 'bg-red-500 text-white'); ?>">
                <?php echo e($isActive ? 'Active' : 'Inactive'); ?>

            </span>
        </p>
        <div class="mt-2 space-x-2">
            <button wire:click="activate" class="bg-green-500 text-white px-4 py-2 rounded">
                Activate
            </button>
            <button wire:click="deactivate" class="bg-red-500 text-white px-4 py-2 rounded">
                Deactivate
            </button>
        </div>
    </div>
    
    <!-- Array Property -->
    <div class="bg-yellow-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Hobbies (Array):</h2>
        <ul class="list-disc list-inside">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $hobbies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($hobby); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
        <button wire:click="addHobby('Swimming')" class="mt-2 bg-yellow-500 text-white px-4 py-2 rounded">
            Add Hobby
        </button>
    </div>
    
    <!-- Two-way Binding with wire:model -->
    <div class="bg-gray-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Email (Two-way Binding):</h2>
        <div class="relative">
            <input 
                type="email" 
                wire:model.live="email"
                placeholder="Enter email (live)"
                class="border rounded px-4 py-2 w-full"
            >
            <span wire:loading wire:target="email" class="absolute right-3 top-2 text-blue-500 text-xs">
                Updating...
            </span>
        </div>
        <p class="mt-2">Current email: <strong><?php echo e($email ?: '(empty)'); ?></strong></p>
        <p class="text-xs text-gray-500 mt-1">
            💡 Type and wait 500ms after stopping - should update then
        </p>
    </div>
    
    <!-- Computed Property -->
    <div class="bg-indigo-50 p-4 rounded">
        <h2 class="font-semibold mb-2">Computed Property:</h2>
        <p class="text-lg"><?php echo e($this->fullInfo); ?></p>
    </div>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/tools/livewire/l-l-basic/resources/views/livewire/user-profile.blade.php ENDPATH**/ ?>