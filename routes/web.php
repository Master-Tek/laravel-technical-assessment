<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\UserForm;
use App\Livewire\UsersInfo;

Route::get('/', UserForm::class);
Route::get('/users/{id}', UsersInfo::class);
