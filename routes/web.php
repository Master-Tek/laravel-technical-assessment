<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', FormComponent::class);