<?php

use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Signup;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::get('/signup', Signup::class);
Route::get('/login', Login::class)->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', Dashboard::class);
});
