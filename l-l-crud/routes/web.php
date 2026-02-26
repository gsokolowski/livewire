<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\CreateStudent;
use App\Livewire\UpdateStudent;
use App\Livewire\ListStudents;
use App\Livewire\Chat\Pages\RoomShow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Livewire\Posts\PostList;

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/students', ListStudents::class)->name('students.index');
    Route::get('/students/create', CreateStudent::class)->name('students.create');
    Route::get('/students/{student}/edit', UpdateStudent::class)->name('students.update');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/files', function () {
        return view('files.index');
    })->name('files.index');

    Route::get('/posts', PostList::class)->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    // url example: /rooms/2
    Route::get('/rooms/{room:slug}', RoomShow::class)->name('rooms.show');
});

require __DIR__.'/auth.php';
