<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controle\{
    DashboardController,
    LivroController,
    PedidoController,
};

Route::prefix('controle')
    ->name('controle.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        // Route::get('livros', [LivroController::class, 'index'])->name('controle.livros.index');
        Route::resource('livros', LivroController::class);
        Route::resource('pedidos', PedidoController::class);
});

