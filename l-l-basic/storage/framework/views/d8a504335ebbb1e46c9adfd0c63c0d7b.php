<div>
    <h1>Todo List</h1>
    <ul>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($todo); ?> <button wire:click="removeTodo(<?php echo e($loop->index); ?>)">Remove</button></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>
    <input type="text" wire:model="todo" placeholder="Add a new todo">
    <button wire:click="addTodo">Add</button>
</div><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/tools/livewire/l-l-basic/resources/views/livewire/todo.blade.php ENDPATH**/ ?>