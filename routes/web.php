<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;
use App\Livewire\ResultsPageComponent;

Route::get('/', FormComponent::class);
Route::get('/results-page', ResultsPageComponent::class);
