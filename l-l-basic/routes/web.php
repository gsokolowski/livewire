<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Todo;

Route::get('/', function () {
    return view('welcome');
});

// route to the todo component
Route::get('/todo', Todo::class);