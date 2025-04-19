<?php

use App\Livewire\Welcome;
use App\Livewire\Dashboard;
use App\Livewire\Client\Clients;
use App\Livewire\Product\Products;
use App\Livewire\Appointment\Appointments;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', Dashboard::class);
    Route::get('/dashboard/clients', Clients::class);
    Route::get('/dashboard/products', Products::class);
    Route::get('/dashboard/appointments', Appointments::class);
});
