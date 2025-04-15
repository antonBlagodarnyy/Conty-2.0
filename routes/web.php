<?php

use App\Livewire\Dashboard;
use App\Livewire\Client\Clients;
use App\Livewire\Welcome;

use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', Dashboard::class);
    Route::get('/dashboard/clients', Clients::class);
});
