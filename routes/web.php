<?php

use App\Livewire\Account;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/nueva-operacion', function () {
        return view('new-operation');
    })->name('new-operation');
    Route::get('/datos-del-perfil', Account::class)->name('account');
});
