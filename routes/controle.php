<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'controle', 'middleware' => ['auth']], function () {
    Route::get('', [App\Http\Controllers\Controle\DashboardController::class, 'index'])->name('controle.dashboard');
});

