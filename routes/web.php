<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\{UserForm, UsersInfo};

Route::get('/', UserForm::class);
Route::get('/users/{id}', UsersInfo::class);
